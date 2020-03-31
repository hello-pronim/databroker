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
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'password_confirmation'=>['same:password'],
            'term_conditions' => ['required']
        ], [
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
            $companyIdx = $companyObj['companyIdx'];
        }
        $data['userStatus'] = $userStatus;

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
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function redirectTo()
    {
        return url()->previous();
    }
}
