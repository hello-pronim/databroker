<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'emailAddress'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request->all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
        }
        else {
            // create our user data for the authentication
            $userdata = array(
                'emailAddress'     => $request->get('emailAddress'),
                'password'  => $request->get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                 return Redirect::to($this->redirectTo);
            }
            else {
                // validation not successful, send back to form
                return Redirect::to('login');

            }
        }
    }

    public function logout()
    {
        return Redirect::to('login');
    }

	public function username()
	{
		return 'emailAddress';
	}
}
