@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-md-8" id="register_section">
                <h1 class="h1-smaller text-primary text-center" id="register_title">Let's get you set up on<br>Databroker!</h1>
                <br>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="firstname" name="firstname" class="form-control input_data @error('firstname')  is-invalid @enderror" placeholder=" "  value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                        <span>{{ trans('auth.first_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'First Name']) }}</div>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="lastname" name="lastname" class="form-control input_data @error('lastname')  is-invalid @enderror" placeholder=" "  value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                        <span>{{ trans('auth.last_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last Name']) }}</div>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="email" name="emailAddress" class="form-control input_data @error('emailAddress')  is-invalid @enderror" placeholder=" "  value="{{ old('emailAddress') }}" required autocomplete="email" autofocus>
                        <span>{{ trans('auth.email_address') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email Address']) }}</div>
                        @error('emailAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="company" name="companyName" class="form-control input_data @error('companyName')  is-invalid @enderror" placeholder=" "  value="{{ old('companyName') }}" required autocomplete="company" autofocus>
                        <span>{{ trans('auth.company') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Company']) }}</div>
                        @error('companyName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="dropdown-container">
                        <div class="dropdown" tabindex="1">
                            <div class="select">
                                <span>What business are you in?</span>
                            </div>
                            <input type="hidden" id="businessName" name="businessName" value="Agriculture/Mining/Forestry">
                            <ul class="dropdown-menu" style="display: none;">
                                <li value="Agriculture/Mining/Forestry">Agriculture/Mining/Forestry</li>
                                <li value="Advertising/Media/Publishing">Advertising/Media/Publishing</li>
                                <li value="Automotive">Automotive</li>
                                <li value="Construction/Engineering/Infrstructure">Construction/Engineering/Infrstructure</li>
                                <li value="Chemicals">Chemicals</li>
                                <li value="Creative">Creative</li>
                                <li value="Education">Education</li>
                                <li value="Energy/Utilities">Energy/Utilities</li>
                                <li value="Financial services &amp; insurance">Financial services &amp; insurance</li>
                                <li value="Government/Non-profit">Government/Non-profit</li>
                                <li value="Healthcare">Healthcare</li>
                                <li value="Hospitality/Tourism">Hospitality/Tourism</li>
                                <li value="IT services">IT services</li>
                                <li value="Manufacturing">Manufacturing</li>
                                <li value="Pharmaceutical/Biotech">Pharmaceutical/Biotech</li>
                                <li value="Retail/Consumer goods">Retail/Consumer goods</li>
                                <li value="Telecommunications/Electronics">Telecommunications/Electronics</li>
                                <li value="Transportation/Logistics">Transportation/Logistics</li>
                                <li value="">Other industry</li>
                            </ul>
                        </div>
                        <div class="error_notice"> This field is required</div>
                    </div>

                    <div class="dropdown-container">
                        <div class="dropdown" tabindex="1">
                            <div class="select">
                                <span>What kind of role do you have?</span>
                            </div>
                            <input type="hidden" id="jobTitle" name="jobTitle" value="Technical">
                            <ul class="dropdown-menu" style="display: none;">
                                <li value="Business">Business</li>
                                <li value="Technical">Technical</li>
                                <li value="">Other</li>
                            </ul>
                        </div>
                        <div class="error_notice"> This field is required</div>
                    </div>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="" required autofocus>
                        <span>{{ trans('auth.password') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Password']) }}</div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control input_data @error('password-confirm')  is-invalid @enderror" placeholder=" "  value="" required autofocus>
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
                            <b class="">Yes, I accept the <font style="color: #78E6D0;">terms and conditions</font> and <font style="color: #78E6D0;">the privacy policy</font> of Databroker</b>
                            <span class="form-check-sign">
                                <span class="custom-check check @error('term_conditions') is-invalid @enderror"></span>
                            </span>                                                        
                        </label>                                                   
                    </div> 
                    <br>                       
                    
                    <div class="form-group row mb-0">                        
                        <div class="col-md-6">                                
                            <button type="submit" class="customize-btn">CREATE ACCOUNT</button>
                        </div>

                        <div class="col-md-6 text-right">
                            @if (Route::has('login'))
                                <a class="btn btn-link text-grey" id="login_link" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
