<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use App\Models\Community;
use App\Http\Controllers\DataController;

Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('/profile', 'ProfileController@index')->name('account.profile');
	Route::get('/profile/company', 'ProfileController@company')->name('account.company');
	Route::post('/profile/company', 'ProfileController@update_company')->name('account.company.update');
	Route::post('/profile/edit', 'ProfileController@update')->name('account.profile.update');	
	Route::get('/profile/purchases', 'ProfileController@purchases')->name('account.purchases');	
	Route::get('/wallet', 'ProfileController@wallet')->name('account.wallet');	
		
	Route::get('/data/offers', 'DataController@offers')->name('data_offers');		//should rename as publish
	Route::get('/data/offers/overview', 'DataController@offers_overview')->name('data_offers_overview');	
	Route::get('/data/offers/{id}', 'DataController@offer_detail')->where('id', '[0-9]+')->name('data_offer_detail');
	Route::get('/data/publish', 'DataController@offer_publish')->name('data_offer_publish');
	
	Route::post('/data/add', 'DataController@add_offer')->name('data.add_offer');			

	Route::get('/bids', 'ProfileController@bids')->name('profile.bids');
});

Route::get('/', 'HomeController@index')->name('home');
Route::post('/offer/filter', 'DataController@filter_offer')->name('data.filter_offer');	
Route::get('/data/{id}', 'DataController@details')->where('id', '[0-9]+')->name('data_details');

Route::get('/about', 'AboutController@index')->name('about.about');    
Route::get('/contact', 'AboutController@contact')->name('contact');    
Route::get('/about/matchmaking', 'AboutController@matchmaking')->name('about.matchmaking'); 
Route::get('/about/partners', 'AboutController@partners')->name('about.partners');    
Route::get('/about/usecase', 'AboutController@usecase')->name('about.usecase'); 

Route::get('/help', 'HelpController@index')->name('help.overview');    	
Route::get('/help/buying-data', 'HelpController@buying_data')->name('help.buying_data');    	

$communities = Community::get();
$datacontroller = new DataController();
foreach ($communities as $key => $community) {

	$community_route = str_replace( ' ', '_', strtolower($community->communityName) );
	$data = array('datacontroller'=>$datacontroller, 'community'=>$community);
	Route::get('/'.$community_route, function() use($data){			
		return $data['datacontroller']->category($data['community']->communityName);
	})->name('data.'.$community_route);	
	
	Route::get('/community/'.$community_route, function() use($data){			
		return $data['datacontroller']->community($data['community']->communityName);
	})->name('data.community_'.$community_route);	
}

Route::get('/register_nl', 'Auth\RegisterController@register_nl')->name('auth.register_nl'); 
Route::post('/register_nl', 'Auth\RegisterController@create_nl')->name('auth.create_nl'); 

Auth::routes(['verify' => true]);
Auth::routes();




