@extends('layouts.app')

@section('additional_css')	
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper">	
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center pb-10">    		
	        <div class="cat-header">
	        	<div class="row">
	        		<div class="col-lg-12">
	        			<h4 class="text-green">{{ trans('pages.explore_data_offer') }}</h4>
			            <h1 class="mt-0">{{$category}} Community <span class="region"></span></h1>
			        </div>    
			    </div>
			    <div class="row">
			    	<div class="col-lg-6">
			            <p class="desc mt-10">
			            	{{ trans('description.'.str_replace( ' ', '_', $category ).'_intro') }}
			            </p>	            
			            <a href="{{ route('data.community_'.str_replace( ' ', '_', strtolower($category) )) }}"><button type="button" class="button secondary-btn w225 mgh25">{{ trans('pages.read_more') }}</button></a>
	        		</div>	
	        	</div>	        	
	        </div>	        
	        <div class="app-monetize-section-item0 ml-0 mt-20"></div>
	        <div class="cat-body">
	        	<div class="row community-filter">
	        		@csrf    		
	        		<div class="col-xl-4 col col-lg-8 mb-20 community">
	        			<label class="cat-label">{{ trans('pages.explore') }}</label>	        	
	                    <div class="adv-combo-wrapper custom-select2 cat-select">
		                    <select id="community" data-placeholder="{{ trans('pages.select_by_community') }}" class="no-search">
		                    	<option value="all">All Communities</option>
		                    	@foreach ($communities as $community)
	                                <option value="{{$community->communityIdx}}" community-name="{{ $community->communityName }}">The {{ $community->communityName }} community</option>
	                            @endforeach
		                    </select>	                        
		                </div>
	        		</div>	        		
	        		<div class="col-xl-4 col-lg-6 mb-20 theme">
	        			<label class="cat-label">{{ trans('pages.for_data_about') }}</label>	        		
	                    <div class="adv-combo-wrapper custom-select2 cat-select">
		                    <select id="theme" data-placeholder="{{ trans('pages.all_themes') }}" class="no-search">
		                    	<option value="all">All themes</option>
		                    	@foreach ($themes as $theme)
	                                <option value="{{$theme->themeIdx}}" community-id="{{ $theme->communityIdx }}">{{ $theme->themeName }}</option>
	                            @endforeach
		                    </select>	                        
		                </div>
	        		</div>
	        		<div class="col-xl-4 col-lg-6 mb-20 region">
	        			<label class="cat-label">{{ trans('pages.in') }}</label>
	        			<div class="custom-dropdown-container cat-select">
	                        <div id="region" class="custom-dropdown" tabindex="1">
	                        	<input type="hidden" name="region" value="">
	                            <div class="select">
	                                <span>Select Region</span>
	                            </div>
	                            <ul class="custom-dropdown-menu region-select mt-10" style="display: none;">
				                    <div class="adv-combo-wrapper custom-select2">
					                    <select data-placeholder="{{ trans('pages.search_by_country') }}">
					                    	<option></option>
					                    	@foreach ($countries as $country)
				                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
				                            @endforeach
					                    </select>	                        
					                </div>
	                            	<h5>Or {{ trans('pages.select_region') }}:</h5>
	                            	<span class="region" region-id="all">{{ trans('pages.all_regions') }}</span>
	                            	@foreach ($regions as $region)
					                    <span class="region" region-id="{{$region->regionIdx}}">{{$region->regionName}}</span>
					                @endforeach					                
	                            </ul>
	                        </div>	                        
	                    </div>  
	        		</div>
	        	</div>
	        </div>	        
    	</div>		    
    	<h1 id="offer-count" class="mb-20 fs-30 text-bold text-left"> Explore <span>{{ count($dataoffer) }}</span> data offers </h1>   
    	<div id="offer-list">
			<div class="row">
				@php
					$makematching = rand(0, count($dataoffer)-1);					
				@endphp
				@foreach ( $dataoffer as $index => $offer )
				<div class="col-md-4 mb-20">
					<div class="card card-profile card-plain mb-0">					
						<div class="card-header">
							<a href="/data/{{ $offer['offerIdx'] }}">
								<img class="img" src="{{ asset('uploads/offer/'.$offer['offerImage']) }}" />
							</a>
						</div>
						<div class="card-body text-left">
							<h4 class="offer-title card-title">{{$offer['offerTitle']}}</h4>
							<h6 class="offer-location card-category">
								@foreach($offer['region'] as $region)
				            		<span>{{ $region->regionName }}</span>
				            	@endforeach
				            </h6>			            
							<a href="{{ $offer['provider']->companyURL }}"><img class="img" src="{{ asset('uploads/company/'.$offer['provider']->companyLogo) }}" /></a>
						</div>
					</div>	
				</div>						
					@if( $index == $makematching )
					<div class="col-md-4 makematching mb-20">
						<div>
							<div class="card card-profile card-plain mb-0">
								<div class="card-body pd-15">
									<div class="app-monetize-section-item0 mb-40"></div>
									<p class="fs-18">Can’t find the data you need?</p>
									<p class="fs-21 text-bold mb-40">Let our tailor-made DataMatch service find the perfect data partner for you!</p>
									<a href="{{route('about.matchmaking')}}"><button type="button" class="button customize-btn mgh25 w225">MATCH ME UP</button></a>
									<p>It’s free!</p>
								</div>
							</div>	
						</div>						
					</div>	
					@endif
				@endforeach							
	  		</div>
  		</div> 	  		
  		<input type="hidden" name="totalcount" value="{{ $totalcount }}">  		
  		<input type="hidden" name="per_page" value="{{ $per_page }}">
  		<div class="text-center @if ( $totalcount < $per_page ) hide @endif"><button id="offer_loadmore" type="button" class="button secondary-btn mgh25 w225">Load More</button></div>
    </div>      
</div>

@endsection

@section('additional_javascript')
	<script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection
