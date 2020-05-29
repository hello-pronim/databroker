@extends('layouts.app')

@section('title', 'Data offers from '. $company->companyName .' | Databroker')

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
	        			<h4 class="text-green">{{ trans('pages.explore_data_offer_from') }}</h4>
			            <h1 class="mt-0">{{$company->companyName}}</h1>
			        </div>    
			    </div>        	
	        </div>	        
	        <div class="app-monetize-section-item0 ml-0 mt-20"></div>        
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
							@php
								$companyName = strtolower($offer['companyName']);
								$title = str_replace(' ', '-', strtolower($offer['offerTitle']) );
								$region = "";	
								foreach($offer['region'] as $key=>$r){
									$region = $region . str_replace(' ', '-', strtolower($r->regionName));
									if($key+1 < count($offer['region'])) $region = $region . "-";
								}
							@endphp
							<a href="{{route('data_details', ['companyName'=>$companyName, 'param'=>$title . '-' . $region])}}">							
								@if( file_exists( public_path() . $offer['offerImage']) && $offer['offerImage'] )
								<img class="img" src="{{ asset( $offer['offerImage'] ) }}" />
								@else
								<img class="img" src="{{ asset('uploads/offer/tiny/default.png') }}" />
								@endif
							</a>
						</div>
						<div class="card-body text-left">
							<h4 class="offer-title card-title">{{$offer['offerTitle']}}</h4>
							<h6 class="offer-location card-category">
								@foreach($offer['region'] as $region)
				            		<span>{{ $region->regionName }}</span>
				            	@endforeach
				            </h6>			     
							<a href="{{route('data.company_offers', ['companyName'=>str_replace(' ', '-', strtolower($offer['companyName']))])}}">
								@if( file_exists( public_path() . '/uploads/company/thumb/'.$offer['provider']->companyLogo) && $offer['provider']->companyLogo )
								<img class="img" src="{{ asset('uploads/company/thumb/'.$offer['provider']->companyLogo) }}" />
								@else
								<img class="img" src="{{ asset('uploads/company/thumb/default.png') }}" />
								@endif
							</a>
						</div>
					</div>	
				</div>						
					@if( $index == $makematching )
					<div class="col-md-4 makematching mb-20">
						<div>
							<div class="card card-profile card-plain mb-0">
								<div class="card-body pd-15">
									<div class="app-monetize-section-item0 mb-40"></div>
									<p class="fs-18">Can't find the data you need?</p>
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
  		<div class="text-center @if ( $totalcount <= $per_page ) hide @endif"><button id="offer_loadmore" type="button" class="button secondary-btn mgh25 w225">Load More</button></div>
    </div>      
</div>

@endsection

@section('additional_javascript')
	<script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection
