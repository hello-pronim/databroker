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

            User::where('userIdx', $user['userIdx'])->update([
                'wallet'=>$walletAddress,
                'walletPrivateKey'=>$walletPrivateKey
            ]);
        }
        return "success";
    }
}
