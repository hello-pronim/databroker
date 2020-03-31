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
        return view('admin.dashboard');
    }

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function usecases($id)
    {   
        $communityIdx = $id;
        $communityName = Community::where('communityIdx', $id)->pluck('communityName')->first();
        $boards = Article::with('community')->where('communityIdx', $id)->orderBy('created_at', 'DESC')->get();
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
        return view('admin.updates');
    }

}
