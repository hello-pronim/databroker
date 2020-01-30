<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function test(){
        $this->sendEmail("template", [
            'from'=>"greenhal2001@gmail.com", 
            'to'=>'pe@jts.ec', 
            'name'=>'Test', 
            'subject'=>'Test'
        ]);
    }
}
