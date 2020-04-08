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
use Response;
use Image;

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
        //$this->middleware(['auth','verified']);
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
            HomeFeaturedData::find($id)->update(['image' => $fileName]);
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
                HomeFeaturedData::find($id)->update(['logo' => $fileName]);
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
                HomeFeaturedData::find($id)->update(['logo' => $fileName]);
                return "true";
            }
    }

    public function home_trending()
    {
        $boards = HomeTrending::orderby('published', 'desc')->get();
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
                HomeTrending::find($id)->update(['image' => $fileName]);
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
                HomeTrending::find($id)->update(['image' => $fileName]);
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
        $boards = HomeMarketplace::orderby('published', 'desc')->get();
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
            HomeMarketplace::find($id)->update(['image' => $fileName]);
            return "true";
    }

    public function home_marketplace_upload_logo(Request $request, $id = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $id.'.jpg';  
            $getfiles->move(public_path('uploads/home/marketplace/logo'), $fileName);
            HomeMarketplace::find($id)->update(['logo' => $fileName]);
            return "true";
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

}
