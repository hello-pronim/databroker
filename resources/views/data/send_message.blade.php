@extends('layouts.app')

@section('title', 'Contact the data provider | Databroker ')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')       
<div class="container-fluid app-wapper bg-pattern-side">
    <div class="container">
        <div class="row send-massage" id="send-message-row">
            <div class="row justify-content-center mt-30 auth-section">
                <div class="col-md-12">
                    <h2 class="text-primary text-center text-bold">{{trans('data.send_a message_to')}} {{ $offer['companyName'] }}</h1>
                    <h2 class="h4_intro text-left"> 
                        Related to {{ $offer['offerTitle'] }} for 
                        @foreach($offer['region'] as $region)
                            {{ $region->regionName }}
                        @endforeach
                    </h2>
                    <br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row justify-content-center mt-30 auth-section">
                    <div class="col-md-12">
                        <div class="col-md-12 col-sm-12">        
                                <form method="POST" action="{{ route('data.post_send_message') }}" id="contactForm">
                                    @csrf
                                    <input type="hidden" name="offerIdx" value="{{$offer['offerIdx']}}">
                                    <input type="hidden" name="providerIdx" value="{{$offer['providerIdx']}}">
                                    <label class="pure-material-textfield-outlined">
                                        <textarea name="message" class="form-control input_data user-message @error('message') is-invalid @enderror" placeholder="{{ trans('data.your_message') }}" maxlength="100" autofocus>{{ old('message')}}</textarea>
                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Message']) }}</div>
                                        @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                    <label class="pure-material-textfield-outlined">
                                        <input type="text" id="email" name="email" class="form-control input_data @error('email')  is-invalid @enderror" placeholder=" "  value="{{ old('email') }}" autocomplete="email" autofocus>
                                        <span>Preferred contact email or phone number</span>
                                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email']) }}</div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </label>
                                    <div class="form-group row mb-0">                        
                                        <div class="col-md-6">                                
                                            <button type="submit" class="customize-btn">{{ trans('data.send_message') }}</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-12">
                <div class="app-section app-reveal-section align-items-center usecases send-message">        
                    <div class="">
                        <div class="send-message-mgt60">
                            <p class="h4_intro text-left">How it works</p>
                            <ul class="databroker-list" id="send-msg-ul">
                                <li>The data provider receives an email with your message, your name, your company and the contact details you provide.</li>
                                <li>As soon as they contact you, you can then continue your conversation outside the Databroker platform.</li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection   