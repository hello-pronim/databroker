@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="h1-smaller color-primary text-center text-primary" id="login_title">Reset your password</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <label class="pure-material-textfield-outlined mt-20">
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
                                <input type="password" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="" autofocus>
                                <span>{{ trans('auth.password') }}</span>
                                <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Password']) }}</div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>

                            <label class="pure-material-textfield-outlined">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input_data @error('password_confirmation')  is-invalid @enderror" placeholder=" "  value="" autofocus>
                                <span>{{ trans('auth.confirm_password') }}</span>
                                <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Password']) }}</div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>

                            <div class="register-actions form-group mb-0">
                                <button type="submit" class="customize-btn">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
