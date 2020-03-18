@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper app-bids-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center data-detail">    		
	        <div class="blog-header">
	            <h1>Bids</h1>	            
	            
	            <div id="bids" class="row">
		            <div class="col-lg-4 nav nav-tabs d-block" data-tabs="tabs">
	            		@if($bidProducts)
	            			@foreach($bidProducts as $key=>$bidProduct)
		            	<div class="bid nav-item @if($key==0) open @endif">
		            		<a class="nav-link @if($key==0) active @endif" href="#tab{{$bidProduct->productIdx}}" data-toggle="tab"><h4 class="fs-20 text-bold">{{$bidProduct->productTitle}}</h4></a>
		            		<p>Belgium</p>
		            		<p>{{$bidProduct->companyName}}</p>
		            		<div class="mt-20">
		            			<label>Format:</label><span>{{$bidProduct->productType}}</span> <br>
		            			<label>Price:</label>
		            			@if($bidProduct->productPrice)<span class="text-warning">€{{$bidProduct->productPrice}}</span> <span>(tax incl.)</span>
		            			@else <span class="text-warning">FREE</span>
		            			@endif
		            			<br>
		            			<label>Access to this data:</label><span>1 {{$bidProduct->productAccessDays}}</span>
		            		</div>
		            	</div>	
			            	@endforeach
			            @endif
		            </div>
		            <div class="bids_list col-lg-8 tab-content">
		            	@if($bidUsers)
		            		@foreach($bidUsers as $key=>$bid)
		            	<div class="tab-pane @if($key==0) active @endif" id="tab{{$bid['productIdx']}}">
		            		@if($bid['users'])
		            			@foreach($bid['users'] as $bidUser)
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-9">
				            			<div class="row">
				            				<div class="col-md-2">
				            				</div>
				            				<div class="col-md-10">
				            					<p class="text-grey">{{date('d/m/y - H:i', strtotime($bidUser['created_at']))}}</p>
				            				</div>
				            			</div>
				            			<div class="row">
				            				<div class="col-md-2">
				            					<label>Bid:</label>		
				            				</div>
				            				<div class="col-md-10">
				            					<span class="text-warning">€{{$bidUser['bidPrice']}}</span>
				            					<span>(tax incl.)</span>
				            				</div>
				            			</div>
				            			<div class="row">
				            				@if($bidUser['bidStatus']==1)
				            				<div class="col-md-2">
				            					<label>Accepted By:</label>		
				            				</div>
				            				<div class="col-md-10">		            					
				            					<p class="text-bold">{{$bid['sellerCompanyName']}}</p>
						            			<p class="text-bold">{{$bid['sellerName']}}</p>	
				            				</div>
				            				@elseif($bidUser['bidStatus']==-1)
				            				<div class="col-md-2">
				            					<label>Rejected By:</label>		
				            				</div>
				            				<div class="col-md-10">		            					
				            					<p class="text-bold">{{$bid['sellerCompanyName']}}</p>
						            			<p class="text-bold">{{$bid['sellerName']}}</p>	
				            				</div>
				            				@else
				            				<div class="col-md-2">
				            					<label>From:</label>		
				            				</div>
				            				<div class="col-md-10">		            					
				            					<p class="text-bold">{{$bidUser['companyName']}}</p>
						            			<p class="text-bold">{{$bidUser['firstname']." ".$bidUser['lastname']}}</p>	
				            				</div>
				            				@endif
				            			</div>
				            			<div class="row">
				            				<div class="col-md-2">
				            					<label>Message:</label>		
				            				</div>
				            				<div class="col-md-10">
				            					<p>{{$bidUser['bidMessage']}}</p>			            					
				            				</div>
				            			</div>
				            			@if($bidUser['bidStatus']==1)       			
				            			<div class="row">
				            				<div class="col-md-2">
				            				</div>
				            				<div class="col-md-10">
				            					<p class="text-grey">You can <a href="#" class="text-green">buy the data via this link</a> at the agreed price. <br>
				            					You will also receive an email including the link.</p>			            					
				            				</div>
				            			</div>
				            			@endif		
				            		</div>
				            		<div class="col-md-3">
				            			@if($bidUser['bidStatus']==-1 && $bidUser['userIdx']==$user->userIdx)
				            			<a href="{{route('data.edit_bid', ['id'=>$bidUser['offerIdx'], 'pid'=>$bidUser['productIdx']])}}">
				            				<button type="button" class="button customize-btn">Update bid</button>
				            			</a>
				            			@endif
				            		</div>
			            		</div>
		            		</div>		  
		            			@endforeach
		            		@endif
		            	</div>
		            		@endforeach
		            	@endif
		            </div>
		        </div>    
	        </div>
	    </div>
	</div>
</div>
@endsection	
