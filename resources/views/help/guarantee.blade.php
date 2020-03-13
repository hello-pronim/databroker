@extends('layouts.app')

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
                        <h1 class="h1-small">Buy and sell with confidence</h1>
                        <p class="para">Databroker is a unique marketplace that brings together buyers and sellers of data from all industries and sectors, and from all over the world. Through our platform, we want to make sure that our community of users has the best possible experience.</p>
                        <p class="fs-18">An important part of this is ensuring peace of mind, so you can buy and sell with confidence.</p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="pull-right">
                            <p class="h3 text-right">Questions?</p>
                            <a href="{{ route('contact') }}"><button class="customize-btn">CONTACT US</button></a>
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
                        <div class="col-md-9 col-sm-12">
                                <div class="card card-profile card-plain">                  
                                    <div class="card-header holder">        
                                        <img class="img" src="{{ asset('images/usecases/Environment@2x.png') }}" />
                                        <div class="small-image-overlay"></div>
                                    </div>
                                </div>  
                        </div>  
                    </div>
                    <div class="row">                
                        <div class="col-md-12">
                            <h1 class="h1-small">FOR BUYERS: 30-day warranty</h1>
                            <p class="fs-18">Just like with physical goods you buy, we want to make sure that you get what you pay for, and that the data matches its description. Which is why we offer a 30-day warranty on all data purchased. We believe that this gives you the time to check the data and make sure it’s what you expected to receive. </p>
                            <p class="fs-18">During this time, Databroker holds the seller’s earnings from the sale, and only releases them once the warranty period ends. </p>
                            <p class="fs-18">If there’s a problem with the data, we recommend that you contact the data provider as soon as possible to try to find a solution. But if that doesn’t help, you can file a complaint within 30 days of your purchase. </p>
                            <p class="fs-18">Databroker then acts as the mediator between you and the data provider, and if we find that the complaint is justified, you get your money back. </p>
                        </div>                
                    </div> 
                    <div class="row">                
                        <div class="col-md-12">
                            <h1 class="h1-small">FOR BUYERS: Instant access to data you buy</h1>
                            <p class="fs-18">As soon as your payment is successful, you have access to the data straight away, whether via the purchase confirmation page, or via a link in the confirmation email we send you. No uncertainty, no waiting for the seller to send you the data.</p>
                            <p class="fs-18">If the data is in file format, you’ll be able to download the file. If it’s a stream or API flow, you’ll receive full instructions on how to access the data. Access to the data is for a specific time period, and you’ll be reminded of this in the purchase confirmation.</p>
                        </div>                
                    </div>  
                    <div class="row">                
                        <div class="col-md-12">
                            <h1 class="h1-small">FOR SELLERS: Your data is never stored</h1>
                            <p class="fs-18">Our marketplace is all about bringing together buyers and sellers, and thanks to our peer-to-peer marketplace, the data you sell is transferred directly from your system to the buyer, never passing through the Databroker platform. </p>
                            <p class="fs-18">This means you keep full control of your data at all times, and that only buyers have access to the specific data product(s) they have bought.</p>
                        </div>                
                    </div>  
                </div>
            </div>
        </div>  
    </div>  
    <div id="sub-footer" class="sub-footer mgh30">
        <div class="section_splitor_gray"></div>
        <div class="bg-pattern1-both flex-center flex-vertical">
            <div class="divider-green mgb30"></div> 
            <div class="h1-small">Discover how Databroker works</div> 
            <br/>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                <a href="{{route('help.buying_data')}}"><button type="button" class="customize-btn button mgt15">How to buy data</button></a>
                </div>
                <div class="col-md-6 col-sm-12">
                <a href="{{route('help.selling_data')}}"><button type="button" class="customize-btn button mgt15">How to sell data</button></a>
                </div>
            </div>
        </div>
        <div class="section_splitor_gray h713"></div>
    </div>    
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection

