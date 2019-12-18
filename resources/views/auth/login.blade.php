@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4" id="login_section">
            <h1 class="h1-smaller color-primary text-center" id="login_title">Please sign in</h1>
            <p class="text-center h4-intro">To send message to the seller</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="pure-material-textfield-outlined">
                    <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" "  value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span>Email Address</span>
                    <div class="error_notice"> This field is required</div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label class="pure-material-textfield-outlined">
                    <input type="text" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="{{ old('password') }}" required autocomplete="password" autofocus>
                    <span>{{ __('Password') }}</span>
                    <div class="error_notice"> This field is required</div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn customize-btn pure-material-button-outlined">CONTINUE</button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" id="forgot_pass_link" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <hr>
                <p class="h4-intro">No account yet?</p>
                <p class="paragraph-small">Let's get you set up on Databroker dao first! It's free!</p>
                <a class="btn btn-secondary" id="register_link" href="{{ route('register') }}">
                    {{ __('REGISTER NOW') }}
                </a>

            </form>
            
        </div>
    </div>
</div>
@endsection
