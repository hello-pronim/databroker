<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\Community;
use App\Models\Company;
use App\Models\Theme;
use App\Models\Region;
use App\Models\HelpTopic;

use App\Http\Requests;

class SitemapController extends Controller
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

    public function index()
    {
        $offers = Offer::with(['region', 'theme', 'provider', 'community', 'usecase'])
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->orderby('offers.created_at', 'desc')
                        ->get(['offers.*', 'offers.updated_at as updatedAt', 'providers.*', 'users.*']);
        $themes = Theme::join('communities', 'themes.communityIdx', '=', 'communities.communityIdx')->get();
        $regions = Region::get();
        $communities = Community::get();
        $companies = Company::orderby('created_at', 'desc')->get();
        $selling_topics = HelpTopic::where('page', 'selling')->where('active', 1)->get();
        $buying_topics = HelpTopic::where('page', 'buying')->where('active', 1)->get();
        $data = array('offers', 'communities', 'companies', 'themes', 'regions', 'selling_topics', 'buying_topics');
      	return response()->view('sitemap.index', compact($data))->header('Content-Type', 'text/xml');
    }
}