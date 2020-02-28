@extends('auth.auth_app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper app-wapper-register bg-pattern-side" ng-app="signupApp" ng-cloak ng-controller="signupCtrl as ctrl">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-md-8" id="register_section">
                <h1 class="h1-smaller text-primary text-center" id="register_title">Get started with Databroker</h1>
                <br>
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="firstname" name="firstname" class="form-control input_data @error('firstname')  is-invalid @enderror" placeholder=" "  value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                        <span>{{ trans('auth.first_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'First Name']) }}</div>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="lastname" name="lastname" class="form-control input_data @error('lastname')  is-invalid @enderror" placeholder=" "  value="{{ old('lastname') }}" autocomplete="lastname" autofocus>
                        <span>{{ trans('auth.last_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last Name']) }}</div>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        @if($email!='')
                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" " value="{{$email}}" readonly autocomplete="email" autofocus>
                        @else
                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" " value="{{ old('email') }}" autocomplete="email" autofocus>
                        @endif
                        <span>{{ trans('auth.email_address') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email Address']) }}</div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        @if($business!='')
                        <input type="text" id="company" name="companyName" class="form-control input_data @error('companyName')  is-invalid @enderror" placeholder=" "  value="{{ $business }}" readonly autocomplete="company" autofocus>
                        @else
                        <input type="text" id="company" name="companyName" class="form-control input_data @error('companyName')  is-invalid @enderror" placeholder=" "  value="{{ old('companyName') }}" autocomplete="company" autofocus>
                        @endif
                        <span>{{ trans('auth.company') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Company']) }}</div>
                        @error('companyName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <div class="dropdown-container">
                        <div class="dropdown2 business_list" tabindex="1">                                
                            <div class="adv-combo-wrapper">
                                <select id="businessName2" name="businessName2" placeholder="Which industry are you in?">
                                    <option></option>
                                @foreach ($businesses as $business)
                                    @if(old('businessName2')==$business->businessName)
                                    <option value="{{$business->businessName}}" selected>{{ $business->businessName }}</option>
                                    @else
                                    <option value="{{$business->businessName}}">{{ $business->businessName }}</option>
                                    @endif
                                @endforeach
                                 </select>
                            </div>                              
                        </div>
                    </div>    

                    <label class="other-industry pure-material-textfield-outlined" style="display: none">
                        <input type="text" id="businessName" name="businessName" class="form-control input_data @error('businessName')  is-invalid @enderror" placeholder=" " value="{{ old('businessName') }}" autocomplete="businessName" autofocus>
                        <span>{{ trans('auth.enter_your_industry') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last Name']) }}</div>
                        @error('businessName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="dropdown-container">
                        <div class="dropdown2 job_list" tabindex="1">                                
                            <div class="adv-combo-wrapper">
                                <select id="jobTitle2" name="jobTitle2" placeholder="What role do you have?">
                                    <option></option>
                                    <option value="Business">Business</option>
                                    <option value="Technical">Technical</option>
                                    <option value="Other">Other</option>
                                 </select>
                            </div>                              
                        </div>
                    </div>    

                    <label class="other-role pure-material-textfield-outlined" style="display: none">
                        <input type="text" id="jobTitle" name="jobTitle" class="form-control input_data @error('jobTitle')  is-invalid @enderror" placeholder=" "  value="{{ old('jobTitle') }}" autocomplete="jobTitle" autofocus>
                        <span>{{ trans('auth.enter_your_role') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Job title']) }}</div>
                        @error('jobTitle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password" name="password" class="form-control input_data @error('password') is-invalid @enderror" placeholder=" "  value="" autofocus>
                        <span>{{ trans('auth.password') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Password']) }}</div>
                        <span class="feedback @error('password') invalid-feedback @enderror" role="alert">
                            <strong>
                                @if($errors->has('password')) {{$errors->first('password')}}
                                @else
                                Your password must contain at least 8 characters, including 1 uppercase letter and 1 digit.
                                @endif
                            </strong>
                        </span>
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control input_data @error('password-confirm')  is-invalid @enderror" placeholder=" "  value="" autofocus>
                        <span>{{ trans('auth.confirm_password') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Confirm Password']) }}</div>
                        @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="form-check">
                        <label class="form-check-label">                
                            <input type="checkbox" class="form-check-input" name="term_conditions" value="true">
                            <p class="text-black fs-18 lh-27">Yes, I accept Databroker’s <a href="{{ route('about.terms_conditions') }}" target="_blank"><font style="color: #78E6D0;">terms and conditions</font></a> and <a href="{{ route('about.privacy_policy') }}" target="_blank"><font style="color: #78E6D0;">the privacy policy</font></a></p>
                            <span class="form-check-sign">
                                <span class="custom-check check @error('term_conditions') is-invalid @enderror"></span>
                            </span>                                                      
                        </label>  
                        @error('term_conditions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                                                  
                    </div> 
                    <br>                       
                    
                    <div class="register-actions form-group mb-0">
                        <button type="submit" class="customize-btn">CREATE ACCOUNT</button>
                        @if (Route::has('login'))
                            <a class="text-grey" id="login_link" href="{{ route('login') }}">
                                {{ __('Already have an account?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional_javascript')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection