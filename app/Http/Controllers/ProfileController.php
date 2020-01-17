<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Business;

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

        $users = User::all();
        $users = null;
        $business = Business::all();

        $data = array('user', 'users', 'business');
        return view('account.profile', compact($data));

    }
   
    public function purchases(Request $request)
    {
        return view('account.purchases');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $fields = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'emailAddress' => ['required', 'string', 'email', 'max:255']
        ];

        // if any of the password fields present, validate
        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');
        $passwordConfirm = $request->input('password_confirmation');

        if ((!empty($oldPassword)) || (!empty($password)) || (!empty($passwordConfirm))) {
            $updatePassword = true;
            $fields['password'] = ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'];
        }
        else {
            $updatePassword = false;
        }

        $validator = Validator::make($request->all(), $fields);

        if($validator->fails()){
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }
        
        // check old password
        
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->emailAddress = $request->input('emailAddress');
        $user->jobTitle = $request->input('jobTitle');
        $user->businessName = $request->input('businessName');

        if ($updatePassword == true)
        {
            if (!Hash::check($oldPassword, $user->password)) {                                
                return response()->json(array("success" => false, 'result' => array('password'=> "Old password is not correct.")));
            }else {
                $user->password = Hash::make($request->input('password'));
            }
            
        }

        $user->save();
        
        return response()->json(['success' => true, 'result' => "Updated successfully."]);
    }

    public function wallet(Request $request){
        return view('account.wallet');
    }

    public function bids(){
        $user = Auth::user();
        
        return view('account.bids');
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
