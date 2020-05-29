<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\Community;
use App\Models\Company;

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
      	return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }
    public function communities()
    {
        $communities = Community::get();
        return response()->view('sitemap.communities', [
            'communities' => $communities,
        ])->header('Content-Type', 'text/xml');
    }
    public function offers()
    {
        $offers = Offer::with(['region', 'theme', 'provider', 'community', 'usecase'])
                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
        				->orderby('offers.created_at', 'desc')
        				->get(['offers.*', 'offers.created_at as createdAt', 'providers.*', 'users.*']);
        return response()->view('sitemap.offers', [
            'offers' => $offers,
        ])->header('Content-Type', 'text/xml');
    }
    public function company_offers()
    {
        $companies = Company::orderby('created_at', 'desc')->get();
        return response()->view('sitemap.company_offers', [
            'companies' => $companies,
        ])->header('Content-Type', 'text/xml');
    }
}