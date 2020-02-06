@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-xl-6 col-lg-6 col-md-10" id="login_section">
                <h1 class="h1-smaller color-primary text-center text-primary" id="login_title">Please sign in</h1>
                <p class="text-center h4-intro mb-50">To {{session('target')?session('target'):$action }} </p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" "  value="{{ old('email') }}" autocomplete="email" autofocus>
                        <span>Email Address</span>
                        <div class="error_notice"> This field is required</div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="{{ old('password') }}" autocomplete="password" autofocus>
                        <span>{{ __('Password') }}</span>
                        <div class="error_notice"> This field is required</div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="form-group row mb-0">
                        <div class="col-6">
                            <button type="submit" class="customize-btn">CONTINUE</button>
                        </div>
                        <div class="col-6 text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-grey" id="forgot_pass_link" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <p class="h4-intro">Don’t have an account yet?</p>
                    <p class="paragraph-small text-bold">Then let’s get you set up!</p>
                    <a id="register_link" href="{{ route('register') }}">
                        <button type="button" class="secondary-btn w225 pure-material-button-outlined">{{ __('REGISTER NOW') }}</button>
                    </a>
                    <label class="ml-30">It’s free!</label>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
