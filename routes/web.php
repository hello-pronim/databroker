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

use App\Model\Task;
use Illuminate\Http\Request;
use App\Model\Community;
use App\Http\Controllers\DataController;

Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('/profile', 'ProfileController@index')->name('account.profile');
	Route::post('/profile/edit', 'ProfileController@update')->name('account.profile.update');
	Route::get('/profile/purchases', 'ProfileController@purchases')->name('account.purchases');	
	
	Route::get('/data/{id}', 'DataController@details')->where('id', '[0-9]+')->name('data_details');
	Route::get('/data/offers', 'DataController@offers')->name('data_offers');		//should rename as publish
	Route::get('/data/offers/overview', 'DataController@offers_overview')->name('data_offers_overview');	
	Route::get('/data/offers/{id}', 'DataController@offer_detail')->where('id', '[0-9]+')->name('data_offer_detail');	

	Route::post('/data/add', 'DataController@add_offer')->name('data.add_offer');	
	

	Route::get('/geographic', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Geographic");
	})->name('data.geographic');	
	Route::get('/environment', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Environment");
	})->name('data.environment');	
	Route::get('/transport', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Transport");
	})->name('data.transport');	
	Route::get('/mobility', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Mobility");
	})->name('data.mobility');	
	Route::get('/people', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("People");
	})->name('data.people');	
	Route::get('/agriculture', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Agriculture");
	})->name('data.agriculture');	
	Route::get('/energy', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Energy");
	})->name('data.energy');	
	Route::get('/economy', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Economy");
	})->name('data.economy');	
	Route::get('/supply_chain', function(){
		$datacontroller = new DataController();
		return $datacontroller->category("Supply Chain");
	})->name('data.supply_chain');		
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Auth::routes();




