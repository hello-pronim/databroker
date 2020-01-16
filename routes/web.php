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
	Route::post('/profile/edit', 'ProfileController@update')->name('account.profile.update');
	Route::get('/profile/purchases', 'ProfileController@purchases')->name('account.purchases');	
	Route::get('/wallet', 'ProfileController@wallet')->name('account.wallet');	
		
	Route::get('/data/offers', 'DataController@offers')->name('data_offers');		//should rename as publish
	Route::get('/data/offers/overview', 'DataController@offers_overview')->name('data_offers_overview');	
	Route::get('/data/offers/{id}', 'DataController@offer_detail')->where('id', '[0-9]+')->name('data_offer_detail');
	
	Route::post('/data/add', 'DataController@add_offer')->name('data.add_offer');			

	Route::get('/usecase', 'MoreController@usecase')->name('more.usecase');    
});

Route::get('/', 'HomeController@index')->name('home');
Route::post('/offer/filter', 'DataController@filter_offer')->name('data.filter_offer');	
Route::get('/data/{id}', 'DataController@details')->where('id', '[0-9]+')->name('data_details');

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

Auth::routes(['verify' => true]);
Auth::routes();




