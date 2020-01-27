@extends('layouts.app')

@section('additional_css')
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer confirm mgh25">
	<div class="bg-half-watermark-right-left">
		<div class="bg-half-watermark w-right"></div>
		<div class="bg-half-watermark w-left"></div>
	</div>
    <div class="container flex-vcenter">	
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<div class="blog-header">
		            <div class="h1-big text-center">Your data offer is published successfully.</div>
		        </div>		        
		        <div class="blog-content">
		            <div class="h2">You can access it via <span class="color-green">Data offers in your account</span> and edit it any time. You can also <span class="color-green">start adding data products now</span> to start selling, or do this later.</div>
		            <div class="flex-center mgt30">
		            	<button class="primary-btn mgr30">GO TO DATA PRODUCT IN YOUR ACCOUNT</button>
		            	<button class="secondary-btn">VIEW DATA PRODUCT ON THE MARKETPLACE</button>
		            </div>
		        </div>
			</div>
		</div>
	</div>   	
</div>

@endsection

@section('additional_javascript')
@endsection

