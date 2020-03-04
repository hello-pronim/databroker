<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Provider;
use App\Models\Region;
use App\Models\Community;
use App\Models\Offer;
use App\Models\Theme;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferProduct;
use App\Models\OfferCountry;
use App\Models\ProductCountry;
use App\Models\RegionProduct;
use App\Models\UseCase;
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
        $user_info = User::where('userIdx', $offer->provider->userIdx)->first();
        
        $offersample = OfferSample::with('offer')->where('offerIdx', $request->id)->where('deleted', 0)->get();
        
        $prev_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        
        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $request->id)->get();

        $user = $this->getAuthUser();

        if(  strpos($prev_route, 'data_community.') === false ){
            $prev_route = '';
        }
    
        $data = array('id'=>$request->id, 'offer' => $offer, 'offersample' => $offersample, 'prev_route' => $prev_route, 'user' => $user, 'user_info' => $user_info, 'products' => $products);
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
                return redirect(route('data_offer_provider'));
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
            // die(json_encode($theme_map));
            $theme_json = json_encode($theme_map);

            $data = array( 'regions', 'countries', 'communities', 'theme_json' );
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

        $offer_path = URL::to('/uploads/offer');
        $offer_images = [$offer['offerImage']];

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

        $data = array( 'offerIdx', 'regions', 'countries', 'communities', 'offer', 'products', 'id', 'link_to_market', 'regionCheckList', 'usecase', 'sample_files', 'sample_images', 'offersample_path', 'offer_path', 'offer_images', 'theme_json', 'themeCheckList' );
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

            $fileName = "offer_".$offerIdx.'.'.$request->file('offerImage_1')->extension();
            $request->file('offerImage_1')->move($offerImage_path, $fileName);
            
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
                $offer_data['offerImage'] = $fileName;
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
        $totalcount = Offer::join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')->where('communities.communityName', ucfirst($category))->where('offers.status', 1)->get()->count();

        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount', 'per_page' );                
        return view('data.category', compact($data));

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
        $link_to_market = route('data_community.'.$community_route);
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
                
                $company = User::where('userIdx', $user->userIdx)->first()['companyName'];
                $data = array('countries', 'company');

                return view('data.offer_provider', compact($data));
            }
        }
    }

    public function save_offer_provider(Request $request){

        $fields = [
            'companyName' => ['required', 'string', 'max:255'],
            'regionIdx' => ['required', 'integer'],            
            'companyURL' => ['required', 'string', 'max:255', "regex: /^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/"]            
        ];    
        $messages = [
            'companyName.required'=>'The company name is required.',
            'regionIdx.required'=>'The region is required.',
            'companyURL.required'=>'The company url is required.',
            'companyURL.regex'=>'The url format is invalid.'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }

        $provider_data = [];
        $providerCompanyLogo_path = public_path('uploads/provider');
        
        $user = $this->getAuthUser();
        $providerIdx = -1;
        $provider_obj = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if (!$provider_obj) {
            $provider_data['userIdx'] = Auth::id();
            $provider_data['regionIdx'] = $request->regionIdx;
            $provider_data['companyName'] = $request->companyName;
            $provider_data['companyURL'] = $request->companyURL;

            $provider_obj = Provider::create($provider_data);
            $providerIdx = $provider_obj['providerIdx'];  

            if($request->file('companyLogo_1')!= null){
                $fileName = "company_".$providerIdx.'.'.$request->file('companyLogo_1')->extension();
                $request->file('companyLogo_1')->move($providerCompanyLogo_path, $fileName);
                
                Provider::where('providerIdx', $providerIdx)->update(array( "companyLogo" => $fileName ));    
            }
        }

        return response()->json(array( "success" => true, 'redirect' => route('data_offers') ));
    }

    public function offer_product_publish_confirm($id, Request $request){
        $data = array('id');
        return view('data.offer_product_publish_confirm', compact($data));
    }        

    public function offer_product_update_confirm($id, $pid, Request $request){
        $offer = Offer::find($id);
        $product = OfferProduct::find($pid);
        $offerTitle = $offer['offerTitle'];
        $productTitle = $product['productTitle'];
        $data = array('id', 'pid', 'offerTitle', 'productTitle');
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

    public function send_message($id, $pid, $uid) {
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'contact the data provider');
        }
        
        $data['offer'] = Offer::with(['provider','region'])->find($id);
        $data['provider_info'] = User::find($uid); // proivder id
        return view('data.send_message')->with($data);
    }

    public function post_send_message(Request $request)
    {
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'contact the data provider');
        }else
        {
            $validator = Validator::make($request->all(),[
                'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'message' => 'required|min:5|max:1000',
            ]);

            if ($validator->fails()) {
                return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
            }

            $email_from = $request->input('email');
            $email_to = $request->input('email_to');
            $message = $request->input('message');
            $id = $request->input('id');
            $company_name = $request->input('company_name');

            $this->sendEmail("send_message_contact", [
                'from'=>$email_from, 
                'to'=>$email_to, 
                'name'=>'Databroker', 
                'subject'=>'You’ve received a message on a data product from User',
                'data'=>$message
            ]);

            $data['id'] = $id;
            $data['company_name'] = $company_name;
            return view('data.send_message_success')->with($data);
        }
     

    }

    public function buy_data(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'buy this data');
        }
    }

    public function send_bid(Request $request){
        $user = $this->getAuthUser();
        if(!$user) {
           return redirect('/login')->with('target', 'send a bid for this data');
        }else{
            $offer = Offer::with(['region', 'theme', 'provider', 'community', 'usecase'])->where('offerIdx', $request->id)->first();
            $user_info = User::where('userIdx', $offer->provider->userIdx)->first();
            
            $offersample = OfferSample::with('offer')->where('offerIdx', $request->id)->where('deleted', 0)->get();
            
            $prev_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
            
            $product = OfferProduct::with(['region'])->where('offerIdx', '=', $request->id)->where('productIdx', '=', $request->pid)->get()->first();

            $user = $this->getAuthUser();

            $data['offer'] = $offer;
            $data['user_info'] = $user_info;
            $data['offersample'] = $offersample;
            $data['prev_route'] = $prev_route;
            $data['product'] = $product;
            $data['user'] = $user;

            $this->sendEmail("sendbid", [
                'from'=>'yuriyes43@gmail.com', 
                'to'=>$user->email, 
                'name'=>'Databroker', 
                'subject'=>'You’ve received a bid on a data product ',
                'data'=>$data
            ]);        
        }
    }
}
