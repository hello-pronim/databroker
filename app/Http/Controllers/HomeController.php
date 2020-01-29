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
            'from'=>"peterjackson0120@gmail.com", 
            'to'=>'peterpan120@yandex.com', 
            'name'=>'Test', 
            'subject'=>'Test'
        ]);
    }
}
