@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!--- xd #79 -->
<div class="container-fluid app-wapper about media-center">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center mgb30">
            <div class="blog-header">
                <h1 class="h1-small mgt60">Press & media</h1>
                <div class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.</div>
            </div>          
            <div class="blog-content">
                <div class="press-list">
                    <div class="row">
                        @foreach ( $press_list as $press )
                        <div class="col-lg-6">
                            <div class="press-item-container gray-border">
                                <p class="h3 text-left">{{ $press['title'] }}</p>
                                <p class="para-small">{{ $press['text'] }}</p>
                                <button class="customize-btn button mgh15">{{ $press['action'] }}</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="">
                    <p class="h2 text-left mgt30">They are talking about us</p>
                    <div class="partner-list">
                        <div class="row">
                            @foreach ( $partners as $partner )
                            <div class="col-lg-2 partner-cell-wrapper flex-center pd15 flex-vertical">
                                <div class="partner-cell pd25 flex-center flex-vertical">
                                    <div class="partner-logo" style="background-image: url('{{asset($partner['logo'])}}');"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>  
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection

