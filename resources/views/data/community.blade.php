@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">	
    <div class="container">
    	<div class="row">
	    	<div class="col-md-12">	    		
				<div class="card card-raised card-background" style="background-image: url({{ asset('images/communities/'.str_replace( ' ', '_', $community).'/hero.jpg') }})">
					<div class="hero_overlay_bg"></div>
					<div class="card-body">						
						<h3 class="card-title fs-40">{{ $community }}</h3>
						<p class="text-white fs-18">
							{{ trans('description.'.str_replace( ' ', '_', $community).'_intro') }}
						</p>
						<a href="{{ route('data_community.'.str_replace( ' ', '_', strtolower($community))) }}" class="btn btn-round readmore mt-30">
							{{ trans('pages.view_dataoffer') }}
						</a>										
					</div>
				</div>
			</div>
	    </div>   
	    <div class="row">
	    	@foreach( $themes as $theme )
	    	<div class="col-md-4 mt-20">
	    		<h4 class="text-green fs-20 text-bold">{{ $theme->themeName }}</h4>
	    		<p class="fs-18">
	    			{{ $theme->themeText }}
	    		</p>
	    	</div>
	    	@endforeach	    	
	    </div> 	
	    <div class="mt-40 text-center">		        	
        	<a href="{{ route('data_community.'.str_replace( ' ', '_', strtolower($community))) }}" ><button type="button" class="btn btn-round sendmessage-btn">{{ trans('pages.view_dataoffer') }}</button></a>
        </div>

        <h1 class="mt-80 mb-20 fs-30 text-bold text-left"> {{trans('pages.discover_improve_business', ['community' => strtolower($community)])}} </h1>
		<div class="row">			
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/usecase2.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title text-bold text-green">Transport</h4>
						<p class="card-description text-bold">Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.
						</p>						
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/usecase3.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title text-bold text-green">People</h4>
						<p class="card-description text-bold">Achieve your full potential with retail location planning
						</p>						
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/usecase1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">						
						<h4 class="card-title text-bold text-green">Agriculture</h4>
						<p class="card-description text-bold">Increased safety thanks to the connected cars. Discover now how data exchanges can help saving lives and preventing accidents.
						</p>
					</div>			
				</div>	
			</div>	
  		</div>  
    </div>      
</div>

<div class="container-fluid app-wapper">
	<div class="section_splitor"></div>    
    <div style="background: url({{ asset('images/patterns/background_01.png') }});background-position: right;background-repeat: no-repeat;background-size: contain;">
        <div style="background: url({{ asset('images/patterns/background_02.png') }});background-position: left;background-repeat: no-repeat;background-size: contain;">
            <div class="app-section app-peek-section align-items-center">
                <div class="app-monetize-section-item0"></div>
                <h1 class="fs-30" style="margin-bottom: 10px;">{{ trans('pages.what_business_challenge') }}</h1>
                <p class="center">
                    {{ trans('pages.tell_us_data_partner')}}
                    <span class="height-space" style="display: block;"></span>
                    <a href="/newsletter">
                        <button style="width: 270px;" type="button" class="btn match-me-up-btn pure-material-button-outlined">TRY OUR DATAMATCH SERVICE</button>
                    </a>                     
                </p> 
                <p class="text-free text-grey">It's free</p>               
            </div>
        </div>
    </div>
    <div class="section_splitor"></div>    
</div>

<div class="container-fluid app-wapper">	
	<div class="container">
		<h1 class="mt-80 mb-20 fs-30 text-bold text-left"> {{ trans('home.team_picks') }} </h1>
		<div class="row">
			@foreach($offers as $offer)		
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/blog1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="offer-title card-title">{{$offer['offerTitle']}}</h4>
						<h6 class="card-category offer-location">
							@foreach($offer['region'] as $region)
			            		<span>{{ $region->regionName }}</span>
			            	@endforeach</h6>
						<a href="{{ $offer['provider']->companyURL }}"><img class="img" src="{{ asset('uploads/company/'.$offer['provider']->companyLogo) }}" /></a>
					</div>			
				</div>	
			</div>
			@endforeach
  		</div>

	    <div class="app-section app-monetize-section align-items-center">
	        <div class="app-monetize-section-item0"></div>
	        <div class="app-monetize-section-item1">
	            <h1 class="fs-30"> {{ trans('home.featured_data_providers') }} </h1>
	            <p>Check out their data offers!</p>
	        </div>
	    </div>
	    <div class="app-partner-items row">
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/partner_1.png') }}">
	                </div>        
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/partner_2.png') }}">
	                </div>        
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/partner_3.png') }}">
	                </div>        
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/partner_4.png') }}">
	                </div>        
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/partner_5.png') }}">
	                </div>        
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item">
					<div class="img">
						<img src="{{ asset('images/europense.png') }}">
	                </div>        
        		</div>
        	</div>
        </div> 

        <h1 class="mt-80 mb-20 fs-30 text-bold text-left"> New In The {{$community}} Community </h1>
		<div class="row">
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/blog1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/blogs/marketplace1.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/blog2.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/blogs/marketplace2.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/blogs/blog3.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/blogs/marketplace3.png') }}" />
					</div>			
				</div>	
			</div>				
  		</div>   
  		<div class="mt-40 text-center">		        	
        	<a href="{{ route('data_community.'.str_replace( ' ', '_', strtolower($community))) }}" ><button type="button" class="btn btn-round sendmessage-btn">View Data Offer</button></a>
        </div>
    </div>    
</div>  

@endsection

