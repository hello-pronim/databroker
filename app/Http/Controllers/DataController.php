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
use App\Models\ProductCountry;
use App\Models\Purchase;
use App\Models\RegionProduct;
use App\Models\UseCase;
use App\Models\Bid;
use App\Models\BillingInfo;
use App\User;
use App\Models\Business;

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
        $offer = Offer::with(['region', 'theme', 'provider', 'community', 'usecase'])->where('offerIdx', $request->id)->first();

        $user_info = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')->where('users.userIdx', $offer->provider->userIdx)->first();
        
        $offersample = OfferSample::with('offer')->where('offerIdx', $request->id)->where('deleted', 0)->get();
        
        $prev_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        
        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $request->id)->where("productStatus", 1)->get();

        // $purchases = Purchase::join('offerProducts', 'offerProducts.productIdx', '=', 'purchases.productIdx')
        //                     ->where('purchases.userIdx', $user->userIdx)
        //                     ->where('offerProducts.offerIdx', $request->id)
        //                     ->orderby('purchases.purchaseIdx', 'DESC')
        //                     ->groupBy('purchases.productIdx')
        //                     ->get();
        // var_dump($purchases);
        // exit;

        if(  strpos($prev_route, 'data_community.') === false ){
            $prev_route = '';
        }
    
        $data = array('id'=>$request->id, 'offer' => $offer, 'offersample' => $offersample, 'prev_route' => $prev_route, 'user_info' => $user_info, 'products' => $products);
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

            $gallery = Gallery::where('category', 'community')->get();
            $gallery_map = [];
            foreach ($gallery as $g_row) {
                $id = $g_row['id'];
                $category = $g_row['category'];
                $content = $g_row['content'];
                $subcontent = $g_row['subcontent'];
                $sequence = $g_row['sequence'];
                $path = $g_row['path'];
                $thumb = $g_row['thumb'];

                if (!isset($gallery_map[$content]))
                    $gallery_map[$content] = [];
                if (!isset($gallery_map[$content][$subcontent]))
                    $gallery_map[$content][$subcontent] = [];
                $gallery_map[$content][$subcontent][$sequence] = ['id' => $id, 'url' => $path, 'thumb' => $thumb];
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
            $offer_path = URL::to('/');    
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

        $gallery = Gallery::where('category', 'community')->get();
        $gallery_map = [];
        foreach ($gallery as $g_row) {
            $id = $g_row['id'];
            $category = $g_row['category'];
            $content = $g_row['content'];
            $subcontent = $g_row['subcontent'];
            $sequence = $g_row['sequence'];
            $path = $g_row['path'];
            $thumb = $g_row['thumb'];

            if (!isset($gallery_map[$content]))
                $gallery_map[$content] = [];
            if (!isset($gallery_map[$content][$subcontent]))
                $gallery_map[$content][$subcontent] = [];
            $gallery_map[$content][$subcontent][$sequence] = ['id' => $id, 'url' => $path, 'thumb' => $thumb];
        }

        $data = array( 'offerIdx', 'regions', 'countries', 'communities', 'offer', 'products', 'id', 'link_to_market', 'regionCheckList', 'usecase', 'sample_files', 'sample_images', 'offersample_path', 'offer_path', 'offer_images', 'theme_json', 'themeCheckList', 'gallery_map' );
        // die(json_encode(compact($data)));
        return view('data.offers', compact($data));
    }

    public function offer_detail($id, Request $request)
    {   
        $offerId = $id;
        $offer = Offer::with(['region'])->where('offers.offerIdx', '=', $id)->first();
        
        $communityIdx = $offer['communityIdx'];
        $community = Community::find($communityIdx);
        $community_route = str_replace( ' ', '_', strtolower($community->communityName) );
        $link_to_market = '/data/'.$id;

        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $id)->orderby('updated_at', 'DESC')->get();

        $data = array( 'offer', 'products', 'id', 'link_to_market' );
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

        $dataoffer = Offer::with(['region', 'provider'])
            ->leftjoin('offerThemes', 'offerThemes.offerIdx', '=',  'offers.offerIdx')
            ->leftjoin('themes', 'themes.themeIdx', '=',  'offerThemes.themeIdx')                    
            ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
            ->where('communities.communityName', ucfirst($category))
            ->where('themes.themeIdx', $request->theme)
            ->where('offers.status', 1)
            ->orderby('offers.offerIdx', 'DESC')            
            ->limit($per_page)
            ->distinct('offers')
            ->get();

        $totalcount = Offer::with(['region', 'provider'])
                    ->leftjoin('offerThemes', 'offerThemes.offerIdx', '=',  'offers.offerIdx')
                    ->leftjoin('themes', 'themes.themeIdx', '=',  'offerThemes.themeIdx')                    
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('themes.themeIdx', $request->theme)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->distinct('offers')
                    ->get()
                    ->count();

        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page', 'curTheme' );                
        return view('data.category', compact($data));
    }

    public function offer_company_filter(Request $request){

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

        $dataoffer = Offer::with(['region'])
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->leftjoin('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->leftjoin('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('users.companyIdx', $request->companyIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')            
                    ->limit($per_page)
                    ->distinct('offers')
                    ->get();

        $totalcount = Offer::with(['region'])                   
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->leftjoin('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                    ->leftjoin('users', 'users.userIdx', '=', 'providers.userIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('users.companyIdx', $request->companyIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->distinct('offers')
                    ->get()
                    ->count();

        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page', 'curTheme' );                
        return view('data.category', compact($data));
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

        $dataoffer = Offer::leftjoin('offerCountries', 'offerCountries.offerIdx', '=', 'offers.offerIdx')
                    ->leftjoin('regions', 'regions.regionIdx', '=', 'offerCountries.regionIdx')
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('regions.regionIdx', $request->regionIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->limit($per_page)
                    ->distinct('offers.offerIdx')
                    ->get();

        $totalcount = Offer::leftjoin('offerCountries', 'offerCountries.offerIdx', '=', 'offers.offerIdx')
                    ->leftjoin('regions', 'regions.regionIdx', '=', 'offerCountries.regionIdx')
                    ->leftjoin('communities', 'offers.communityIdx', '=',  'communities.communityIdx')
                    ->where('communities.communityName', ucfirst($category))
                    ->where('regions.regionIdx', $request->regionIdx)
                    ->where('offers.status', 1)
                    ->orderby('offers.offerIdx', 'DESC')
                    ->distinct('offers.offerIdx')
                    ->get()
                    ->count();

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

            $offer_obj = Offer::create($offer_data);
            $offerIdx = $offer_obj['offerIdx'];

            $offerimagefile = $request->file('offerImage_1');
            if ($offerimagefile != null) {
                $fileName = "offer_".$offerIdx.'.'.$offerimagefile->extension();
                $ret = $offerimagefile->move($offerImage_path, $fileName);
                $fileName = 'uploads/offer/' . $fileName;
                $offer_data['offerImage'] = $fileName;
            } else {  
                $fileName = $request->input('gallery_offerImage_1');
                $offer_data['offerImage'] = $fileName;
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
                $ret = $offerimagefile->move($offerImage_path, $fileName);
                $offer_data['offerImage'] =  'uploads/offer/'. $fileName;
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
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();

        $data = array( 'countries', 'offer', 'regions' );
        return view('data.offer_add_product', compact($data));
    }

    public function offer_edit_product($id, $pid, Request $request) {   
        $offerId = $id;
        $offer = Offer::with(['region'])->where('offers.offerIdx', '=', $id)->first();
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

        $data = array( 'offer', 'product', 'id', 'pid', 'link_to_market', 'countries', 'regions', 'regionCheckList', 'prodTypeList', 'accessPeriodList', 'bidTypes' );
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
        //$product_data['productMoreInfo'] = $request->productMoreInfo;
        $product_data['productBidType'] = $request->period;
        $period = $product_data['productBidType'].'_period';
        $price = $product_data['productBidType'].'_price';
        $product_data['productAccessDays'] = $request->$period;        
        if( $request->period == "no_bidding" || $request->period == "bidding_possible" ){
            $product_data['productPrice'] = $request->$price;
        }
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
            //->where('communities.communityName', ucfirst($community))
            //->where('offers.status', 1)
            ->limit(3)
            ->get();

        $themes = Theme::get_theme_by_community($community);
        
        $data = array( 'community', 'offers', 'themes' );                
        return view('data.community', compact($data));
    }    

    public function filter_offer(Request $request){

        $dataoffer = Offer::filter_offer($request);
            
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
            'companyURL' => ['required', 'string', 'max:255', "regex: /^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9\-]+(\.[a-z\-]{2,}){1,3}(#?\/?[a-zA-Z0-9\-#]+)*\/?(\?[a-zA-Z0-9-_\-]+=[a-zA-Z0-9-%\-]+&?)?$/"],
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
        $data = array('id', 'uniqueId');
        return view('data.offer_product_publish_confirm', compact($data));
    }        

    public function offer_product_update_confirm($id, $pid, Request $request){
        $offer = Offer::find($id);
        $product = OfferProduct::find($pid);
        $offerTitle = $offer['offerTitle'];
        $productTitle = $product['productTitle'];

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

        $data = array('id', 'pid', 'offerTitle', 'productTitle', 'uniqueId');
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
        $data = array('offer');
        return view('data.send_message', compact($data));
    }

    public function post_send_message(Request $request){    
        $validator = Validator::make($request->all(),[
            'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
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
            'from'=>$email, 
            'to'=>$seller['email'], 
            'name'=>'Databroker', 
            'subject'=>'You’ve received a message',
            'data'=>$data
        ]);

        $data = array('offer', 'seller');

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
            //$bid = Bid::where('userIdx', $user->userIdx)->where('pid', $request->pid)->get()->first();
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
            $data = array('product', 'buyer', 'countries', 'publishable_key', 'bidIdx');
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
            'card_number.numeric'=>'The card number must be numeric.',
            'card_number.min'=>'The card number is invalid.',
            'exp_month'=>'The expiry month is required.',
            'exp_year'=>'The expiry year is required.',
            'cvc.required'=>'The CVC is required.',
            'cvc.numeric'=>'The CVC must be numeric.',
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
                    \Stripe\Charge::create ( array (
                            "amount" => $request->productPrice * 100,
                            "currency" => "eur",
                            "source" => $request->input('stripeToken'), // obtained with Stripe.js
                            "description" => "Databroker Data Fee" 
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
                    $data['product'] = $product;

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
                    $paidProductObj = Purchase::create($paidProductData);

                    $data['expiry_from'] = date('d/m/Y', strtotime($paidProductData['from']));
                    $data['expiry_to'] = date('d/m/Y', strtotime($paidProductData['to']));

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

                    return redirect(route('data.pay_success', ['id'=>$request->offerIdx, 'pid'=>$request->productIdx]));
                } catch ( \Exception $e ) {
                    var_dump($e->getMessage);
                    exit;
                    //Session::flash ( 'fail-message', "Error! Please Try again." );
                   // return Redirect::back ();
                }
            }
        }
    }

    public function pay_success(Request $request){
        $user = $this->getAuthUser();
        if(!$user){
            return redirect('/login');
        }else{
            $product = OfferProduct::with('region')
                                    ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                    ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                    ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                    ->where('productIdx', $request->pid)
                                    ->get()
                                    ->first();
            $paidProductObj = Purchase::where('userIdx', $user->userIdx)
                                        ->where('productIdx', $request->pid)
                                        ->orderby('created_at', 'DESC')
                                        ->limit(1)
                                        ->get()
                                        ->first();
            $expiry_from = date('d/m/Y', strtotime($paidProductObj['from']));
            $expiry_to = date('d/m/Y', strtotime($paidProductObj['to']));
            $data = array('product', 'expiry_from', 'expiry_to');
            return view('data.pay_success', compact($data));
        }
    }

    public function bid(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'send a bid for this data');
        }else{
            $product = OfferProduct::with('region')->where('productIdx', $request->pid)->get()->first();
            $offer = Offer::where('offerIdx', $request->id)->get()->first();
            $providerIdx = $offer['providerIdx'];
            $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
            $data = array('product', 'provider');
            return view('data.bid', compact($data));
        }
    }
    public function send_bid(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'bidPrice' => ['required', 'numeric']
        ];

        $messages = [
            'bidPrice.required' => 'Your bid price is required.',
            'bidPrice.numeric' => 'Bid price must be numeric.'
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

        $bidObj = Bid::where('userIdx', $user->userIdx)->where('productIdx', $request->productIdx)->get()->first();
        if(!$bidObj){
            $bidObj = Bid::create($bidData);

            $seller = User::join('providers', 'providers.userIdx', '=', 'users.userIdx')
                        ->join('offers', 'offers.providerIdx', '=', 'providers.providerIdx')
                        ->where('offers.offerIdx', $request->offerIdx)
                        ->get()
                        ->first();
            $buyer = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('userIdx', $user->userIdx)->get()->first();

            $product = OfferProduct::with('region')->where('productIdx', $request->productIdx)->get()->first();

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
    }
    public function edit_bid(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'send a bid for this data');
        }else{
            $product = OfferProduct::with('region')->where('productIdx', $request->pid)->get()->first();
            $offer = Offer::where('offerIdx', $request->id)->get()->first();
            $providerIdx = $offer['providerIdx'];
            $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
            $bid = Bid::where('productIdx', $request->pid)->where('userIdx', $user->userIdx)->get()->first();
            $data = array('product', 'provider', 'bid');
            return view('data.edit_bid', compact($data));
        }
    }
    public function update_bid(Request $request){
        $user = $this->getAuthUser();

        $fields = [
            'bidPrice' => ['required', 'numeric']
        ];

        $messages = [
            'bidPrice.required' => 'Your bid price is required.',
            'bidPrice.numeric' => 'Bid price must be numeric.'
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
        $offer = Offer::where('offerIdx', $request->id)->get()->first();
        $providerIdx = $offer['providerIdx'];
        $provider = Provider::with('region')->where('providerIdx', $providerIdx)->get()->first();
        $companyName = $provider->companyName;
        $offerIdx = $request->id;
        $data = array('companyName', 'offerIdx');
        return view("data.send_bid_success", compact($data));
    }
    public function bid_respond(Request $request){
        $bidObj = Bid::where('bidIdx', $request->bid)
                    ->join('users', 'users.userIdx', '=', 'bids.userIdx')
                    ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->join('offerProducts', 'offerProducts.productIdx', '=', 'bids.productIdx')
                    ->get(["bids.*", "bids.created_at as createdAt", "users.*", "companies.*", "offerProducts.*"])
                    ->first();
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

        $mailData['seller'] = $seller;
        $mailData['buyer'] = $buyer;
        $mailData['product'] = $product;

        if($request->response==1){
            $this->sendEmail("acceptbid", [
                'from'=>'pe@jts.ec', 
                'to'=>$buyer['email'], 
                'subject'=>'Your bid on a data product was accepted.', 
                'name'=>'Databroker',
                'data'=>$mailData
            ]);
        }
        else if($request->response==-1){
            $this->sendEmail("rejectbid", [
                'from'=>'pe@jts.ec', 
                'to'=>$buyer['email'], 
                'subject'=>'Your bid on a data product was rejected.', 
                'name'=>'Databroker',
                'data'=>$mailData
            ]);
        }

        return redirect(route('profile.seller_bids'));
    }
}
