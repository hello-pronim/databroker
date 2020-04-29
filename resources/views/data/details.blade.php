@extends('layouts.app')

@section('title')
{{ $offer['offerTitle']." | Databroker" }}
@stop
@section('description', 'Looking for data to help you make insight-driven business decisions? Explore our marketplace and get easy access to a world of data.')


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
		            		<a href="{{route('data.offer_theme_filter', ['community'=>str_replace( ' ', '_', strtolower($offer['community']->communityName)), 'theme'=>$theme->themeIdx])}}"><span>{{ $theme->themeName }}</span></a>
		            	@endforeach
	            	</label>
	            </p>
	        </div>	        
	        <div class="blog-content">
	        	<div class="row">
	        		<div class="col-lg-8">
	        			@if( file_exists(public_path() . '/'. $offer['offerImage'] ) && $offer['offerImage'] )
	        			<img class="blog-img" src="{{ asset($offer['offerImage']) }}" />
	        		    @else
	        		    <img class="blog-img" src="{{ asset('uploads/offer/default.png') }}" />
	        		    @endif  	
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
							<p class="mobile-scrolling" id="description"></p>
				            <div class="link-box" id="description">
				            	<h2>{{ trans('pages.description') }}</h2>
				                <p>{!! nl2br($offer['offerDescription']) !!}</p>
				                <div class="region">
				                	<label>{{ trans('pages.region') }}: </label> 
				                	<span>
				                		@foreach($offer['region'] as $region)
						            		<a href="{{route('data.offer_region_filter', ['community'=>str_replace( ' ', '_', strtolower($offer['community']->communityName)), 'regionIdx'=>$region->regionIdx])}}">{{ $region->regionName }}</a>
						            	@endforeach
				                	</span>
				                </div>
				            </div>
				            @endif
							@if( $offer['usecase'] )
							<p class="mobile-scrolling" id="use_cases"></p>
				            <div class="link-box" id="use_cases">
				                <h2>{{ trans('pages.use_case') }}</h2>
				                @if( $offer['usecase'] )
				                <p>{!! nl2br($offer['usecase']->useCaseContent) !!}</p>
				                @endif
				            </div>
				            @endif
							@if( sizeof($offersample)>0 )
							<p class="mobile-scrolling" id="samples"></p>
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
				                			@if( file_exists(public_path() . '/uploads/offersample/'.$sample['sampleFileName']) && $sample['sampleFileName'] )	
					                		<img src="{{ asset('uploads/offersample/'.$sample['sampleFileName']) }}">
					                		@else
					                		<img class="img" src="{{ asset('uploads/default.png') }}" />
					                		@endif
					                		<p>{{$sample['sampleDescription']}}</p>
				                		</div>
				                	@endif				                	
				                @endforeach				               
				            </div>
				            @endif
							@if( sizeof($products ) > 0 )
							<p class="mobile-scrolling" id="this_data"></p>
				            <div class="link-box" id="this_data">
				                <h2>Buy data</h2>
				                <p>If the data provider has already defined data products that can be purchased directly, you’ll find these below. When you buy a data product, you’ll receive an email link to access or download the data. 

								This link will also be available in the Purchases section of your account. 

								If you don’t see the data you need below, you can contact the data provider directly to request specific data.
								</p>

				                <div class="buy_lists">
				                	@foreach($products as $product)
				                	<div class="buy_list">				                		
				                		<div class="row">
				                			<div class="col col-8">
					                			<div class="text-left">
						                			<h3>{{$product->productTitle}}</h3>	
						                			<label class="country offer-location">
						                				@foreach($product['region'] as $region)
					            							<span>{{ $region->regionName }}</span>
					            						@endforeach
					            					</label>
						                			<p><label class="text-grey">{{ trans('pages.format') }} : </label> <span>{{ $product->productType }}</span></p>
						                			@if($product->productMoreInfo)
						                			<a href="javascript:;" id="more_info" class="dropdown-toggle" data-toggle="dropdown" aaria-haspopup="true" aria-expanded="false">More Info</a>
						                			<div class="dropdown-menu more_info" aria-labelledby="more_info">
						                				<p class="pd-15">{{ $product->productMoreInfo }}</p>
						                			</div>
						                			@endif
						                		</div>
						                	</div>
						                	<div class="col col-4">
						                		<div class="text-right">
						                			@if($product->productBidType=="bidding_only")
						                			<p class="price">Make your best bid</p>
						                			@elseif($product->productBidType=="free")
						                			<p class="price">FREE</p>
						                			@else
						                			<p class="price"><span class="currency">€</span>{{ $product->productPrice }} <span class="color-black">(tax incl.)</span></p>
						                			@endif

						                			<p class="expiry"><label>{{ trans('pages.access_to_data') }} : </label> <span>1 {{ $product->productAccessDays }}</span></p>
						                		</div>	
						                	</div>
				                		</div>	 
			                			<div class="product_actions">
				                			@if($product->productBidType == 'no_bidding')
				                			<a href="{{route('data.buy_data', ['id'=>$id, 'pid'=>$product->productIdx])}}">
				                				<button type="button" class="customize-btn my-0">BUY NOW</button>
				                			</a>
				                			@elseif($product->productBidType == 'bidding_only')
				                			<a href="{{route('data.bid', ['id'=>$id, 'pid'=>$product->productIdx])}}">
				                				<button type="button" class="customize-btn my-0">SEND BID</button>
				                			</a>
				                			@elseif($product->productBidType == 'bidding_possible')
				                			<a href="{{route('data.bid', ['id'=>$id, 'pid'=>$product->productIdx])}}">
				                				<button type="button" class="customize-btn my-0">SEND BID</button>
				                			</a>
				                			<a href="{{route('data.buy_data', ['id'=>$id, 'pid'=>$product->productIdx])}}">
				                				<button type="button" class="customize-btn my-0">BUY NOW</button>
				                			</a>
				                			<br>
				                			@elseif($product->productBidType == 'free')
				                			<a href="{{route('data.get_data', ['id'=>$id, 'pid'=>$product->productIdx])}}">
				                				<button type="button" class="customize-btn my-0">GET DATA</button>
				                			</a>
			                				@endif
			                			</div>			                		
				                	</div>
				                	@endforeach				                	

				                	<div class="row">
				                		<div class="cta_box col-12">
						        			<h3 class="text-bold">Questions about this data? </h3>
											<p class="fs-18">Or want to request specific data from this provider?</p>
						        			<a href="{{route('data.send_message', ['id'=> $offer['offerIdx']])}}">
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
	        			@if(preg_match("@^https?://@", $offer['provider']->companyURL))
	        			<label class="author"><a target="_blank" href="{{ $offer['provider']->companyURL }}">{{ $offer['provider']->companyURL }}</a></label>
	        			@else
	        			<label class="author"><a target="_blank" href="https://{{ $offer['provider']->companyURL }}">{{ $offer['provider']->companyURL }}</a></label>
	        			@endif
	        			<div class="author_avatar">	        				
	        				@if( file_exists( public_path() . '/uploads/company/'.$offer['provider']->companyLogo) && $offer['provider']->companyLogo )
	        				<img src="{{ asset('uploads/company/'.$offer['provider']->companyLogo) }}">
	        				@else
	        				<img class="img" src="{{ asset('uploads/company/default.png') }}" />
	        				@endif
	        			</div>	        			
	        			<p class="short-desc">
	        				{!! trans('pages.contact_data_provider') !!}
	        			</p>
	        			<a href="{{route('data.send_message', ['id'=> $offer['offerIdx']])}}">
	        				<button  type="button" class="secondary-btn mgh25">CONTACT THE DATA PROVIDER</button>
	        			</a><br/>
	        			<a href="{{route('data.company_offers', ['companyIdx'=>$user_info->companyIdx])}}">
	        				View more data from {{ $offer['provider']->companyName }}
	        			</a>
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

