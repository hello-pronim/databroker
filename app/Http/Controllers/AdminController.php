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

    public function usecases()
    {   
        $boards = Article::with('community')->orderBy('created_at', 'DESC')->get();
        $data = array('boards');
        return view('admin.usecases', compact($data));
    }

    public function usecases_add_new()
    {
        $categories = Community::get();  
        $data = array( 'categories' );
        return view('admin.usecases_add_new', compact($data));
    }

    public function usecases_edit($id)
    {
        $id = $id;
        $categories = Community::get();  
        $board = Article::where('articleIdx', $id)->first(); 
        $data = array( 'categories', 'id', 'board' );
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
                $data['published'] = date("Y-m-d");
                unset($data['id']);
                Article::create($data);
                return "success";
            }
    }

    public function usecases_upload_attach(Request $request, $articleIdx = 0)
    {
            $getfiles = $request->file('uploadedFile');
            $fileName = $articleIdx.'.jpg';  
            $getfiles->move(public_path('uploads/usecases'), $fileName);
            Article::find($articleIdx)->update(['image' => $fileName]);
            return "true";
    }
}
