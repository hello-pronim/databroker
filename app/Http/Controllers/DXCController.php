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

        $client1 = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/user/apikey/".$address;
        $response = $client1->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $apiKey = $response->getBody()->getContents();

        $walletAddress = $userObj->wallet;
        $client2 = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/dxc/getfor/".$walletAddress;
        $response = $client2->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $response = json_decode($response->getBody()->getContents());
        $dxcs = $response->dxcs;

        $data = array('address', 'apiKey', 'dxcs');
        return view('dxc.data_exchange_controller', compact($data));
    }
    public function update_apiKey(Request $request){
        $client = new \GuzzleHttp\Client();
        $url = "http://161.35.212.38:8081/user/apikey/".$request->address.'?forceNew=true';
        $response = $client->request("GET", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $apiKey = $response->getBody()->getContents();
        if($apiKey!="") return "success";
        else return "fail";
    }
}
