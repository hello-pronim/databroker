@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
            	<div class="success-msg">
					<h1 class="text-primary text-center text-bold">{{trans('data.bid_send_success')}} {{$companyName}}</h1>
                	<h4 class="text-center text-bold">You'll receive an email when they respond to your bid.<br/>Remember that you can also follow up on your bids in the <a href="{{route('profile.bids')}}">Bids sent</a>section of your account.</h4>
                	<a href="{{route('data_details', ['id'=>$offerIdx])}}">
                		<button type="button" class="customize-btn">{{trans('data.continue')}}</button>
                	</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection