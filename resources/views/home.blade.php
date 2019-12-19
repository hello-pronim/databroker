@extends('layouts.app')


@section('content')
<div class="container-fluid app-wapper">	
    <div class="top-bg-image"></div>
    <div class="app-section app-reveal-section align-items-center">
        <div class="app-reveal-section-notify" style="margin-bottom: 0;">
            <h1>Welcome to <br> databroker. </h1>
            <p>Here comes an extra copy line. Lorem<br>
                ipsum dolor sit amet, consectetur</p>
        </div>
    </div>
    <img class="app-reveal-section-mark2" src="{{ asset('images/reveal_mark1.jpg') }}">
    <div class="app-section app-reveal-section align-items-center" style="padding-top: 0;">    
        <img class="app-reveal-section-mark" src="{{ asset('images/reveal_mark0.jpg') }}">
    </div>
</div>
<div class="container-fluid app-wapper">    
	<div class="section_splitor_green">        
    </div>
	<div class="container">		
	    <div class="row">
	    	<div class="col-md-12">
				<div class="card card-raised card-background" style="background-image: url({{ asset('images/plane.jpg') }})">
					<div class="card-body">
						<h6 class="card-category text-info tx-success">Featured</h6>
						<h3 class="card-title">Weather data</h3>
						<p class="card-description">
							Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
						</p>
						<a href="#pablo" class="btn btn-round readmore">
							READ MORE
						</a>
						<div class="card-author">
							<p> Data provided by sigfox </p>
							<img src="{{ asset('images/partner_4.png') }}">	
						</div>						
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>	

<div class="container-fluid app-wapper">
    <div class="container">        
        <h1 class="mb-20 text-left">Trending</h1>
        <div class="app-partner-items row">
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon">
						<img src="{{ asset('images/design/transport.svg') }}">
	                </div>        
					<h4 class="info-title"> Car data </h4>
        		</div>

        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon">
						<img src="{{ asset('images/design/transport.svg') }}">
	                </div>
					<h4 class="info-title"> Car data </h4>
        		</div>

        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon"><img src="{{ asset('images/design/people.svg') }}">
                    </div>
					<h4 class="info-title"> Car data </h4>
        		</div>

        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon"><img src="{{ asset('images/design/geography.svg') }}">
                    </div>
					<h4 class="info-title"> Car data </h4>
        		</div>

        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon"><img src="{{ asset('images/design/energy.svg') }}">
                    </div>		
					<h4 class="info-title"> Car data </h4>
        		</div>

        	</div>
        	<div class="col-md-2">
        		<div class="app-partner-item info">
					<div class="icon"><img src="{{ asset('images/design/geography.svg') }}">
                    </div>
					<h4 class="info-title"> Car data </h4>
        		</div>
        	</div>
        </div>


		<h1 class="mt-80 mb-20 text-left"> Fresh on the marketplace </h1>
		<div class="row">
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_4.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_5.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_1.png') }}" />
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
                <h1 style="margin-bottom: 20px;">Looking for specific data to improve your business?</h1>
                <p class="center">
                    We can match you up with the perfect data partner
                    <span class="height-space" style="display: block;"></span>
                    <a href="/newsletter">
                        <button type="button" class="btn match-me-up-btn pure-material-button-outlined">Notify Me</button>
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
		<h1 class="mt-80 mb-20 text-left"> Team picks </h1>
		<div class="row">
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_4.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_5.png') }}" />
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title">Satelite imagery of building and roads</h4>
						<h6 class="card-category">Europe</h6>
						<img class="img" src="{{ asset('images/partner_1.png') }}" />
					</div>			
				</div>	
			</div>	
  		</div>

	    <div class="app-section app-monetize-section align-items-center">
	        <div class="app-monetize-section-item0"></div>
	        <div class="app-monetize-section-item1">
	            <h1>Featured data providers.</h1>	            
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
    </div>    
</div>    

<div class="container-fluid app-wapper">
	<div class="section_splitor"></div>    
    <div style="background: url({{ asset('images/patterns/background_01.png') }});background-position: right;background-repeat: no-repeat;background-size: contain;">
        <div style="background: url({{ asset('images/patterns/background_02.png') }});background-position: left;background-repeat: no-repeat;background-size: contain;">
            <div class="app-section app-peek-section align-items-center">
                <div class="app-monetize-section-item0"></div>
                <h1 style="margin-bottom: 20px;">Title addressing potential buyers?</h1>
                <p class="center">
                    Subtitle addresssing potential buyers
                    <span class="height-space" style="display: block;"></span>
                    <a href="/newsletter">
                        <button type="button" class="btn match-me-up-btn pure-material-button-outlined">Contact</button>
                    </a>                     
                </p>                
            </div>
        </div>
    </div>
    <div class="section_splitor"></div>    
</div>
<div class="container-fluid app-wapper">	
	<div class="container">
		<h1 class="mt-80 mb-20 text-left"> Top use cases </h1>
		<div class="row">
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title text-bold text-green">Satelite imagery of building and roads</h4>
						<p class="card-description">Increased satety thanks to the connected cars.
							Discover now how data exchanges can help saving lives and preventing accidents.
						</p>						
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">
						<h4 class="card-title text-bold text-green">Satelite imagery of building and roads</h4>
						<p class="card-description">Increased satety thanks to the connected cars.
							Discover now how data exchanges can help saving lives and preventing accidents.
						</p>						
					</div>			
				</div>	
			</div>	
			<div class="col-md-4">
				<div class="card card-profile card-plain">
					<div class="card-header">
						<a href="#pablo">
							<img class="img" src="{{ asset('images/design/Rectangle 745-1.png') }}" />
						</a>
					</div>
					<div class="card-body text-left">						
						<h4 class="card-title text-bold text-green">Satelite imagery of building and roads</h4>
						<p class="card-description">Increased satety thanks to the connected cars.
							Discover now how data exchanges can help saving lives and preventing accidents.
						</p>
					</div>			
				</div>	
			</div>	
  		</div>
  	</div>  	
</div>
@endsection

