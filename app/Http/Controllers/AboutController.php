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

class AboutController extends Controller
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
                'logo'  => '/images/partners/Image_1.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_2.png',
            ),
            array(
                'id'    => 3,
                'logo'  => '/images/partners/Image_3.png',
            ),
            array(
                'id'    => 4,
                'logo'  => '/images/partners/Image_4.png',
            ),
            array(
                'id'    => 5,
                'logo'  => '/images/partners/Image_5.png',
            ),
            array(
                'id'    => 6,
                'logo'  => '/images/partners/Image_6.png',
            ),
            array(
                'id'    => 7,
                'logo'  => '/images/partners/Image_7.png',
            ),
            array(
                'id'    => 8,
                'logo'  => '/images/partners/Image_8.png',
            ),
            array(
                'id'    => 9,
                'logo'  => '/images/partners/Image_9.png',
            ),
            array(
                'id'    => 10,
                'logo'  => '/images/partners/Image_10.png',
            ),
            array(
                'id'    => 11,
                'logo'  => '/images/partners/Image_11.png',
            ),
            array(
                'id'    => 12,
                'logo'  => '/images/partners/Image_12.png',
            ),
            array(
                'id'    => 13,
                'logo'  => '/images/partners/Image_13.png',
            ),
            array(
                'id'    => 14,
                'logo'  => '/images/partners/Image_14.png',
            ),
            array(
                'id'    => 15,
                'logo'  => '/images/partners/Image_15.png',
            ),
            array(
                'id'    => 16,
                'logo'  => '/images/partners/Image_16.png',
            ),
            array(
                'id'    => 17,
                'logo'  => '/images/partners/Image_17.png',
            ),
            array(
                'id'    => 18,
                'logo'  => '/images/partners/Image_18.png',
            ),
            // array(
            //     'id'    => 19,
            //     'logo'  => '/images/partners/Image_19.png',
            // ),
            // array(
            //     'id'    => 20,
            //     'logo'  => '/images/partners/Image_20.png',
            // ),
            array(
                'id'    => 21,
                'logo'  => '/images/partners/Image_21.png',
            ),
            array(
                'id'    => 22,
                'logo'  => '/images/partners/Image_22.png',
            ),
            array(
                'id'    => 23,
                'logo'  => '/images/partners/Image_23.png',
            ),
            array(
                'id'    => 24,
                'logo'  => '/images/partners/Image_24.png',
            ),
            // array(
            //     'id'    => 25,
            //     'logo'  => '/images/partners/Image_25.png',
            // ),
            // array(
            //     'id'    => 26,
            //     'logo'  => '/images/partners/Image_26.png',
            // ),
        );
        $partners2 = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/Image_1.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_2.png',
            ),
        );
        $data = array( 'partners', 'partners2' );
        return view('about.partners', compact($data));
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

        $data = array( 'usecases', 'usecases2' );
        return view('about.usecase', compact($data));
    }
}
