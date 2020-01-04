@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-xl-4 col-lg-6 col-md-10" id="login_section">
                <h1 class="h1-smaller color-primary text-center text-primary" id="login_title">Please sign in</h1>
                <p class="text-center h4-intro mb-50">To send message to the seller</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <label class="pure-material-textfield-outlined">
                        <input type="text" id="emailAddress" name="emailAddress" class="form-control input_data @error('emailAddress')  is-invalid @enderror" placeholder=" "  value="{{ old('emailAddress') }}" required autocomplete="emailAddress" autofocus>
                        <span>Email Address</span>
                        <div class="error_notice"> This field is required</div>
                        @error('emailAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <label class="pure-material-textfield-outlined">
                        <input type="password" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="{{ old('password') }}" required autocomplete="password" autofocus>
                        <span>{{ __('Password') }}</span>
                        <div class="error_notice"> This field is required</div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn customize-btn">CONTINUE</button>
                        </div>
                        <div class="col-md-6 text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-grey" id="forgot_pass_link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <p class="h4-intro">No account yet?</p>
                    <p class="paragraph-small text-bold">Let's get you set up on Databroker dao first! It's free!</p>
                    <a id="register_link" href="{{ route('register') }}">
                        <button type="button" class="btn custom-btn1 pure-material-button-outlined">{{ __('REGISTER NOW') }}</button>
                    </a>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
