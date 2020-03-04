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
			                <ul class="nav nav-tabs">
			                	@if( $offer['offerDescription'] )
			                    <li class="nav-item">
			                        <a class="nav-link active" href="#description">{{ trans('pages.description') }}</a>
			                    </li>
			                    @endif
			                    @if( $offer['usecase'] )
			                    <li class="nav-item">
			                        <a class="nav-link" href="#use_cases">{{ trans('pages.use_case') }}</a>
			                    </li>
			                    @endif
			                    @if( sizeof($offersample) >0 )
			                    <li class="nav-item">
			                        <a class="nav-link" href="#samples">{{ trans('pages.samples') }}</a>
			                    </li>
			                    @endif				                    
			                    @if( sizeof($products ) > 0 )
			                    <li class="nav-item">
			                        <a class="nav-link" href="#this_data">{{ trans('pages.buy_this_data') }}</a>
			                    </li>
			                    @endif
			                </ul>
			            </div>				        
				        <div class="link-content">
				        	@if( $offer['offerDescription'] )
				            <div class="link-box" id="description">
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
				            <div class="link-box" id="use_cases">
				                <h2>{{ trans('pages.use_case') }}</h2>
				                @if( $offer['usecase'] )
				                <p>{{ $offer['usecase']->useCaseContent }}</p>
				                @endif
				            </div>
				            @endif
			                @if( sizeof($offersample)>0 )
				            <div class="link-box" id="samples">
				                <h2>{{ trans('pages.samples') }}</h2>				               
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
				            </div>
				            @endif
				            @if( sizeof($products ) > 0 )
				            <div class="link-box" id="this_data">
				                <h2>Buy data</h2>
				                <p>If the data provider has already defined data products that can be purchased directly, you’ll find these below. When you buy a data product, you’ll receive an email link to access or download the data. 

								This link will also be available in the Purchases section of your account. 

								If you don’t see the data you need below, you can contact the data provider directly to request specific data.
								</p>

				                <div class="buy_lists">
				                	@foreach($products as $product)
				                	<div class="buy_list">				                		
				                		<div class="flex-row justify-content-between">
				                			<div class="text-left">
					                			<h3>{{$product->productTitle}}</h3>	
					                			<label class="country offer-location">
					                				@foreach($product['region'] as $region)
				            							<span>{{ $region->regionName }}</span>
				            						@endforeach
				            					</label>
					                			<p><label class="text-grey">{{ trans('pages.format') }} : </label> <span>{{ $product->productType }}</span></p>
					                			<a href="javascript:;" id="more_info" class="dropdown-toggle" data-toggle="dropdown" aaria-haspopup="true" aria-expanded="false">More Info</a>
					                			@if($product->productMoreInfo)
					                			<div class="dropdown-menu more_info" aria-labelledby="more_info">
					                				<p class="pd-15">{{ $product->productMoreInfo }}</p>
					                			</div>
					                			@endif
					                		</div>
					                		<div class="text-right">
					                			@if($product->productPrice>0 && $product->productBidType != 'free')
					                			<p class="price"><span class="currency">€</span>{{ $product->productPrice }}</p>
					                			@else
					                			<p class="price">FREE</p>
					                			@endif

					                			<p class="expiry"><label>{{ trans('pages.access_to_data') }} : </label> <span>1 {{ $product->productAccessDays }}</span></p>
					                			<div class="flex-row align-items-center justify-content-end">
						                			@if($product->productBidType == 'no_bidding')
						                			<a href="/data/buy_data/{{ $id }}/{{$product->productIdx}}">
						                				<button type="button" class="customize-btn">Buy Now</button>
						                			</a>
						                			@elseif($product->productBidType == 'bidding_only')
						                			<a href="/data/send_bid/{{ $id }}/{{$product->productIdx}}">
						                				<button type="button" class="customize-btn">SEND BID</button>
						                			</a>
						                			@elseif($product->productBidType == 'bidding_possible')
						                			<a href="/data/send_bid/{{ $id }}/{{$product->productIdx}}">
						                				<button type="button" class="customize-btn">SEND BID</button>
						                			</a>
						                			<a href="/data/buy_data/{{ $id }}/{{$product->productIdx}}">
						                				<button type="button" class="customize-btn">Buy Now</button>
						                			</a>
						                			<br>
						                			@elseif($product->productBidType == 'free')
						                			<a href="javascript:;">
						                				<button type="button" class="customize-btn">GET DATA</button>
						                			</a>
					                				@endif
					                			</div>
					                		</div>	
				                		</div>				                		
				                	</div>
				                	@endforeach				                	

				                	<div class="row">
				                		<div class="cta_box col-12">
						        			<h3 class="text-bold">Questions about this data? </h3>
											<p class="fs-18">Or want to request specific data from this provider?</p>
						        			<a href="/data/send_message/{{ $offer['offerIdx'] }}/{{ $offer['provider']->providerIdx }}/{{ $offer['provider']->userIdx }}">
						        				<button type="button" class="secondary-btn mgh25">CONTACT THE DATA PROVIDER</button>
						        			</a>
						        		</div>
				                	</div>
				                </div>
				            </div>
				            @endif
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
	        			<a href="/data/send_message/{{ $offer['offerIdx'] }}/{{ $offer['provider']->providerIdx }}/{{ $offer['provider']->userIdx }}"><button  type="button" class="secondary-btn mgh25">CONTACT THE DATA PROVIDER</button></a>
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

