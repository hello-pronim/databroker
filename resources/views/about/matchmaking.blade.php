@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!--- xd #57 -->
<div class="container-fluid app-wapper about matchmaking">
    <div class="bg-pattern1-left" id="matchmaking-background"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div class="blog-header">
                <h1 class="h1-small">Looking for specific data to improve your business?</h1>
                <div class="para">We can match you up with the perfect data partner.</div>
            </div>          
            <div class="">
                <div class="row mgh60">
                    <div class="col-lg-3 avatar-wrapper">
                        <div class="avatar"></div>
                    </div>
                    <div class="col-lg-6 flex-vcenter mg30 matchmaking">
                        <div>
                            <p class="h4_intro text-left">Hi, I’m Vincent, your DataMatch Advisor!</p>
                            <p class="para">Are you looking for specific data that’s hard to find? We work with you to understand exactly what you need, and then use our wide network to find the perfect data match for you.</p>
                            <p class="para">Our DataMatch service is already up and running, so just tell us what you need and we’ll do our best to make it happen!</p>
                        </div>
                    </div>
                </div>
                <div class="mgt60">
                    <p class="h4_intro text-left">How it works</p>
                    <ul class="databroker-list">
                        <li>You tell us your business challenge or data needs</li>
                        <li>We may contact you for more details</li>
                        <li>We search for potential data partners within our wide network</li>
                        <li>No robots, no technology, but real people from the databroker dao team</li>
                        <li>We'll let you know when we found a match</li>
                    </ul>
                </div>
                <div class="flex-vcenter">
                    <button class="customize-btn">Yes, I want to be matched up</button><!-- goto 74 --><span>&nbsp;&nbsp;(Coming soon)</span>
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

