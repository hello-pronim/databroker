@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">    	
    	<div class="app-section app-reveal-section align-items-center data-detail">     		
    		@if($prev_route)
    		<a href="{{ route($prev_route) }}" class="back-icon text-grey"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
    		@endif
	        <div class="blog-header">
	            <h1>{{ $offer['offerTitle'] }}</h1>	            
	            <p class="area">
	            	@foreach($offer['region'] as $region)
	            		<span>{{ $region->regionName }}</span>
	            	@endforeach
	            </p>
	            <p class="category"> Published in : <a href="{{ route('data_community.'.str_replace( ' ', '_', strtolower($offer['community']->communityName) )) }}" >{{ $offer['community']->communityName }}</a>
	            	<label>
		            	<span>asdssdfsf</span><span>ffeeesss</span>
		            	@foreach($offer['theme'] as $theme)
		            		<span>{{ $theme->themeName }}</span>
		            	@endforeach
	            	</label>
	            </p>
	        </div>	        
	        <div class="blog-content">
	        	<div class="row">
	        		<div class="col-lg-8">
	        			<img class="blog-img" src="{{ asset('uploads/offer/'.$offer['offerImage']) }}" />
	        		      	
			            <div class="nav-tabs-wrapper mt-30">
			                <ul class="nav nav-tabs" data-tabs="tabs">
			                	@if( $offer['offerDescription'] )
			                    <li class="nav-item">
			                        <a class="nav-link active" href="#description" data-toggle="tab">{{ trans('pages.description') }}</a>
			                    </li>
			                    @endif
			                    @if( $offer['usecase'] )
			                    <li class="nav-item">
			                        <a class="nav-link" href="#use_cases" data-toggle="tab">{{ trans('pages.use_case') }}</a>
			                    </li>
			                    @endif
			                    @if( $offer['samples'] )
			                    <li class="nav-item">
			                        <a class="nav-link" href="#samples" data-toggle="tab">{{ trans('pages.samples') }}</a>
			                    </li>
			                    @endif			                    
			                    <li class="nav-item">
			                        <a class="nav-link" href="#this_data" data-toggle="tab">{{ trans('pages.buy_this_data') }}</a>
			                    </li>
			                </ul>
			            </div>				        
				        <div class="tab-content">
				        	@if( $offer['offerDescription'] )
				            <div class="tab-pane" id="description">
				            	<h2>{{ trans('pages.description') }}</h2>
				                <p>{{ $offer['offerDescription'] }}</p>
				                <div class="region">
				                	<label>{{ trans('pages.region') }}: </label> 
				                	<span>
				                		@foreach($offer['region'] as $region)
						            		<span>{{ $region->regionName }}</span>
						            	@endforeach
				                	</span>
				                </div>
				            </div>
				            @endif
			                @if( $offer['usecase'] )
				            <div class="tab-pane" id="use_cases">
				                <h2>{{ trans('pages.use_case') }}</h2>
				                @if( $offer['usecase'] )
				                <p>{{ $offer['usecase']->useCaseContent }}</p>
				                @endif
				            </div>
				            @endif
			                @if( $offer['samples'] )
				            <div class="tab-pane" id="samples">
				                <h2>{{ trans('pages.samples') }}</h2>
				                @if( $offersample )
					                @foreach($offersample as $sample)
					                	@if( explode("-", $sample['sampleType'])[0] == 'file')
					                	<div class="file">
					                		<p>{{$sample['sampleDescription']}}</p>
					                		<a class="download" href="{{ asset('uploads/offersample/'.$sample['sampleFileName']) }}"><i class="material-icons">get_app</i><span>{{$sample['sampleFileName']}}</span></a>
					                	</div>	
					                	@endif				                	
					                	@if( explode("-", $sample['sampleType'])[0] == 'image')				                	
					                		<div class="image">					                		
						                		<img src="{{ asset('uploads/offersample/'.$sample['sampleFileName']) }}">
						                		<p>{{$sample['sampleDescription']}}</p>
					                		</div>
					                	@endif				                	
					                @endforeach
				                @endif	
				            </div>
				            @endif
				            <div class="tab-pane" id="this_data">
				                <h2>Buy data</h2>
				                <p>You can buy the data products already prepared by the data provider, or request the data provider to prepare the specific dataset you need. When you buy data, a link to access or download the data will be offered to you via email. You can also access this link via the purchases-section in your account.</p>

				                <div class="buy_lists">
				                	<div class="buy_list">
				                		<div class="row">
				                			<div class="col-md-6">
					                			<h3>Satellite imagery of buildings and roads</h3>	
					                			<label class="country">Belgium</label>
					                			<p><label class="text-grey">{{ trans('pages.format') }} : </label> <span>Stream</span></p>
					                			<a href="javascript:;">More Info <i class="material-icons">arrow_drop_down</i></a>
					                		</div>
					                		<div class="col-md-6 text-right">
					                			<p class="price">$500</p>
					                			<p class="expiry"><label>{{ trans('pages.access_to_data') }} : </label> <span>1 year</span></p>
					                			<a href="/data/buy_data">
					                				<button type="button" class="customize-btn">Buy Now</button>
					                			</a>
					                		</div>	
				                		</div>				                		
				                	</div>
				                	<div class="buy_list">
				                		<div class="row">
				                			<div class="col-md-6">
					                			<h3>Satellite imagery of buildings and roads</h3>	
					                			<label class="country">Belgium</label>
					                			<p><label class="text-grey">{{ trans('pages.format') }} : </label> <span>Stream</span></p>
					                			<a href="javascript:;">More Info <i class="material-icons">get_app</i></a>
					                		</div>
					                		<div class="col-md-6 text-right">
					                			<p class="price">$500</p>
					                			<p class="expiry"><label>{{ trans('pages.access_to_data') }} : </label> <span>1 year</span></p>
					                			<a href="/data/send_bid">
					                				<button type="button" class="customize-btn">Send a bid to the seller</button>
					                			</a>
					                			<a href="/data/buy_data">
					                				<button type="button" class="customize-btn">Buy Now</button>
					                			</a>
					                		</div>	
				                		</div>				                		
				                	</div>
				                	<div class="buy_list">
				                		<div class="row">
				                			<div class="col-md-6">
					                			<h3>Satellite imagery of buildings and roads</h3>	
					                			<label class="country">Belgium</label>
					                			<p><label class="text-grey">{{ trans('pages.format') }} : </label> <span>Stream</span></p>
					                			<a href="javascript:;">More Info <i class="material-icons">get_app</i></a>
					                		</div>
					                		<div class="col-md-6 text-right">
					                			<p class="price">$500</p>
					                			<p class="expiry"><label>{{ trans('pages.access_to_data') }} : </label> <span>1 year</span></p>
					                			<a href="/data/buy_data">
					                				<button type="button" class="customize-btn">Buy Now</button>
					                			</a>
					                		</div>	
				                		</div>				                		
				                	</div>	
				                </div>
				            </div>
				        </div>
	        		</div>

	        		<div class="col-lg-4">
	        			<h2 class="explain">Data provided by {{ $offer['provider']->companyName }}</h2>
	        			<h5 class="subcategory">{{$user_info['businessName']}} Service</h5>
	        			<label class="country">{{ $offer['provider']['region']->regionName }}</label>
	        			<label class="author"><a target="_blank" href="{{ $offer['provider']->companyURL }}">{{ $offer['provider']->companyURL }}</a></label>
	        			<div class="author_avatar">	        				
	        				@if($offer['provider']->companyLogo)
	        				<img src="{{ asset('uploads/company/'.$offer['provider']->companyLogo) }}">
	        				@endif
	        			</div>	        			
	        			<p class="short-desc">
	        				{!! trans('pages.contact_data_provider') !!}
	        			</p>
	        			<a href="/data/send_message"><button  type="button" class="btn btn-round sendmessage-btn">CONTACT THE DATA PROVIDER</button></a>
	        		</div>
	        	</div>
	        </div>
	    </div>	
	    @if($prev_route)
		<a href="{{ route($prev_route) }}" class="back-icon text-grey"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
		@endif	    
    </div>      
</div>

@endsection

