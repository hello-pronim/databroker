@extends('layouts.data')

@section('title', 'Publishing provider info | Databroker')
@section('description', '')

@section('additional_css')
	<link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	<!-- <link rel="stylesheet" href="{{ asset('bower_components/select2/select2.css') }}"> -->
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<form method="post" action="{{ route('save_data_offer_provider') }}">
    		@csrf    		
            <div class="app-section app-reveal-section align-items-center">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="blog-header">
                            <h1>Before we start</h1>
                            <p class="area">Please tell us a little more about your company.<br>
                            This information will be published in the marketplace along with your data offer.</p>
                        </div>
                        <div class="blog-content">
                            <label class="pure-material-textfield">Which country are you located in? </label>
                            <div class="adv-combo-wrapper custom-select2">
                                <select id="regionIdx" name="regionIdx" class="" data-placeholder="{{ trans('pages.search_by_country') }}">
                                    <option></option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback regionIdx">
                                    <strong></strong>
                                </div>
                            </div>
                            <label class="pure-material-textfield">{{ trans('pages.what_company_name') }}</label>
                            <label class="pure-material-textfield-outlined">
                                <input type="text" id="companyName" name="companyName" class="form-control input_data" placeholder=" "  value="">
                                <span>{{ trans('pages.enter_name') }}</span>                            
                                <div class="invalid-feedback companyName">
                                    <strong></strong>
                                </div>
                            </label>
                            <label class="pure-material-textfield">{{ trans('pages.what_company_url') }}</label>
                            <label class="pure-material-textfield-outlined">
                                <input type="text" id="companyURL" name="companyURL" class="form-control input_data" placeholder=" "  value="">
                                <span>{{ trans('pages.enter_url') }}</span> 
                                <div class="invalid-feedback companyURL">
                                    <strong></strong>
                                </div>                        
                            </label>
                            <label class="pure-material-textfield mt-20">Please upload your company's logo <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.company_logo_tooltip') }}">help</i></label>
                            <div class="fileupload data-offer">                            
                                <input type="file" name="companyLogo" accept='image/*'>
                                <div class="invalid-feedback companyLogo"></div>
                            </div>
                            <div class="buttons text-right">    
                                <button type="submit" class="customize-btn btn-next pull-right">{{ trans('pages.save') }}</button>
                            </div>
                        </div>  
                    </div>
                </div>   
            </div>     
        </form>
    </div>
</div>
@endsection
@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection