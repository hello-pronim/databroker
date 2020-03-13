@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
            	<div class="success-msg">
					<h1 class="text-primary text-center text-bold">{{trans('data.bid_send_success')}} {{$companyName}}</h1>
                	<h4 class="text-center text-bold">You will receive an email when the seller responds to your bid.<br/>You can follow up on you bids in <a href="{{route('profile.bids')}}">your account</a></h4>
                	<a href="{{route('data_details', ['id'=>$offerIdx])}}">
                		<button type="button" class="customize-btn">{{trans('data.continue')}}</button>
                	</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection