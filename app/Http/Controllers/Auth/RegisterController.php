<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Mail;
use App\Http\Controllers\Controller;
use App\Libraries\MailChimp;

use App\User;
use App\Models\Community;
use App\Models\Region;
use App\Models\Company;
use App\Models\Business;
use App\Models\LinkedUser;
use App\Models\Subscription;

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
    protected $redirectTo = '/';

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

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ? redirect(back()) : redirect()->intended($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'term_conditions' => ['required']
        ], [
            'password.min'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.required'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.regex'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
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

        $this->sendEmail("register", [
            'from'=>'pe@jts.ec', 
            'to'=>$data['email'], 
            'subject'=>'Databroker', 
            'name'=>'Databroker',
            'userData'=>$data
        ]);    

        $userStatus = 1;
        if($data['companyIdx']!=0) $userStatus = 2;
        $isLinkedUser = LinkedUser::where('linked_email', '=', $data['email'])->first();
        if($isLinkedUser) $isLinkedUser->delete();
        $companyIdx = $data['companyIdx'];
        if($data['companyIdx']==0){
            $companyObj = Company::where('CompanyName', '=', $data['companyName'])->first();
            if(!$companyObj)
                $companyObj = Company::create([                
                    'companyName'=>$data['companyName']
                ]);
            else $userStatus=2;
            $companyIdx = $companyObj['companyIdx'];
        }
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'companyIdx'=> $companyIdx,
            'businessName' => $businessName,
            'role' => $role,
            'userStatus' => $userStatus,
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function register_nl()
    {
        $communities = Community::get();
        $businesses = Business::get();
        $countries = Region::where('regionType', 'country')->get(); 
        
        $data = array( 'communities', 'businesses', 'countries' );                
        return view('auth.register_nl', compact($data));
    }  

    protected function create_nl(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'companyName' => 'required|min:2',
            'regionIdx' => 'required',
            'community'=> 'required|array|min:1'
        ],[
            'community.required'=>'Please choose at least one.',
            'regionIdx.required'=>'The country field is required.'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $businessName = $request->businessName2==='Other industry'?$request->businessName:$request->businessName2;
        $role = $request->role2==='Other'?$request->role:$request->role2;

        $subscription['firstname'] = $request->firstname;
        $subscription['lastname'] = $request->lastname;
        $subscription['email'] = $request->email;        
        $subscription['companyName'] = $request->companyName;
        $subscription['regionIdx'] = $request->regionIdx;
        $subscription['businessName'] = $businessName;
        $subscription['role'] = $role;
        $subscription['communities'] = json_encode($request->community);

        $subscriptionObj = Subscription::where('email', '=', $request->email)->get()->first();
        if($subscriptionObj) $subscriptionObj->delete();

        $subscriptionObj = Subscription::create($subscription);

        $mailchimp = new MailChimp();
        $list_id = '4076927107';
        $result = $mailchimp->post("lists/$list_id/members", [
            'email_address' => $subscription['email'],
            'merge_fields' => ['FNAME'=> $subscription['firstname'], 'LNAME'=> $subscription['lastname']],
            'status'        => 'subscribed',
        ]);

        return view('auth.register_nl_success');
    }

    protected function redirectTo()
    {
        return url()->previous();
    }
}
