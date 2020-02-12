<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Community;
use Mail;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],  
            'term_conditions' => ['required']          
        ], [
            'password.regex'=>'Password should contain A~Z, a~z, 0~9'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous() .'#registerForm')
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $businessName = $data['businessName2']===NULL?$data['businessName']:$data['businessName2'];
        $jobTitle = $data['jobTitle2']===NULL?$data['jobTitle']:$data['jobTitle2'];

        $this->sendEmail("register", [
            'from'=>'yuriyes43@gmail.com', 
            'to'=>$data['email'], 
            'subject'=>'Databroker', 
            'name'=>'Databroker',
            'userData'=>$data
        ]);   

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'companyName' => $data['companyName'],
            'businessName' => $businessName,
            'jobTitle' => $jobTitle,
            'userStatus' => 1,
            'password' => Hash::make($data['password']),
        ]);

    }

    
    public function sendEmail($tplName, $params){

        $from = $params['from'];
        $to = $params['to'];
        $name = $params['name'];
        $subject = $params['subject'];

        Mail::send('email.'.$tplName, $params,
            function($mail) use ($from, $to, $name, $subject){
                // $mail->from($from, $name);
                // $mail->to($to, $to);
                // $mail->subject($subject);
        });
    }

    protected function register_nl()
    {
        $communities = Community::get();                
        
        $data = array( 'communities' );                
        return view('auth.register_nl', compact($data));
    }    
}
