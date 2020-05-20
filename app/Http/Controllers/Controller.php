<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\User;

use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function sendEmail($tplName, $params){
        $from = $params['from'];
        $to = $params['to'];
        $name = $params['name'];
        $subject = $params['subject'];

        Mail::send('email.'.$tplName, $params,
            function($mail) use ($from, $to, $name, $subject){
                $mail->from($from, $name);
                $mail->to($to, $to);
                $mail->subject($subject);
        });
    }

    public function createWalletForAllUsers(){
        $users = User::where('wallet', null)->get()->toArray();
        foreach ($users as $key => $user) {
            $client1 = new \GuzzleHttp\Client();
            $url = "https://dxs-swagger.herokuapp.com/ethereum/wallet";
            $response = $client1->request("POST", $url, [
                'headers'=> ['Content-Type' => 'application/json'],
                'body'=>'{}'
            ]);
            $responseBody = json_decode($response->getBody()->getContents());
            $walletAddress = $responseBody->address;
            $walletPrivateKey = $responseBody->privatekey;

            $client2 = new \GuzzleHttp\Client();
            $url = "http://161.35.212.38:3333/user/apikey/".$walletAddress;
            $response = $client2->request("GET", $url, [
                'headers'=> ['Content-Type' => 'application/json'],
                'body'=>'{}'
            ]);
            $apikey = $response->getBody()->getContents();

            User::where('userIdx', $user['userIdx'])->update([
                'wallet'=>$walletAddress,
                'walletPrivateKey'=>$walletPrivateKey,
                'apiKey'=>$apikey
            ]);
        }
        return "success";
    }

    public function createApiKeyForAllUsers(){
        $result = $this->createWalletForAllUsers();
        if($result == "success"){
            $users = User::get()->toArray();
            foreach ($users as $key => $user) {
                $walletAddress = $user['wallet'];
                $client2 = new \GuzzleHttp\Client();
                $url = "http://161.35.212.38:3333/user/apikey/".$walletAddress;
                $response = $client2->request("GET", $url, [
                    'headers'=> ['Content-Type' => 'application/json'],
                    'body'=>'{}'
                ]);
                $apikey = $response->getBody()->getContents();

                User::where('userIdx', $user['userIdx'])->update([
                    'apiKey'=>$apikey
                ]);
            }
            echo "success";
        }
    }
}
