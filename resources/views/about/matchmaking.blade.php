@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!--- xd #57 -->
<div class="container-fluid app-wapper about matchmaking">
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div class="blog-header">
                <h1 class="h1-small">Looking for specific data to supercharge your business?</h1>
                <div class="para text-bold fs-20">Let our tailor-made DataMatch service find the perfect data partner for you!</div>
            </div>          
            <div class="">
                <div class="row mgh60">
                    <div class="col-lg-3 avatar-wrapper">
                        <div class="avatar"></div>
                    </div>
                    <div class="col-lg-6 flex-vcenter mg30 matchmaking">
                        <div>
                            <p class="h4_intro text-left">Hi, I'm Vincent, your DataMatch Advisor!</p>
                            <p class="para">You know what data you need, but don’t have the time to search for it? Or maybe you’ve tried, without success? Here at Databroker, we know that time is your most precious resource, so we’ll be happy to take on the task for you. At no cost.</p>
                        </div>
                    </div>
                </div>
                <div class="mgt60">
                    <p class="h4_intro text-left">How it works</p>
                    <ul class="databroker-list">
                        <li>You explain your business challenge to us, so we understand your exact needs.</li>
                        <li>We search our wide network for the perfect data partner.</li>
                        <li>We tell you when we’ve found a match. </li>
                    </ul>
                </div>
                <div class="mt-30">
                    <p class="para">Simple as that!</p>
                </div>
                <div class="mt-30">
                    <p class="para">Here at Databroker, we love technology … but sometimes a human touch is priceless!</p>
                </div>
                <div class="flex-vcenter mt-30">
                    <a href="{{ route('contact') }}"><button class="customize-btn">Match me up</button></a>
                    <div class="mg15 pd15">It's free</div>
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

