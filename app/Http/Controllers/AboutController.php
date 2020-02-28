<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Provider;
use App\Models\Region;
use App\Models\Community;
use App\Models\Offer;
use App\Models\Business;
use App\Models\Theme;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferCountry;
use App\Models\UseCase;
use App\Models\Contact;

class AboutController extends Controller
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

    public function index(Request $request)
    {
        $teammates = array(
            array(
                'id'        => 1, 
                'avatar'    => '../images/dummy/Matthew_DB.png', 
                'name'      => 'Matthew van Niekerk',
                'title'  => 'Co-founder and CEO', 
            ),
            array(
                'id'        => 2, 
                'avatar'    => '../images/dummy/Roderik_DB.png', 
                'name'      => 'Roderik van der Veer',
                'title'  => 'Co-founder and CTO', 
            ),
            array(
                'id'        => 3, 
                'avatar'    => '../images/dummy/Vincent_DB.png', 
                'name'      => 'Vincent Bultot',
                'title'  => 'DataMatch Advisor', 
            ),
            array(
                'id'        => 4, 
                'avatar'    => '../images/dummy/Valentina_DB.png', 
                'name'      => 'Valentina Ponomariova',
                'title'  => 'Marketing and Communications Manager', 
            ),
        );        
        $data = array( 'teammates' );
        return view('about.about', compact($data));
    }

    public function partners(Request $request)
    {        
        $partners = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/Image_0_1.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_0_2.png',
            ),
            array(
                'id'    => 3,
                'logo'  => '/images/partners/Image_0_3.png',
            ),
            array(
                'id'    => 4,
                'logo'  => '/images/partners/Image_0_4.png',
            ),
            array(
                'id'    => 5,
                'logo'  => '/images/partners/Image_0_5.png',
            ),
            array(
                'id'    => 6,
                'logo'  => '/images/partners/Image_1.png',
            ),
            array(
                'id'    => 7,
                'logo'  => '/images/partners/Image_2.png',
            ),
            array(
                'id'    => 8,
                'logo'  => '/images/partners/Image_3.png',
            ),
            array(
                'id'    => 9,
                'logo'  => '/images/partners/Image_4.png',
            ),
            array(
                'id'    => 10,
                'logo'  => '/images/partners/Image_5.png',
            ),
            array(
                'id'    => 11,
                'logo'  => '/images/partners/Image_6.png',
            ),
            array(
                'id'    => 12,
                'logo'  => '/images/partners/Image_7.png',
            ),
            array(
                'id'    => 13,
                'logo'  => '/images/partners/Image_8.png',
            ),
            array(
                'id'    => 14,
                'logo'  => '/images/partners/Image_9.png',
            ),
            array(
                'id'    => 15,
                'logo'  => '/images/partners/Image_10.png',
            ),
            array(
                'id'    => 16,
                'logo'  => '/images/partners/Image_11.png',
            ),
            array(
                'id'    => 17,
                'logo'  => '/images/partners/Image_12.png',
            ),
            array(
                'id'    => 18,
                'logo'  => '/images/partners/Image_13.png',
            ),
            array(
                'id'    => 19,
                'logo'  => '/images/partners/Image_14.png',
            ),
            array(
                'id'    => 20,
                'logo'  => '/images/partners/Image_15.png',
            ),
            array(
                'id'    => 21,
                'logo'  => '/images/partners/Image_16.png',
            ),
            array(
                'id'    => 22,
                'logo'  => '/images/partners/Image_17.png',
            ),
            array(
                'id'    => 23,
                'logo'  => '/images/partners/Image_18.png',
            ),
            array(
                'id'    => 24,
                'logo'  => '/images/partners/Image_21.png',
            ),
            array(
                'id'    => 25,
                'logo'  => '/images/partners/Image_22.png',
            ),
            array(
                'id'    => 26,
                'logo'  => '/images/partners/Image_23.png',
            ),
            array(
                'id'    => 27,
                'logo'  => '/images/partners/Image_24.png',
            ),
        );
        $resellers = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/Image_25.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_26.png',
            ),
        );
        $data = array( 'partners', 'resellers' );
        return view('about.partners', compact($data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function matchmaking(Request $request)
    {        
        return view('about.matchmaking');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usecase(Request $request)
    {        
        $usecases = array( 
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'traffic_80.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'shop_80.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'Agriculture.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'People.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'Energy.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'Environment.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'traffic_80.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'Agriculture.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'photo_1532974297617_c0f05fe48b.png',
            ),
        );
        $usecases2 = array( 
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Transport',
                'image' => 'traffic_80.png',
            ),
            array(
                'id' => 1,
                'title' => 'Achieve your full potential with retail location planning', 
                'category' => 'People',
                'image' => 'shop_80.png',
            ),
            array(
                'id' => 1,
                'title' => 'Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.', 
                'category' => 'Agriculture',
                'image' => 'Agriculture.png',
            ),
        );
        $communities = Community::all();

        $data = array( 'usecases', 'usecases2', 'communities' );
        return view('about.usecase', compact($data));
    }

    public function contact(){
        $communities = Community::get();  
        $businesses = Business::get();
        $data = array( 'communities', 'businesses' );
        return view('about.contact', compact($data));
    }

    public function send(Request $request){
        $user = Auth::user();
        if(!$user){
            return redirect('/login')->with('target', 'use our DataMatch service');
        }else{
            $validator = Validator::make($request->all(),[
                'firstname' => 'required|min:2',
                'lastname' => 'required|min:2',
                'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'message' => 'required|min:5|max:1000',
                'companyName' => 'required|min:2',
                'country' => 'required|min:2',
                'community'=> 'required|array|min:1'
            ],[
                'community.required'=>'Please choose at least one.'
            ]);

            if ($validator->fails()) {
                return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
            }

            $businessName = $request->businessName2==='Other industry'?$request->businessName:$request->businessName2;
            $jobTitle = $request->jobTitle2==='Other'?$request->jobTitle:$request->jobTitle2;

            $contact_data['firstname'] = $request->firstname;
            $contact_data['lastname'] = $request->lastname;
            $contact_data['email'] = $request->email;        
            $contact_data['companyName'] = $request->companyName;
            $contact_data['jobTitle'] = $jobTitle;
            $contact_data['content'] = $request->message;
            $contact_obj = Contact::create($contact_data);
            return view('about.contact_success');
        }
    }

    public function media_center(){
        $press_list = array(
            array(
                'id'    => 1,
                'title' => 'Media inquiries',
                'text'  => 'We’re always happy to work with journalists from around the world to discuss the rising value and importance of data in general, or Databroker’s peer-to-peer data marketplace in particular. If you’re a member of the media and would like to talk with us, please get in touch.',
                'action'=> 'CONTACT US',
                'link'=>'contact'
            ),
            array(
                'id'    => 2,
                'title' => 'Databroker media kit',
                'text'  => 'Our media kit contains everything you need to write about Databroker, including web-friendly logos, photos of our team, short biographies of our founders, a company overview and a summary of what our platform offers.',
                'action'=> 'DOWNLOAD OUR MEDIA KIT',
                'link'=>''
            ),
        );
        $partners = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/Image_0_1.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_0_2.png',
            ),
            array(
                'id'    => 3,
                'logo'  => '/images/partners/Image_0_3.png',
            ),
            array(
                'id'    => 4,
                'logo'  => '/images/partners/Image_0_4.png',
            ),
            array(
                'id'    => 5,
                'logo'  => '/images/partners/Image_0_5.png',
            ),
            array(
                'id'    => 6,
                'logo'  => '/images/partners/Image_1.png',
            ),
            array(
                'id'    => 7,
                'logo'  => '/images/partners/Image_2.png',
            ),
            array(
                'id'    => 8,
                'logo'  => '/images/partners/Image_3.png',
            ),
            array(
                'id'    => 9,
                'logo'  => '/images/partners/Image_4.png',
            ),
            array(
                'id'    => 10,
                'logo'  => '/images/partners/Image_5.png',
            ),
            array(
                'id'    => 11,
                'logo'  => '/images/partners/Image_6.png',
            ),
            array(
                'id'    => 12,
                'logo'  => '/images/partners/Image_7.png',
            ),
            array(
                'id'    => 13,
                'logo'  => '/images/partners/Image_8.png',
            ),
            array(
                'id'    => 14,
                'logo'  => '/images/partners/Image_9.png',
            ),
            array(
                'id'    => 15,
                'logo'  => '/images/partners/Image_10.png',
            ),
            array(
                'id'    => 16,
                'logo'  => '/images/partners/Image_11.png',
            ),
            array(
                'id'    => 17,
                'logo'  => '/images/partners/Image_12.png',
            ),
            array(
                'id'    => 18,
                'logo'  => '/images/partners/Image_13.png',
            ),
            array(
                'id'    => 19,
                'logo'  => '/images/partners/Image_14.png',
            ),
            array(
                'id'    => 20,
                'logo'  => '/images/partners/Image_15.png',
            ),
            array(
                'id'    => 21,
                'logo'  => '/images/partners/Image_16.png',
            ),
            array(
                'id'    => 22,
                'logo'  => '/images/partners/Image_17.png',
            ),
            array(
                'id'    => 23,
                'logo'  => '/images/partners/Image_18.png',
            ),
            array(
                'id'    => 24,
                'logo'  => '/images/partners/Image_21.png',
            ),
            array(
                'id'    => 25,
                'logo'  => '/images/partners/Image_22.png',
            ),
            array(
                'id'    => 26,
                'logo'  => '/images/partners/Image_23.png',
            ),
            array(
                'id'    => 27,
                'logo'  => '/images/partners/Image_24.png',
            ),
        );
        $data = array( 'press_list', 'partners' );
        return view('about.media_center', compact($data));        
    }

    public function terms_conditions(){
        return view('about.terms_conditions');
    }

    public function privacy_policy(){
        return view('about.privacy_policy');
    }

    public function cookie_policy(){
        return view('about.cookie_policy');
    }
}
