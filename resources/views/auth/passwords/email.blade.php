@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper">    
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-lg-8 col-md-10">                
                <h1 class="h1-smaller color-primary text-center text-primary">{{ __('Forgot your password?') }}</h1>
                <p class="text-center text-bold fs-20">{{ __('Enter your email address and we will send you a link to reset your password.') }}</p>                
                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-0">
                            <label class="pure-material-textfield-outlined mt-20">
                                <input type="text" id="email" name="emailAddress" class="form-control input_data @error('emailAddress')  is-invalid @enderror" placeholder=" "  value="{{ old('emailAddress') }}" autocomplete="emailAddress" autofocus>
                                <span>Email Address</span>
                                <div class="error_notice"> This field is required</div>
                                @error('emailAddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>                        
                        
                        <div class="form-group mb-0 col-md-6 text-right">                            
                            <button type="submit" class="customize-btn">{{ __('Send Password Reset Link') }}</button>
                        </div>    
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>    
@endsection
