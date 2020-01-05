@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center">
    		<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
	        <div class="blog-header">
	            <h1>Satellite imagery of building and roads </h1>
	            <p class="area">Europe</p>
	            <p class="category">Mobility</p>
	        </div>
	        <div class="blog-content">
	        	<div class="row">
	        		<div class="col-lg-8">
	        			<img class="blog-img" src="{{ asset('images/blogs/blog.png') }}" />
	        		</div>
	        		<div class="col-lg-4">
	        			<h2 class="explain">Data provided by sigfox</h2>
	        			<h5 class="subcategory">Geo Information Service</h5>
	        			<label class="country">Belgium</label>
	        			<label class="author">sigfox.com</label>
	        			<div class="author_avatar">
	        				<img src="{{ asset('images/blogs/sigfox.png') }}">
	        			</div>	        			
	        			<p class="short-desc">
	        				Contact this data provider for any questions, or to prepare a specific dataset based on your needs.
	        			</p>
	        			<button type="button" class="btn btn-round sendmessage-btn">Send a Message</button>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-lg-8">	        	
			            <div class="nav-tabs-wrapper">
			                <ul class="nav nav-tabs" data-tabs="tabs">
			                    <li class="nav-item">
			                        <a class="nav-link active" href="#description" data-toggle="tab">Description</a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="nav-link" href="#use_cases" data-toggle="tab">Use cases</a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="nav-link" href="#samples" data-toggle="tab">Samples</a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="nav-link" href="#this_data" data-toggle="tab">Buy this data</a>
			                    </li>
			                </ul>
			            </div>				        
				        <div class="tab-content">
				            <div class="tab-pane active" id="description">
				            	<h2>Description</h2>
				                <p>The very high resolution optical images enable the identification of single buildings, roads, vehicles, and even individual trees. The launch of the IKONOS satellite (1999) made history with the world’s first 1 meter commercial remote sensing satellite. IKONOS produces black-and-white (panchromatic) images with 82-centimeter resolution and multispectral imagery with 4-meter resolution. Imagery from both sensors can be merged to create 1-meter colour imagery (pan-sharpened). The more than 300 million km² of imagery that IKONOS has collected over every continent is being used for national security, military mapping, and by regional and local governments.</p>
				                <div class="region">
				                	<label>{{ trans('pages.region') }}: </label> 
				                	<span>Europe</span>
				                </div>
				            </div>
				            <div class="tab-pane" id="use_cases">
				                <h2>Use cases</h2>
				                <p>(free text input) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>				                
				            </div>
				            <div class="tab-pane" id="samples">
				                <h2>Use cases</h2>
				                <p>Sample of lorem ipsum dolor sit amet.</p>
				                <div class="download"><i class="material-icons">cloud_download</i><span>document.pdf</span></div>

				                <p>Sample of lorem ipsum dolor sit amet.</p>
				                <div class="download"><i class="material-icons">cloud_download</i><span>document.pdf</span></div>
				            </div>
				            <div class="tab-pane" id="this_data">
				                <h2>Buy this data</h2>
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
					                			<button type="button" class="btn customize-btn">Buy Now</button>
					                		</div>	
				                		</div>				                		
				                	</div>
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
					                			<button type="button" class="btn customize-btn">Send a bid to the seller</button>
					                			<button type="button" class="btn customize-btn">Buy Now</button>
					                		</div>	
				                		</div>				                		
				                	</div>
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
					                			<button type="button" class="btn customize-btn">Buy Now</button>
					                		</div>	
				                		</div>				                		
				                	</div>	
				                </div>
				            </div>
				        </div>
	        		</div>
	        	</div>
	        </div>
	    </div>	
	    <a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>    
    </div>      
</div>

@endsection

