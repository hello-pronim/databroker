@extends('layouts.app')

@section('content')       
<div class="container-fluid app-wapper bg-pattern-side">
    <div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
                <h1 class="text-primary text-center text-bold">{{trans('contact.get_in_touch')}}</h1>
                <p class="text-center fs-16"> 
                	Want to know more about our DataMatch service? About becoming a partner? Or maybe you didn’t find the answer to your questions in our <a href="#">Help & support centre</a> or <a href="#">Media centre?</a><br/><br/>
	                Tell us how we can help, and we’ll get back to you!<br/><br/>
					You can also use this form to give us your feedback on Databroker – we’d love to hear it! 
				</p>
                <br>
                <form method="POST" action="{{ route('contact.send') }}" id="contactForm">
                    @csrf
                    <label class="pure-material-textfield-outlined">
						<textarea name="message" class="form-control input_data user-message @error('message') is-invalid @enderror" placeholder="{{ trans('pages.your_message') }}" maxlength="1000" autofocus>{{ old('message')}}</textarea>
						<div class="error_notice">{{ trans('validation.required', ['attribute' => 'Message']) }}</div>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="firstname" name="firstname" class="form-control input_data @error('firstname')  is-invalid @enderror" placeholder=" "  value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                        <span>{{ trans('contact.first_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'First Name']) }}</div>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="lastname" name="lastname" class="form-control input_data @error('lastname')  is-invalid @enderror" placeholder=" "  value="{{ old('lastname') }}" autocomplete="lastname" autofocus>
                        <span>{{ trans('contact.last_name') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last Name']) }}</div>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" "  value="{{ old('email') }}" autocomplete="email" autofocus>
                        <span>{{ trans('contact.email_address') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email Address']) }}</div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="company" name="companyName" class="form-control input_data @error('companyName')  is-invalid @enderror" placeholder=" "  value="{{ old('companyName') }}" autocomplete="company" autofocus>
                        <span>{{ trans('contact.company') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Company']) }}</div>
                        @error('companyName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="country" name="country" class="form-control input_data @error('country')  is-invalid @enderror" placeholder=" "  value="{{ old('country') }}" autocomplete="country" autofocus>
                        <span>{{ trans('contact.country') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Country']) }}</div>
                        @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="industry-dropdown dropdown-container">
                        <div class="dropdown" tabindex="1">
                            <div class="select">
                                <span>Which industry are you in?</span>
                            </div>
                            <input type="hidden" id="businessName2" name="businessName2" value="Agriculture/Mining/Forestry">
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

                    <label class="other-industry pure-material-textfield-outlined" style="display: none">
                        <input type="text" id="businessName" name="businessName" class="form-control input_data @error('businessName')  is-invalid @enderror" placeholder=" "  value="{{ old('businessName') }}" autocomplete="businessName" autofocus>
                        <span>{{ trans('contact.enter_your_industry') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Your industry']) }}</div>
                        @error('businessName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="role-dropdown dropdown-container">
                        <div class="dropdown" tabindex="1">
                            <div class="select">
                                <span>What role do you have?</span>
                            </div>
                            <input type="hidden" id="jobTitle2" name="jobTitle2" value="Technical">
                            <ul class="dropdown-menu" style="display: none;">
                                <li value="Business">Business</li>
                                <li value="Technical">Technical</li>
                                <li value="">Other</li>
                            </ul>
                        </div>
                        <div class="error_notice"> This field is required</div>
                    </div>

                    <label class="other-role pure-material-textfield-outlined" style="display: none">
                        <input type="text" id="jobTitle" name="jobTitle" class="form-control input_data @error('jobTitle')  is-invalid @enderror" placeholder=" "  value="{{ old('jobTitle') }}" autocomplete="jobTitle" autofocus>
                        <span>{{ trans('contact.enter_your_role') }}</span>
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Your role']) }}</div>
                        @error('jobTitle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <p class="fs-18 text-bold mt-30">
                    	We’d love to know a little more about your interests.<br/>
      								Which data communities are most relevant for you?
      							</p>

                    <div class="row mt-30">
                        @foreach ($communities as $community)
                        <div class="col-md-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="community[]" value="{{$community['communityIdx']}}">
                                    <p class="text-black fs-16 lh-24">{{$community['communityName']}}</p>
                                    <span class="form-check-sign">
                                        <span class="custom-check check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>    
                        @endforeach
                        @error('community')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    

                    <p>We’re committed to your privacy. Your details are collected and stored so we can respond to your query.</p>
                    
                    <div class="form-group row mb-0">                        
                        <div class="col-md-6">                                
                            <button type="submit" class="customize-btn">{{ trans('contact.send') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('additional_javascript')
<script type="text/javascript">
  $(function(){
    $('.bmd-form-group').map((index, item)=>{
      var child = $(item).find('.input_data');
      console.log(child);
      item = $(child); 
    })
  });
</script>
@endsection   