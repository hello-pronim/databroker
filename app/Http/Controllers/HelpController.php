<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Provider;
use App\Models\Region;
use App\Models\Purchase;
use App\Models\Community;
use App\Models\Offer;
use App\Models\Theme;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferCountry;
use App\Models\OfferProduct;
use App\Models\UseCase;
use App\Models\FAQ;
use App\Models\HelpTopic;
use App\Models\Complaint;
use App\User;

class HelpController extends Controller
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

    public function index(Request $request)
    {
        $teammates = array(
            array(
                'id'        => 1, 
                'avatar'    => '../images/dummy/Matthew_DB.png', 
                'name'      => 'Matthew van Niekerk',
                'title'  => 'Co-founder and CEO', 
            ),
        );        
        $data = array( 'teammates' );
        return view('help.overview', compact($data));
    }

    public function buying_data(Request $request)
    {
        $topics = HelpTopic::where('page', 'buying')->where('active', 1)->get();
        $header = HelpTopic::where('page', 'buying_header')->get()->first();
        $faqs = FAQ::where('for', 'buying')->orderby('created_at', 'desc')->limit(10)->get();
        $data = array( 'topics', 'header', 'faqs' );
        return view('help.buying-data', compact($data));
    }

    public function buying_data_topic(Request $request){
        $topics = HelpTopic::get();
        $topic = null;
        foreach ($topics as $key => $t) {
            if($request->title == str_replace(" ", "-", strtolower($t->title))){
                $topic = $t;
                break;
            }
        }
        if(!$topic) return view('errors.404');
        $data = array('topic');
        return view('help.buying-data-topic', compact($data));
    }

    public function selling_data(Request $request)
    {
        $topics = HelpTopic::where('page', 'selling')->where('active', 1)->get();
        $header = HelpTopic::where('page', 'selling_header')->get()->first();
        $faqs = FAQ::where('for', 'selling')->orderby('created_at', 'desc')->limit(10)->get();
        $data = array( 'topics', 'header', 'faqs' );
        return view('help.selling-data', compact($data));
    }

    public function selling_data_topic(Request $request){
        $topics = HelpTopic::get();
        $topic = null;
        foreach ($topics as $key => $t) {
            if($request->title == str_replace(" ", "-", strtolower($t->title))){
                $topic = $t;
                break;
            }
        }
        if(!$topic) return view('errors.404');
        $data = array('topic');
        return view('help.selling-data-topic', compact($data));
    }

    public function guarantee()
    {
        $topics = HelpTopic::where('page', 'guarantees')->get();
        $data = array('topics');
        return view('help.guarantee', compact($data));
    }

    public function file_complaint()
    {
        $topics = HelpTopic::where('page', 'complaints')->get();
        $data = array('topics');
        return view('help.file_complaint', compact($data));
    }

    public function send_file_complaint(Request $request)
    {
        $user = $this->getAuthUser();
        if(!$user) 
           return redirect('/login')->with('target', 'file a complaint');
        else{
            if($request->pid) {
                $paidProduct = Purchase::where('userIdx', $user->userIdx)->where('productIdx', $request->pid)->get()->first();
                if($paidProduct){
                    $product = OfferProduct::where('productIdx', $request->pid)
                                    ->get()
                                    ->first();
                    $company = Provider::join('offers', 'offers.providerIdx', '=', 'providers.providerIdx')
                                    ->join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                                    ->where('offerProducts.productIdx', $request->pid)
                                    ->get()
                                    ->first();
                    $data = array('product', 'company');
                    return view('help.send_file_complaint', compact($data));
                } else return redirect(route('help.send_file_complaint'));
            }
            else return view('help.send_file_complaint');
        }
    }

    public function post_send_file_complaint(Request $request)
    {
        $user = $this->getAuthUser();
        if($request->productIdx)
            $validator = Validator::make($request->all(),[
                'message' => 'required|min:5|max:1000',
            ]);
        else
            $validator = Validator::make($request->all(),[
                'provider_company_name' => 'required_without_all:seller_company_name,other',
                'seller_company_name' => 'required_without_all:provider_company_name,other',
                'other' => 'required_without_all:provider_company_name,seller_company_name',
                'message' => 'required|min:5|max:1000',
            ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $provider_company_name = $request->provider_company_name;
        $seller_company_name = $request->seller_company_name;
        $other = $request->other;
        $message = $request->message;

        $data['message'] = $message;

        if(isset($request->productIdx)){
            $data['productTitle'] = OfferProduct::where('productIdx', $request->productIdx)->get()->first()->productTitle;
            $data['companyName'] = $request->companyName;
        }
        else
            $data['companyName'] = $provider_company_name ? $provider_company_name : ($seller_company_name ? $seller_company_name : $other);
        $data['user'] = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                            ->where('userIdx', $user->userIdx)
                            ->get()
                            ->first();
        $complaint['userIdx'] = $user->userIdx;
        $complaint['complaintTarget'] = $data['companyName'];
        $complaint['complaintContent'] = $message;
        if(isset($request->productIdx)) $complaint['productIdx'] = $request->productIdx;
        
        Complaint::create($complaint);

        $this->sendEmail("complaint", [
            'from'=>"cg@jts.ec", 
            //'to'=>env('DB_TEAM_EMAIL'),
            'to'=>'hello@databroker.global', 
            'name'=>'Databroker', 
            'subject'=>'Someone has sent a complaint on Databroker',
            'data'=>$data
        ]);

        return view('help.send_complaint_success');
    }

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function feedback()
    {
        $topics = HelpTopic::where('page', 'feedbacks')->get();
        $data = array('topics');
        return view('help.feedback', compact($data));
    }
}
