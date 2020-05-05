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
		Route::get('/profile/purchases/{pid}', 'ProfileController@purchases_detail')->where('pid', '[0-9]+')->name('account.purchases_detail');	
		Route::get('/wallet', 'ProfileController@wallet')->name('account.wallet');	
		Route::get('/profile/sales', 'ProfileController@sales')->name('account.sales');	
		Route::get('/profile/sales/{sid}', 'ProfileController@sales_detail')->where('sid', '[0-9]+')->name('account.sales_detail');	
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
		Route::post('/data/bid/{id}/{pid}', 'DataController@send_bid')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.send_bid');
		Route::get('/data/bid/update/{bid}', 'DataController@edit_bid')->where('bid', '[0-9]+')->name('data.edit_bid');
		Route::post('/data/bid/update/{bid}', 'DataController@update_bid')->where('bid', '[0-9]+')->name('data.update_bid');
		Route::get('/data/bid/success/{id}/{pid}', 'DataController@send_bid_success')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.send_bid_success');
		Route::get('/data/bid/respond/{bid}', 'DataController@bid_respond')->where('bid', '[0-9]+')->where('pid', '[0-9]+')->name('data.bid_respond');
		Route::post('/data/bid/respond/{bid}', 'DataController@send_bid_response')->where('bid', '[0-9]+')->where('pid', '[0-9]+')->name('data.bid_send_response');
		Route::get('/data/buy/{id}/{pid}', 'DataController@buy_data')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.buy_data');
		Route::post('/data/buy/{id}/{pid}', 'DataController@pay_data')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.pay_data');
		Route::get('/data/buy/success/{purIdx}', 'DataController@pay_success')->where('purIdx', '[0-9]+')->name('data.pay_success');

		Route::get('/data/get/{id}/{pid}', 'DataController@get_data')->where('id', '[0-9]+')->where('pid', '[0-9]+')->name('data.get_data');
		
		Route::post('/data/add', 'DataController@add_offer')->name('data.add_offer');
		Route::post('/data/update-status', 'DataController@data_update_status')->name('data.update_status');			

		Route::get('/buyer/bids', 'ProfileController@buyer_bids')->name('profile.buyer_bids');
		Route::get('/seller/bids', 'ProfileController@seller_bids')->name('profile.seller_bids');

		Route::get('/dxc/data_exchange_controller', 'DXCController@data_exchange_controller')->name('dxc.data_exchange_controller');
	});

	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/offer/filter', 'DataController@filter_offer')->name('data.filter_offer');	

	Route::get('/data/{id}', 'DataController@details')->where('id', '[0-9]+')->name('data_details');
	Route::get('/{community}/theme/{theme}', 'DataController@offer_theme_filter')->where('theme', '[0-9]+')->name('data.offer_theme_filter');
	Route::get('/company/{companyIdx}/offers', 'DataController@company_offers')->where('companyIdx', '[0-9]+')->name('data.company_offers');
	Route::get('/{community}/region/{regionIdx}', 'DataController@offer_region_filter')->where('regionIdx', '[0-9]+')->name('data.offer_region_filter');
	Route::get('/getAllThemes', 'DataController@get_all_themes')->name('data.get_all_themes');


	Route::get('/data/send_message/{id}', 'DataController@send_message')->name('data.send_message');	
	Route::post('/data/send_message', 'DataController@post_send_message')->name('data.post_send_message');
	Route::get('/data/send_message_success/{id}', 'DataController@send_message_success')->name('data.send_message_success');	
	
	Route::get('/data/publish', 'DataController@offer_publish')->name('data_offer_publish');
	Route::get('/data/start', 'DataController@offer_start')->name('data_offer_start');
	Route::get('/data/second', 'DataController@offer_second')->name('data_offer_second');
	Route::get('/data/provider', 'DataController@offer_provider')->name('data_offer_provider');

	Route::post('/data/provider', 'DataController@save_offer_provider')->name('save_data_offer_provider');

	Route::get('/data/offers', 'DataController@offers')->name('data_offers');		//should rename as publish		

	Route::get('/about', 'AboutController@index')->name('about.about');  
	Route::get('/terms_conditions', 'AboutController@terms_conditions')->name('about.terms_conditions');   
	Route::get('/privacy_policy', 'AboutController@privacy_policy')->name('about.privacy_policy');   
	Route::get('/cookie_policy', 'AboutController@cookie_policy')->name('about.cookie_policy');    
	Route::get('/contact', 'AboutController@contact')->name('contact'); 
	Route::post('/contact', 'AboutController@send')->name('contact.send');       
	Route::get('/contact_pass', 'AboutController@contact_pass')->name('contact_pass');
	Route::get('/about/matchmaking', 'AboutController@matchmaking')->name('about.matchmaking'); 
	Route::get('/about/media-center', 'AboutController@media_center')->name('about.media_center'); 
	Route::get('/about/partners', 'AboutController@partners')->name('about.partners');    
	Route::get('/about/usecase', 'AboutController@usecase')->name('about.usecase'); 
	Route::get('/about/updates', 'AboutController@news')->name('about.news');
	Route::post('/about/updates/updates_loadmore', 'AboutController@updates_loadmore')->name('about.updates_loadmore');
	Route::post('/about/usecases/usecases_loadmore', 'AboutController@usecases_loadmore')->name('about.usecases_loadmore');
	
	Route::get('/help', 'HelpController@index')->name('help.overview');    	
	Route::get('/help/buying-data', 'HelpController@buying_data')->name('help.buying_data'); 
	Route::get('/help/selling-data', 'HelpController@selling_data')->name('help.selling_data');  
	Route::get('/help/guarantee', 'HelpController@guarantee')->name('help.guarantee'); 
	Route::get('/help/file_complaint', 'HelpController@file_complaint')->name('help.file_complaint');
	Route::get('/help/file_complaint/send', 'HelpController@send_file_complaint')->name('help.send_file_complaint');
	Route::post('/help/file_complaint/send', 'HelpController@post_send_file_complaint')->name('help.post_send_file_complaint');
	Route::get('/help/feedback', 'HelpController@feedback')->name('help.feedback');

	Route::get('/emailtest', 'HomeController@test')->name('test.email'); 	

	Route::get('/download/data-toolkit', 'AboutController@download')->name('download.data-toolkit');
	Route::get('/about/usecase/{id}', 'AboutController@usecase_detail')->where('id', '[0-9]+')->name('about.usecase_detail');
	Route::get('/about/updates/{id}', 'AboutController@news_detail')->where('id', '[0-9]+')->name('about.news_detail');


	Route::group(['middleware' => ['guest_auth']], function(){
		Route::get('/admin/login', "AdminController@login")->name('admin.login');
		Route::post('/admin/login', "AdminController@check_login")->name('admin.check_login');
	});

	Route::group(['middleware' => ['admin_auth']], function(){
		Route::get('/admin/logout', "AdminController@logout")->name('admin.logout');
		//admin route usecase
		Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
		Route::get('/admin/usecases/{id}', 'AdminController@usecases')->where('id', '[0-9]+')->name('admin.usecases');
		Route::get('/admin/usecases/add_new/{id}', 'AdminController@usecases_add_new')->where('id', '[0-9]+')->name('admin.usecases.add_new');
		Route::post('/admin/usecases/update', 'AdminController@usecases_update')->name('admin.usecases.update');
		Route::post('/admin/usecases/upload_attach/{articleIdx}', 'AdminController@usecases_upload_attach')->name('admin.usecases_upload_attach');
		Route::get('/admin/usecases/edit/{id}', 'AdminController@usecases_edit')->where('id', '[0-9]+')->name('admin.usecases_edit');
		Route::post('/admin/usecases/delete/{id}', 'AdminController@usecases_delete')->where('id', '[0-9]+')->name('admin.usecases_delete');
		//admin route media
		Route::get('/admin/media_library', 'AdminController@media_library')->name('admin.media_library');
		Route::get('/admin/media/add_new', 'AdminController@edit_media')->name('admin.add_media');
		Route::get('/admin/media/edit/{mid}', 'AdminController@edit_media')->where('mid', '[0-9]+')->name('admin.edit_media');
		Route::post('/admin/media/delete/{mid}', 'AdminController@delete_media')->where('mid', '[0-9]+')->name('admin.delete_media');
		Route::post('/admin/media/update', 'AdminController@media_update')->name('admin.media_update');
		Route::post('/admin/media/upload_attach/{id}', 'AdminController@media_upload_attach')->name('admin.media_upload_attach');

		//admin route updates
		Route::get('/admin/updates', 'AdminController@updates')->name('admin.updates');
		Route::get('/admin/updates/add_new', 'AdminController@updates_add_new')->name('admin.updates_add_new');
		Route::post('/admin/updates/update', 'AdminController@updates_update')->name('admin.updates_update');
		Route::get('/admin/updates/edit/{id}', 'AdminController@updates_edit')->where('id', '[0-9]+')->name('admin.updates_edit');
		Route::post('/admin/updates/delete/{id}', 'AdminController@updates_delete')->where('id', '[0-9]+')->name('admin.updates_delete');

		Route::get('/admin',  "AdminController@index")->name('admin.index');
		Route::get('/admin/home', 'AdminController@home')->name('admin.home');
		Route::get('/admin/home_featured_data', 'AdminController@home_featured_data')->name('admin.home_featured_data');
		Route::post('/admin/home_featured_data/upload_attach/{id}', 'AdminController@home_featured_data_upload_attach');
		Route::post('/admin/home_featured_data/upload_logo/{id}', 'AdminController@home_featured_data_upload_logo');
		Route::get('/admin/home_featured_data/edit', 'AdminController@home_featured_data_edit')->name('admin.home_featured_data_edit');
		Route::post('/admin/home_featured_data/update', 'AdminController@home_featured_data_update')->name('admin.home_featured_data_update');
		Route::get('/admin/home_trending', 'AdminController@home_trending')->name('admin.home_trending');
		Route::post('/admin/home_trending/upload_attach/{id}', 'AdminController@home_trending_upload_attach')->name('admin.home_trending_upload_attach');
		Route::get('/admin/home_trending/edit/{id}', 'AdminController@home_trending_edit')->where('id', '[0-9]+')->name('admin.home_trending_edit');
		Route::get('/admin/home_trending/add_new', 'AdminController@home_trending_edit')->name('admin.home_trending_add_new');
		Route::post('/admin/home_trending/update', 'AdminController@home_trending_update')->name('admin.home_trending_update');
		Route::get('/admin/home_marketplace', 'AdminController@home_marketplace')->name('admin.home_marketplace');
		Route::get('/admin/home_marketplace/add_new', 'AdminController@home_marketplace_edit')->name('admin.home_marketplace_add_new');
		Route::post('/admin/home_marketplace/update', 'AdminController@home_marketplace_update')->name('admin.home_marketplace_update');
		Route::get('/admin/home_marketplace/edit/{id}', 'AdminController@home_marketplace_edit')->where('id', '[0-9]+')->name('admin.home_marketplace_edit');
		Route::post('/admin/home_marketplace/upload_attach/{id}', 'AdminController@home_marketplace_upload_attach')->name('admin.home_marketplace_upload_attach');
		Route::post('/admin/home_marketplace/upload_logo/{id}', 'AdminController@home_marketplace_upload_logo')->name('admin.home_marketplace_upload_logo');
		Route::get('/admin/home_teampicks', 'AdminController@home_teampicks')->name('admin.home_teampicks');
		Route::get('/admin/home_teampicks/edit/{id}', 'AdminController@home_teampicks_edit')->where('id', '[0-9]+')->name('admin.home_teampicks_edit');
		Route::post('/admin/home_teampicks/update', 'AdminController@home_teampicks_update')->name('admin.home_teampicks_update');
		Route::get('/admin/home_teampicks/add_new', 'AdminController@home_teampicks_edit')->name('admin.home_teampicks_add_new');
		Route::post('/admin/home_teampicks/upload_logo/{id}', 'AdminController@home_teampicks_upload_logo')->name('admin.home_teampicks_upload_logo');
		Route::post('/admin/home_teampicks/upload_attach/{id}', 'AdminController@home_teampicks_upload_attach')->name('admin.home_teampicks_upload_attach');
		Route::get('/admin/home_featured_provider', 'AdminController@home_featured_provider')->name('admin.home_featured_provider');
		Route::get('/admin/home_featured_provider/add_new', 'AdminController@home_featured_provider_edit')->name('admin.home_featured_provider_add_new');
		Route::get('/admin/home_featured_provider/edit/{id}', 'AdminController@home_featured_provider_edit')->where('id', '[0-9]+')->name('admin.home_featured_provider_edit');
		Route::get('/admin/home_featured_provider/delete/{id}', 'AdminController@home_featured_provider_delete')->where('id', '[0-9]+')->name('admin.home_featured_provider_delete');
		Route::post('/admin/home_featured_provider/update', 'AdminController@home_featured_provider_update')->name('admin.home_featured_provider_update');

		Route::get('/admin/preview/home/{url}/{model}', 'AdminController@preview_home')->name('admin.preview_home');
		Route::get('/admin/preview_check/{url}/{model}/{check}', 'AdminController@preview_check')->name('admin.preview_check');

		Route::get('/admin/help/buying_data', 'AdminController@help_buying_data')->name('admin.help.buying_data');
		Route::post('/admin/help/buying_data/update', 'AdminController@update_help_buying_data')->name('admin.help.update_buying_data');
		Route::get('/admin/help/buying_data/faqs', 'AdminController@help_buying_faqs')->name('admin.help.buying_data_faqs');
		Route::get('/admin/help/buying_data/faq/add_new', 'AdminController@edit_help_buying_faq')->name('admin.help.add_buying_faq');	
		Route::get('/admin/help/buying_data/faq/edit/{fid}', 'AdminController@edit_help_buying_faq')->where('fid', '[0-9]+')->name('admin.help.edit_buying_faq');
		Route::post('/admin/help/buying_data/faq/update', 'AdminController@update_help_buying_faq')->name('admin.help.update_buying_faq');	
		Route::get('/admin/help/buying_data/faq/delete/{fid}', 'AdminController@delete_help_buying_faq')->name('admin.help.delete_buying_faq');	
		Route::get('/admin/help/buying_data/topics', 'AdminController@help_buying_data_topics')->name('admin.help.buying_data_topics');
		Route::get('/admin/help/buying_data/topic/add_new', 'AdminController@edit_help_buying_data_topic')->name('admin.help.add_buying_data_topic');
		Route::get('/admin/help/buying_data/topic/edit/{tid}', 'AdminController@edit_help_buying_data_topic')->where('tid', '[0-9]+')->name('admin.help.edit_buying_data_topic');
		Route::get('/admin/help/buying_data/topic/delete/{tid}', 'AdminController@delete_help_buying_data_topic')->where('tid', '[0-9]+')->name('admin.help.delete_buying_data_topic');
		Route::post('/admin/help/buying_data/topic/update', 'AdminController@update_help_buying_data_topic')->name('admin.help.update_buying_data_topic');

		Route::get('/admin/help/selling_data', 'AdminController@help_selling_data')->name('admin.help.selling_data');
		Route::post('/admin/help/selling_data/update', 'AdminController@update_help_selling_data')->name('admin.help.update_selling_data');
		Route::get('/admin/help/selling_data/faqs', 'AdminController@help_selling_faqs')->name('admin.help.selling_data_faqs');
		Route::get('/admin/help/selling_data/faq/add_new', 'AdminController@edit_help_selling_faq')->name('admin.help.add_selling_faq');	
		Route::get('/admin/help/selling_data/faq/edit/{fid}', 'AdminController@edit_help_selling_faq')->where('fid', '[0-9]+')->name('admin.help.edit_selling_faq');
		Route::post('/admin/help/selling_data/faq/update', 'AdminController@update_help_selling_faq')->name('admin.help.update_selling_faq');	
		Route::get('/admin/help/selling_data/faq/delete/{fid}', 'AdminController@delete_help_selling_faq')->name('admin.help.delete_selling_faq');	
		Route::get('/admin/help/selling_data/topics', 'AdminController@help_selling_data_topics')->name('admin.help.selling_data_topics');
		Route::get('/admin/help/selling_data/topic/add_new', 'AdminController@edit_help_selling_data_topic')->name('admin.help.add_selling_data_topic');
		Route::get('/admin/help/selling_data/topic/edit/{tid}', 'AdminController@edit_help_selling_data_topic')->where('tid', '[0-9]+')->name('admin.help.edit_selling_data_topic');
		Route::get('/admin/help/selling_data/topic/delete/{tid}', 'AdminController@delete_help_selling_data_topic')->where('tid', '[0-9]+')->name('admin.help.delete_selling_data_topic');
		Route::post('/admin/help/selling_data/topic/update', 'AdminController@update_help_selling_data_topic')->name('admin.help.update_selling_data_topic');

		Route::get('/admin/help/faqs', 'AdminController@help_faqs')->name('admin.help.faqs');		
		Route::get('/admin/help/faqs/add_new', 'AdminController@edit_help_faq')->name('admin.help.add_faq');	
		Route::get('/admin/help/faqs/edit/{fid}', 'AdminController@edit_help_faq')->where('fid', '[0-9]+')->name('admin.help.edit_faq');
		Route::get('/admin/help/faqs/update', 'AdminController@update_help_faq')->name('admin.help.update_faq');	
		Route::post('/admin/help/faqs/delete/{fid}', 'AdminController@delete_help_faq')->name('admin.help.delete_faq');	


		Route::get('/admin/help/guarantees', 'AdminController@help_guarantees')->name('admin.help.guarantee');
		Route::get('/admin/help/guarantees/add_new', 'AdminController@edit_help_guarantee')->name('admin.help.add_guarantee');
		Route::get('/admin/help/guarantees/edit/{tid}', 'AdminController@edit_help_guarantee')->where('tid', '[0-9]+')->name('admin.help.edit_guarantee');
		Route::get('/admin/help/guarantees/delete/{tid}', 'AdminController@delete_help_guarantee')->where('tid', '[0-9]+')->name('admin.help.delete_guarantee');
		Route::post('/admin/help/guarantees/update', 'AdminController@update_help_guarantee')->where('tid', '[0-9]+')->name('admin.help.update_guarantee');

		Route::get('/admin/help/complaints', 'AdminController@help_complaints')->name('admin.help.complaint');
		Route::get('/admin/help/complaints/add_new', 'AdminController@edit_help_complaint')->name('admin.help.add_complaint');
		Route::get('/admin/help/complaints/edit/{tid}', 'AdminController@edit_help_complaint')->where('tid', '[0-9]+')->name('admin.help.edit_complaint');
		Route::get('/admin/help/complaints/delete/{tid}', 'AdminController@delete_help_complaint')->where('tid', '[0-9]+')->name('admin.help.delete_complaint');
		Route::post('/admin/help/complaints/update', 'AdminController@update_help_complaint')->where('tid', '[0-9]+')->name('admin.help.update_complaint');

		Route::get('/admin/help/feedbacks', 'AdminController@help_feedbacks')->name('admin.help.feedback');	
		Route::get('/admin/help/feedbacks/add_new', 'AdminController@edit_help_feedback')->name('admin.help.add_feedback');
		Route::get('/admin/help/feedbacks/edit/{tid}', 'AdminController@edit_help_feedback')->where('tid', '[0-9]+')->name('admin.help.edit_feedback');
		Route::get('/admin/help/feedbacks/delete/{tid}', 'AdminController@delete_help_feedback')->where('tid', '[0-9]+')->name('admin.help.delete_feedback');
		Route::post('/admin/help/feedbacks/update', 'AdminController@update_help_feedback')->where('tid', '[0-9]+')->name('admin.help.update_feedback');	
	});

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