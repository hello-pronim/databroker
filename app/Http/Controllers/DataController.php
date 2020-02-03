<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details(Request $request)
    {        
        $offer = Offer::with(['region', 'provider', 'community', 'usecase'])->where('offerIdx', $request->id)->first();

        $offersample = OfferSample::with('offer')->where('offerIdx', $request->id)->get();
                
        $data = array('offer' => $offer, 'offersample' => $offersample);

        return view('data.details')->with($data);
    }

    public function offers(Request $request){        
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $communities = Community::all();

        $user = $this->getAuthUser();
        $company = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if (!$company) {
            $current_step = 'before';
        } else {
            $current_step = 'step1';
        }

        $data = array( 'regions', 'countries', 'communities', 'current_step' );
        return view('data.offers', compact($data));
    }

    public function offers_overview(Request $request){                
        $offers = Offer::getProduct(Auth::id());

        $data = array( 'offers');
        return view('data.offers_overview', compact($data));
    }

    public function offer_publish(Request $request){
        $communities = Community::get();

        $data = array('communities');
        return view('data.offer_publish', compact($data));   
    }

    public function offer_detail($id, Request $request)
    {   
        $offer = Offer::with(['region'])->where('offers.offerIdx', '=', $id)->first();
        $products = OfferProduct::with(['region'])->where('offerIdx', '=', $id)->get();

        $data = array( 'offer', 'products', 'id' );
        return view('data.offer_detail', compact($data));
    }

    public function add_offer(Request $request){

        $provider_data = [];
        $companyLogo_path = public_path('uploads/company');
                
        $user = $this->getAuthUser();
        $providerIdx = -1;
        $provider_obj = Provider::with('Region')->where('userIdx', $user->userIdx)->first();
        if (!$provider_obj) {
            $provider_data['userIdx'] = Auth::id();
            $provider_data['regionIdx'] = $request->regionIdx;
            $provider_data['companyName'] = $request->companyName;        
            $provider_data['companyURL'] = $request->companyUrl;        

            $provider_obj = Provider::create($provider_data);
            $providerIdx = $provider_obj['providerIdx'];    

            if($request->file('companyLogo_1')!= null){
                $fileName = "company_".$providerIdx.'.'.$request->file('companyLogo_1')->extension();
                $request->file('companyLogo_1')->move($companyLogo_path, $fileName);
                
                Provider::where('providerIdx', $providerIdx)->update(array( "companyLogo" => $fileName ));    
            }
        } else {
            $providerIdx = $provider_obj['providerIdx'];    
        }   

        $offer_data = [];
        $offerImage_path = public_path('uploads/offer');

        $offer_data['offerTitle'] = $request->offerTitle;
        $offer_data['offerDescription'] = $request->offerDescription;
        $offer_data['communityIdx'] = $request->communityIdx;
        $offer_data['providerIdx'] = $providerIdx;
        $offer_data['status'] = 1;

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

    public function offer_add_product($offerIdx , Request $request) {        
        $offer = Offer::with(['region'])->where('offers.OfferIdx', $offerIdx)->first();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();

        $data = array( 'countries', 'offer', 'regions' );
        return view('data.offer_add_product', compact($data));
    }

    public function offer_submit_product(Request $request) {
        $product_data = [];

        $product_data['offerIdx'] = $request->offerIdx;
        $product_data['productType'] = $request->format;
        //$product_data['productMoreInfo'] = $request->productMoreInfo;
        $product_data['productBidType'] = $request->period;
        $period = $product_data['productBidType'].'_period';
        $product_data['productAccessDays'] = $request->$period;        
        if( $request->period == "nobidding" ){
            $product_data['productPrice'] = $request->nobidding_price;    
        } elseif ($request->period == "buyer_bid") {            
            $product_data['productPrice'] = $request->buyer_bid_price;    
        }
        $product_data['productMoreInfo'] = $request->productMoreInfo;
        $product_data['productTitle'] = $request->productTitle;
        $product_data['productLicenseUrl'] = $request->licenceUrl;
        $product_data['productStatus'] = 1;

        $offer_obj = OfferProduct::create($product_data);
        $productIdx = $offer_obj['productIdx'];

        $productcountry_data = [];
        $productcountry_data['productIdx'] = $productIdx;
        $country = explode(',', $request->offercountry);

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
        return response()->json(array( "success" => true, 'offerid' => $offerid, 'redirect' => route('data_offer_product_publish_confirm', ['id'=>$offerid]) ));
    }

    public function category($category=""){

        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        $per_page = 11;

        $dataoffer = Offer::with(['region', 'provider', 'usecase'])->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')->where('communities.communityName', ucfirst($category))->limit($per_page)->get();
        $totalcount = Offer::join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')->where('communities.communityName', ucfirst($category))->get()->count();

        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes', 'totalcount' );                
        return view('data.category', compact($data));

    }

    public function community($community=""){         

        $communities = Community::get();        
        $themes = Theme::get_theme_by_community($community);
        
        $data = array( 'community', 'communities', 'themes' );                
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
        $link_to_market = route('data.'.$community_route);

        $data = array( 'offerId', 'link_to_market' ); //, 'offer_plain', 'community_plain'
        return view('data.offer_publish_confirm', compact($data));
    }

    public function offer_product_publish_confirm(Request $request){
        $data = array(  );
        return view('data.offer_product_publish_confirm', compact($data));
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

}
