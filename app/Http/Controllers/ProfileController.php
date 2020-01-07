<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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

    public function getAuthUser ()
    {
        return Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = $this->getAuthUser();

        // TODO
        $users = \App\User::all();
        $users = null;

        return view('account.profile', $user)->with('users', $users);
    }

    public function edit(Request $request)
    {
        $user = $this->getAuthUser();

        return view('account.profile_edit', $user);
    }

    public function purchases(Request $request)
    {
        return view('account.purchases');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'emailAddress' => ['required', 'string', 'email', 'max:255']
        ]);

        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->emailAddress = $data['emailAddress'];
        $user->jobTitle = $request->input('jobTitle');
        $user->businessName = $request->input('businessName');

        $user->save();
        return redirect('/profile/'.Auth::user()->id)->with('success', 'Profile has been updated');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'emailAddress' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }
}
