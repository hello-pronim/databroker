<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Models\Provider;
use App\Models\Region;
use App\Models\Community;
use App\Models\Offer;
use App\Models\Business;
use App\Models\Theme;
use App\Models\Gallery;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferCountry;
use App\Models\OfferProduct;
use App\Models\UseCase;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Subscription;
use App\Models\Article;
use App\Models\LinkedUser;
use App\Models\HomeFeaturedData;
use App\Models\HomeTrending;
use App\Models\HomeMarketplace;
use App\Models\HomeTeamPicks;
use App\Models\HomeFeaturedProvider;
use App\Models\FAQ;
use App\Models\HelpTopic;
use App\Models\Admin;
use Response;
use Image;
use Session;
use Redirect;
use File;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware(['admin_auth', 'verified']);
    }

    public function index(){
        return redirect(route('admin.dashboard'));
    }

    public function login(){
        return view('admin.login');
    }

    public function check_login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }
        $adminUser = Admin::where('email', $request->email)->get()->first();
        if(!$adminUser){
            return Redirect::back()->withErrors(['email'=>'The email is not correct. Please try again.']);
        }
        else if($adminUser->password == md5($request->password)){
            $adminUserData['id'] = $adminUser->id;
            $adminUserData['username'] = $adminUser->username;
            $adminUserData['firstname'] = $adminUser->firstname;
            $adminUserData['lastname'] = $adminUser->lastname;
            $adminUserData['email'] = $adminUser->email;
            $adminUserData['role'] = $adminUser->role;
            Session::put('admin_user', $adminUserData);
            return redirect(route('admin.dashboard'));
        } else{
            return Redirect::back()->withErrors(['password'=>'The password is not correct. Please try again.']);
        }
    }

    public function logout(){
        if(Session::has('admin_user'))
            Session::forget('admin_user');
        return redirect(route('admin.login'));
    }

    public function dashboard()
    {
        return redirect()->route('admin.updates');
        // return view('admin.dashboard');
    }

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function home()
    {
        return view('admin.home');
    }

    public function home_featured_data()
    {
        $boards = HomeFeaturedData::join('providers', 'providers.providerIdx', '=', 'home_featured_data.providerIdx')
                                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                ->get();
        $data = array('boards');
        return view('admin.home_featured_data', compact($data));
    }

    public function home_featured_data_edit()
    {
            $board = HomeFeaturedData::first(); 
            $providers = Provider::get();
            $data = array('board', 'providers');
            return view('admin.home_featured_data_edit', compact($data));
    }

    public function home_featured_data_update(Request $request)
    {
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            HomeFeaturedData::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            unset($data['id']);
            HomeFeaturedData::create($data);
            return "success";
        }
    }

    public function home_featured_data_upload_attach(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());
            $tinyimg->fit(300,200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/featured_data/tiny').'/'.$fileName);
            $tinyimg->fit(80,40, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/featured_data/thumb').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/home/featured_data'), $fileName);
            HomeFeaturedData::find($id)->update(['image' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_featured_data_upload_logo(Request $request, $id = 0)
    {

            $getfiles = $request->file('uploadedFile');
            $fileExtention = $getfiles->getClientOriginalExtension();
            if($fileExtention == 'svg')
            {
                $fileName = $id.'.svg';
                $getfiles->move(public_path('uploads/home/featured_data/logo/'), $fileName);
                HomeFeaturedData::find($id)->update(['logo' => $fileName, 'active' => 0]);
                return "true";
            }
            else
            {
                $fileName = $id.'.jpg';
                //image compress start
                $tinyimg = Image::make($getfiles->getRealPath());
                $tinyimg->resize(140,140, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/featured_data/logo').'/'.$fileName);
                
                $tinyimg->resize(80,80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/marketplace/logo/thumb').'/'.$fileName);
            
                //image compress end
                HomeFeaturedData::find($id)->update(['logo' => $fileName, 'active' => 0]);
                return "true";
            }
    }

    public function home_trending()
    {
        $boards = HomeTrending::orderby('order', 'asc')->get();
        $data = array('boards');
        return view('admin.home_trending', compact($data));
    }

    public function home_trending_upload_attach(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileExtention = $getfiles->getClientOriginalExtension();
            if($fileExtention == 'svg')
            {
                $fileName = $id.'.svg';
                $getfiles->move(public_path('uploads/home/trending/'), $fileName);                
                HomeTrending::find($id)->update(['image' => $fileName, 'active' => 0]);
                return "true";
            }
            else
            {
                $fileName = $id.'.jpg';
                //image compress start
                $tinyimg = Image::make($getfiles->getRealPath());
                $tinyimg->resize(60, 60, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/trending').'/'.$fileName);
                $tinyimg->resize(40,40, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/trending/thumb').'/'.$fileName);
                //image compress end
                HomeTrending::find($id)->update(['image' => $fileName, 'active' => 0]);
                return "true";
            }
    }

    public function home_trending_edit($id = '')
    {
        if($id == '')
        {
            return view('admin.home_trending_edit');
        }
        else
        {
            $id = $id;
            $board = HomeTrending::where('id', $id)->first(); 
            $data = array('id', 'board');
            return view('admin.home_trending_edit', compact($data));
        }
    }

    public function home_trending_update(Request $request)
    {
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            HomeTrending::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            unset($data['id']);
            HomeTrending::create($data);
            return "success";
        }
    }

    public function home_marketplace()
    {
        $boards = HomeMarketplace::orderby('order', 'asc')->get();
        $data = array('boards');
        return view('admin.home_marketplace', compact($data));
    }

    public function home_marketplace_edit($id = '')
    {
        if($id == '')
        {
            return view('admin.home_marketplace_edit');
        }
        else
        {
            $id = $id;
            $board = HomeMarketplace::where('id', $id)->first(); 
            $data = array('id', 'board');
            return view('admin.home_marketplace_edit', compact($data));
        }
    }

    public function home_marketplace_update(Request $request)
    {
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            HomeMarketplace::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            unset($data['id']);
            HomeMarketplace::create($data);
            return "success";
        }
    }

    public function home_marketplace_upload_attach(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());
            $tinyimg->fit(1200,800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/large').'/'.$fileName);

            $tinyimg->fit(750,500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/medium').'/'.$fileName);

            $tinyimg->fit(300,200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/tiny').'/'.$fileName);

            $tinyimg->fit(60,40, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/thumb').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/home/marketplace'), $fileName);
            HomeMarketplace::find($id)->update(['image' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_marketplace_upload_logo(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());

            $tinyimg->resize(140,140, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/logo/tiny').'/'.$fileName);

            $tinyimg->resize(80,80, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/logo/thumb').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/home/marketplace/logo'), $fileName);
            HomeMarketplace::find($id)->update(['logo' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_teampicks()
    {
        $boards = HomeTeamPicks::orderby('order', 'asc')->get();
        $data = array('boards');
        return view('admin.home_teampicks', compact($data));
    }

    public function home_teampicks_edit($id = '')
    {
        if($id == '')
        {
            return view('admin.home_teampicks_edit');
        }
        else
        {
            $id = $id;
            $board = HomeTeamPicks::where('id', $id)->first(); 
            $data = array('id', 'board');
            return view('admin.home_teampicks_edit', compact($data));
        }
    }

    public function home_teampicks_update(Request $request)
    {
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            HomeTeamPicks::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            unset($data['id']);
            HomeTeamPicks::create($data);
            return "success";
        }
    }

    public function home_teampicks_upload_logo(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());

            $tinyimg->resize(140,140, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/logo/tiny').'/'.$fileName);

            $tinyimg->resize(80,80, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/logo/thumb').'/'.$fileName);
            //image compress end

            $getfiles->move(public_path('uploads/home/teampicks/logo'), $fileName);
            HomeTeamPicks::find($id)->update(['logo' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_teampicks_upload_attach(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());
            $tinyimg->fit(1200,800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/large').'/'.$fileName);

            $tinyimg->fit(750,500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/medium').'/'.$fileName);

            $tinyimg->fit(300,200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/tiny').'/'.$fileName);

            $tinyimg->fit(60,40, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/thumb').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/home/teampicks'), $fileName);
            HomeTeamPicks::find($id)->update(['image' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_featured_provider()
    {
        $boards = HomeFeaturedProvider::join('providers', 'providers.providerIdx', '=', 'home_featured_provider.providerIdx')
                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                        ->orderby('order', 'asc')
                        ->get();
        $data = array('boards');
        return view('admin.home_featured_provider', compact($data));
    }

    public function home_featured_provider_edit($id = '')
    {
        if($id == '')
        {
            $providers = Provider::get();
            $data = array('providers');
            return view('admin.home_featured_provider_edit', compact($data));
        }
        else
        {
            $id = $id;
            $providers = Provider::get();
            $provider = HomeFeaturedProvider::where('id', $id)->first(); 
            $data = array('id', 'providers', 'provider');
            return view('admin.home_featured_provider_edit', compact($data));
        }
    }

    public function home_featured_provider_delete(Request $request)
    {
        $id = $request->id;
        $board = HomeFeaturedProvider::where('id', $id)->delete(); 
        return redirect(route('admin.home_featured_provider'));
    }

    public function home_featured_provider_update(Request $request)
    {
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            HomeFeaturedProvider::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            unset($data['id']);
            HomeFeaturedProvider::create($data);
            return "success";
        }
    }

    public function usecases($id)
    {   
        $communityIdx = $id;
        $communityName = Community::where('communityIdx', $id)->pluck('communityName')->first();
        $boards = Article::with('community')->where('communityIdx', $id)->orderBy('published', 'DESC')->get();
        $data = array('boards', 'communityIdx', 'communityName');
        return view('admin.usecases', compact($data));
    }

    public function usecases_add_new($id)
    {
        $categories = Community::get();
        $communityIdx = $id;  
        $data = array( 'categories', 'communityIdx' );
        return view('admin.usecases_add_new', compact($data));
    }

    public function usecases_edit(Request $request)
    {
        $id = $request->id;
        $categories = Community::get();  
        $board = Article::where('articleIdx', $id)->first(); 
        $communityIdx = $board->communityIdx;
        $data = array( 'categories', 'id', 'board', 'communityIdx' );
        return view('admin.usecases_edit', compact($data));
    }

    public function usecases_delete(Request $request){
        Article::where('articleIdx', $request->id)->delete();
        return "success";
    }

    public function usecases_update(Request $request)
    {
        $date = explode("/", $request->published);
        $published = $date[2].'-'.$date[1].'-'.$date[0];
        if($request->input('id')) {
            $articleIdx = $request->input('id');
            $data = $request->all();
            $data['published'] = date('Y-m-d', strtotime($published));
            unset($data['id']);
            Article::find($articleIdx)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            $data['published'] = date('Y-m-d', strtotime($published));
            unset($data['id']);
            Article::create($data);
            return "success";
        }
    }

    public function usecases_upload_attach(Request $request, $articleIdx = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $articleIdx.'.jpg';              
            //image compress start
            $tinyimg = Image::make($getfiles->getRealPath());
            $tinyimg->fit(1200,800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/large').'/'.$fileName);

            $tinyimg->fit(750,500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/medium').'/'.$fileName);

            $tinyimg->fit(300,200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/tiny').'/'.$fileName);

            $tinyimg->fit(60,40, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/thumb').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/usecases'), $fileName);
            Article::find($articleIdx)->update(['image' => $fileName]);
            return "true";
    }

    public function updates()
    {   
        $boards = Article::where('communityIdx', null)->orderBy('published', 'DESC')->get();
        $data = array('boards');
        return view('admin.updates', compact($data));
    }

    public function updates_add_new()
    {
        return view('admin.updates_add_new');
    }

    public function updates_update(Request $request)
    {
        $date = explode("/", $request->published);
        $published = $date[2].'-'.$date[1].'-'.$date[0];
        if($request->input('id')) {
            $articleIdx = $request->input('id');
            $data = $request->all();
            $data['published'] = date('Y-m-d', strtotime($published));            
            Article::find($articleIdx)->update($data);
            return "success";
        } else {
            $data = $request->all();
            $data['published'] = date('Y-m-d', strtotime($published));
            unset($data['id']);
            Article::create($data);
            return "success";
        }
    }
    public function updates_delete(Request $request){
        Article::where('articleIdx', $request->id)->delete();
        return "success";
    }

    public function updates_edit($id)
    {
        $id = $id;
        $board = Article::where('articleIdx', $id)->first(); 
        $data = array('id', 'board');
        return view('admin.updates_edit', compact($data));
    }

    public function media_library(Request $request){
        $images = Gallery::join('communities', 'communities.communityIdx', '=', 'gallery.content')
                            ->orderby('gallery.content', 'asc')
                            ->get();
        $data = array('images');
        return view('admin.media_library', compact($data));
    }

    public function edit_media($id = 0){
        if( $id == 0 ){
            $communities = Community::get();
            $data = array('communities');
        }else{
            $communities = Community::get();
            $media = Gallery::where('id', $id)->get()->first();
            $data = array('id', 'communities', 'media');
        }
        return view('admin.media_edit', compact($data));
    }

    public function delete_media(Request $request){
        Gallery::where('id', $request->mid)->delete();
        return "success";
    }

    public function media_update(Request $request){
        if($request->input('id')) {
            $id = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            if($data['subcontent']==1) $data['subcontent'] = 0;
            else $data['subcontent'] = null;
            $heroExist = Gallery::where('content', $data['content'])->where('subcontent', 0)->get()->first();
            if($data['subcontent']!==0){
                if($heroExist){
                    $max_sequence = Gallery::where('content', $data['content'])->where('subcontent', null)->orderby('sequence', 'DESC')->get()->first();
                    if($max_sequence) $data['sequence'] = $max_sequence->sequence + 1;
                    else $data['sequence'] = 1;
                }else{
                    return "Hero data doesn't exist. You need to add it first!";
                }
            }
            else{
                if($heroExist && $id!=$heroExist->id) return "Hero data already exist. You can edit it directly!";
                else $data['sequence'] = 1;
            }
            Gallery::find($id)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            unset($data['id']);
            if($data['subcontent']==1) $data['subcontent'] = 0;
            else unset($data['subcontent']);
            $data['category'] = "community";
            $heroExist = Gallery::where('content', $data['content'])->where('subcontent', 0)->get()->first();

            if(!isset($data['subcontent'])){
                if($heroExist){
                    $max_sequence = Gallery::where('content', $data['content'])->where('subcontent', null)->orderby('sequence', 'DESC')->get()->first();
                    if($max_sequence) $data['sequence'] = $max_sequence->sequence + 1;
                    else $data['sequence'] = 1;
                }else{
                    return "Hero data doesn't exist. You need to add it first!";
                }
            }
            else{
                if($heroExist) return "Hero data already exist. You can edit it directly!";
                else $data['sequence'] = 1;
            } 
            Gallery::create($data);
            return "success";
        }
    }

    public function media_upload_attach(Request $request, $mediaIdx = 0){
        $getfiles = $request->file('uploadedFile');
        $fileName = "media_".$mediaIdx.'.jpg';         
        //image compress start
        $tinyimg = Image::make($getfiles->getRealPath());
        $tinyimg->fit(1200,800, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/gallery/thumbs/large').'/'.$fileName);

        $tinyimg->fit(750,500, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/gallery/thumbs/medium').'/'.$fileName);

        $tinyimg->fit(300,200, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/gallery/thumbs/tiny').'/'.$fileName);

        $tinyimg->fit(60,40, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/gallery/thumbs/thumb').'/'.$fileName);
        //image compress end
        $getfiles->move(public_path('images/gallery/thumbs'), $fileName);
        Gallery::find($mediaIdx)->update(['thumb' => $fileName]);
        return "true";
    }

    public function preview_home($url, $model)
    {
        $url = $url;
        $model = $model;
        $featured_data = HomeFeaturedData::join('providers', 'providers.providerIdx', '=', 'home_featured_data.providerIdx')
                                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                        ->get()
                                        ->first();
        $trendings = HomeTrending::orderby('order', 'asc')->limit(6)->get();
        $marketplaces = HomeMarketplace::orderby('order', 'asc')->limit(3)->get();
        $teampicks = HomeTeamPicks::orderby('order', 'asc')->limit(3)->get();
        $featured_providers = HomeFeaturedProvider::join('providers', 'providers.providerIdx', '=', 'home_featured_provider.providerIdx')
                                            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                            ->orderby('order', 'asc')
                                            ->limit(6)
                                            ->get();
        $top_usecases = Article::where('communityIdx', '<>', null)->with('community')->orderby('published', 'desc')->limit(3)->get();
        $data = array('featured_data', 'trendings', 'marketplaces', 'teampicks', 'featured_providers', 'top_usecases', 'url', 'model');
        return view('preview.home', compact($data));
    }

    public function preview_check($url, $model, $check)
    {
        if($check == '1')
        {
            if($model == 'HomeFeaturedData')
            {
                HomeFeaturedData::where('active', '=', 0)->update(['active'=>1]);
            }
            if($model == 'HomeFeaturedProvider')
            {
                HomeFeaturedProvider::where('active', '=', 0)->update(['active'=>1]);
            }
            if($model == 'HomeMarketplace')
            {
                HomeMarketplace::where('active', '=', 0)->update(['active'=>1]);
            }
            if($model == 'HomeTeamPicks')
            {
                HomeTeamPicks::where('active', '=', 0)->update(['active'=>1]);
            }
            if($model == 'HomeTrending')
            {
                HomeTrending::where('active', '=', 0)->update(['active'=>1]);
            }
            return redirect()->route($url);
        }
        else
        {
            return redirect()->route($url);
        }
        
    }

    public function help_buying_data(Request $request){
        $header = HelpTopic::where('page', 'buying_header')->get()->first();
        $data = array('header');
        return view('admin.help_buying_data', compact($data));
    }
    public function update_help_buying_data(Request $request){
        if($request->helpTopicIdx==0){
            $header['title'] = $request->title;
            $header['description'] = $request->description;
            $header['page'] = 'buying_header';
            HelpTopic::create($header);
        }else{
            $header['title'] = $request->title;
            $header['description'] = $request->description;
            $header['page'] = 'buying_header';
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($header);
        }
        return "success";
    }
    public function help_buying_faqs(Request $request){
        $faqs = FAQ::where('for', 'buying')->get();
        $data = array('faqs');
        return view('admin.help_buying_data_faqs', compact($data));
    }
    public function edit_help_buying_faq(Request $request, $fid = 0){
        if($fid==0){
            return view('admin.help_buying_data_faq_edit');
        }else{
            $faq = FAQ::where('faqIdx', $fid)->get()->first();
            $data = array('faq');
            return view('admin.help_buying_data_faq_edit', compact($data));
        }
    }
    public function update_help_buying_faq(Request $request){
        if($request->faqIdx==0){
            $faq['faq'] = $request->faq;
            $faq['description'] = $request->description;
            $faq['for'] = "buying";
            FAQ::create($faq);
        }else{
            $faq['faq'] = $request->faq;
            $faq['description'] = $request->description;
            $faq['for'] = "buying";
            FAQ::where('faqIdx', $request->faqIdx)->update($faq);
        }
        return "success";
    }
    public function delete_help_buying_faq(Request $request, $fid){
        FAQ::where('faqIdx', $fid)->delete();
        return "success";
    }

    public function help_buying_data_topics(Request $request){
        $topics = HelpTopic::where('page', 'buying')->get();
        $data = array('topics');
        return view('admin.help_buying_data_topics', compact($data));
    }
    public function edit_help_buying_data_topic(Request $request, $tid = 0){
        if($tid==0){
            return view('admin.help_buying_data_topic_edit');
        }else{
            $topic = HelpTopic::where('helpTopicIdx', $tid)->get()->first();
            $data = array('topic');
            return view('admin.help_buying_data_topic_edit', compact($data));
        }
    }
    public function update_help_buying_data_topic(Request $request){
        if($request->helpTopicIdx==0){
            $topic['page'] = "buying";
            $topic['title'] = $request->title;
            HelpTopic::create($topic);
        }else{
            $topic['page'] = "buying";
            $topic['title'] = $request->title;
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($topic);
        }
        return "success";
    }

    public function delete_help_buying_data_topic(Request $request, $tid){
        HelpTopic::where('helpTopicIdx', $tid)->delete();
        return "success";
    }

    public function help_selling_data(Request $request){
        $header = HelpTopic::where('page', 'selling_header')->get()->first();
        $data = array('header');
        return view('admin.help_selling_data', compact($data));
    }
    public function update_help_selling_data(Request $request){
        if($request->helpTopicIdx==0){
            $header['title'] = $request->title;
            $header['description'] = $request->description;
            $header['page'] = 'selling_header';
            HelpTopic::create($header);
        }else{
            $header['title'] = $request->title;
            $header['description'] = $request->description;
            $header['page'] = 'selling_header';
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($header);
        }
        return "success";
    }
    public function help_selling_faqs(Request $request){
        $faqs = FAQ::where('for', 'selling')->get();
        $data = array('faqs');
        return view('admin.help_selling_data_faqs', compact($data));
    }
    public function edit_help_selling_faq(Request $request, $fid = 0){
        if($fid==0){
            return view('admin.help_selling_data_faq_edit');
        }else{
            $faq = FAQ::where('faqIdx', $fid)->get()->first();
            $data = array('faq');
            return view('admin.help_selling_data_faq_edit', compact($data));
        }
    }
    public function update_help_selling_faq(Request $request){
        if($request->faqIdx==0){
            $faq['faq'] = $request->faq;
            $faq['description'] = $request->description;
            $faq['for'] = "selling";
            FAQ::create($faq);
        }else{
            $faq['faq'] = $request->faq;
            $faq['description'] = $request->description;
            $faq['for'] = "selling";
            FAQ::where('faqIdx', $request->faqIdx)->update($faq);
        }
        return "success";
    }
    public function delete_help_selling_faq(Request $request, $fid){
        FAQ::where('faqIdx', $fid)->delete();
        return "success";
    }

    public function help_selling_data_topics(Request $request){
        $topics = HelpTopic::where('page', 'selling')->get();
        $data = array('topics');
        return view('admin.help_selling_data_topics', compact($data));
    }
    public function edit_help_selling_data_topic(Request $request, $tid = 0){
        if($tid==0){
            return view('admin.help_selling_data_topic_edit');
        }else{
            $topic = HelpTopic::where('helpTopicIdx', $tid)->get()->first();
            $data = array('topic');
            return view('admin.help_selling_data_topic_edit', compact($data));
        }
    }
    public function update_help_selling_data_topic(Request $request){
        if($request->helpTopicIdx==0){
            $topic['page'] = "selling";
            $topic['title'] = $request->title;
            HelpTopic::create($topic);
        }else{
            $topic['page'] = "selling";
            $topic['title'] = $request->title;
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($topic);
        }
        return "success";
    }
    public function delete_help_selling_data_topic(Request $request, $tid){
        HelpTopic::where('helpTopicIdx', $tid)->delete();
        return "success";
    }
    public function help_guarantees(Request $request){
        $topics = HelpTopic::where('page', 'guarantees')->get();
        $data = array('topics');
        return view('admin.help_guarantees', compact($data));
    }
    public function edit_help_guarantee(Request $request, $tid = 0){
        if($tid == 0){
            return view('admin.help_guarantee_edit');
        }else{
            $topic = HelpTopic::where('helpTopicIdx', $tid)->get()->first();
            $data = array('topic');
            return view('admin.help_guarantee_edit', compact($data));
        }
    }
    public function delete_help_guarantee(Request $request, $tid){
        HelpTopic::where('helpTopicIdx', $tid)->delete();
        return "success";
    }
    public function update_help_guarantee(Request $request){
        if($request->helpTopicIdx==0){
            $topic['page'] = "guarantees";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::create($topic);
        }else{
            $topic['page'] = "guarantees";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($topic);
        }
        return "success";
    }
    public function help_complaints(Request $request){
        $topics = HelpTopic::where('page', 'complaints')->get();
        $data = array('topics');
        return view('admin.help_complaints', compact($data));
    }
    public function edit_help_complaint(Request $request, $tid = 0){
        if($tid == 0){
            return view('admin.help_complaint_edit');
        }else{
            $topic = HelpTopic::where('helpTopicIdx', $tid)->get()->first();
            $data = array('topic');
            return view('admin.help_complaint_edit', compact($data));
        }
    }
    public function delete_help_complaint(Request $request, $tid){
        HelpTopic::where('helpTopicIdx', $tid)->delete();
        return "success";
    }
    public function update_help_complaint(Request $request){
        if($request->helpTopicIdx==0){
            $topic['page'] = "complaints";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::create($topic);
        }else{
            $topic['page'] = "complaints";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($topic);
        }
        return "success";
    }

    public function help_feedbacks(Request $request){
        $topics = HelpTopic::where('page', 'feedbacks')->get();
        $data = array('topics');
        return view('admin.help_feedbacks', compact($data));
    }
    public function edit_help_feedback(Request $request, $tid = 0){
        if($tid == 0){
            return view('admin.help_feedback_edit');
        }else{
            $topic = HelpTopic::where('helpTopicIdx', $tid)->get()->first();
            $data = array('topic');
            return view('admin.help_feedback_edit', compact($data));
        }
    }
    public function delete_help_feedback(Request $request, $tid){
        HelpTopic::where('helpTopicIdx', $tid)->delete();
        return "success";
    }
    public function update_help_feedback(Request $request){
        if($request->helpTopicIdx==0){
            $topic['page'] = "feedbacks";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::create($topic);
        }else{
            $topic['page'] = "feedbacks";
            $topic['title'] = $request->title;
            $topic['description'] = $request->description;
            HelpTopic::where('helpTopicIdx', $request->helpTopicIdx)->update($topic);
        }
        return "success";
    }
 
    public function compress_images(Request $request){
        if(isset($request->path)){
            if($request->path == "gallery"){
                $path = public_path('images/gallery/thumbs');    
            }else{
                $path = public_path('uploads/'.$request->path);    
            }
            
            $files = File::allfiles($path);
            // /dd($files);
            if($request->path == "usecases" || $request->path == "offer" || $request->path == "gallery" ){
                foreach ($files as $key => $file) {                
                    $fileName = $file->getFilename();                
                    if($path ."/". $fileName == $file->getpathName() && File::exists($path . "/". $fileName)){
                        $tinyimg = Image::make($file->getpathName());
                        $tinyimg->fit(1200,800, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/large/". $fileName);
                        sleep(0.3);
                        $tinyimg->fit(750,500, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/medium/".$fileName);
                        sleep(0.3);
                        $tinyimg->fit(300,200, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/tiny/" . $fileName);
                        sleep(0.3);
                        $tinyimg->fit(60,40, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/thumb/". $fileName);
                        sleep(0.3);
                    }                
                }    
            }
            

            if($request->path == "company"){
                foreach ($files as $key => $file) {                
                    $fileName = $file->getFilename();        
                    if($path ."/". $fileName == $file->getpathName() && File::exists($path . "/". $fileName)){
                        //image compress start
                        $tinyimg = Image::make($file->getpathName());
                        $tinyimg->resize(215,215, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path ."/medium/".$fileName);
                        $tinyimg->resize(150,70, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/tiny/" . $fileName);
                        $tinyimg->resize(80,40, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . "/thumb/". $fileName);
                        //image compress end
                    }    
                }    
            }

            echo "success";
        }                
    }
    
    public function users(Request $request){
        $users = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('users.userStatus', 1)
                        ->get(["users.*", 'companies.*', 'users.created_at as createdAt']);
        foreach($users as $user){
            $count_all = User::where('companyIdx', $user->companyIdx)->where('userStatus', 2)->get()->count();
            $count_pending = LinkedUser::where('invite_userIdx', $user->userIdx)->get()->count();
            $count_products = OfferProduct::join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                        ->where('users.userIdx', $user->userIdx)
                                        ->get()
                                        ->count();
            $user['count_all'] = $count_all;
            $user['count_pending'] = $count_pending;
            $user['count_products'] = $count_products;
        }
        $data = array('users');
        return view('admin.users', compact($data));
    }

    public function company_users(Request $request){
        $companyIdx = User::where('userIdx', $request->adminUserIdx)->get()->first()->companyIdx;
        $users = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->where('users.userStatus', 2)
                        ->where('companies.companyIdx', $companyIdx)
                        ->get(['users.*', 'companies.*', 'users.created_at as createdAt'])
                        ->toArray();
        $result = array();
        foreach ($users as $user) {
            $temp = $user;
            $count_products = OfferProduct::join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                        ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                        ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                        ->where('users.userIdx', $user['userIdx'])
                                        ->get()
                                        ->count();
            $temp['count_products'] = $count_products;
            array_push($result, $temp);
        }
        return json_encode(array('users'=>$result));
    }
    public function edit_user(Request $request){
        $user = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                    ->where('users.userIdx', $request->userIdx)
                    ->get()
                    ->first();
        $businesses = Business::get();

        $data = array('user', 'businesses');
        return view('admin.edit_user', compact($data));
    }
    public function update_user(Request $request){
        $user = User::where('userIdx', $request->userIdx)->get()->first();
        if($user){
            $data = array();
            $data['firstname'] = $request->firstname;
            $data['lastname'] = $request->lastname;
            $data['email'] = $request->email;
            $data['jobTitle'] = $request->jobTitle;
            if($request->businessName2=="Other industry") 
                $data['businessName'] = $request->businessName;
            else $data['businessName'] = $request->businessName2;
            if($request->role2=="Other")
                $data['role'] = $request->role;
            else $data['role'] = $request->role2;

            User::where('userIdx', $request->userIdx)->update($data);
            echo "success";
        }else 
            echo "fail";
    }
    public function delete_user(Request $request){
        $user = User::where('userIdx', $request->userIdx)->get()->first();
        if($user){
            if($user->userStatus==1){
                $subusers = User::where('companyIdx', $user->companyIdx)->get();
                if($subusers->count()>0){
                    foreach ($subusers as $user) {
                        $provider = Provider::where('userIdx', $user->userIdx)->get()->first();
                        if($provider){
                            $offer = Offer::where('providerIdx', $provider->providerIdx)->get()->first();
                            if($offer){
                                $products = OfferProduct::where('offerIdx', $offer->offerIdx)->get();
                                foreach ($products as $product) {
                                    RegionProduct::where('productIdx', $product->productIdx)->delete();
                                }
                                OfferProduct::where('offerIdx', $offer->offerIdx)->delete();
                            }
                            OfferCountry::where('offerIdx', $offer->offerIdx)->delete();
                            OfferSample::where('offerIdx', $offer->offerIdx)->delete();
                            OfferTheme::where('offerIdx', $offer->offerIdx)->delete();
                            Offer::where('providerIdx', $provider->providerIdx)->delete();
                            Provider::where('userIdx', $user->userIdx)->delete();
                        }
                        User::where('userIdx', $user->userIdx)->delete();
                    }
                }
                User::where('userIdx', $request->userIdx)->delete();
                echo "success";
            }else if($user->userStatus==2){
                try{
                    $provider = Provider::where('userIdx', $request->userIdx)->get()->first();
                    if($provider){
                        $offer = Offer::where('providerIdx', $provider->providerIdx)->get()->first();
                        if($offer){
                            $products = OfferProduct::where('offerIdx', $offer->offerIdx)->get();
                            foreach ($products as $product) {
                                RegionProduct::where('productIdx', $product->productIdx)->delete();
                            }
                            OfferProduct::where('offerIdx', $offer->offerIdx)->delete();
                        }
                        OfferCountry::where('offerIdx', $offer->offerIdx)->delete();
                        OfferSample::where('offerIdx', $offer->offerIdx)->delete();
                        OfferTheme::where('offerIdx', $offer->offerIdx)->delete();
                        Offer::where('providerIdx', $provider->providerIdx)->delete();
                        Provider::where('userIdx', $request->userIdx)->delete();
                    }
                    User::where('userIdx', $request->userIdx)->delete();
                    echo "success";
                }catch(Exception $e){
                    echo "fail";
                }
            }
        }else echo "fail";
    }
}
