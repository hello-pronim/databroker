@extends('layouts.app')

@section('additional_css')
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer overview">
	<div class="bg-pattern1-left"></div>
    <div class="container mb-40">	
		<div class="row">
			<div class="col-lg-6">
				<div class="blog-header mt-60">
		            <h2 class="text-primary text-bold">You are ready to publish your data offer.</h2>
		            <h4>We will guide you step-by-step via our wizard.</h4>
		        </div>		        
			</div>			
		</div>
		<div class="app-monetize-section-item0 ml-0 mt-20"></div>
		<div class="row">
			<div class="col-lg-6">
				<h3 class="text-bold">You will go through 4 steps.</h3>	
			</div>			
		</div>	
		<div class="row mt-30">
			<div class="col-lg-6 publish_start">				
				<div class="mt-20">
					<h4 class="text-bold"><span class="fs-30">1. </span> The basics (minimum necessary for publishing)</h4>
					<p class="fs-18">Add a title and a nice image for your data, for what region the data available, and in which communities you want to publish it.</p>
				</div>
				<div class="mt-20">
					<h4 class="text-bold"><span class="fs-30">2. </span> Description of the data (optional but recommended)</h4>
					<p class="fs-18">Add a description of the data. This can be some technical information, or you can also add some text here about the data products.  </p>
				</div>
				<div class="mt-20">
					<h4 class="text-bold"><span class="fs-30">3. </span> Use cases (optional but recommended)</h4>
					<p class="fs-18">Add some typical use cases for your data. What business challenges do they solve?</p>
				</div>
				<div class="mt-20">
					<h4 class="text-bold"><span class="fs-30">4. </span> Samples (optional but recommended)</h4>
					<p class="fs-18">Add some samples files or images to make your data offer even more clear.</p>
					<p class="fs-18 mt-30">Done? Your data offer will be ready to be published on Databroker. Also some text here about the data products that can be added right away or later etc.</p>
				</div>
				<a href="{{ route('data_offers') }}">
					<button type="button" class="btn customize-btn btn-next">START NOW</button>
				</a>	
			</div>	
			<div class="col-lg-2">				
			</div>
			<div class="col-lg-4">				
				<div class="publish_box">
        			<h4 class="text-bold">Good to know</h4>
        			<p class="text-grey fs-18 mt-10">You can publish your data offer and products, and make it available in the community, even when you are not yet technically setup for the transaction.</p>
        			<p class="text-grey fs-18 mt-10">You will be able to edit and add info about your data at any time, also when it is published.</p>
        			<p class="text-grey text-bold fs-18 mt-10">Not sure how to start? <a href="javascript:;">View an example (pdf)</a></p>        			
        		</div>
			</div>	
		</div>		
	</div>   	
</div>

@endsection

@section('additional_javascript')
@endsection

