<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Models\Business;
use App\Models\Provider;
use App\Models\Region;
use App\Models\LinkedUser;

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

        $users = User::where('companyName', $user->companyName)->where('userIdx', '<>' ,$user->userIdx)->get();        
        $invited_users = LinkedUser::where('invite_userIdx', $user->userIdx)->get();            
        $business = Business::all();

        $data = array('user', 'users', 'invited_users', 'business');
        return view('account.profile', compact($data));

    }

    public function company(){
        $user = $this->getAuthUser();
        $company = Provider::with('Region')->where('userIdx', $user->userIdx)->first();        
        $countries = Region::where('regionType', 'country')->get(); 

        $data = array('company', 'countries');
        return view('account.company', compact($data));        
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
            'email' => ['required', 'string', 'email', 'max:255']
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
        $user->email = $request->input('email');
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

    public function update_company(Request $request){
        $fields = [
            'companyName' => ['required', 'string', 'max:255'],
            'regionIdx' => ['required', 'integer'],            
            'companyURL' => ['required', 'string', 'max:255']            
        ];    

        $validator = Validator::make($request->all(), $fields);

        if($validator->fails()){
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }

        $company = [];
        $company['companyName'] = $request->companyName;
        $company['regionIdx'] = $request->regionIdx;
        $company['companyURL'] = $request->companyURL;
        
        if($request->file('companyLogo_1')!=null){            
            $companyLogo_path = public_path('uploads/company');
            $fileName = "company_".$request->providerIdx.'.'.$request->file('companyLogo_1')->extension();
            
            if(file_exists($companyLogo_path.'/'.$request->old_companyLogo)){                                
                File::delete($companyLogo_path.'/'.$request->old_companyLogo);
            }
            $request->file('companyLogo_1')->move($companyLogo_path, $fileName);  
            $company['companyLogo'] = $fileName;  
        }        
        
        Provider::where('providerIdx', $request->providerIdx)->update($company);

        return response()->json(array( "success" => true, 'redirect' => route('account.company') ));
    }

    public function wallet(Request $request){
        return view('account.wallet');
    }

    public function bids(){
        $user = Auth::user();
        
        return view('account.bids');
    }

    public function invite_user(Request $request){
        $data = $request->all();
        $user = $this->getAuthUser();
        foreach ($data['linked_email'] as $key => $value) {
            if($value){
                $linked['invite_userIdx'] = $data['invite_userIdx'];
                $linked['linked_email'] = $value;
                LinkedUser::create($linked);

                $this->sendEmail("invite", [
                    'from'=>$user->email, 
                    'to'=>$linked['linked_email'], 
                    'name'=>'Databroker', 
                    'subject'=>'You’ve been invited to join a Databroker account',
                    'data'=>$user
                ]);
            }
        }

        return response()->json(array( "success" => true )); 
        
    }

    public function delete(Request $request){
        if($request->user_id){
            if($request->type == "registered")
                User::where('userIdx', $request->user_id)->delete();    
            if($request->type == "pendding")
                LinkedUser::where('linkedIdx', $request->user_id)->delete();    
        }
        
        return response()->json(array( "success" => true) );
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }
}
