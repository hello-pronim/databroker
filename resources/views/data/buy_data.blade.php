@extends('layouts.data')

@section('title', 'Buy data product | Databroker ')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<form data-cc-on-file="false" data-stripe-publishable-key="{{$publishable_key}}" method="post" 
    			action="{{ route('data.pay_data', ['id'=>$product->offerIdx, 'pid'=>$product->productIdx]) }}" id="buy-data">
    		@csrf
	    	<div id="step1" class="app-section app-reveal-section align-items-center step current">
	    		<div class="row blog-header">
		    		<div class="col col-9">
						<h1>Please review the data you're about to buy</h1>
						<p class="para text-bold">You are buying from {{$product->companyName}}</p>
					</div>
				</div>
				<div class="app-monetize-section-item0 ml-0 mt-20"></div>
				<div class="blog-content">
					<div class="row">
						<div class="col-6">
							<div class="row">
								<div class="col-md-12">
									<p class="fs-24 para text-bold mb-0">{{$product->productTitle}}</p>
									<p class="para fs-16">
										@foreach($product->region as $region)
	            							<span>{{ $region->regionName }}</span>
	            						@endforeach
	            					</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="para text-red">€ {{$finalPrice}}</p>
									<p class="para">
						        		<span class="text-grey">{{ trans('data.access_to_this_data') }}: </span>
						        		<span>1 {{$product->productAccessDays}}</span>
						        	</p>
						        	<p class="para">
						        		<span class="text-grey">{{ trans('data.format') }}: </span>
						        		<span>{{$product->productType}}</span>
						        	</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-check">
		                                <label class="form-check-label">
		                                    <input type="checkbox" class="form-check-input" name="termcondition_privacypolicy">
		                                    <p class="text-black fs-16 lh-24">{!! trans('data.accept_termsconditions_privacypolicy', ['url1'=>route('about.terms_conditions'), 'url2'=>route('about.privacy_policy')]) !!}</p>
		                                    <span class="form-check-sign">
		                                        <span class="custom-check check"></span>
		                                    </span>
	                        				<div class="error_notice termcondition_privacypolicy">Please confirm that you accept Databroker’s Terms and conditions and Privacy policy.</div>
		                                </label>
		                            </div>
		                            <div class="form-check">
		                                <label class="form-check-label">
		                                    <input type="checkbox" class="form-check-input" name="license_seller">
		                                    <p class="text-black fs-16 lh-24">{!! trans('data.accept_license_seller', ['url'=>$product->productLicenseUrl]) !!}</p>
		                                    <span class="form-check-sign">
		                                        <span class="custom-check check"></span>
		                                    </span>
	                        				<div class="error_notice license_seller">Please confirm that you accept the data provider’s licence for the use of this data.</div>
		                                </label>
		                            </div>
								</div>
							</div>
							<div class="row mt-20">
								<div class="col-md-12">
									<div class="buttons flex-vcenter">
										<button type="button" class="customize-btn btn-next">{{ trans('data.confirm') }}</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6 flex-column align-items-center">
							<div class="ml-20">
								<p class="fs-24 para text-bold">Buy with confidence</p>
			        			<ul class="custom-list">
			        				<li>30-day warranty</li>
			        				<li>Instant access to the data</li>
			        				<li>Fully secure peer-to-peer data transfer</li>
			        			</ul>
			        		</div>
		        		</div>
					</div>
				</div>
		    </div>	
	    	<div id="step2" class="app-section app-reveal-section align-items-center step">  
	    		<div class="row blog-header">
		    		<div class="col col-9">
						<h1>{{ trans('data.enter_payment_details') }}</h1>
						<p class="para text-bold">You are buying from {{$product->companyName}}</p>	
					</div>
				</div>
				<div class="app-monetize-section-item0 ml-0 mt-20"></div>
				<div class="blog-content">
					<div class="row">
						<div class="col-6 auth-section">
							<div>
								<p class="para text-bold">{{trans("data.contact_information")}}</p>
								<input type="hidden" id="userIdx" name="userIdx" value="{{$buyer->userIdx}}">
								<input type="hidden" id="offerIdx" name="offerIdx" value="{{$product->offerIdx}}">
								<input type="hidden" id="productIdx" name="productIdx" value="{{$product->productIdx}}">
								<input type="hidden" id="productPrice" name="productPrice" value="{{$finalPrice}}">
								<input type="hidden" id="bidIdx" name="bidIdx" value="{{$bidIdx}}">
								<label class="pure-material-textfield-outlined">
			                        <input type="text" id="firstname" name="firstname" class="form-control input_data @error('firstname')  is-invalid @enderror" placeholder=" "  value="{{ old('firstname', $buyer->firstname) }}" autocomplete="firstname" autofocus>
			                        <span>{{ trans('data.first_name') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'First Name']) }}</div>
		                            <span class="invalid-feedback firstname" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="lastname" name="lastname" class="form-control input_data @error('lastname')  is-invalid @enderror" placeholder=" "  value="{{ old('lastname', $buyer->lastname) }}" autocomplete="lastname" autofocus>
			                        <span>{{ trans('data.last_name') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last Name']) }}</div>
		                            <span class="invalid-feedback lastname" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" "  value="{{ old('email', $buyer->email) }}" autocomplete="email" autofocus>
			                        <span>{{ trans('data.email_address') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email Address']) }}</div>
		                            <span class="invalid-feedback email" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                </div>
		                    <div class="mt-10">
								<p class="para text-bold">{{trans("data.billing_information")}}</p>
								<label class="pure-material-textfield-outlined">
			                        <input type="text" id="companyName" name="companyName" class="form-control input_data @error('companyName')  is-invalid @enderror" placeholder=" "  value="{{ old('companyName', $buyer->companyName) }}" autocomplete="companyName" autofocus>
			                        <span>{{ trans('data.company_name') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Company Name']) }}</div>
		                            <span class="invalid-feedback companyName" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="companyVAT" name="companyVAT" class="form-control input_data @error('companyVAT')  is-invalid @enderror" placeholder=" "  value="{{ old('companyVAT', $buyer->companyVAT) }}" autocomplete="companyVAT" autofocus>
			                        <span>{{ trans('data.vat_number') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'VAT number']) }}</div>
		                            <span class="invalid-feedback companyVAT" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="address" name="address" class="form-control input_data @error('address')  is-invalid @enderror" placeholder=" "  value="{{ old('address', $buyer->address?$buyer->address:'') }}" autocomplete="address" autofocus>
			                        <span>{{ trans('data.address') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Address']) }}</div>
		                            <span class="invalid-feedback address" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="city" name="city" class="form-control input_data @error('city')  is-invalid @enderror" placeholder=" "  value="{{ old('city', $buyer->city?$buyer->city:'') }}" autocomplete="city" autofocus>
			                        <span>{{ trans('data.city') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'City']) }}</div>
			                            <span class="invalid-feedback city" role="alert">
			                                <strong></strong>
			                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="postal_code" name="postal_code" class="form-control input_data @error('postal_code')  is-invalid @enderror" placeholder=" "  value="{{ old('postal_code', $buyer->postal_code?$buyer->postal_code:'') }}" autocomplete="postal_code" autofocus>
			                        <span>{{ trans('data.postal_code') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Postal code']) }}</div>
		                            <span class="invalid-feedback postal_code" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <label class="pure-material-textfield-outlined">
			                        <input type="text" id="state" name="state" class="form-control input_data @error('state')  is-invalid @enderror" placeholder=" "  value="{{ old('state', $buyer->state?$buyer->state:'') }}" autocomplete="state" autofocus>
			                        <span>{{ trans('data.state_optional') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'state']) }}</div>
			                    </label>
			                    <div class="dropdown-container">
			                        <div class="dropdown2 region_list" tabindex="1">                                
			                            <div class="adv-combo-wrapper">
			                                <select id="regionIdx" class="@error('regionIdx') is-invalid @enderror" name="regionIdx" placeholder="Country">
			                                    <option></option>
			                                    @foreach ($countries as $country)
			                                        @if( $country->regionIdx == old('regionIdx') )
			                                        <option value="{{$country->regionIdx}}" selected>{{ $country->regionName }}</option>
			                                        @elseif( $country->regionIdx == $buyer->regionIdx )
			                                        <option value="{{$country->regionIdx}}" selected>{{ $country->regionName }}</option>
			                                        @else
			                                        <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
			                                        @endif
			                                    @endforeach
			                                </select>
		                                    <span class="invalid-feedback regionIdx" role="alert">
		                                        <strong></strong>
		                                    </span>
			                            </div>                              
			                        </div>
			                    </div>
			                </div>
		                    <div class="mt-10">
								<p class="para text-bold">{{trans("data.payment_method")}}</p>
								<label class="pure-material-textfield-outlined">
			                        <input type="text" id="card_number" name="card_number" class="form-control input_data @error('card_number')  is-invalid @enderror" placeholder=" "  value="{{ old('card_number') }}" maxlength="16" autocomplete="card_number" autofocus>
			                        <span>{{ trans('data.card_number') }}</span>
			                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Card number']) }}</div>
		                            <span class="invalid-feedback card_number" role="alert">
		                                <strong></strong>
		                            </span>
			                    </label>
			                    <div class="flex-row align-items-center">
			                    	<div class="dropdown-container mr-10">
				                        <div class="dropdown2" tabindex="1">                                
				                            <div class="adv-combo-wrapper">
				                                <select id="exp_month" class="@error('exp_month') is-invalid @enderror" name="exp_month" placeholder="{{trans('data.expiry_month')}}">
				                                    <option></option>
				                                    @for($i=1; $i<=12; $i++)
				                                    	@if(old('exp_month')==$i)
				                                    <option value="{{$i}}" selected>{{$i}}</option>
				                                    	@else
				                                    <option value="{{$i}}">{{$i}}</option>
				                                    	@endif
				                                    @endfor
				                                </select>
			                                    <span class="invalid-feedback exp_month" role="alert">
			                                        <strong></strong>
			                                    </span>
				                            </div>                              
				                        </div>
				                    </div>
				                    <div class="dropdown-container mr-10">
				                        <div class="dropdown2" tabindex="1">                                
				                            <div class="adv-combo-wrapper">
				                                <select id="exp_year" class="@error('exp_year') is-invalid @enderror" name="exp_year" placeholder="{{trans('data.expiry_year')}}">
				                                    <option></option>
				                                    @for($i=date('Y')+10; $i>=1970; $i--)
				                                    	@if(old('exp_year')==$i)
				                                    <option value="{{$i}}" selected>{{$i}}</option>
				                                    	@else
				                                    <option value="{{$i}}">{{$i}}</option>
				                                    	@endif
				                                    @endfor
				                                </select>
			                                    <span class="invalid-feedback exp_year" role="alert">
			                                        <strong></strong>
			                                    </span>
				                            </div>                              
				                        </div>
				                    </div>
									<label class="pure-material-textfield-outlined">
				                        <input type="text" id="cvc" name="cvc" class="form-control input_data @error('cvc')  is-invalid @enderror" placeholder=" "  value="{{ old('cvc') }}" autocomplete="cvc" autofocus maxlength="4">
				                        <span>{{ trans('data.cvc') }}</span>
				                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'CVC card']) }}</div>
			                            <span class="invalid-feedback cvc" role="alert">
			                                <strong></strong>
			                            </span>
				                    </label>
			                    </div>
							</div>
		                    <p class="error hide">
		                    	<span class="text-red text-bold alert"></span>
		                    </p>
							<div class="buttons flex-vcenter">
								<button type="submit" class="customize-btn">{{ trans('data.pay') }}</button>
							</div>
						</div>
						<div class="col-6 flex-column align-items-center">
							<div class="ml-20">
								<p class="fs-24 para text-bold">{{trans("data.order_summary")}}</p>
								<div class="mt-20">
			        				<p class="para text-bold mb-0">{{$product->productTitle}}</p>
			        				<p class="para fs-16">
										@foreach($product->region as $region)
	            							<span>{{ $region->regionName }}</span>
	            						@endforeach
	            					</p>
			        			</div>
			        			<div class="mt-20">
			        				<p class="para text-red">€ {{$product->productPrice}}</p>
									<p class="para">
						        		<span class="text-grey">{{ trans('data.access_to_this_data') }}: </span>
						        		<span>1 {{$product->productAccessDays}}</span>
						        	</p>
						        	<p class="para">
						        		<span class="text-grey">{{ trans('data.format') }}: </span>
						        		<span>{{$product->productType}}</span>
						        	</p>
			        			</div>
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
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src='https://js.stripe.com/v1/' type='text/javascript'></script>
@endsection