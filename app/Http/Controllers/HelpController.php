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
        $topics = array(
            array(
                'id'        => 1, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 2, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
            array(
                'id'        => 3, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 4, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 5, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 6, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
        );
        $texts = array(
            'title' => 'Buying data',
            'title-description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
            'section2' => 'Top 10 FAQ',
            'faq_explain' => '(Short explanation) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
        );
        $faqs = array(
            array(
                'id'        => '1',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '2',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '3',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '4',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '5',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '6',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
        );
        $data = array( 'topics', 'texts', 'faqs' );
        return view('help.buying-data', compact($data));
    }

    public function selling_data(Request $request)
    {
        $topics = array(
            array(
                'id'        => 1, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 2, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
            array(
                'id'        => 3, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 4, 
                'title'     => 'Nunc varius risus sed metus bibendum, ac efficitur lorem ornare.', 
            ),
            array(
                'id'        => 5, 
                'title'     => 'Topic', 
            ),
            array(
                'id'        => 6, 
                'title'     => 'Lorem ipsum dolor sit amet', 
            ),
        );
        $texts = array(
            'title' => 'Selling data',
            'title-description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
            'section2' => 'Top 10 FAQ',
            'faq_explain' => '(Short explanation) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.',
        );
        $faqs = array(
            array(
                'id'        => '1',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '2',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '3',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '4',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '5',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
            array(
                'id'        => '6',
                'question'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?',
            ),
        );
        $data = array( 'topics', 'texts', 'faqs' );
        return view('help.selling-data', compact($data));
    }

    public function guarantee()
    {
        return view('help.guarantee');
    }

    public function file_complaint()
    {
        return view('help.file_complaint');
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

        if($request->productIdx){
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
        
        Complaint::create($complaint);

        $this->sendEmail("complaint", [
            'from'=>"cg@jts.ec", 
            'to'=>env('DB_TEAM_EMAIL'), 
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
        return view('help.feedback');
    }
}
