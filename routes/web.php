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

Route::group(['middleware' => ['ReturnAfterAuthentication']], function(){
	Route::group(['middleware' => ['auth']], function(){
		Route::get('/profile', 'ProfileController@index')->name('account.profile');
		Route::get('/profile/company', 'ProfileController@company')->name('account.company');
		Route::post('/profile/company', 'ProfileController@update_company')->name('account.company.update');
		Route::post('/profile/edit', 'ProfileController@update')->name('account.profile.update');	
		Route::get('/profile/purchases', 'ProfileController@purchases')->name('account.purchases');	
		Route::get('/wallet', 'ProfileController@wallet')->name('account.wallet');	
		Route::post('/user/delete', 'ProfileController@delete')->name('account.delete');	
		Route::post('/invite', 'ProfileController@invite_user')->name('account.invite_user');

		Route::get('/data/offers/overview', 'DataController@offers_overview')->name('data_offers_overview');			
		Route::get('/data/offers/{id}', 'DataController@offer_detail')->where('id', '[0-9]+')->name('data_offer_detail');
		Route::get('/data/offers/{id}/confirmation', 'DataController@offer_publish_confirm')->where('id', '[0-9]+')->name('data_offer_publish_confirm');
		Route::get('/data/offers/{id}/edit', 'DataController@offer_edit')->where('id', '[0-9]+')->name('data_offer_edit');
		Route::post('/data/offers/{id}/update', 'DataController@update_offer')->where('id', '[0-9]+')->name('data.update_offer');
        Route::get('/data/offers/{id}/confirm-update', 'DataController@offer_update_confirm')->where('id', '[0-9]+')->name('data_offer_update_confirm');
        		
		Route::get('/data/offers/{id}/product/add', 'DataController@offer_add_product')->where('id', '[0-9]+')->name('data_offer_add_product');
		Route::get('/data/offers/{id}/product/{pid}/edit', 'DataController@offer_edit_product')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data_offer_edit_product');
		Route::post('/data/product/add', 'DataController@offer_submit_product')->name('data_offer_submit_product');
		Route::get('/data/offers/{id}/product/{pid}/confirmation', 'DataController@offer_product_publish_confirm')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data_offer_product_publish_confirm');
		Route::get('/data/offers/{id}/product/{pid}/confirm-update', 'DataController@offer_product_update_confirm')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data_offer_product_update_confirm');
		Route::get('/data/offers/{id}/confirmation', 'DataController@offer_publish_confirm')->where('id', '[0-9]+')->name('data_offer_publish_confirm');
		Route::get('/data/offers/{id}/confirm-update', 'DataController@offer_update_confirm')->where('id', '[0-9]+')->name('data_offer_update_confirm');
		Route::get('/data/bid/{id}/{pid}', 'DataController@bid')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.bid');
		Route::post('/data/bid/', 'DataController@send_bid')->name('data.send_bid');
		Route::get('/data/buy_data/{id}/{pid}', 'DataController@buy_data')->name('data.buy_data');
		
		Route::post('/data/add', 'DataController@add_offer')->name('data.add_offer');
		Route::post('/data/update-status', 'DataController@data_update_status')->name('data.update_status');			

		Route::get('/bids', 'ProfileController@bids')->name('profile.bids');
	});

	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/offer/filter', 'DataController@filter_offer')->name('data.filter_offer');	

	Route::get('/data/{id}', 'DataController@details')->where(array('id' => '[0-9]+'))->name('data_details');
	Route::get('/{community}/{theme}', 'DataController@offer_filter')->where('theme', '[0-9]+')->name('data.offer_filter');

	Route::get('/data/send_message/{id}/{pid}/{uid}', 'DataController@send_message')->name('data.send_message');	
	Route::get('/data/publish', 'DataController@offer_publish')->name('data_offer_publish');
	Route::get('/data/start', 'DataController@offer_start')->name('data_offer_start');
	Route::get('/data/second', 'DataController@offer_second')->name('data_offer_second');
	Route::get('/data/provider', 'DataController@offer_provider')->name('data_offer_provider');

	Route::post('/data/send_message', 'DataController@post_send_message')->name('data.post_send_message');
	Route::get('/data/send_message', 'DataController@post_send_message')->name('data.post_send_message');
	Route::post('/data/provider', 'DataController@save_offer_provider')->name('save_data_offer_provider');

	Route::get('/data/offers', 'DataController@offers')->name('data_offers');		//should rename as publish		

	Route::get('/about', 'AboutController@index')->name('about.about');  
	Route::get('/terms_conditions', 'AboutController@terms_conditions')->name('about.terms_conditions');   
	Route::get('/privacy_policy', 'AboutController@privacy_policy')->name('about.privacy_policy');   
	Route::get('/cookie_policy', 'AboutController@cookie_policy')->name('about.cookie_policy');    
	Route::get('/contact', 'AboutController@contact')->name('contact'); 
	Route::post('/contact', 'AboutController@send')->name('contact.send');       
	Route::get('/contact_pass', 'AboutController@contact_pass')->name('contact_pass');
	Route::post('/contact_pass', 'AboutController@contact_pass_send')->name('contact_pass.send');
	Route::get('/about/matchmaking', 'AboutController@matchmaking')->name('about.matchmaking'); 
	Route::get('/about/media-center', 'AboutController@media_center')->name('about.media_center'); 
	Route::get('/about/partners', 'AboutController@partners')->name('about.partners');    
	Route::get('/about/usecase', 'AboutController@usecase')->name('about.usecase'); 
	    	
	Route::get('/help', 'HelpController@index')->name('help.overview');    	
	Route::get('/help/buying-data', 'HelpController@buying_data')->name('help.buying_data'); 
	Route::get('/help/selling-data', 'HelpController@selling_data')->name('help.selling_data');  
	Route::get('/help/guarantee', 'HelpController@guarantee')->name('help.guarantee'); 
	Route::get('/help/file_complaint', 'HelpController@file_complaint')->name('help.file_complaint');
	Route::get('/help/file_complaint/send_file_complaint', 'HelpController@send_file_complaint')->name('help.send_file_complaint');
	Route::post('/help/file_complaint/send_file_complaint', 'HelpController@post_send_file_complaint')->name('help.post_send_file_complaint');
	Route::get('/help/feedback', 'HelpController@feedback')->name('help.feedback');

	Route::get('/emailtest', 'HomeController@test')->name('test.email'); 	

	Route::get('/download/data-toolkit', 'AboutController@download')->name('download.data-toolkit');
	Route::get('/about/usecase/{id}', 'AboutController@usecase_detail')->where('id', '[0-9]+')->name('about.usecase_detail');

	//admin route
	Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
	Route::get('/admin/usecases', 'AdminController@usecases')->name('admin.usecases');
	Route::get('/admin/usecases/add_new', 'AdminController@usecases_add_new')->name('admin.usecases.add_new');
	Route::post('/admin/usecases/update', 'AdminController@usecases_update')->name('admin.usecases.update');
	Route::post('/admin/usecases/upload_attach/{articleIdx}', 'AdminController@usecases_upload_attach')->name('admin.usecases_upload_attach');
	Route::get('/admin/usecases/edit/{id}', 'AdminController@usecases_edit')->where('id', '[0-9]+')->name('admin.usecases_edit');



	$communities = Community::get();
	$datacontroller = new DataController();
	foreach ($communities as $key => $community) {

		$community_route = str_replace( ' ', '_', strtolower($community->communityName) );
		$data = array('datacontroller'=>$datacontroller, 'community'=>$community);
		Route::get('/'.$community_route, function() use($data){			
			return $data['datacontroller']->category($data['community']->communityName);
		})->name('data_community.'.$community_route);	
		
		Route::get('/community/'.$community_route, function() use($data){			
			return $data['datacontroller']->community($data['community']->communityName);
		})->name('data.community_'.$community_route);	
	}
	Route::get('/register_nl', 'AboutController@register_nl')->name('register_nl'); 
	Route::post('/register_nl', 'AboutController@create_nl')->name('create_nl'); 
});

Auth::routes(['verify' => true]);
Auth::routes();