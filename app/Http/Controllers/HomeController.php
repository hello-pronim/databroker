<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\HomeFeaturedData;
use App\Models\HomeTrending;
use App\Models\HomeMarketplace;
use App\Models\HomeTeamPicks;
use App\Models\HomeFeaturedProvider;
use Mail;
use App\Models\Article;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featured_data = HomeFeaturedData::where('active', 1)->first();
        $trendings = HomeTrending::where('active', 1)->orderby('order', 'asc')->limit(6)->get();
        $marketplaces = HomeMarketplace::where('active', 1)->orderby('order', 'asc')->limit(3)->get();
        $teampicks = HomeTeamPicks::where('active', 1)->orderby('order', 'asc')->limit(3)->get();
        $featured_providers = HomeFeaturedProvider::join('providers', 'providers.providerIdx', '=', 'home_featured_provider.providerIdx')
                                            ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                            ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                                            ->where('active', 1)
                                            ->orderby('order', 'asc')
                                            ->limit(6)
                                            ->get();
        $top_usecases = Article::where('communityIdx', '<>', null)->with('community')->orderby('published', 'desc')->limit(3)->get();
        $data = array('featured_data', 'trendings', 'marketplaces', 'teampicks', 'featured_providers', 'top_usecases');
        // return view('home', compact($data));
        return view('home_cms', compact($data));
    }

    public function sendEmail($tplName, $params){
		return;
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
		
        $this->sendEmail1("test", [
            'from'=>'pe@jts.ec', 
            'to'=>'cg@jts.ec', 
            'subject'=>'This is email test', 
            'name'=>'Databroker'
        ]); 
        echo "success";
        exit;
    }

	public function sendEmail1($tplName, $params){		
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
}
