@extends('layouts.app')

@section('title', 'Share your feedback with us | Databroker ')
@section('description', 'Your opinion is important to us, and we’d love to hear your feedback on what we’re doing well and what we could do better.')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div class="blog-header mgt60">
                <div class="row">
                    <div class="col-lg-9 col-sm-12">
                        <h1 class="h1-small">How can we make Databroker even better?</h1>
                        <p class="para">We’re always striving to improve our marketplace, and we love to hear your feedback on what we’re doing well and what we could do better.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pull-right">
                            <p class="h3 text-right"></p>
                            <br/>
                            <br/>
                            <a href="{{ route('contact') }}"><button class="customize-btn">GIVE FEEDBACK</button></a>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-4 flex-vcenter mgh30">
                        <!-- <h4 class="h4_intro">FOR BUYERS: 30-day warranty</h4> -->
                    </div>
                </div>
                <div id="usecase-list" class="mgh30">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                                <div class="card card-profile card-plain">                  
                                    <div class="card-header holder">        
                                        <img class="img" src="{{ asset('images/usecases/Agriculture_cvs@2x.png') }}" />
                                        <div class="small-image-overlay"></div>
                                    </div>
                                </div>  
                        </div>  
                    </div>
                    <div class="row">                
                        <div class="col-md-12">
                            <h1 class="h1-small">Why your feedback is important to us</h1>
                            <p class="fs-18">When we understand why something helps you or frustrates you, or how a new feature could bring benefits, we can use that information to develop Databroker more effectively.</p>
                            <p class="fs-18"><b>If you’re sharing your thoughts about a particular part of the marketplace</b>, or a certain process, please be as detailed as possible when explaining what you like or dislike.</p>
                            <p class="fs-18"><b>If you’re submitting an idea for something new</b>, please give us as much information to work with as you can, e.g. why your idea would be good for the Databroker community, what problems it could solve etc.</p>
                        </div>                
                    </div> 
                    <div class="row">                
                        <div class="col-md-12">
                            <br/>
                            <br/>
                            <a href="{{ route('contact') }}"><button class="customize-btn">GIVE FEEDBACK</button></a>
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

