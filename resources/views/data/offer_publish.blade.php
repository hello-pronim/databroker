@extends('layouts.app')

@section('additional_css')
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer overview">
	<div class="bg-pattern1-left"></div>
    <div class="container">	
		<div class="row">
			<div class="col-lg-6">
				<div class="blog-header mt-60">
		            <h1>{{ trans('pages.publish_data_offer_title') }}</h1>			            
		            <p class="area">{!! trans('pages.publish_data_offer_desc') !!}</p>
		        </div>		        
			</div>
			<div class="col-lg-6 flex-end">
				<a href="{{ route('data_offers') }}">
					<button type="button" class="btn customize-btn btn-next pull-right">{{ 
					trans('pages.publish_a_data_offer') }}</button>
				</a>	
			</div>
		</div>
		<div class="app-monetize-section-item0 ml-0 mt-20"></div>
		<div class="row">
			<div class="col-lg-6">
				<h3 class="text-bold">{{ trans('pages.advantage_databroker') }}</h3>	
			</div>			
		</div>	
		<div class="row mt-30">
			<div class="col-lg-6">				
				<div class="number-counter mt-20">
					<span>{{ trans('pages.advantage_databroker_reason1') }}</span>
				</div>
			</div>	
			<div class="col-lg-6 pl-15">
				{{ trans('pages.advantage_databroker_reason1_desc') }}
			</div>	
		</div>
		<div class="row mt-30">
			<div class="col-lg-6">				
				<div class="number-counter mt-20">
					<span>{{ trans('pages.advantage_databroker_reason2') }}</span>					
				</div>
			</div>	
			<div class="col-lg-6 pl-15">
				{{ trans('pages.advantage_databroker_reason2_desc') }}
			</div>	
		</div>
		<div class="row mt-30">
			<div class="col-lg-6">				
				<div class="number-counter mt-20">
					<span>{{ trans('pages.advantage_databroker_reason3') }}</span>
				</div>
			</div>	
			<div class="col-lg-6 pl-15">
				{{ trans('pages.advantage_databroker_reason3_desc') }}
			</div>	
		</div>
	</div>   	
</div>
<div class="container-fluid app-wapper">
	<div class="section_splitor"></div>    
    <div style="background: url(http://dev.databroker.com/images/patterns/background_01.png);background-position: right;background-repeat: no-repeat;background-size: contain;">
        <div style="background: url(http://dev.databroker.com/images/patterns/background_02.png);background-position: left;background-repeat: no-repeat;background-size: contain;">
        	<div class="container">
        		<div class="testimonials">
	            	<div class="testimonial">
	            		<p class="content">
	            			"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."
	            		</p>
	            		<p class="author">Name, role, company</p>
	            	</div>
	            	<div class="testimonial">
	            		<p class="content">
	            			"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."
	            		</p>
	            		<p class="author">Name, role, company</p>
	            	</div>
	            </div>
        	</div>            
        </div>
    </div>
    <div class="section_splitor"></div>    
</div>

<div class="container-fluid app-wapper">	
	<div class="container">		
		<div class="row">			
        	<div class="col-lg-6">
        		<h3 class="text-bold">Publish your data offer in any of our data communities</h3>
        		<div class="row">
        			@foreach ($communities as $community)
                        <div class="col-md-4 mt-10 text-bold fs-18">{{ $community->communityName }}</div>
                    @endforeach  
        		</div>
        	</div>
        	<div class="col-lg-6">
        		<div class="publish_box">
        			<h4 class="text-bold">Are you ready?</h4>
        			<a href="{{route('data_offers')}}"><button type="button" class="btn customize-btn btn-next">{{ trans('pages.publish_a_data_offer') }}</button></a>
        			<p class="text-grey text-bold fs-18 mt-10">It’s free!</p>
        			<div class="app-monetize-section-item0 mt-20"></div>

        			<h4 class="text-bold mb-0">Still have questions?</h4>
        			<a class="fs-18 text-green" href="{{route('data_offers')}}">Find out how it all works</a>
        			<p class="fs-18">Or contact us for a chat</p>
        			<a href="{{route('contact')}}">
        				<button type="button" class="btn btn-round sendmessage-btn">CONTACT US</button>
        			</a>
        		</div>
        	</div>
        </div>
	</div>                    
</div>


@endsection

@section('additional_javascript')
@endsection

