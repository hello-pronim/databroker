@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="row justify-content-center mt-30 auth-section">
            <div class="col-md-8">
            	<div class="success-msg">
                    <h2 class="text-primary text-center text-bold">Your message to Seller Company has been sent successfully</h2>
					<h3 class="text-primary text-center text-bold">{{trans('data.received_success')}}</h3>
                </div>
                <div class="form-group row mb-0">                        
                    <div class="col-md-4">                                
                    </div>
                    <div class="col-md-4">                                
                        <button type="submit" class="customize-btn" id="submit-success-message">{{ trans('data.continue') }}</button>
                    </div>
                    <div class="col-md-4">                                
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
    document.getElementById('submit-success-message').onclick = function (){
        var i=65;
        window.location.href = '/data/'+i;
    };
</script>
@endsection