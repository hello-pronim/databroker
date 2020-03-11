@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper app-bids-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center">    		
	        <div class="blog-header">
	            <h1>Send a bid to {{$provider->companyName}}</h1>
	            <p class="para text-bold">{{$product->productTitle}}</p>
	            <p class="para">
	            	@foreach($product['region'] as $region)
	            		<span>{{$region->regionName}}</span>
	            	@endforeach
	            </p>
	        </div>
	        <div class="blog-content">
	        	<div class="para text-red">
	        	@if($product->productPrice)
	        		<span>€ {{$product->productPrice}}</span>
	        	@else
	        		<span>FREE</span>
	        	@endif
	        	</div>
	        	<div class="para">
	        		<span class="text-grey">{{ trans('data.access_to_this_data') }}: </span>
	        		<span>1 {{$product->productAccessDays}}</span>
	        	</div>
	        	<div class="para">
	        		<span class="text-grey">{{ trans('data.format') }}: </span>
	        		<span>{{$product->productType}}</span>
	        	</div>
	        	<div class="row mt-30">
	        		<div class="col-md-6 auth-section">
	        			<form method="POST" action="{{route('data.send_bid')}}">
                        	@csrf

		        			<label class="pure-material-textfield-outlined">
		                        <input type="text" id="bid" name="bid" class="form-control input_data @error('bid') is-invalid @enderror" placeholder=" "  value="{{ old('bid') }}" autocomplete="bid" autofocus>
		                        <span>{{ trans('data.your_bid') }}</span>
		                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Your bid']) }}</div>
		                        @error('bid')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
		                    </label>
		                    <label class="pure-material-textfield-outlined">
								<textarea name="message" class="form-control input_data user-message @error('message') is-invalid @enderror" placeholder="{{ trans('data.add_message_optional') }}" maxlength="100" autofocus>{{ old('message')}}</textarea>
								<div class="error_notice">{{ trans('validation.required', ['attribute' => 'Message']) }}</div>
		                        @error('message')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
							</label>
							<div class="form-group mb-0">                                
		                        <button type="submit" class="customize-btn">{{ trans('data.send_a_bid') }}</button>
		                    </div>
						</form>
	        		</div>
	        		<div class="col-md-6">
	        			<div class="pl-30">
		        			<p class="para text-bold">How it works</p>
		        			<ul class="custom-list">
		        				<li>Only the company will receive y our bid. It will not be published on the platform.</li>
		        				<li>Your name and company will be visible for them.</li>
		        				<li>You will receive an email when they respond to the bid.</li>
		        				<li>You can follow up on your bids in account.</li>
		        				<li>A bid is not binding. The data provider can... You can...</li>
		        			</ul>
		        		</div>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
</div>
@endsection	
