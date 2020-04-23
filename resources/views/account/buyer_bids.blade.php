@extends('layouts.app')

@section('title', 'Bids sent | Databroker ')

@section('content')
<div class="container-fluid app-wapper app-bids-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center data-detail">    		
	        <div class="blog-header">
	            <h1>Bids sent</h1>
	            <p class="para">{{trans('data.bids_sent_intro')}}</p>
	            
	            <div id="bids" class="row">
		            <div class="col-lg-4 nav nav-tabs d-block" data-tabs="tabs">
	            		@if($bidProducts)
	            			@foreach($bidProducts as $key=>$bidProduct)
		            	<a class="nav-link @if($key==0) active @endif" href="#tab{{$bidProduct->productIdx}}" data-toggle="tab">
			            	<div class="bid nav-item @if($key==0) open @endif">
			            		<h4 class="fs-20 text-bold">{{$bidProduct->productTitle}}</h4>
			            		<p>
			            			@foreach($bidProduct->region as $region)
	        							<span>{{ $region->regionName }}</span>
	        						@endforeach
	        					</p>
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
		            	</a>
			            	@endforeach
			            @endif
		            </div>
		            <div class="bids_list col-lg-8 tab-content">
		            	@if($bidUsers)
		            		@foreach($bidUsers as $key=>$bid)
		            			@if($key==0) 
		            	<div class="tab-pane active" id="tab{{$bid['productIdx']}}">
		            			@else
		            	<div class="tab-pane" id="tab{{$bid['productIdx']}}">
		            			@endif
		            		@if($bid['users'])
		            			@foreach($bid['users'] as $bidUser)
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-3">
		            				</div>
		            				<div class="col-md-9">
		            					<p class="text-grey">{{date('d/m/Y - H:i', strtotime($bidUser['createdAt']))}}</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-3">
		            					<label>Bid:</label>		
		            				</div>
					            	@if($bidUser['bidStatus']==-1 && $bidUser['userIdx']==$user->userIdx)
		            				<div class="col-md-6">
		            					<span class="text-warning">€ {{$bidUser['bidPrice']}}</span>
		            					<span>(tax incl.)</span>
		            				</div>
		            				<div class="col-md-3">
				            			<a href="{{route('data.edit_bid', ['bid'=>$bidUser['bidIdx']])}}">
				            				<button type="button" class="button customize-btn m-0">Update bid</button>
				            			</a>
		            				</div>
		            				@else
		            				<div class="col-md-9">
		            					<span class="text-warning">€ {{$bidUser['bidPrice']}}</span>
		            					<span>(tax incl.)</span>
		            				</div>
					            	@endif
		            			</div>
		            			<div class="row">
		            				@if($bidUser['bidStatus']==1)
		            				<div class="col-md-3">
		            					<label class="label-badge"><i class="icon material-icons text-primary">check_circle</i>Accepted By:</label>		
		            				</div>
		            				<div class="col-md-9">		            					
		            					<p class="text-bold">{{$bid['sellerCompanyName']}}</p>
				            			<p class="text-bold">{{$bid['sellerName']}}</p>	
		            				</div>
		            				@elseif($bidUser['bidStatus']==-1)
		            				<div class="col-md-3">
		            					<label class="label-badge"><i class="icon material-icons text-red">error</i>Rejected By:</label>		
		            				</div>
		            				<div class="col-md-9">		            					
		            					<p class="text-bold">{{$bid['sellerCompanyName']}}</p>
				            			<p class="text-bold">{{$bid['sellerName']}}</p>	
		            				</div>
		            				@else
		            				<div class="col-md-3">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-9">		            					
		            					<p class="text-bold">{{$bidUser['companyName']}}</p>
				            			<p class="text-bold">{{$bidUser['firstname']." ".$bidUser['lastname']}}</p>	
		            				</div>
		            				@endif
		            			</div>
		            			@if($bidUser['userIdx'] == $user->userIdx)
		            				@foreach($bidUser['messages'] as $message)
				            			<div class="row">
				            				<div class="col-md-3">
		            							@if($message['senderIdx'] == $user->userIdx)
				            					<label>Message from {{$bidUser['firstname']." ".$bidUser['lastname']}}:</label>	
				            					@else
				            					<label>Message from {{$bid['sellername']}}:</label>	
				            					@endif
				            				</div>
				            				<div class="col-md-9">
				            					<p>{{$message['message']}}</p>			            					
				            				</div>
				            			</div>
			            			@endforeach
			            			@if($bidUser['bidStatus']==1)
			            			<div class="row">
			            				<div class="col-md-3"></div>
			            				<div class="col-md-9">
					            			<a href="{{route('data.buy_data', ['id'=>$bidUser['offerIdx'], 'pid'=>$bidUser['productIdx']]).'?bidIdx='.$bidUser['bidIdx']}}">
					            				<button type="button" class="button customize-btn m-0">Buy data at agreed price</button>
					            			</a>
			            					<p class="text-grey mt-10">You will also receive an email with a link to the purchase page.</p>	
			            				</div>
			            			</div>
			            			@endif
		            			@endif
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
