<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/ ';

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'emailAddress' => $request->email]
        );
    }
    protected function rules()
    {
        return [
            'token' => 'required',
            'emailAddress' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
    protected function credentials(Request $request)
    {
        return $request->only(
            'emailAddress', 'password', 'password_confirmation', 'token'
        );
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('emailAddress'))
                    ->withErrors(['emailAddress' => trans($response)]);
    }
}
