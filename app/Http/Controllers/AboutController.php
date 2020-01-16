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
        return view('more.usecase', compact($data));
    }
}
