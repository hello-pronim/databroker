@extends('layouts.app')

@section('title', 'Problem with a purchase? | Databroker ')
@section('description', 'Our 30-day warranty means you can buy data with confidence. If there is any problem with a purchase, you can file a complaint within the first 30 days.')

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
                        <h1>Problem with a purchase?</h1>
                        <p class="para">If there’s a mismatch between data you have purchased and how it was described, we recommend that you first contact the seller directly to discuss the problem, and try to come to an agreement about how to proceed.</p>
                        <p class="fs-18">In situations where you can’t resolve the issue amicably, you can file a complaint against the seller <b>within 30 days of your purchase</b>. </p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pull-right">
                            <p class="h3 text-right"><br/></p>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <a href="{{ route('help.send_file_complaint') }}"><button class="customize-btn">FILE A COMPLAINT</button></a>
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
                        <div class="col-md-12">
                            <h3 class="text-bold">Why the time limit?</h3>
                            <p class="fs-18">We believe that a 30-day warranty period gives you the time to check the data and make sure it’s what you expected to receive.</p>
                            <p class="fs-18"> If there is a mismatch, you should contact the seller as soon as possible to discuss the problem, keeping in mind the deadline to file a complaint.   </p>
                        </div>                
                    </div> 
                    <div class="row">                
                        <div class="col-md-12">
                            <h3 class="text-bold">What happens when I file a complaint? </h3>
                            <p class="fs-18">When you file a complaint, the first action we take is to freeze the seller’s earnings related to that sale. </p>
                            <p class="fs-18">A Databroker mediator then investigates the complaint, working with you and the seller to try to come to an agreement. If an agreement can’t be reached, the mediator will make a final, binding decision.</p>
                            <p class="fs-18">If the complaint is deemed valid, we’ll reimburse the amount you paid.</p>
                        </div>                
                    </div>  
                    <div class="row">                
                        <div class="col-md-12">
                            <br/>
                            <br/>
                            <a href="{{ route('help.send_file_complaint') }}"><button class="customize-btn">FILE A COMPLAINT</button></a>
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

