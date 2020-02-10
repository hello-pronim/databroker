<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contacts(){
        $user = Auth::user();
        if(!$user){
            return redirect('/login')->with('target', 'use our DataMatch service');
        }else{
            $communities = Community::get();  
            $data = array( 'communities' );
            return view('contacts', compact($data));
        }
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

    public function test(){
        $this->sendEmail("template", [
            'from'=>'peterjackson0120@gmail.com', 
            'to'=>"yuriyes43@gmail.com", 
            'name'=>'Test', 
            'subject'=>'Test'
        ]);                                                                                                   
    }
}
