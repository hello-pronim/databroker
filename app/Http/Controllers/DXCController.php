<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;

class DXCController extends Controller
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

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function data_exchange_controller(){
        $user = $this->getAuthUser();
        $userObj = User::where('userIdx', $user->userIdx)->get()->first();
        $address = $userObj->wallet;
        $apiKey = $userObj->apiKey;
        $data = array('address', 'apiKey');
        return view('dxc.data_exchange_controller', compact($data));
    }
}
