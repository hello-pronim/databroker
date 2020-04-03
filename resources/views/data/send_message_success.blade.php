@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
            	<div class="success-msg">
                    <h1 class="text-primary text-center text-bold">Your message to {{ $seller['companyName'] }} has been sent successfully</h2>
					<p class="para text-center text-bold">{{trans('data.received_success')}}</p>
                </div>
                <div class="form-group row mb-0">                        
                    <div class="col-md-4">                                
                    </div>
                    <div class="col-md-4">                                
                        <a href="{{ route('data_details', [ 'id' => $offer['offerIdx'] ] ) }}"><button class="customize-btn">{{ trans('data.continue') }}</button></a>
                    </div>
                    <div class="col-md-4">                                
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection