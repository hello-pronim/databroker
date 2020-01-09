<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Provider;
use App\Models\Region;
use App\Models\Community;

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
        return view('data.details');
    }

    public function offers(Request $request){        
        $regions = Region::where('regionType', 'area')->get();
        $countries = Region::where('regionType', 'country')->get();
        $communities = Community::all();

        $data = array( 'regions', 'countries', 'communities' );
        return view('data.offers', compact($data));
    }
    public function add_offer(Request $request){

        $provider_data = [];
        $companyLogo_path = public_path('uploads');
                
        $provider_data['userIdx'] = Auth::id();
        $provider_data['regionIdx'] = $request->regionIdx;
        $provider_data['companyName'] = $request->companyName;        
        $provider_data['companyUrl'] = $request->companyUrl;        

        $provider_obj = Provider::create($provider_data);
        $providerIdx = $provider_obj['providerIdx'];

        $fileName = "company_".$providerIdx.'.'.$request->file('companyLogo')->extension();
        $request->file('companyLogo')->move($companyLogo_path, $fileName);
        $provider_data['companyLogo'] = $request->companyLogo;
        Provider::where('providerIdx', $providerIdx)->update(array( "companyLogo" => $fileName ));


    }
}
