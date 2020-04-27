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
use App\Models\Company;
use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\Bid;
use App\Models\Message;
use App\Models\Region;
use App\Models\LinkedUser;

use DB;

class ProfileController extends Controller
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

        $users = User::where('companyIdx', $user->companyIdx)->where('userIdx', '<>' ,$user->userIdx)->get();        
        $invited_users = LinkedUser::where('invite_userIdx', $user->userIdx)->get();            
        $businesses = Business::get();

        $admin = User::where('companyIdx', $user->companyIdx)->where('userStatus', '=', 1)->get()->first(); 
        $company = Company::where('companyIdx', '=', $user->companyIdx)->get()->first();

        $data = array('admin', 'user', 'users', 'invited_users', 'businesses', 'company');
        return view('account.profile', compact($data));

    }

    public function company(){
        $user = $this->getAuthUser();    
        $countries = Region::where('regionType', 'country')->get(); 
        $company = Company::with('region')->join('users', 'users.companyIdx', '=', 'companies.companyIdx')->where('userIdx', $user->userIdx)->first();
        $data = array('countries', 'user', 'company');
        return view('account.company', compact($data));
    }
   
    public function purchases(Request $request)
    {
        $user = $this->getAuthUser();
        $purchases = Offer::with(['region', 'provider'])
                        ->join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                        ->join('purchases', 'purchases.productIdx', '=', 'offerProducts.productIdx')
                        ->leftjoin('bids', 'bids.bidIdx', '=', 'purchases.bidIdx')
                        ->where('purchases.userIdx', $user->userIdx)
                        ->get(["offers.*", "offerProducts.*", "purchases.*", "bids.*", "offerProducts.productIdx as pid"]);
        $data = array('purchases');
        return view('account.purchases', compact($data));
    }

    public function purchases_detail(Request $request)
    {
        $user = $this->getAuthUser();
        $detail = Offer::with(['region', 'provider'])
                        ->join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                        ->join('purchases', 'purchases.productIdx', '=', 'offerProducts.productIdx')
                        ->leftjoin('bids', 'bids.bidIdx', '=', 'purchases.bidIdx')
                        ->where('purchases.purchaseIdx', $request->pid)
                        ->get()
                        ->first();
        $company = Offer::join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                        ->where('offers.offerIdx', $detail['offerIdx'])
                        ->get()
                        ->first()
                        ->companyName;
        if(!$detail) return redirect(route('account.purchases'));
        $data = array('detail', 'company');
        return view('account.purchases_detail', compact($data));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $fields = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix']
        ];

        // if any of the password fields present, validate
        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');
        $passwordConfirm = $request->input('password_confirmation');

        if ((!empty($oldPassword)) || (!empty($password)) || (!empty($passwordConfirm))) {
            $updatePassword = true;
            $fields['password'] = ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'];
            $fields['password_confirmation'] = ['same:password'];
        }
        else {
            $updatePassword = false;
        }

        $validator = Validator::make($request->all(), $fields, [
            'password.min'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.required'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password.regex'=>'Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.',
            'password_confirmation.same'=>"Passwords do not match.",
        ]);

        if($validator->fails()){
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }
        
        // check old password
        
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->jobTitle = $request->input('jobTitle');
        $user->businessName = $request->input('businessName2')!='Other industry'
                                ? $request->input('businessName2')
                                : $request->input('businessName');
        $user->role = $request->input('role2')!='Other'
                                ? $request->input('role2')
                                : $request->input('role');

        if ($updatePassword == true)
        {
            if (!Hash::check($oldPassword, $user->password)) {                                
                return response()->json(array("success" => false, 'result' => array('oldPassword'=> "Old password is not correct.")));
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
            'companyURL' => ['required', 'string', 'max:255', "regex: #[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si"],
            'companyVAT'=>['required', 'string', 'max:255']
        ];
        $messages = [
            'companyName.required'=>'The company name is required.',
            'regionIdx.required'=>'The region is required.',
            'companyURL.required'=>'The company url is required.',
            'companyURL.regex'=>'The url format is invalid.',
            'companyVAT.required'=>'The company VAT number is required.'
        ];

        $validator = Validator::make($request->all(), $fields, $messages);

        if($validator->fails()){
            return response()->json(array( "success" => false, 'result' => $validator->errors() ));                    
        }


        $user = $this->getAuthUser();
        $company = [];
        $company['companyName'] = $request->companyName;
        $company['regionIdx'] = $request->regionIdx;
        $company['companyURL'] = $request->companyURL;
        $company['companyVAT'] = $request->companyVAT;
        
        if($request->file('companyLogo_1')!=null){            
            $companyLogo_path = public_path('uploads/company');
            $fileName = "company_".$request->companyIdx.'.'.$request->file('companyLogo_1')->extension();
            
            if(file_exists($companyLogo_path.'/'.$request->old_companyLogo)){                                
                File::delete($companyLogo_path.'/'.$request->old_companyLogo);
            }
            $request->file('companyLogo_1')->move($companyLogo_path, $fileName);  
            $company['companyLogo'] = $fileName;  
        }

        Company::where('companyIdx', $request->companyIdx)->update($company);

        $providers = Provider::where('userIdx', '=', $user->userIdx)->get();
        foreach($providers as $index=>$provider){
            $updatedProvider['regionIdx'] = $request->regionIdx;
            $updatedProvider['companyName'] = $request->companyName;
            $updatedProvider['companyURL'] = $request->companyURL;
            $updatedProvider['companyVAT'] = $request->companyVAT;
            if($request->file('companyLogo_1')!=null)
                $updatedProvider['companyLogo'] = $fileName;
            Provider::where('providerIdx', '=', $provider->providerIdx)->update($updatedProvider);
        }

        return response()->json(array( "success" => true, 'redirect' => route('account.company') ));
    }

    public function wallet(Request $request){
        return view('account.wallet');
    }

    public function buyer_bids(){
        $user = Auth::user();

        $bidProducts = OfferProduct::with('region')
                        ->join('bids', 'bids.productIdx', '=', 'offerProducts.productIdx')
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->join('providers', 'offers.providerIdx', '=', 'providers.providerIdx')
                        ->join('regions', 'regions.regionIdx', '=', 'providers.regionIdx')
                        ->where('bids.userIdx', $user->userIdx)
                        ->orderby('bids.created_at', 'desc')
                        ->groupby('offerProducts.productIdx')
                        ->get();
        
        $bidUsers = array();
        foreach ($bidProducts as $key => $bid) {
            $provider = Provider::join("offers", 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                                ->join("users", 'users.userIdx', '=', 'providers.userIdx')
                                ->where('offerProducts.productIdx', $bid['productIdx'])
                                ->get()
                                ->first();
            $sellerCompanyName = $provider['companyName'];
            $sellerName = $provider['firstname']." ".$provider['lastname'];

            $users = Bid::join('users', 'users.userIdx', '=', 'bids.userIdx')
                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->join('offerProducts', 'offerProducts.productIdx', '=', 'bids.productIdx')
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->where('bids.productIdx', $bid['productIdx'])
                        ->where('bids.userIdx', $user->userIdx)
                        ->orderby('bids.created_at', 'desc')
                        ->get(["users.*", 'companies.*', 'offerProducts.*', 'offers.*', 'bids.*', 'bids.created_at as createdAt']);
            foreach ($users as $key => $user) {
                $messages = Message::where('bidIdx', $user->bidIdx)->orderby('created_at', 'asc')->get();
                $user['messages'] = $messages;
            }
            array_push($bidUsers, array(
                'offerIdx'=>$bid['offerIdx'],
                'productIdx'=>$bid['productIdx'], 
                'sellerCompanyName'=>$sellerCompanyName, 
                'sellerName'=>$sellerName, 
                'users'=>$users)
            );
        }
        $data = array('bidProducts', 'bidUsers', 'user');
        return view('account.buyer_bids', compact($data));
    }

    public function seller_bids(Request $request){
        $user = Auth::user();
        
        $bidProducts = OfferProduct::with('region')
                                ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                                ->join(DB::raw("(SELECT *, bids.created_at as createdAt FROM bids ORDER BY createdAt DESC) as bids"), function($join){
                                        $join->on("bids.productIdx", "=", "offerProducts.productIdx");})
                                ->join('providers', 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('users', 'users.userIdx', '=', 'providers.userIdx')
                                ->where('users.userIdx', $user->userIdx)
                                ->groupby('offerProducts.productIdx')
                                ->get();

        $bidUsers = array();
        foreach ($bidProducts as $key => $bid) {
            $provider = Provider::join("offers", 'providers.providerIdx', '=', 'offers.providerIdx')
                                ->join('offerProducts', 'offerProducts.offerIdx', '=', 'offers.offerIdx')
                                ->join("users", 'users.userIdx', '=', 'providers.userIdx')
                                ->where('offerProducts.productIdx', $bid['productIdx'])
                                ->get()
                                ->first();
            $sellerCompanyName = $provider['companyName'];
            $sellerName = $provider['firstname']." ".$provider['lastname'];

            $users = Bid::join('users', 'users.userIdx', '=', 'bids.userIdx')
                        ->join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                        ->join('offerProducts', 'offerProducts.productIdx', '=', 'bids.productIdx')
                        ->join('offers', 'offers.offerIdx', '=', 'offerProducts.offerIdx')
                        ->where('bids.productIdx', $bid['productIdx'])
                        ->orderby('bids.created_at', 'desc')
                        ->get(["users.*", 'companies.*', 'offerProducts.*', 'offers.*', 'bids.*', 'bids.created_at as createdAt']);
            foreach ($users as $key => $user) {
                $messages = Message::where('bidIdx', $user->bidIdx)->orderby('created_at', 'asc')->get();
                $user['messages'] = $messages;
            }
            array_push($bidUsers, array(
                'offerIdx'=>$bid['offerIdx'],
                'productIdx'=>$bid['productIdx'], 
                'sellerCompanyName'=>$sellerCompanyName, 
                'sellerName'=>$sellerName, 
                'users'=>$users)
            );
        }
        $data = array('bidProducts', 'bidUsers', 'user');
        return view('account.seller_bids', compact($data));
    }

    public function invite_user(Request $request){
        $data = $request->all();
        $user = $this->getAuthUser();
        foreach ($data['linked_email'] as $key => $value) {
            if($value){
                $linked['invite_userIdx'] = $data['invite_userIdx'];
                $linked['linked_email'] = $value;
                $linked_user = LinkedUser::where('linked_email', '=', $value)->first();
                if(!$linked_user){
                    LinkedUser::create($linked);

                    $linkedUserData['user'] = $user;
                    $linkedUserData['email'] = base64_encode($linked['linked_email']);
                    
                    $this->sendEmail("invite", [
                        'from'=>$user->email, 
                        'to'=>$linked['linked_email'], 
                        'name'=>'Welcome to Databroker', 
                        'subject'=>'You’ve been invited to join a Databroker account',
                        'data'=>$linkedUserData
                    ]);
                }
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
