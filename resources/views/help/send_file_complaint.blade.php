@extends('layouts.data')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')       
<div class="container-fluid app-wapper bg-pattern-side">
    <div class="container">
        <div class="row send-massage" id="send-message-row">
                    <div class="row justify-content-center mt-30 auth-section">
                        <div class="col-md-12">
                            <h2 class="text-primary text-left text-bold">File a complaint</h1>
                            <br>
                        </div>
                    </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row justify-content-center mt-30 auth-section">
                    <div class="col-md-12">
                        <div class="col-md-12 col-sm-12">        
                                <form method="POST" action="{{ route('help.post_send_file_complaint') }}" id="contactForm">
                                    @csrf
                                    <h4 class="h4_intro text-left">I want to file a complaint against</h4>
                                    <div class="radio-wrapper period">
                                        <div class="mb-10">
                                            <label class="container para">A data provider
                                                <input type="radio" name="period" value="provider">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="period_select">
                                                    <label class="pure-material-textfield-outlined">
                                                        <input type="text" id="provider_company_name" name="provider_company_name" class="form-control input_data @error('provider_company_name')  is-invalid @enderror" placeholder=" "  value="{{ old('provider_company_name') }}" autocomplete="provider_company_name" autofocus>
                                                        <span>Company name</span>
                                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Provider Company Name']) }}</div>
                                                        @error('provider_company_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </label>			                    
                                            </div>	
                                        </div>		                    		                    
                                        <div>
                                            <label class="container para">A data seller
                                            <input type="radio" name="period" value="seller">
                                            <span class="checkmark"></span>
                                            </label>
                                            <div class="period_select">
                                                    <label class="pure-material-textfield-outlined">
                                                        <input type="text" id="seller_company_name" name="seller_company_name" class="form-control input_data @error('seller_company_name')  is-invalid @enderror" placeholder=" "  value="{{ old('seller_company_name') }}" autocomplete="seller_company_name" autofocus>
                                                        <span>Company name</span>
                                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Seller Company Name']) }}</div>
                                                        @error('seller_company_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </label>			                    
                                            </div>	
                                        </div>
                                        <div>
                                            <label class="container para">Other
                                            <input type="radio" name="period" value="other">
                                            <span class="checkmark"></span>
                                            </label>
                                            <div class="period_select">
                                                    <label class="pure-material-textfield-outlined">
                                                        <input type="text" id="other" name="other" class="form-control input_data @error('other')  is-invalid @enderror" placeholder=" "  value="{{ old('other') }}" autocomplete="other" autofocus>
                                                        <span>Other</span>
                                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Other']) }}</div>
                                                        @error('other')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </label>			                    
                                            </div>	
                                        </div>							
                                    </div>
                                    <label class="pure-material-textfield-outlined">
                                        <textarea name="message" class="form-control input_data user-message @error('message') is-invalid @enderror" placeholder="Your complaint (please provide as much detail as possible)" maxlength="100" autofocus>{{ old('message')}}</textarea>
                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Message']) }}</div>
                                        @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                    <div class="form-group row mb-0">                        
                                        <div class="col-md-6">                                
                                            <button type="submit" class="customize-btn">FILE COMPLAINT</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-12">
                <div class="app-section app-reveal-section align-items-center usecases send-message">        
                    <div class="">
                        <div class="send-message-mgt60">
                            <p class="h4_intro text-left">How it works</p>
                            <ul class="databroker-list" id="send-msg-ul">
                                <li>Before filing a complaint with Databroker, we strongly recommend that you contact the data provider directly to discuss the problem, and try to come to an agreement about how to proceed.</li>
                                <li>In situations where you can’t resolve the issue amicably, <b>make sure to file your complaint within 30 days of your purchase</b>. Complaints sent after the 30-day warranty period will unfortunately not be processed.</li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection   