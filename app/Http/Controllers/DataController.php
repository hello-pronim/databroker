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
use App\Models\OfferCountry;
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

        $data = array( 'regions', 'countries', 'communities' );
        return view('data.offers', compact($data));
    }

    public function offers_overview(Request $request){        
        $offers = array( 
            array(
                'id' => 1,
                'title' => 'Satellite imagery of highways', 
                'region' => 'Europe',
                'products' => 'not added yet',
                'status' => 'active',
            ),
            array(
                'id' => 2,
                'title' => 'Noise Maps', 
                'region' => 'New York',
                'products' => '6',
                'status' => '',
            ),
            array(
                'id' => 3,
                'title' => 'Flood Maps', 
                'region' => 'Worldwide',
                'products' => '3',
                'status' => '',
            ),
            array(
                'id' => 4,
                'title' => 'Traffic Maps', 
                'region' => 'Worldwide',
                'products' => '3',
                'status' => '',
            ),
        );

        $data = array( 'offers' );
        return view('data.offers_overview', compact($data));
    }

    public function offer_publish(Request $request){
        $communities = Community::get();

        $data = array('communities');
        return view('data.offer_publish', compact($data));   
    }

    public function offer_detail(Request $request)
    {   
        $offer = [
            'title' => 'Satellite imagery of highways',
            'region' => 'Europe',
            'publish_status' => 'Published',            
        ];
        $products = [
                [
                    'title' => 'Satellite imagery of buildings and roads', 
                    'region' => 'Belgium',
                    'format' => 'API flow',
                    'price' => '€500 / DTX xxx',
                    'price_status' => '',
                    'period' => '1 day',
                    'status' => 'Unpublished',
                    'sell_status' => '',
                ],
                [
                    'title' => 'Satellite imagery of highways', 
                    'region' => 'Belgium - Flanders',
                    'format' => 'One file (xml)',
                    'price' => '€500 / DTX xxx',
                    'price_status' => 'Bidding possible',
                    'period' => '1 month',
                    'status' => 'published',
                    'sell_status' => 'pending',
                ],
                [
                    'title' => 'Satellite imagery of buildings and roads', 
                    'region' => 'Germany - Berlin',
                    'format' => 'Stream',
                    'price' => 'Price not set.',
                    'price_status' => 'Only bidding.',
                    'period' => '1 year',
                    'status' => 'published',
                    'sell_status' => 'pending',
                ],
                [
                    'title' => 'Satellite imagery of buildings and roads', 
                    'region' => 'Flanders',
                    'format' => 'Stream',
                    'price' => 'Price not set.',
                    'price_status' => 'Only bidding.',
                    'period' => '',
                    'status' => 'published',
                    'sell_status' => 'ready',
                ],
            ];
        $data = array( 'offer', 'products' );
        return view('data.offer_detail', compact($data));
    }

    public function add_offer(Request $request){

        $provider_data = [];
        $companyLogo_path = public_path('uploads/company');
                
        $provider_data['userIdx'] = Auth::id();
        $provider_data['regionIdx'] = $request->regionIdx;
        $provider_data['companyName'] = $request->companyName;        
        $provider_data['companyURL'] = $request->companyUrl;        

        $provider_obj = Provider::create($provider_data);
        $providerIdx = $provider_obj['providerIdx'];

        $fileName = "company_".$providerIdx.'.'.$request->file('companyLogo_1')->extension();
        $request->file('companyLogo_1')->move($companyLogo_path, $fileName);
        
        Provider::where('providerIdx', $providerIdx)->update(array( "companyLogo" => $fileName ));

        $offer_data = [];
        $offerImage_path = public_path('uploads/offer');

        $offer_data['offerTitle'] = $request->offerTitle;
        $offer_data['offerDescription'] = $request->offerDescription;
        $offer_data['communityIdx'] = $request->communityIdx;
        $offer_data['providerIdx'] = $providerIdx;

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

        return response()->json(array( "success" => true ));

    }   

    public function category($category=""){

        $communities = Community::get();
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $themes = Theme::get();
        
        $dataoffer = Offer::with(['region', 'provider', 'usecase'])->join('communities', 'offers.communityIdx', '=',  'communities.communityIdx')->where('communities.communityName', ucfirst($category))->limit(12)->get();
        
        $data = array('dataoffer', 'category', 'communities', 'regions', 'countries', 'themes' );                
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
}
