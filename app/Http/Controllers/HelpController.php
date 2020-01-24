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

class HelpController extends Controller
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
        );        
        $data = array( 'teammates' );
        return view('help.overview', compact($data));
    }

    public function buying_data(Request $request)
    {
        $topics = array(
            array(
                'id'        => 1, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 2, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
            array(
                'id'        => 3, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 4, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 5, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 6, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
        );
        $texts = array(
            'title' => 'Buying data',
            'title-description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
            'section2' => 'Top 10 FAQ',
            'faq_explain' => '(Short explanation) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
        );
        $faqs = array(
            array(
                'id'        => '1',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '2',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '3',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '4',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '5',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '6',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
        );
        $data = array( 'topics', 'texts', 'faqs' );
        return view('help.buying-data', compact($data));
    }
}
