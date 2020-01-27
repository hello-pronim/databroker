@extends('layouts.app')

@section('additional_css')	
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!-- -->
<div class="container-fluid app-wapper help buying-data">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <h1 class="h1-small">You are adding a new data product</h1>
                <h3 class="h3">Related to Satellite imagery of highways</h3>
                <span class="para">Europe</span>
            </div>
            <div class="divider-green mgh40"> </div>
            <div class="content">
            	<div class="row">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">What is the data product you are selling?</h4>

						<div class="text-wrapper">
							<textarea name="offerTitle" class="round-textbox user-message min-h100" placeholder="{{ trans('pages.your_message') }}" maxlength="1000"></textarea>							
							<div class="error_notice offerTitle"> This field is required</div>
							<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
						</div>
					</div>
				</div>
            	<div class="row">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">For what region?</h4>
			        	<div class="adv-combo-wrapper custom-select2">
		                    <select name="regionIdx" data-placeholder="{{ trans('pages.search_by_country') }}">
		                    	<option></option>
		                    	@foreach ($countries as $country)
	                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
	                            @endforeach
		                    </select>
	                        <div class="error_notice regionIdx"> This field is required</div>
		                </div>
					</div>
				</div>
            	<div class="row mgt30">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">In what format will you provide the data?</h4>
			        	<div class="radio-wrapper format">		                    
		                    <label class="container para">File
							  <input type="radio" checked="checked" name="format">
							  <span class="checkmark"></span>
							</label>

							<label class="container para">Api flow	
							  <input type="radio" name="format">
							  <span class="checkmark"></span>
							</label>

							<label class="container para">Stream
							  <input type="radio" name="format">
							  <span class="checkmark"></span>
							</label>
		                </div>
					</div>
				</div>
            	<div class="row mgt30">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">How will you handle pricing?</h4>
			        	<div class="radio-wrapper period">		                    
		                    <label class="container para">The data is free
							  <input type="radio" checked="checked" name="period">
							  <span class="checkmark"></span>
							</label>

							<div>
								<label class="container para">I will set a price, the buyer cannot bid	
								  <input type="radio" name="period">
								  <span class="checkmark"></span>
								</label>
								<div class="flex-vcenter">
									<div>
										<label class="pure-material-textfield-outlined">
					                        <input type="text" id="licenseUrl" name="companyUrl" class="form-control2 input_data" placeholder=" "  value="">
					                        <span>{{ trans('pages.enter_url') }}</span>	                        
					                    </label>
					                </div>
				                    <span class="para mgl30 mgr30">for access to this data for</span>
						        	<div class="adv-combo-wrapper custom-select2">
					                    <select name="regionIdx" data-placeholder="{{ trans('pages.search_by_country') }}">
					                    	<option></option>
					                    	@foreach ($countries as $country)
				                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
				                            @endforeach
					                    </select>
				                        <div class="error_notice regionIdx"> This field is required</div>
					                </div>
					            </div>
			                </div>


							<label class="container para">I will set a price, but the buyer can also bid
							  <input type="radio" name="period">
							  <span class="checkmark"></span>
							</label>

							<label class="container para">I will not set a price, only bidding
							  <input type="radio" name="period">
							  <span class="checkmark"></span>
							</label>
		                </div>
					</div>
				</div>
            	<div class="row mgt30">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">Do you have any extra relevant information for potential buyers about this data? (optional)</h4>
			        	<div class="text-wrapper">
							<textarea name="offerTitle" class="round-textbox user-message min-h200" placeholder="{{ trans('pages.your_message') }}" maxlength="1000"></textarea>							
							<div class="error_notice offerTitle"> This field is required</div>
							<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
						</div>
					</div>
				</div>
            	<div class="row mgt30">
            		<div class="col-lg-6">
		                <h4 class="h4_intro text-left">Provide a URL where the buyer can read the data license</h4>
			        	<label class="pure-material-textfield-outlined">
	                        <input type="text" id="licenseUrl" name="companyUrl" class="form-control2 input_data" placeholder=" "  value="">
	                        <span>{{ trans('pages.enter_url') }}</span>	                        
	                    </label>
					</div>
				</div>
				<div class="row mgt40">
					<div class="col-lg-6">
						<button class="customize-btn">PUBLISH NOW</button><!-- submit and redirect to #38 -->
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
