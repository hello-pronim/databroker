<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Provider;
use App\Models\Region;
use App\Models\Company;
use App\Models\Community;
use App\Models\Gallery;
use App\Models\Offer;
use App\Models\Theme;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferProduct;
use App\Models\OfferCountry;
use App\Models\HomeFeaturedProvider;
use App\Models\ProductCountry;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\PaidHistory;
use App\Models\RegionProduct;
use App\Models\UseCase;
use App\Models\Bid;
use App\Models\BillingInfo;
use App\Models\Message;
use App\Models\ApiProductKey;
use App\Models\Transaction;
use App\User;
use App\Models\Business;
use App\Models\Stream;

use Redirect;
use Config;
use File;
use Image;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details(Request $request)
    {   
        $offers = Offer::with(['region', 'provider', 'usecase', 'theme'])                   
                        ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->get();
        $offer = null;
        foreach ($offers as $key => $off) {
            $companyName = str_replace(' ', '', strtolower($off->companyName));
            $reg = $off->region;
            $offer_region = "";
            $offer_title = str_replace(' ', '-', strtolower($off->offerTitle));
            foreach ($reg as $key => $r) {
                $offer_region = $offer_region . str_replace(' ', '-', strtolower($r->regionName));
                if($key+1 < count($reg)) $offer_region = $offer_region . "-";
            }
            if($request->companyName == $companyName && $request->param == $offer_title.'-'.$offer_region){
                $offer = $off;
                break;
            }
        }

        if(!$offer) return view('errors.404');

        $user_info = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                            ->where('users.userIdx', $offer->provider->userIdx)
                            ->first();
        
        $offersample = OfferSample::with('offer')->where('offerIdx', $offer->offerIdx)->where('deleted', 0)->get();
        
        $prev_route = "";        
        if( parse_url(url()->previous(), PHP_URL_HOST ) ==  parse_url(Config::get('app.url'), PHP_URL_HOST ) ){
            $prev_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        }
        
        
        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $offer->offerIdx)->where("productStatus", 1)->get();

        if(  $prev_route && strpos($prev_route, 'data_community.') === false ){
            $prev_route = '';
        }

        if ($offer['offerImage']) {                           
            if (strpos($offer['offerImage'], 'media_') === false ) {                           
                $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
            }else{
                $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
            }
        }    
            
        $data = array('id'=>$offer->offerIdx, 'offer' => $offer, 'offersample' => $offersample, 'prev_route' => $prev_route, 'user_info' => $user_info, 'products' => $products);
        return view('data.details')->with($data);        
    }

    public function offers(Request $request){       
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'publish your data offer');
        }
        else{
            $provider = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
            if(!$provider)
                return redirect(route('data_offer_start'));
            $regions = Region::where('regionType', 'area')->get();
            $countries = Region::where('regionType', 'country')->get();
            $communities = Community::all();
            $themes = Theme::all();
            $theme_map = [];
            foreach ($themes as $theme) {
                $idx = $theme['communityIdx'];
                $themeIdx = $theme['themeIdx'];
                $name = $theme['themeName'];
                $text = $theme['themeText'];

                $theme_map[$idx][] = ['id' => $themeIdx, 'name' => $name, 'text' => $text];
            }
            $theme_json = json_encode($theme_map);

            $gallery = Gallery::join('communities', 'communities.communityIdx', '=', 'gallery.content')->where('category', 'community')->get();
            $gallery_map = [];
            foreach ($gallery as $g_row) {
                $id = $g_row['id'];
                $category = $g_row['category'];
                $content = $g_row['content'];
                $communityName = $g_row['communityName'];
                $subcontent = $g_row['subcontent'];
                $sequence = $g_row['sequence'];
                $path = $g_row['path'];
                $thumb = $g_row['thumb'];

                if (!isset($gallery_map[$content]))
                    $gallery_map[$content] = [];
                if (!isset($gallery_map[$content][$subcontent]))
                    $gallery_map[$content][$subcontent] = [];
                $gallery_map[$content][$subcontent][$sequence] = ['id' => $id, 'community'=>$content, 'communityName'=>$communityName, 'url' => $path, 'thumb' => $thumb];
                //$gallery_map[$content][$sequence] = ['id' => $id, 'url' => $path, 'thumb' => $thumb];
            }

            // die(json_encode($gallery_map));

            $data = array( 'regions', 'countries', 'communities', 'theme_json', 'gallery_map' );
            return view('data.offers', compact($data));
        }
    }

    public function offers_overview(Request $request){                
        $offers = Offer::getProduct(Auth::id());

        $data = array( 'offers' );
        return view('data.offers_overview', compact($data));
    }

    public function offer_publish(Request $request){
        
        $communities = Community::get();

        $data = array('communities');
        return view('data.offer_publish', compact($data)); 
    }

    public function offer_edit($id, Request $request)
    {
        $offerIdx = $id;
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $communities = Community::all();

        $user = $this->getAuthUser();

        $offerId = $id;
        $offer = Offer::with(['region', 'theme'])->where('offers.offerIdx', '=', $id)->first();

        if(!$offer) return view('errors.404');
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = route('data_community.'.$community_route);

        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $id)->get();

        $regionCheckList = [];
        foreach ($offer['region'] as $o_region) {
            $regionIdx = $o_region['regionIdx'];
            $regionCheckList[$regionIdx] = $o_region['regionName'];
        }

        $themeCheckList = [];
        foreach ($offer['theme'] as $o_theme) {
            $themeIdx = $o_theme['themeIdx'];
            $themeCheckList[$themeIdx] = $o_theme['themeName'];
        }

        $usecase = UseCase::where('offerIdx', $offerId)->first();

        //$offer_path = URL::to('/uploads/offer');
        
        $offer_images = [$offer['offerImage']];
        if($offer['offerImage']){        
            if (strpos($offer['offerImage'], 'media_') !== false ) {
                $offer_path = URL::to('/images/gallery/thumbs/medium');
            }else{
                $offer_path = URL::to('/uploads/offer/medium');    
            }
        }

        $offersample_path = URL::to('/uploads/offersample');
     
        $sample_files = OfferSample::where('offerIdx', $offerIdx)
            ->where('sampleType', 'like', 'file-%')
            ->where('deleted', 0)
            ->orderby('sampleIdx')
            ->pluck('sampleFileName')
            ->toArray();
            
        $sample_images = OfferSample::where('offerIdx', $offerIdx)
            ->where('sampleType', 'like', 'image-%')
            ->where('deleted', 0)
            ->orderby('sampleIdx')
            ->pluck('sampleFileName')
            ->toArray();

        $themes = Theme::all();
        $theme_map = [];
        foreach ($themes as $theme) {
            $idx = $theme['communityIdx'];
            $themeIdx = $theme['themeIdx'];
            $name = $theme['themeName'];
            $text = $theme['themeText'];

            $theme_map[$idx][] = ['id' => $themeIdx, 'name' => $name, 'text' => $text];
        }
        // die(json_encode($theme_map));
        // die(json_encode($offer));
        $theme_json = json_encode($theme_map);

        $gallery = Gallery::join('communities', 'communities.communityIdx', '=', 'gallery.content')->where('category', 'community')->get();
        $gallery_map = [];
        foreach ($gallery as $g_row) {
            $id = $g_row['id'];
            $category = $g_row['category'];
            $content = $g_row['content'];
            $communityName = $g_row['communityName'];
            $subcontent = $g_row['subcontent'];
            $sequence = $g_row['sequence'];
            $path = $g_row['path'];
            $thumb = $g_row['thumb'];

            if (!isset($gallery_map[$content]))
                $gallery_map[$content] = [];
            if (!isset($gallery_map[$content][$subcontent]))
                $gallery_map[$content][$subcontent] = [];
            $gallery_map[$content][$subcontent][$sequence] = ['id' => $id, 'community'=>$content, 'communityName'=>$communityName, 'url' => $path, 'thumb' => $thumb];

        }
        if(isset($offer_path))
            $data = array( 'offerIdx', 'regions', 'countries', 'communities', 'offer', 'products', 'id', 'link_to_market', 'regionCheckList', 'usecase', 'sample_files', 'sample_images', 'offersample_path', 'offer_path', 'offer_images', 'theme_json', 'themeCheckList', 'gallery_map' );
        else
            $data = array( 'offerIdx', 'regions', 'countries', 'communities', 'offer', 'products', 'id', 'link_to_market', 'regionCheckList', 'usecase', 'sample_files', 'sample_images', 'offersample_path', 'offer_images', 'theme_json', 'themeCheckList', 'gallery_map' );
        // die(json_encode(compact($data)));
        return view('data.offers', compact($data));
    }

    public function offer_detail($id, Request $request)
    {   
        $offerId = $id;
        $offer = Offer::with(['region'])->where('offers.offerIdx', '=', $id)->first();

        if(!$offer) return view('errors.404');
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = '/data/'.$id;

        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $id)->orderby('updated_at', 'DESC')->get();

        $user = $this->getAuthUser();  
        $userObj = User::where('userIdx', $user->userIdx)->get()->first();
        $walletAddress = $userObj->wallet;
        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/dxc/getfor/".$walletAddress;
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $response = json_decode($response->getBody()->getContents());
        $dxcs = $response->dxcs;

        $data = array( 'offer', 'products', 'id', 'link_to_market', 'dxcs' );
        return view('data.offer_detail', compact($data));
    }

    public function offer_theme_filter(Request $request){

        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        $per_page = 11;
        
        foreach ($communities as $key => $community) {
            if(str_replace( ' ', '_', strtolower($community->communityName)) == $request->community)
                $category = $community->communityName;
        }
        $curTheme = Theme::where('themeIdx', $request->theme)->get()->first();
        session(['curCommunity'=>$category]);

        $dataoffers = Offer::with(['region', 'provider'])
            ->leftjoin('offerThemes', 'offerThemes.offerIdx', '=',  'offers.offerIdx')
            ->leftjoin('themes', 'themes.themeIdx', '=',  'offerThemes.themeIdx')                    
            ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
            ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
            ->where('communities.communityName', ucfirst($category))
            ->where('offers.status', 1)
            ->orderby('offers.offerIdx', 'DESC')
            ->get();
        $dataoffer = array();
        foreach ($dataoffers as $key => $doffer) {
            if(str_replace( ' ', '-', strtolower($doffer->themeName))==$request->theme)
                array_push($dataoffer, $doffer);
        }
        $dataoffer = array_slice($dataoffer, 0, $per_page);

        $total = Offer::with(['region', 'provider'])
                    ->leftjoin('offerThemes', 'offerThemes.offerIdx', '=',  'offers.offerIdx')
                    ->leftjoin('themes', 'themes.themeIdx', '=',  'offerThemes.themeIdx')                    
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->get();
        $totalcount = 0;
        foreach ($total as $key => $doffer) {
            if(str_replace( ' ', '-', strtolower($doffer->themeName))==$request->theme)
                $totalcount++;
        }
        
        foreach ($dataoffer as $key => $offer) {
            if ($offer['offerImage']) {                           
                if (strpos($offer['offerImage'], 'media_') === false ) {                           
                    $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
                }else{
                    $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
                }
            }    
            $dataoffer[$key]=$offer;
        }   

        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page', 'curTheme' );                
        return view('data.category', compact($data));
    }

    public function company_offers(Request $request){
        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        $per_page = 11;

        $companies = Company::get();
        $company = null;
        foreach ($companies as $key => $comp) {
            if($request->companyName==str_replace(' ', '-', strtolower($comp->companyName))){
                $company = $comp;
                break;
            }
        }
        if(!$company) return view('errors.404');

        $dataoffer = Offer::with(['region'])
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->leftjoin('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->leftjoin('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->leftjoin('companies', 'users.companyIdx', '=', 'companies.companyIdx')
                    ->where('users.companyIdx', $company->companyIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')            
                    ->limit($per_page)
                    ->distinct('offers')
                    ->get();

        $totalcount = Offer::with(['region'])                   
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->leftjoin('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->leftjoin('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->leftjoin('companies', 'users.companyIdx', '=', 'companies.companyIdx')
                    ->where('users.companyIdx', $company->companyIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->distinct('offers')
                    ->get()
                    ->count();

        foreach ($dataoffer as $key => $offer) {
            if ($offer['offerImage']) {                           
                if (strpos($offer['offerImage'], 'media_') === false ) {                           
                    $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
                }else{
                    $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
                }
            }
            $dataoffer[$key]=$offer;
        }                    
        $data = array('company', 'dataoffer', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page' );                
        return view('data.company_offers', compact($data));
    }

    public function offer_region_filter(Request $request){

        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        $per_page = 11;
        
        foreach ($communities as $key => $community) {
            if(str_replace( ' ', '_', strtolower($community->communityName)) == $request->community)
                $category = $community->communityName;
        }
        $curTheme = Theme::where('themeIdx', $request->theme)->get()->first();
        session(['curCommunity'=>$category]);

        $dataoffers = Offer::with(['region', 'provider', 'usecase'])
                            ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                            ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                            ->where('communities.communityName', ucfirst($category))
                            ->where('offers.status', 1)
                            ->orderby('offers.offerIdx', 'DESC')
                            ->distinct('offers.offerIdx')
                            ->get();
        $dataoffer = array();
        foreach ($dataoffers as $key => $doffer) {
            $regs = $doffer->region;
            foreach ($regs as $key => $reg) {
                if(str_replace( ' ', '-', strtolower($reg->regionName))==$request->regionName)
                    array_push($dataoffer, $doffer);
            }
        }
        $dataoffer = array_slice($dataoffer, 0, $per_page);

        $total = Offer::with(['region', 'provider', 'usecase'])
                    ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->distinct('offers.offerIdx')
                    ->get();
        $totalcount = 0;
        foreach ($total as $key => $doffer) {
            $regs = $doffer->region;
            foreach ($regs as $key => $reg) {
                if($reg->regionIdx==$request->regionIdx)
                    $totalcount++;
            }
        }

        foreach ($dataoffer as $key => $offer) {
            if ($offer['offerImage']) {                           
                if (strpos($offer['offerImage'], 'media_') === false ) {                           
                    $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
                }else{
                    $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
                }
            }    
            $dataoffer[$key]=$offer;
        }                       
        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page', 'curTheme' );                
        return view('data.category', compact($data));
    }

    public function add_offer(Request $request){
        $user = $this->getAuthUser();
        $providerIdx = -1;
        $provider_obj = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if ($provider_obj) {
            $providerIdx = $provider_obj['providerIdx'];

            $offer_data = [];
            $offerImage_path = public_path('uploads/offer');

            $offer_data['offerTitle'] = $request->offerTitle;
            $offer_data['offerDescription'] = $request->offerDescription;
            $offer_data['communityIdx'] = $request->communityIdx;
            $offer_data['providerIdx'] = $providerIdx;
            $offer_data['status'] = '1';

            $offerCount = Offer::where('providerIdx', $providerIdx)->get()->count();
            $offer_obj = Offer::create($offer_data);
            if($offerCount==0){//pipeDrive api integration(data provider case)
                $userObj = User::join('providers', 'providers.userIdx', '=', 'users.userIdx')
                                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                ->join('regions', 'regions.regionIdx', '=', 'companies.regionIdx')
                                ->where('users.userIdx', $user->userIdx)
                                ->get()
                                ->first()
                                ->toArray();
                $query['user_type'] = "data_provider";
                $query['firstname'] = $userObj['firstname'];
                $query['lastname'] = $userObj['lastname'];
                $query['email'] = $userObj['email'];
                $query['companyName'] = $userObj['companyName'];
                $query['businessName'] = $userObj['businessName'];
                $query['role'] = $userObj['role'];
                $query['jobTitle'] = $userObj['jobTitle'];
                $query['region'] = $userObj['regionName'];
                $query['companyURL'] = $userObj['companyURL'];
                $query['companyVAT'] = $userObj['companyVAT'];
                $client = new \GuzzleHttp\Client();
                $url = "https://prod-107.westeurope.logic.azure.com:443/workflows/bdf7e02c893d426c8f8e101408d30471/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=RvoLkDUgsGbKOUk8oorOUrhXpjcSIdf1_29oSPDA-Tw";
                $response = $client->request("POST", $url, [
                    'headers'=> ['Content-Type' => 'application/json'],
                    'body'=> json_encode($query)
                ]);
            }
            $offerIdx = $offer_obj['offerIdx'];

            $offerimagefile = $request->file('offerImage_1');
            if ($offerimagefile != null) {
                $fileName = "offer_".$offerIdx.'.'.$offerimagefile->extension();                

                $tinyimg = Image::make($offerimagefile->getRealPath());
                $tinyimg->fit(1200,800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/large/". $fileName);      

                $tinyimg->fit(750,500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/medium/".$fileName);
                
                $tinyimg->fit(300,200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/tiny/" . $fileName);

                $tinyimg->fit(60,40, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/thumb/". $fileName);                

                $ret = $offerimagefile->move($offerImage_path, $fileName);                
                $offer_data['offerImage'] = $fileName;       

            } else {  
                $fileName = $request->input('gallery_offerImage_1');
                $offer_data['offerImage'] =  basename( $fileName );
            }
            
            Offer::where('offerIdx', $offerIdx)->update(array( "offerImage" => $fileName ));        

            $offercountry_data = [];

            $offercountry_data['offerIdx'] = $offerIdx;
            $offercountry = explode(',', $request->offercountry);
            if( count( $offercountry ) > 0 ){
                for( $i=0; $i< count($offercountry); $i++ ){
                    $offercountry_data['regionIdx'] = $offercountry[$i];
                    OfferCountry::create($offercountry_data);
                }            
            }else{
                $offercountry_data['regionIdx'] = $offercountry;
                OfferCountry::create($offercountry_data);
            }

            $offertheme_data = [];
            $offertheme_data['offerIdx'] = $offerIdx;
            $theme_list = explode(',', $request->offertheme);
            if( count( $theme_list ) > 0 ){
                for( $i=0; $i< count($theme_list); $i++ ){
                    $offertheme_data['themeIdx'] = $theme_list[$i];
                    OfferTheme::create($offertheme_data);
                }            
            }else{
                $offertheme_data['themeIdx'] = $theme_list;
                OfferTheme::create($offertheme_data);
            }
            
            $usercase_data = [];

            if($request->useCaseContent !=""){
                $usercase_data['offerIdx'] = $offerIdx;
                $usercase_data['useCaseContent'] = $request->useCaseContent;
                $usecase_obj = UseCase::create($usercase_data);    
            }        

            $offersample_data =[];

            $offersample_path = public_path('uploads/offersample');
            $offersample_data['offerIdx'] = $offerIdx;
            
            $i =1;        
            while( $request->file('offersample_files_'.$i) != null ){        
                $extension = $request->file('offersample_files_'.$i)->extension();
                $fileName = pathinfo($request->file('offersample_files_'.$i)->getClientOriginalName(), PATHINFO_FILENAME)."_".date('Ymd').'.'.$extension;
                
                $request->file('offersample_files_'.$i)->move($offersample_path, $fileName);

                $offersample_data['sampleFileName'] = $fileName;
                $offersample_data['sampleType'] = "file-".$extension;
                OfferSample::create($offersample_data);    
                $i++;
            }

            $i =1;
            while( $request->file('offersample_images_'.$i) != null ){
                $extension = $request->file('offersample_images_'.$i)->extension();
                $fileName = pathinfo($request->file('offersample_images_'.$i)->getClientOriginalName(), PATHINFO_FILENAME)."_".date('Ymd').'.'.$extension;
                
                $request->file('offersample_images_'.$i)->move($offersample_path, $fileName);

                $offersample_data['sampleFileName'] = $fileName;
                $offersample_data['sampleType'] = "image-".$extension;
                OfferSample::create($offersample_data);    
                $i++;
            }        

            return response()->json(array( "success" => true, 'redirect' => route('data_offer_publish_confirm', ['id'=>$offerIdx]) ));
        }
        else return response()->json(array( "success" => false, 'redirect' => route('data_offer_provider') ));
    }

    public function update_offer($id, Request $request){
        $user = $this->getAuthUser();
        $providerIdx = -1;
        $provider_obj = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if ($provider_obj) {
            $providerIdx = $provider_obj['providerIdx'];

            $offer_data = [];
            $offerImage_path = public_path('uploads/offer');

            $offer_data['offerTitle'] = $request->offerTitle;
            $offer_data['offerDescription'] = $request->offerDescription;
            $offer_data['communityIdx'] = $request->communityIdx;
            $offer_data['providerIdx'] = $providerIdx;
            $offer_data['themes'] = $request->offertheme;

            $offerIdx = $id;
            $offerimagefile = $request->file('offerImage_1');
            if ($offerimagefile != null) {
                $fileName = "offer_".$offerIdx.'.'.$offerimagefile->extension();                

                $tinyimg = Image::make($offerimagefile->getRealPath());
                $tinyimg->fit(1200,800, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/large/". $fileName);      

                $tinyimg->fit(750,500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/medium/".$fileName);
                
                $tinyimg->fit(300,200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/tiny/" . $fileName);

                $tinyimg->fit(60,40, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($offerImage_path . "/thumb/". $fileName);

                $ret = $offerimagefile->move($offerImage_path, $fileName);
                $offer_data['offerImage'] =  $fileName;
                
            } else {
                $fileName = $request->input('gallery_offerImage_1');
                $offer_data['offerImage'] = basename( $fileName );
            }

            Offer::find($id)->update($offer_data);
            
            $offercountry_data = [];
            OfferCountry::where('offerIdx', $offerIdx)->delete();
            $offercountry_data['offerIdx'] = $offerIdx;
            $offercountry = explode(',', $request->offercountry);
            if( count( $offercountry ) > 0 ){
                for( $i=0; $i< count($offercountry); $i++ ){
                    $offercountry_data['regionIdx'] = $offercountry[$i];
                    OfferCountry::create($offercountry_data);
                }            
            }else{
                $offercountry_data['regionIdx'] = $offercountry;
                OfferCountry::create($offercountry_data);
            }

            $offertheme_data = [];
            OfferTheme::where('offerIdx', $offerIdx)->delete();
            $offertheme_data['offerIdx'] = $offerIdx;
            $theme_list = explode(',', $request->offertheme);
            if( count( $theme_list ) > 0 ){
                for( $i=0; $i< count($theme_list); $i++ ){
                    $offertheme_data['themeIdx'] = $theme_list[$i];
                    OfferTheme::create($offertheme_data);
                }            
            }else{
                $offertheme_data['themeIdx'] = $theme_list;
                OfferTheme::create($offertheme_data);
            }
            
            $usercase_data = [];

            $usercase_data['useCaseContent'] = $request->useCaseContent;
            UseCase::where('offerIdx', $offerIdx)->update($usercase_data);

            $i =1;        
            while( ($fileName = $request->input('removed_offersample_files_'.$i)) != null ){ 
                OfferSample::where('offerIdx', $offerIdx)
                    ->where('sampleFileName', $fileName)
                    ->update(['deleted' => 1]);
                $i++;
            }

            $i =1;
            while( ($fileName = $request->input('removed_offersample_images_'.$i)) != null ){          
                OfferSample::where('offerIdx', $offerIdx)
                    ->where('sampleFileName', $fileName)
                    ->update(['deleted' => 1]);
                $i++;
            }
            

            $offersample_data =[];
            $offersample_data['offerIdx'] = $offerIdx;
            $offersample_path = public_path('uploads/offersample');
            $i =1;        
            while( $request->file('offersample_files_'.$i) != null ){        
                $extension = $request->file('offersample_files_'.$i)->extension();
                $fileName = pathinfo($request->file('offersample_files_'.$i)->getClientOriginalName(), PATHINFO_FILENAME)."_".date('Ymd').'.'.$extension;
                
                $request->file('offersample_files_'.$i)->move($offersample_path, $fileName);

                $offersample_data['sampleFileName'] = $fileName;
                $offersample_data['sampleType'] = "file-".$extension;
                OfferSample::create($offersample_data);    
                $i++;
            }

            $i =1;
            while( $request->file('offersample_images_'.$i) != null ){
                $extension = $request->file('offersample_images_'.$i)->extension();
                $fileName = pathinfo($request->file('offersample_images_'.$i)->getClientOriginalName(), PATHINFO_FILENAME)."_".date('Ymd').'.'.$extension;
                
                $request->file('offersample_images_'.$i)->move($offersample_path, $fileName);

                $offersample_data['sampleFileName'] = $fileName;
                $offersample_data['sampleType'] = "image-".$extension;
                OfferSample::create($offersample_data);    
                $i++;
            }

            return response()->json(array( "success" => true, 'redirect' => route('data_offer_update_confirm', ['id'=>$offerIdx]) ));
        } else 
            return response()->json(array( "success" => false, 'redirect' => route('data_offer_provider') ));
    }

    public function offer_add_product($offerIdx , Request $request) {        
        $offer = Offer::with(['region'])->where('offers.OfferIdx', $offerIdx)->first();
        if(!$offer) return view('errors.404');
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();

        $user = $this->getAuthUser();  
        $userObj = User::where('userIdx', $user->userIdx)->get()->first();
        $walletAddress = $userObj->wallet;
        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/dxc/getfor/".$walletAddress;
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $response = json_decode($response->getBody()->getContents());
        $dxcs = $response->dxcs;

        $data = array( 'countries', 'offer', 'regions', 'dxcs' );
        return view('data.offer_add_product', compact($data));
    }

    public function offer_edit_product($id, $pid, Request $request) {   
        $offerId = $id;
        $offer = Offer::with(['region'])->where('offers.offerIdx', '=', $id)->first();

        if(!$offer) return view('errors.404');
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = route('data_community.'.$community_route);

        // $product = OfferProduct::with(['region'])->where('offerIdx', $id)->where('productIdx', $pid)->get();
        $product = OfferProduct::with(['region'])->find($pid);

        $regionCheckList = [];
        foreach ($product['region'] as $p_region) {
            $regionIdx = $p_region['regionIdx'];
            $regionCheckList[$regionIdx] = $p_region['regionName'];
        }

        $prodTypeList = ['File', 'Api flow', 'Stream'];
        $bidTypes = [
            ['type'=>'free', 'label' => 'Free', 'biddable' => false],
            ['type'=>'no_bidding', 'label' => 'I will set a price. No bidding is possible.', 'biddable' => true],
            ['type'=>'bidding_possible', 'label' => 'I will set a price, but buyers can also send bids.', 'biddable' => true],
            ['type'=>'bidding_only', 'label' => 'I will not set a price. Interested parties can send bids.', 'biddable' => false],
        ];
        $accessPeriodList = [
            ['key' => 'day', 'label' => '1 day'],
            ['key' => 'week', 'label' => '1 week'],
            ['key' => 'month', 'label' => '1 month'],
            ['key' => 'year', 'label' => '1 year'],
        ];

        $user = $this->getAuthUser();  
        $userObj = User::where('userIdx', $user->userIdx)->get()->first();
        $walletAddress = $userObj->wallet;
        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/dxc/getfor/".$walletAddress;
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $response = json_decode($response->getBody()->getContents());
        $dxcs = $response->dxcs; 
        // var_dump($dxcs);
        // exit;

        $data = array( 'offer', 'product', 'id', 'pid', 'link_to_market', 'countries', 'regions', 'regionCheckList', 'prodTypeList', 'accessPeriodList', 'bidTypes', 'dxcs' );
        return view('data.offer_edit_product', compact($data));
    }

    public function offer_submit_product(Request $request) {
        $product_data = [];

        $isEditMode = false;
        if (isset($request->productIdx)) {
            //update product
            $productIdx = $request->productIdx;
            $isEditMode = true;
        } else {
            $product_data['offerIdx'] = $request->offerIdx;
        }
        $product_data['productType'] = $request->format;
        $product_data['productBidType'] = $request->period;
        $period = $product_data['productBidType'].'_period';
        $price = $product_data['productBidType'].'_price';
        $product_data['productAccessDays'] = $request->$period;        
        if( $request->period == "no_bidding" || $request->period == "bidding_possible" ){
            $product_data['productPrice'] = $request->$price;
        }else if($request->period == 'free')
            $product_data['productUrl'] = $request->dataUrl;
        $product_data['dxc'] = $request->dxc;
        $product_data['did'] = $request->did;
        $product_data['productMoreInfo'] = $request->productMoreInfo;
        $product_data['productTitle'] = $request->productTitle;
        $product_data['productLicenseUrl'] = $request->licenceUrl;
        $product_data['productStatus'] = 1;

        if ($isEditMode) {
            OfferProduct::find($productIdx)->update($product_data);
        } else {
            $offer_obj = OfferProduct::create($product_data);
            $productIdx = $offer_obj['productIdx'];
        }

        $productcountry_data = [];
        $productcountry_data['productIdx'] = $productIdx;
        $country = explode(',', $request->offercountry);

        if ($isEditMode) {
            RegionProduct::where('productIdx', $productIdx)->delete();
        }
        if( count( $country ) > 0 ){
            for( $i=0; $i< count($country); $i++ ){
                $productcountry_data['regionIdx'] = $country[$i];
                RegionProduct::create($productcountry_data);
            }
        }else{
            $productcountry_data['regionIdx'] = $country;
            RegionProduct::create($productcountry_data);
        }
        
        $offerid = $request->offerIdx;
        if ($isEditMode) {
            return response()->json(array( "success" => true, 'offerid' => $offerid, 'productIdx' => $productIdx, 'redirect' => route('data_offer_product_update_confirm', ['id'=>$offerid, 'pid'=>$productIdx]) ));
        } else {
            //add product confirmation
            return response()->json(array( "success" => true, 'offerid' => $offerid, 'productIdx' => $productIdx, 'redirect' => route('data_offer_product_publish_confirm', ['id'=>$offerid, 'pid'=>$productIdx]) ));
        }
    }

    public function category($category=""){

        session(['curCommunity'=>$category]);

        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        $per_page = 11;

        $dataoffer = Offer::with(['region', 'provider', 'usecase'])
                ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                ->where('communities.communityName', ucfirst($category))
                ->where('offers.status', 1)
                ->orderby('offers.offerIdx', 'DESC')
                ->limit($per_page)
                ->get();
        $totalcount = Offer::join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                ->where('communities.communityName', ucfirst($category))
                ->where('offers.status', 1)
                ->get()
                ->count();
        
        foreach ($dataoffer as $key => $offer) {
            if ($offer['offerImage']) {                           
                if (strpos($offer['offerImage'], 'media_') === false ) {                           
                    $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
                }else{
                    $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
                }
            }    

            $dataoffer[$key]=$offer;            
        }   
                
        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page' );                
        return view('data.category', compact($data));

    }

    public function get_all_themes(){
        $themes = Theme::get();
        $result = array('themes' => $themes);
        return $result;
    }

    public function community($community=""){         

        session(['curCommunity'=>$community]);

        $offers = Offer::with(['region', 'provider', 'usecase'])
            ->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
            ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
            ->where('communities.communityName', ucfirst($community))
            ->where('offers.status', 1)
            ->limit(3)
            ->get();
        $featured_providers = HomeFeaturedProvider::join('providers', 'providers.providerIdx', '=', 'home_featured_provider.providerIdx')
                                            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                            ->where('active', 1)
                                            ->orderby('order', 'asc')
                                            ->limit(6)
                                            ->get();

        $themes = Theme::get_theme_by_community($community);
        
        $data = array( 'community', 'offers', 'themes', 'featured_providers' );                
        return view('data.community', compact($data));
    }    

    public function filter_offer(Request $request){

        $dataoffer = Offer::filter_offer($request);
        
        $temp = array();
        foreach ($dataoffer["offers"] as $key => $offer) {
        
            if ($offer['offerImage']) {                           
                if (strpos($offer['offerImage'], 'media_') === false ) {                           
                    $offer['offerImage'] = '/uploads/offer/medium/'.$offer['offerImage'];    
                }else{
                    $offer['offerImage'] = '/images/gallery/thumbs/medium/'.$offer['offerImage'];    
                }
            }        

            if(!File::exists(public_path( $offer["offerImage"]))){
                $offer["offerImage"] = null;
            }      
            array_push($temp, $offer);      
        }

        $dataoffer["offers"] = $temp;        
        return response()->json($dataoffer);
    }

    public function offer_publish_confirm($id, Request $request){
        $offerId = $id;
        $offer = Offer::find($id);
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        // $offer_plain = json_encode($offer);
        // $community_plain = json_encode($community);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = route('data_details', ['id'=>$offerId]);

        $data = array( 'offerId', 'link_to_market' ); //, 'offer_plain', 'community_plain'
        return view('data.offer_publish_confirm', compact($data));
    }

    public function offer_update_confirm($id, Request $request){
        $offerId = $id;
        $offer = Offer::find($id);
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        // $offer_plain = json_encode($offer);
        // $community_plain = json_encode($community);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = '/data/'.$id;
        $title = $offer['offerTitle'];

        $data = array( 'offerId', 'link_to_market', 'title' ); //, 'offer_plain', 'community_plain'
        return view('data.offer_update_confirm', compact($data));
    }

    public function offer_start(Request $request){
        $user = $this->getAuthUser();
        if($user){
            $offer = Offer::join('providers', 'offers.providerIdx', '=',  'providers.providerIdx')
                    ->where('providers.userIdx', $user->userIdx )->get()->count();
            if( $offer > 0 )
                return redirect( route('data_offers') );
        }

        return view('data.offer_publish_first');    
    }    

    public function offer_second(Request $request){
        $user = $this->getAuthUser();
        if($user){
            $offer = Offer::join('providers', 'offers.providerIdx', '=',  'providers.providerIdx')
                    ->where('providers.userIdx', $user->userIdx )->get()->count();
            if( $offer > 0 ) return redirect( route('data_offers') );
        }    
        return view('data.offer_publish_second');
    }        

    public function offer_provider(Request $request){
        $user = $this->getAuthUser();
        if(!$user){
            return redirect('/login');
        }else{
            $provider = Provider::where('userIdx', $user->userIdx)->first();
            if($provider)
                return redirect( route('data_offers') );
            else{
                //$regions = Region::where('regionType', 'area')->get();
                $countries = Region::where('regionType', 'country')->get();
                //$communities = Community::all();
                
                $company = Company::where('companyIdx', $user->companyIdx)->first();
                $data = array('user', 'countries', 'company');

                return view('data.offer_provider', compact($data));
            }
        }
    }

    public function save_offer_provider(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'companyName' => ['required', 'string', 'max:255'],
            'regionIdx' => ['required', 'integer'],
            'companyURL' => ['required', 'string', 'max:255', "regex: #[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si"],
            'companyVAT'=>['required'],
            'companyLogo'=>['required']
        ];
        $messages = [
            'companyName.required'=>'The company name is required.',
            'regionIdx.required'=>'The region is required.',
            'companyURL.required'=>'The company url is required.',
            'companyURL.regex'=>'The url format is is invalid.',
            'companyVAT.required'=>'The company VAT number is required.',
            'companyLogo.required'=>'The company logo is required.'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            if($request->providerCompanyLogo)
                return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
            else
                return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }

        $provider_data = [];
        $providerCompanyLogo_path = public_path('uploads/company');
        
        $providerIdx = -1;
        $provider_obj = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if (!$provider_obj) {
            $provider_data['userIdx'] = Auth::id();
            $provider_data['regionIdx'] = $request->regionIdx;
            $provider_data['companyName'] = $request->companyName;
            $provider_data['companyURL'] = $request->companyURL;
            $provider_data['companyVAT'] = $request->companyVAT;
            $provider_data['companyLogo'] = $request->companyLogo;

            $provider_obj = Provider::create($provider_data);

            $providerIdx = $provider_obj['providerIdx'];  

            if($request->file('companyLogo_1')!= null){
                $fileName = "company_".$providerIdx.'.'.$request->file('companyLogo_1')->extension();
                $request->file('companyLogo_1')->move($providerCompanyLogo_path, $fileName);
                $provider_data['companyLogo'] = $fileName;
                
                Provider::where('providerIdx', $providerIdx)->update(array( "companyLogo" => $fileName ));    
            }

            if($request->companyIdx!=0){
                $companyObj=Company::where('companyIdx', '=', $request->companyIdx)->update([
                    'regionIdx'=>$request->regionIdx,
                    'companyURL'=>$request->companyURL,
                    'companyVAT'=>$request->companyVAT,
                    'companyLogo'=>$provider_data['companyLogo']
                ]);
            }
        }
        if($request->file('companyLogo_1')!= null)
            return response()->json(array( "success" => true, 'redirect' => route('data_offer_second') ));
        else 
            return redirect(route('data_offer_second'));
    }

    public function offer_product_publish_confirm($id, $pid, Request $request){
        $offer = Offer::with(['region'])->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->where('offerIdx', '=', $id)
                        ->first();
        $providerIdx = $offer['providerIdx'];
        $communityIdx = $offer['communityIdx'];
        $userIdx = Provider::where('providerIdx', '=', $providerIdx)->first()['userIdx'];
        $companyIdx = User::where('userIdx', '=', $userIdx)->first()['companyIdx'];
        $datetime = time();
        $rnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 12);

        $companyIdx = base_convert($companyIdx, 10, 26);
        $communityIdx = base_convert($communityIdx, 10, 26);
        $companyIdx = str_pad($companyIdx, 5, '0', STR_PAD_LEFT);
        $communityIdx = str_pad($communityIdx, 5, '0', STR_PAD_LEFT);
        $uniqueId = $companyIdx . $communityIdx . $datetime . $rnd;

        OfferProduct::where('productIdx', $pid)->update(['uniqueProductIdx'=>$uniqueId]);

        $data = array('id', 'uniqueId', 'offer');
        return view('data.offer_product_publish_confirm', compact($data));
    }        

    public function offer_product_update_confirm($id, $pid, Request $request){
        $offer = Offer::with(['region'])->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->where('offerIdx', '=', $id)
                        ->first();
        $product = OfferProduct::find($pid);
        $offerTitle = $offer['offerTitle'];
        $productTitle = $product['productTitle'];

        $uniqueId = $product->uniqueProductIdx;
        if(!$uniqueId){
            $offer = Offer::where('offerIdx', '=', $id)->first();
            $providerIdx = $offer['providerIdx'];
            $communityIdx = $offer['communityIdx'];
            $userIdx = Provider::where('providerIdx', '=', $providerIdx)->first()['userIdx'];
            $companyIdx = User::where('userIdx', '=', $userIdx)->first()['companyIdx'];
            $datetime = time();
            $rnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 12);

            $companyIdx = base_convert($companyIdx, 10, 26);
            $communityIdx = base_convert($communityIdx, 10, 26);
            $companyIdx = str_pad($companyIdx, 5, '0', STR_PAD_LEFT);
            $communityIdx = str_pad($communityIdx, 5, '0', STR_PAD_LEFT);
            $uniqueId = $companyIdx . $communityIdx . $datetime . $rnd;

            OfferProduct::where('productIdx', $pid)->update(['uniqueProductIdx'=>$uniqueId]);
        }

        $data = array('id', 'pid', 'offerTitle', 'productTitle', 'uniqueId', 'offer');
        return view('data.offer_product_update_confirm', compact($data));
    }

    public function data_update_status(Request $request){
        if($request->update == "unpublish"){
            if($request->dataType == "offer"){
                Offer::where('offerIdx', $request->dataId)->update(array( "status" => 0 ));
            }elseif($request->dataType == "product"){
                OfferProduct::where('productIdx', $request->dataId)->update(array( "productStatus" => 0 ));
            }    
        }elseif ($request->update == "publish"){
            if($request->dataType == "offer"){
                Offer::where('offerIdx', $request->dataId)->update(array( "status" => 1 ));
            }elseif($request->dataType == "product"){
                OfferProduct::where('productIdx', $request->dataId)->update(array( "productStatus" => 1 ));
            }    
        }
        
        return response()->json(array( "success" => true ));        
    }

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function send_message(Request $request) {
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'contact the data provider');
        }
        
        $offer = Offer::with('region')
                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->where('offers.offerIdx', $request->id)
                    ->get()
                    ->first();
        if(!$offer) return view('errors.404');
        $data = array('offer');
        return view('data.send_message', compact($data));
    }

    public function post_send_message(Request $request){    
        $validator = Validator::make($request->all(),[
            'email' => 'required|max:255',
            'message' => 'required|min:5|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $email = $request->email;
        $message = $request->message;
        $user = $this->getAuthUser();
        $buyer = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('users.userIdx', $user->userIdx)
                        ->get()
                        ->first();
        $seller = User::join('providers', 'providers.userIdx', '=', 'users.userIdx')
                        ->where('providers.providerIdx', $request->providerIdx)
                        ->get()
                        ->first();
        $offer = Offer::with('region')
                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->where('offers.offerIdx', $request->offerIdx)
                    ->get()
                    ->first();

        $data['buyer'] = $buyer;
        $data['seller'] = $seller;
        $data['offer'] = $offer;
        $data['message'] = $message;
        $data['email'] = $email;

        $this->sendEmail("sendmessage", [
            'from'=>'cg@jts.ec', 
            'to'=>$seller['email'], 
            'name'=>'Databroker', 
            'subject'=>'You’ve received a message',
            'data'=>$data
        ]);

        $data = array('offer', 'seller');

        return redirect(route('data.send_message_success', ['id'=>$offer['offerIdx']]));
    }

    public function send_message_success(Request $request){
        $user = $this->getAuthUser();
        if(!$user)
            return redirect('/login')->with('target', 'contact the data provider');
        $offerIdx = $request->id;
        $offer = Offer::with(['region'])
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->where('offers.offerIdx', $offerIdx)
                        ->get()
                        ->first();
        $seller = Offer::join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->where('offers.offerIdx', $request->id)
                        ->where('users.userIdx', $user->userIdx)
                        ->get()
                        ->first();
        $data = array('offerIdx', 'seller', 'offer');
        return view('data.send_message_success', compact($data));
    }

    public function buy_data(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'buy this data');
        }else{
            $product = OfferProduct::with('region')
                                    ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                    ->where('offerProducts.productIdx', $request->pid)
                                    ->get()
                                    ->first();
            if(!$product) return view('errors.404');
            $finalPrice = $product->productPrice;
            if($request->bidIdx){
                $bid = Bid::where('bidIdx', $request->bidIdx)->get()->first();
                $finalPrice = $bid->bidPrice;
            }
            $buyer = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('users.userIdx', $user->userIdx)
                        ->get()
                        ->first();
            $billingInfo = BillingInfo::where('userIdx', $user->userIdx)->get()->first();
            $bidIdx = $request->bidIdx? $request->bidIdx : 0;
            if($billingInfo){
                $buyer['firstname'] = $billingInfo['firstname'];
                $buyer['lastname'] = $billingInfo['lastname'];
                $buyer['email'] = $billingInfo['email'];
                $buyer['companyName'] = $billingInfo['companyName'];
                $buyer['companyVAT'] = $billingInfo['companyVAT'];
                $buyer['address'] = $billingInfo['address'];
                $buyer['city'] = $billingInfo['city'];
                $buyer['postal_code'] = $billingInfo['postal_code'];
                if($billingInfo['state']) $buyer['state'] = $billingInfo['state'];
                $buyer['regionIdx'] = $billingInfo['regionIdx'];
            }
            $countries = Region::where('regionType', 'country')->get(); 
            $publishable_key = env('STRIPE_PUBLIC_KEY');
            $data = array('product', 'buyer', 'countries', 'publishable_key', 'bidIdx', 'finalPrice');
            return view('data.buy_data', compact($data));
        }
    }

    public function pay_data(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'companyName' => 'required|min:2',
            'companyVAT' => 'required|min:2',
            'address'=>'required|min:2',
            'city'=>'required|min:2',
            'postal_code'=>'required|min:2',
            'regionIdx' => 'required',
            'card_number'=> 'required|numeric|min:12',
            'exp_month'=>'required',
            'exp_year'=>'required',
            'cvc'=>'required|numeric|min:4'
        ],[
            'companyName.required'=>'The company name is required',
            'companyVAT.required'=>'The company VAT number is required',
            'address.required'=>'The address is required',
            'city'=>'The city is required',
            'postal_code.required'=>'The postal code is required.',
            'regionIdx.required'=>'The country field is required.',
            'card_number.required'=>'The card number is required.',
            'card_number.numeric'=>'The card number should be numeric.',
            'card_number.min'=>'The card number is invalid.',
            'exp_month'=>'The expiry month is required.',
            'exp_year'=>'The expiry year is required.',
            'cvc.required'=>'The CVC is required.',
            'cvc.numeric'=>'The CVC should be numeric.',
            'cvc.min'=>'The CVC is invalid.'
        ]);
        if ($validator->fails()) {
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));
        }else{
            $user = $this->getAuthUser();
            $billingData['userIdx'] = $user->userIdx;
            $billingData['firstname'] = $request->firstname;
            $billingData['lastname'] = $request->lastname;
            $billingData['email'] = $request->email;
            $billingData['companyName'] = $request->companyName;
            $billingData['companyVAT'] = $request->companyVAT;
            $billingData['address'] = $request->address;
            $billingData['city'] = $request->city;
            $billingData['postal_code'] = $request->postal_code;
            if($request->state) $billingData['state'] = $request->state;
            $billingData['regionIdx'] = $request->regionIdx;

            $billingObj = BillingInfo::where('userIdx', $user->userIdx)->get()->first();
            if(!$billingObj) $billingObj = BillingInfo::create($billingData);
            else BillingInfo::where('userIdx', $user->userIdx)->update($billingData);
            if(!$request->stripeToken)
                return response()->json(array( "success" => true ));
            else{
                \Stripe\Stripe::setApiKey ( env('STRIPE_SECRET_KEY') );
                try {
                    $region = Region::where('regionIdx', $request->regionIdx)->get()->first();
                    $customer = \Stripe\Customer::create( array(
                            'source' => $request->input('stripeToken'),
                            'name' => $request->firstname . " " . $request->lastname,
                            'email' => $request->email
                    ) );
                    $charge = \Stripe\Charge::create ( array (
                            "amount" => (int) $request->productPrice * 100,
                            "currency" => "eur",
                            "description" => "Databroker Data Fee",
                            "customer" => $customer->id
                    ) );

                    $buyer = BillingInfo::where('userIdx', $user->userIdx)->get()->first();
                    $seller = OfferProduct::with('region')
                                    ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                    ->where('productIdx', $request->productIdx)
                                    ->get()
                                    ->first();
                    $product = OfferProduct::where('productIdx', $request->productIdx)->get()->first();

                    $data['seller'] = $seller;
                    $data['buyer'] = $buyer;
                    $data['finalPrice'] = $request->productPrice;
                    $data['product'] = $product;

                    $datetime = time();
                    $sellerIdx = base_convert($seller->userIdx, 10, 26);
                    $sellerIdx = str_pad($sellerIdx, 5, '0', STR_PAD_LEFT);
                    $srnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 30);
                    $stransactionId = $sellerIdx . $datetime . $srnd;
                    $stransaction['transactionId'] = $stransactionId;
                    $stransaction['transactionType'] = 'sold';
                    $stransaction['userIdx'] = $seller->userIdx;
                    $stransaction['senderIdx'] = $user->userIdx;
                    $stransaction['receiverIdx'] = $seller->userIdx;
                    $stransaction['productIdx'] = $request->productIdx;
                    $stransaction['amount'] = floatval($request->productPrice);
                    $stransaction['status'] = 'pending';

                    Transaction::create($stransaction);

                    $buyerIdx = base_convert($user->userIdx, 10, 26);
                    $buyerIdx = str_pad($buyerIdx, 5, '0', STR_PAD_LEFT);
                    $brnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 30);
                    $btransactionId = $buyerIdx . $datetime . $brnd;
                    $btransaction['transactionId'] = $btransactionId;
                    $btransaction['transactionType'] = 'purchased';
                    $btransaction['userIdx'] = $user->userIdx;
                    $btransaction['senderIdx'] = $user->userIdx;
                    $btransaction['receiverIdx'] = $seller->userIdx;
                    $btransaction['productIdx'] = $request->productIdx;
                    $btransaction['amount'] = -(floatval($request->productPrice));
                    $btransaction['status'] = 'pending';

                    Transaction::create($btransaction);

                    $paidProductData['productIdx'] = $request->productIdx;
                    $paidProductData['userIdx'] = $user->userIdx;
                    $paidProductData['bidIdx'] = $request->bidIdx;
                    $paidProductData['from'] = date('Y-m-d H:i:s');
                    if($product['productAccessDays']=='day')
                        $paidProductData['to'] = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($paidProductData['from'])));
                    else if($product['productAccessDays']=='week')
                        $paidProductData['to'] = date('Y-m-d H:i:s', strtotime('+7 day', strtotime($paidProductData['from'])));
                    else if($product['productAccessDays']=='month')
                        $paidProductData['to'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($paidProductData['from'])));
                    else if($product['productAccessDays']=='year')
                        $paidProductData['to'] = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($paidProductData['from'])));
                    $paidProductData['transactionId'] = $btransactionId;
                    $paidProductObj = Purchase::create($paidProductData);

                    if($product->productType=="Api flow" || $product->productType=="Stream"){
                        $datetime = time();
                        $rnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 20);

                        $purchaseIdx = base_convert($paidProductObj->purchaseIdx, 10, 26);
                        $purchaseIdx = str_pad($purchaseIdx, 5, '0', STR_PAD_LEFT);
                        $apiKey = $purchaseIdx . base64_encode($datetime) . $rnd;

                        ApiProductKey::create([
                            'purchaseIdx' => $paidProductObj->purchaseIdx,
                            'apiKey' => $apiKey
                        ]);
                    }

                    $soldProductData = $paidProductData;
                    unset($soldProductData['userIdx']);
                    $soldProductData['purchaseIdx'] = $paidProductObj->purchaseIdx;
                    $soldProductData['sellerIdx'] = $seller->userIdx;
                    $soldProductData['buyerIdx'] = $user->userIdx;
                    $soldProductData['redeemed'] = 0;
                    $soldProductData['redeemed_at'] = null;
                    $soldProductData['transactionId'] = $stransactionId;
                    $soldProductObj = Sale::create($soldProductData);

                    $data['from'] = date('d/m/Y', strtotime($paidProductData['from']));
                    $data['to'] = date('d/m/Y', strtotime($paidProductData['to']));
                    $data['expire_at'] = date('d/m/Y', strtotime('+1 day', strtotime($paidProductData['to'])));
                    $data['warranty_to'] = date('d/m/Y', strtotime('+30 days', strtotime($paidProductData['from'])));
                    $data['redeemed_on'] = date('d/m/Y', strtotime('+14 days', strtotime($paidProductData['from'])));

                    $history['userIdx'] = $user->userIdx;
                    $history['productIdx'] = $request->productIdx;
                    $history['transactionId'] = $charge->id;
                    $history['paymentMethodIdx'] = 1; //1: Stripe
                    $history['paidAmount'] = $charge->amount / 100;
                    $history['paidCurrency'] = $charge->currency;
                    $history['cardIdx'] = $charge->source->id;
                    $history['cardType'] = $charge->source->brand;
                    $history['cardCountry'] = $charge->payment_method_details->card->country;
                    $history['expMonth'] = $charge->payment_method_details->card->exp_month;
                    $history['expYear'] = $charge->payment_method_details->card->exp_year;
                    $history['cvcCheck'] = $charge->payment_method_details->card->checks->cvc_check;
                    $history['last4'] = $charge->payment_method_details->card->last4;
                    $history['fingerprint'] = $charge->payment_method_details->card->fingerprint;
                    $history['funding'] = $charge->payment_method_details->card->funding;
                    $history['installments'] = $charge->payment_method_details->card->isntallments;
                    $history['network'] = $charge->payment_method_details->card->network;
                    $history['wallet'] = $charge->payment_method_details->card->wallet;
                    $history['amountRefunded'] = $charge->amount_refunded;
                    $history['application'] = $charge->application;
                    $history['applicationFee'] = $charge->application_fee;
                    $history['applicationFeeAmount'] = $charge->application_fee_amount;
                    $history['balanceTransaction'] = $charge->balance_transaction;
                    $history['captured'] = $charge->captured;
                    $history['customer'] = $charge->customer;
                    $history['description'] = $charge->description;
                    $history['destination'] = $charge->destination;
                    $history['dispute'] = $charge->dispute;
                    $history['disputed'] = $charge->disputed;
                    $history['failureCode'] = $charge->failure_code;
                    $history['failureMessage'] = $charge->failure_message;
                    $history['invoice'] = $charge->invoice;
                    $history['liveMode'] = $charge->livemode;
                    $history['order'] = $charge->order;
                    $history['paid'] = $charge->paid;
                    $history['paymentIntent'] = $charge->payment_intent;
                    $history['paymentMethod'] = $charge->payment_method;
                    $history['receiptEmail'] = $charge->receipt_email;
                    $history['receiptNumber'] = $charge->receipt_number;
                    $history['receiptURL'] = $charge->receipt_url;
                    $history['refunded'] = $charge->refunded;
                    $history['review'] = $charge->review;
                    $history['shipping'] = $charge->shipping;
                    $history['status'] = $charge->status;

                    PaidHistory::create($history);

                    $userObj = User::where('userIdx', $user->userIdx)->get()->first();

                    $client = new \GuzzleHttp\Client();
                    $query = array();
                    $query['address'] = $seller->wallet;
                    $query['amount'] = floatval($request->productPrice);
                    $url = "http://161.35.212.38:8081/ethereum/wallet/addfunds";
                    $response = $client->request("POST", $url, [
                        'headers'=> ['Content-Type' => 'application/json'],
                        'body'=> json_encode($query)
                    ]);
                    $res = $response->getBody()->getContents();

                    // $client = new \GuzzleHttp\Client();
                    // $url = "http://161.35.212.38:8081/ethereum/deal";
                    // $query = array();
                    // $query['did'] = $product->did;
                    // $query['ownerAddress'] = $userObj->wallet;
                    // $query['ownerPercentage'] = 0;
                    // $query['publisherAddress'] = $userObj->wallet;
                    // $query['publisherPercentage'] = 90;
                    // $query['userAddress'] = $userObj->wallet;
                    // $query['marketplaceAddress'] = $userObj->wallet;
                    // $query['marketplacePercentage'] = 10;
                    // $query['amount'] = floatval($request->productPrice);
                    // $query['validFrom'] = strtotime($paidProductData['from']);
                    // $query['validUntil'] = strtotime($paidProductData['to']);

                    // $response = $client->request("POST", $url, [
                    //     'headers'=> ['Content-Type' => 'application/json'],
                    //     'body'=>json_encode($query)
                    // ]);
                    // $response = $response->getBody()->getContents();

                    $this->sendEmail("buydata", [
                        'from'=>'cg@jts.ec', 
                        'to'=>$buyer['email'], 
                        'subject'=>'You’ve successfully purchased a data product', 
                        'name'=>'Databroker',
                        'data'=>$data
                    ]);  
                    $this->sendEmail("selldata", [
                        'from'=>'cg@jts.ec', 
                        'to'=>$seller['email'], 
                        'subject'=>'You’ve sold a data product', 
                        'name'=>'Databroker',
                        'data'=>$data
                    ]);

                    return redirect(route('data.pay_success', ['purIdx'=>$paidProductObj->purchaseIdx]));
                } catch ( \Exception $e ) {
                    $errorBody = $e->getJsonBody();
                    $err = $errorBody['error'];

                    $history['userIdx'] = $user->userIdx;
                    $history['productIdx'] = $request->productIdx;
                    $history['paymentMethodIdx'] = 1; //1: Stripe
                    $history['errorCode'] = $err['code'];
                    $history['errorDocURL'] = $err['doc_url'];
                    $history['errorMessage'] = $err['message'];
                    if(isset($err['param'])) $history['errorParam'] = $err['param'];
                    $history['errorType'] = $err['type'];

                    PaidHistory::create($history);

                    $message = $err['message'];
                    $id = $request->id;
                    $pid = $request->pid;
                    $data = array('message', 'id', 'pid');
                    return view('data.pay_fail', compact($data));
                }
            }
        }
    }

    public function pay_success(Request $request){
        $user = $this->getAuthUser();
        if(!$user){
            return redirect('/login');
        }else{
            $userObj = User::where('userIdx', $user->userIdx)->get()->first();
            $product = OfferProduct::with('region')
                                    ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                    ->join('purchases', 'purchases.productIdx', '=', 'offerProducts.productIdx')
                                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                    ->where('purchases.purchaseIdx', $request->purIdx)
                                    ->get()
                                    ->first();
            $from = date('d/m/Y', strtotime($product->from));
            $to = date('d/m/Y', strtotime($product->to));
            $expire_on = date('d/m/Y', strtotime('+1 day', strtotime($product->to)));
            $apiKey="";
            $transactionId = "";
            $dataAccess = null;
            if($product->productType=='Api flow' || $product->productType=="Stream"){
                $apiKey = ApiProductKey::where('purchaseIdx', $request->purIdx)->get()->first()->apiKey;
                $transactionId = $product->transactionId;
            }
            $client = new \GuzzleHttp\Client();
            $url = "http://161.35.212.38:8081/dxc/datasource/".$product->did."/geturlfor/".$userObj->wallet.'?privatekey='.$userObj->walletPrivateKey;
            $response = $client->request("GET", $url, [
                'headers'=> ['Content-Type' => 'application/json'],
                'body'=>'{}'
            ]);
            $dataAccess = json_decode($response->getBody()->getContents());

            $data = array('product', 'from', 'to', 'expire_on', 'transactionId', 'apiKey', 'dataAccess');
            return view('data.pay_success', compact($data));
        }
    }

    public function get_data(Request $request){
        $user = $this->getAuthUser();
        if(!$user)
           return redirect('/login')->with('target', 'get free data');
        $product = OfferProduct::with('region')
                                ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                ->where('offerProducts.productIdx', $request->pid)
                                ->where('offerProducts.offerIdx', $request->id)
                                ->get()
                                ->first();
        if(!$product) return view('errors.404');
        $lastPurchase = Purchase::where('productIdx', $request->pid)->where('userIdx', $user->userIdx)->orderby('created_at', 'desc')->get()->first();
        
        if(!$product || $product->productBidType!="free"){ 
            return Redirect::back();
        } else if(!$lastPurchase || $lastPurchase->to < date('Y-m-d')){
            $data = array('product');
            return view('data.get_data_review', compact($data));
        } else return redirect(route('account.purchases'));
    }

    public function take_data(Request $request){
        $user = $this->getAuthUser();
        if(!$user)
           return redirect('/login')->with('target', 'get free data');

        $fields = [
            'termcondition_privacypolicy' => ['required'],
            'license_seller' => ['required'],
        ];
        $messages = [
            'termcondition_privacypolicy.required'=>'Please confirm that you accept Databroker’s Terms and conditions and Privacy policy.',
            'license_seller.required'=>'Please confirm that you accept the data provider’s licence for the use of this data.',
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();             
        }

        $product = OfferProduct::with('region')
                                ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                ->where('offerProducts.productIdx', $request->pid)
                                ->where('offerProducts.offerIdx', $request->id)
                                ->get()
                                ->first();

        $purchaseData['productIdx'] = $request->pid;
        $purchaseData['userIdx'] = $user->userIdx;
        $purchaseData['bidIdx'] = 0;
        $purchaseData['from'] = date('Y-m-d H:i:s');
        if($product['productAccessDays']=='day')
            $purchaseData['to'] = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($purchaseData['from'])));
        else if($product['productAccessDays']=='week')
            $purchaseData['to'] = date('Y-m-d H:i:s', strtotime('+7 day', strtotime($purchaseData['from'])));
        else if($product['productAccessDays']=='month')
            $purchaseData['to'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($purchaseData['from'])));
        else if($product['productAccessDays']=='year')
            $purchaseData['to'] = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($purchaseData['from'])));

        $from = date('d/m/Y', strtotime($purchaseData['from']));
        $to = date('d/m/Y', strtotime($purchaseData['to']));
        $expire_on = date('d/m/Y', strtotime('+1 day', strtotime($purchaseData['to'])));

        $buyer = User::where('userIdx', $user->userIdx)->get()->first();
        $seller = OfferProduct::with('region')
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('offerProducts.productIdx', $request->pid)
                        ->get()
                        ->first();

        $datetime = time();
        $sellerIdx = base_convert($seller->userIdx, 10, 26);
        $sellerIdx = str_pad($sellerIdx, 5, '0', STR_PAD_LEFT);
        $srnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 30);
        $stransactionId = $sellerIdx . $datetime . $srnd;
        $stransaction['transactionId'] = $stransactionId;
        $stransaction['transactionType'] = 'sold';
        $stransaction['userIdx'] = $seller->userIdx;
        $stransaction['senderIdx'] = $user->userIdx;
        $stransaction['receiverIdx'] = $seller->userIdx;
        $stransaction['productIdx'] = $request->pid;
        $stransaction['amount'] = 0.00;
        $stransaction['status'] = 'complete';

        Transaction::create($stransaction);

        $buyerIdx = base_convert($user->userIdx, 10, 26);
        $buyerIdx = str_pad($buyerIdx, 5, '0', STR_PAD_LEFT);
        $brnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 30);
        $btransactionId = $buyerIdx . $datetime . $brnd;
        $btransaction['transactionId'] = $btransactionId;
        $btransaction['transactionType'] = 'purchased';
        $btransaction['userIdx'] = $user->userIdx;
        $btransaction['senderIdx'] = $user->userIdx;
        $btransaction['receiverIdx'] = $seller->userIdx;
        $btransaction['productIdx'] = $request->pid;
        $btransaction['amount'] = 0.00;
        $btransaction['status'] = 'complete';

        Transaction::create($btransaction);

        $purchaseData['transactionId'] = $btransactionId;
        $paidProductObj = Purchase::create($purchaseData);

        $soldProductData = $purchaseData;
        unset($soldProductData['userIdx']);
        $soldProductData['purchaseIdx'] = $paidProductObj->purchaseIdx;
        $soldProductData['sellerIdx'] = $seller->userIdx;
        $soldProductData['buyerIdx'] = $user->userIdx;
        $soldProductData['redeemed'] = 1;
        $soldProductData['redeemed_at'] = date('Y-m-d');
        $soldProductData['transactionId'] = $stransactionId;
        $soldProductObj = Sale::create($soldProductData);

        $mailData['seller'] = $seller;
        $mailData['buyer'] = $buyer;
        $mailData['finalPrice'] = 0;
        $mailData['product'] = $product;
        $mailData['from'] = date('d/m/Y', strtotime($purchaseData['from']));
        $mailData['to'] = date('d/m/Y', strtotime($purchaseData['to']));
        $mailData['expire_at'] = date('d/m/Y', strtotime('+1 day', strtotime($purchaseData['to'])));
        $mailData['warranty_to'] = date('d/m/Y', strtotime('+30 days', strtotime($purchaseData['from'])));
        $mailData['redeemed_on'] = date('d/m/Y', strtotime('+14 days', strtotime($purchaseData['from'])));

        $apiKey="";
        $transactionId = "";
        if($product->productType=="Api flow" || $product->productType=="Stream"){
            $datetime = time();
            $rnd = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') ,1 , 20);

            $purchaseIdx = base_convert($paidProductObj->purchaseIdx, 10, 26);
            $purchaseIdx = str_pad($purchaseIdx, 5, '0', STR_PAD_LEFT);
            $apiKey = $purchaseIdx . base64_encode($datetime) . $rnd;

            ApiProductKey::create([
                'purchaseIdx' => $paidProductObj->purchaseIdx,
                'apiKey' => $apiKey
            ]);
            $transactionId = $btransactionId;
        }

        $this->sendEmail("buydata", [
            'from'=>'cg@jts.ec', 
            'to'=>$buyer['email'], 
            'subject'=>'You’ve successfully purchased a data product', 
            'name'=>'Databroker',
            'data'=>$mailData
        ]);  
        $this->sendEmail("selldata", [
            'from'=>'cg@jts.ec', 
            'to'=>$seller['email'], 
            'subject'=>'You’ve sold a data product', 
            'name'=>'Databroker',
            'data'=>$mailData
        ]);

        return redirect(route('data.get_success', ['purIdx'=>$paidProductObj->purchaseIdx]));
    }

    public function get_success(Request $request){
        $product = OfferProduct::with('region')
                                ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                ->join('purchases', 'purchases.productIdx', '=', 'offerProducts.productIdx')
                                ->where('purchases.purchaseIdx', $request->purIdx)
                                ->get()
                                ->first();
        $from = date('d/m/Y', strtotime($product['from']));
        $to = date('d/m/Y', strtotime($product['to']));
        $expire_on = date('d/m/Y', strtotime('+1 day', strtotime($product['to'])));
        $apiKey="";
        $transactionId = $product->transactionId;
        $dataAccess = null;
        if($product->productType=="Api flow" || $product->productType=="Stream"){
            $apiKeyObj = ApiProductKey::where('purchaseIdx', $request->purIdx)->get()->first();
            if($apiKeyObj) $apiKey = $apiKeyObj->apiKey;
        }

        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/dxc/datasource/".$product->did."/geturlfor/".$userObj->wallet.'?privatekey='.$userObj->walletPrivateKey;
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $dataAccess = json_decode($response->getBody()->getContents());

        $data = array('product', 'from', 'to', 'expire_on', 'apiKey', 'transactionId', 'dataAccess');
        return view('data.get_success', compact($data));
    }

    public function bid(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'send a bid for this data');
        }else{
            $product = OfferProduct::with('region')->where('productIdx', $request->pid)->get()->first();
            if(!$product) return view('errors.404');
            $offer = Offer::where('offerIdx', $request->id)->get()->first();
            if(!$offer) return view('errors.404');
            $providerIdx = $offer['providerIdx'];
            $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
            $data = array('product', 'provider');
            return view('data.bid', compact($data));
        }
    }
    public function send_bid(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'bidPrice' => ['required', 'numeric', 'min:0.5']
        ];

        $messages = [
            'bidPrice.required' => 'Your bid price is required.',
            'bidPrice.numeric' => 'Bid price should be numeric.',
            'bidPrice.min' => 'Bid price should be higher than €0.50'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();             
        }

        $bidData['userIdx'] = $user->userIdx;
        $bidData['productIdx'] = $request->productIdx;
        $bidData['bidPrice'] = $request->bidPrice;
        $bidData['bidMessage'] = $request->bidMessage;
        $bidData['bidStatus'] = 0;

        $bidObj = Bid::create($bidData);

        $seller = User::join('providers', 'providers.userIdx', '=', 'users.userIdx')
                    ->join('offers', 'offers.providerIdx', '=', 'providers.providerIdx')
                    ->where('offers.offerIdx', $request->offerIdx)
                    ->get()
                    ->first();
        $buyer = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('userIdx', $user->userIdx)->get()->first();

        $product = OfferProduct::with('region')->where('productIdx', $request->productIdx)->get()->first();


        $msgData['bidIdx'] = $bidObj->bidIdx;
        $msgData['senderIdx'] = $user->userIdx;
        $msgData['receiverIdx'] = $seller->userIdx;
        $msgData['message'] = $request->bidMessage;
        
        Message::create($msgData);

        $product['from'] = date('Y-m-d');
        if($product->productAccessDays=="day")
            $product['to'] = date('Y-m-d', strtotime('+1 day', strtotime($product['from'])));
        else if($product->productAccessDays=="week")
            $product['to'] = date('Y-m-d', strtotime('+7 day', strtotime($product['from'])));
        else if($product->productAccessDays=='month')
            $product['to'] = date('Y-m-d', strtotime('+1 month', strtotime($product['from'])));
        else if($product->productAccessDays=='year')
            $product['to'] = date('Y-m-d', strtotime('+1 year', strtotime($product['from'])));

        $data['seller'] = $seller;
        $data['buyer'] = $buyer;
        $data['product'] = $product;
        $data['bid'] = $bidObj;

        $this->sendEmail("sendbid", [
            'from'=>'cg@jts.ec', 
            'to'=>$seller['email'], 
            'subject'=>'You’ve received a bid on a data product', 
            'name'=>'Databroker',
            'data'=>$data
        ]);    

        return redirect(route('data.send_bid_success', ['id'=>$request->offerIdx, 'pid'=>$request->productIdx]));
    }
    public function edit_bid(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'send a bid for this data');
        }else{
            $bid = Bid::where('bidIdx', $request->bid)->get()->first();
            if(!$bid) return view('errors.404');
            $product = OfferProduct::with('region')->where('productIdx', $bid->productIdx)->get()->first();
            $offer = Offer::join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                            ->where('offerProducts.productIdx', $bid->productIdx)
                            ->get()
                            ->first();
            $providerIdx = $offer['providerIdx'];
            $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
            $data = array('product', 'provider', 'bid');
            return view('data.edit_bid', compact($data));
        }
    }
    public function update_bid(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'bidPrice' => ['required', 'numeric', 'min:0.5']
        ];

        $messages = [
            'bidPrice.required' => 'Your bid price is required.',
            'bidPrice.numeric' => 'Bid price should be numeric.',
            'bidPrice.min' => 'Bid price should be higher than €0.50'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();             
        }

        $bidData['userIdx'] = $user->userIdx;
        $bidData['productIdx'] = $request->productIdx;
        $bidData['bidPrice'] = $request->bidPrice;
        $bidData['bidMessage'] = $request->bidMessage;
        $bidData['bidStatus'] = 0;

        Bid::where('bidIdx', $request->bid)->update($bidData);
        $bidObj = Bid::where('bidIdx', $request->bid)->get()->first();

        $seller = User::join('providers', 'providers.userIdx', '=', 'users.userIdx')
                    ->join('offers', 'offers.providerIdx', '=', 'providers.providerIdx')
                    ->where('offers.offerIdx', $request->offerIdx)
                    ->get()
                    ->first();
        $buyer = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('userIdx', $user->userIdx)->get()->first();

        $product = OfferProduct::with('region')->where('productIdx', $request->productIdx)->get()->first();

        $msgData['bidIdx'] = $request->bid;
        $msgData['senderIdx'] = $user->userIdx;
        $msgData['receiverIdx'] = $seller->userIdx;
        $msgData['message'] = $request->bidMessage;
        Message::create($msgData);

        $data['seller'] = $seller;
        $data['buyer'] = $buyer;
        $data['product'] = $product;
        $data['bid'] = $bidObj;

        $this->sendEmail("sendbid", [
            'from'=>'cg@jts.ec', 
            'to'=>$seller['email'], 
            'subject'=>'You’ve received a bid on a data product', 
            'name'=>'Databroker',
            'data'=>$data
        ]);    

        return redirect(route('data.send_bid_success', ['id'=>$request->offerIdx, 'pid'=>$request->productIdx]));
    }
    public function send_bid_success(Request $request){
        $product = OfferProduct::with('region')->where('productIdx', $request->pid)->get()->first();
        $offer = Offer::with(['region'])
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->where('offers.offerIdx', $request->id)
                        ->get()
                        ->first();
        $providerIdx = $offer['providerIdx'];
        $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
        $companyName = $provider->companyName;
        $offerIdx = $request->id;
        $data = array('companyName', 'offerIdx', 'offer');
        return view("data.send_bid_success", compact($data));
    }
    public function bid_respond(Request $request){
        $bidObj = Bid::where('bidIdx', $request->bid)
                    ->join('users', 'users.userIdx', '=', 'bids.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->join('offerProducts', 'offerProducts.productIdx', '=', 'bids.productIdx')
                    ->get(["bids.*", "bids.created_at as createdAt", "users.*", "companies.*", "offerProducts.*"])
                    ->first();
        if(!$bidObj) return view('errors.404');
        $data = array('bidObj');
        return view('data.bid_respond', compact($data));
    }
    public function send_bid_response(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'response' => ['required', 'numeric']
        ];

        $messages = [
            'response.required' => 'Please respond to bid.',
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();             
        }
        $data['bidResponse'] = $request->bidResponse;
        $data['bidStatus'] = $request->response;
        Bid::where('bidIdx', $request->bidIdx)->update($data);

        $seller = Bid::join('offerProducts', 'offerProducts.productIdx', '=', 'bids.productIdx')
                    ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                    ->join("providers", 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->join('regions', 'regions.regionIdx', '=', 'providers.regionIdx')
                    ->where('bids.bidIdx', $request->bidIdx)
                    ->get()
                    ->first();

        $buyer = Bid::join('users', 'users.userIdx', '=', 'bids.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('bids.bidIdx', $request->bidIdx)
                    ->get()
                    ->first();

        $product = OfferProduct::with('region')
                        ->join('bids', 'bids.productIdx', '=', 'offerProducts.productIdx')
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->where('bids.productIdx', $request->productIdx)
                        ->get(['offerProducts.*', 'offerProducts.created_at as createdAt', 'bids.*', 'offers.*', 'providers.*'])
                        ->first();

        $msgData['bidIdx'] = $request->bidIdx;
        $msgData['senderIdx'] = $user->userIdx;
        $msgData['receiverIdx'] = $buyer->userIdx;
        $msgData['message'] = $request->bidResponse;
        Message::create($msgData);

        $mailData['seller'] = $seller;
        $mailData['buyer'] = $buyer;
        $mailData['product'] = $product;
        $mailData['bidIdx'] = $request->bidIdx;

        if($request->response==1){
            $this->sendEmail("acceptbid", [
                'from'=>'cg@jts.ec', 
                'to'=>$buyer['email'], 
                'subject'=>'Your bid on a data product was accepted.', 
                'name'=>'Databroker',
                'data'=>$mailData
            ]);
        }
        else if($request->response==-1){
            $this->sendEmail("rejectbid", [
                'from'=>'cg@jts.ec', 
                'to'=>$buyer['email'], 
                'subject'=>'Your bid on a data product was rejected.', 
                'name'=>'Databroker',
                'data'=>$mailData
            ]);
        }

        return redirect(route('profile.seller_bids'));
    }
    public function configure_stream(Request $request){
        $user = $this->getAuthUser();
        if(!$user)
            return redirect('/login')->with('target', 'configure stream details');
        $product = OfferProduct::with(['region'])
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->join('purchases', 'purchases.productIdx', '=', 'offerProducts.productIdx')
                        ->leftjoin('apiProductKeys', 'apiProductKeys.purchaseIdx', '=', 'purchases.purchaseIdx')
                        ->leftjoin('bids', 'bids.bidIdx', '=', 'purchases.bidIdx')
                        ->where('purchases.purchaseIdx', $request->purIdx)
                        ->get()
                        ->first();
        if(!$product) return view('errors.404');
        $company = Offer::join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->where('offers.offerIdx', $product->offerIdx)
                        ->get()
                        ->first()
                        ->companyName;
        $stream = Stream::where('userIdx', $user->userIdx)->where('purchaseIdx', $request->purIdx)->get()->first();
        $data = array('product', 'stream', 'company');
        return view('data.configure_stream', compact($data));
    }
    public function save_stream(Request $request){
        $fields = [
            'IP' => ['required'],
            'port' => ['required', 'numeric']
        ];

        $messages = [
            'bidPrice.required' => 'Your bid price is required.',
            'bidPrice.numeric' => 'Bid price should be numeric.',
            'bidPrice.min' => 'Bid price should be higher than €0.50'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();             
        }
        $user = $this->getAuthUser();
        $stream['purchaseIdx'] = $request->purchaseIdx;
        $stream['userIdx'] = $user->userIdx;
        $stream['IP'] = $request->IP;
        $stream['port'] = $request->port;

        if($request->streamIdx==0)
            Stream::create($stream);
        else Stream::where('streamIdx', $request->streamIdx)->update($stream);

        return redirect(route('data.save_stream_success'));
    }
    public function save_stream_success(Request $request){
        return view('data.save_stream_success');
    }
}
