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
use App\Models\UseCase;
use App\Models\Contact;
use App\Models\Subscription;
use App\Models\Article;
use App\Models\HomeFeaturedData;
use App\Models\HomeTrending;
use App\Models\HomeMarketplace;
use App\Models\HomeTeamPicks;
use App\Models\HomeFeaturedProvider;
use App\Models\Admin;
use Response;
use Image;
use Session;
use Redirect;

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
        $boards = HomeFeaturedData::get();
        $data = array('boards');
        return view('admin.home_featured_data', compact($data));
    }

    public function home_featured_data_edit()
    {
            $board = HomeFeaturedData::first(); 
            $data = array('board');
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
            $tinyimg->resize(300,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/featured_data/tiny').'/'.$fileName);
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
                $tinyimg->resize(500,500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/featured_data/logo').'/'.$fileName);
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
                $tinyimg->resize(500,500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/home/trending').'/'.$fileName);
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
            $tinyimg->resize(1000,1100, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/medium').'/'.$fileName);
            $tinyimg->resize(300,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/marketplace/tiny').'/'.$fileName);
            //image compress end
            $getfiles->move(public_path('uploads/home/marketplace'), $fileName);
            HomeMarketplace::find($id)->update(['image' => $fileName, 'active' => 0]);
            return "true";
    }

    public function home_marketplace_upload_logo(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
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
            $tinyimg->resize(1000,1100, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/medium').'/'.$fileName);
            $tinyimg->resize(300,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/home/teampicks/tiny').'/'.$fileName);
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

    public function usecases_edit($id, $communityIdx)
    {
        $id = $id;
        $communityIdx = $communityIdx;
        $categories = Community::get();  
        $board = Article::where('articleIdx', $id)->first(); 
        $data = array( 'categories', 'id', 'board', 'communityIdx' );
        return view('admin.usecases_edit', compact($data));
    }

    public function usecases_update(Request $request)
    {
            if($request->input('id')) {
                $articleIdx = $request->input('id');
                $data = $request->all();
                unset($data['id']);
                Article::find($articleIdx)->update($data);
                return "success";
            } else {
                $data = $request->all();
                // $data['published'] = date("Y-m-d");
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
            $tinyimg->resize(1000,1100, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/medium').'/'.$fileName);
            $tinyimg->resize(300,400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/usecases/tiny').'/'.$fileName);
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
        if($request->input('id')) {
            $articleIdx = $request->input('id');
            $data = $request->all();
            unset($data['id']);
            Article::find($articleIdx)->update($data);
            return "success";
        } else {
            $data = $request->all();
            // $data['published'] = date("Y-m-d");
            unset($data['id']);
            Article::create($data);
            return "success";
        }
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

    public function add_media(Request $request){
        $communityIdx = $request->cid;
        $communityName = Community::where('communityIdx', $request->cid)->pluck('communityName')->first();
        $data = array('communityIdx', 'communityName');
        return view('admin.media_add_new', compact($data));
    }
    public function edit_media(Request $request){
        $communityIdx = $request->cid;
        $communityName = Community::where('communityIdx', $request->cid)->pluck('communityName')->first();
        $data = array('communityIdx', 'communityName');
        return view('admin.media_edit', compact($data));
    }

    public function media_upload_attach(Request $request){
        return "true";
    }

    public function preview_home($url, $model)
    {
        $url = $url;
        $model = $model;
        $featured_data = HomeFeaturedData::first();
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

}
