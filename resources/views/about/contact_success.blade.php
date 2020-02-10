@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
            	<div class="success-msg">
					<h1 class="text-primary text-center text-bold">{{trans('contact.received_success')}}</h1>
					<p class="text-bold fs-24 mt-10">The Databroker dao team will contact you soon.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection