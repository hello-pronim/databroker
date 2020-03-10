@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper help">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <h1 class="h1-small">Help & customer care</h1>
            </div>  
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-4 mgh30">
                        <a href = "{{ route('help.buying_data') }}">
                            <div class="flex-center flex-vertical help-item-container">
                                <div class="icon-75 icon-cart-buying"></div>
                                <p class="h3">All about buying data</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container">
                            <div class="icon-75 icon-cart-selling"></div>
                            <p class="h3">All about selling data</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container">
                            <div class="divider-green"></div>
                            <p class="h3">Questions?</p>
                            <p class="para mgb25">Feel free to contact us.<br/> We are happy to help.</p>
                            <a href="{{ route('contact') }}"><button class="customize-btn">Contact us</button></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container small">
                            <div class="divider-green"></div>
                            <p class="h3 text-center">Buy & sell with trust.<br/>Our guarantees</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container small">
                            <div class="divider-green"></div>
                            <p class="h3 text-center">File a complaint</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container small">
                            <div class="divider-green"></div>
                            <p class="h3 text-center">Help us improve! <br/>Give your feedback</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection

