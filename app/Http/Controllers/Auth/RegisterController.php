<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Mail;
use Newsletter;

use App\User;
use App\Models\Community;
use App\Models\Region;
use App\Models\Company;
use App\Models\Business;
use App\Models\LinkedUser;
use App\Models\Subscription;
use App\Models\Wallet;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register_nl';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {        
        $email = $request->e?base64_decode($request->e):"";
        $companyIdx = $request->cid?$request->cid:"";
        $company = Company::where('companyIdx', '=', $companyIdx)->get()->first();

        $params['email'] = $email;
        $params['company'] = $company;
        $params['businesses'] = Business::get();

        return view('auth.register')->with($params);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'companyName' => ['required'],
            'businessName2' => ['required'],
            'role2' => ['required'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'password_confirmation'=>['same:password'],
            'term_conditions' => ['required']
        ];
        if($data['businessName2']=="Other industry")
            $rules['businessName'] = ['required', 'string'];
        else if($data['role2']=="Other")
            $rules['role'] = ['required', 'string'];
        return Validator::make($data, $rules, [
            'companyName.required'=>'Your company name is required.',
            'businessName2.required'=>'Your industry is required.',
            'businessName.required'=>'Your industry is required.',
            'role2.required'=>'Your role is required.',
            'role.required'=>'Your role is required.',
            'password.min'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.required'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.regex'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password_confirmation.same'=>"Passwords do not match.",
            'term_conditions.required'=>'Please confirm that you accept Databroker’s terms and conditions and privacy policy.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        $businessName = $data['businessName2']==='Other industry'?$data['businessName']:$data['businessName2'];
        $role = $data['role2']==='Other'?$data['role']:$data['role2'];

        $userStatus = 1;
        if($data['companyIdx']!=0) $userStatus = 2;
        $isLinkedUser = LinkedUser::where('linked_email', '=', $data['email'])->first();
        if($isLinkedUser) $isLinkedUser->delete();
        $companyIdx = $data['companyIdx'];
        if($data['companyIdx']==0){
            // $companyObj = Company::where('CompanyName', '=', $data['companyName'])->first();
            // if(!$companyObj)
                $companyObj = Company::create([                
                    'companyName'=>$data['companyName']
                ]);
            //else $userStatus=2;
            $data['companyIdx'] = $companyObj['companyIdx'];
            $companyIdx = $companyObj['companyIdx'];
        }
        $data['userStatus'] = $userStatus;

        $query = $data;
        $query['user_type'] = "data_buyer";
        $query['job_title'] = "";
        $query['region'] = "";
        $query['companyURL'] = "";
        $query['companyVAT'] = "";
        unset($query['_token']);
        unset($query['companyIdx']);
        unset($query['userStatus']);
        unset($query['password']);
        unset($query['password_confirmation']);

        $client1 = new \GuzzleHttp\Client();
        $url = "https://prod-107.westeurope.logic.azure.com:443/workflows/bdf7e02c893d426c8f8e101408d30471/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=RvoLkDUgsGbKOUk8oorOUrhXpjcSIdf1_29oSPDA-Tw";
        $response = $client1->request("POST", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=> json_encode($query)
        ]);

        //create a wallet
        $client2 = new \GuzzleHttp\Client();
        $url = "https://dxs-swagger.herokuapp.com/ethereum/wallet";
        $response = $client2->request("POST", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=>'{}'
        ]);
        $responseBody = json_decode($response->getBody()->getContents());
        $walletAddress = $responseBody->address;

        $this->sendEmail("register", [
            'from'=>'ce@jts.ec', 
            'to'=>$data['email'], 
            'subject'=>'Welcome to Databroker', 
            'name'=>'Databroker',
            'userData'=>$data
        ]);    

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'companyIdx'=> $companyIdx,
            'businessName' => $businessName,
            'role' => $role,
            'userStatus' => $userStatus,
            'wallet'=>$walletAddress,
            'password' => Hash::make($data['password']),
        ]);
    }
}
