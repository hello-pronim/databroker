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

    public function index(){
        $user = $this->getAuthUser();
        $userObj = User::where('userIdx', $user->userIdx)->get()->first();
        $address = $userObj->wallet;
        $apiKey = $userObj->apiKey;

        $walletAddress = "0xaFd6E98D5B2504A65D2528072314e59d2974bEDc";
        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:3333/dxc/getfor/".$walletAddress;
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $response = json_decode($response->getBody()->getContents());
        $dxcs = $response->dxcs;

        $data = array('address', 'apiKey', 'dxcs');
        return view('dxc.data_exchange_controller', compact($data));
    }
    public function update_apiKey(Request $request){
        echo "success";
    }
}
