@extends('layouts.app')

@section('title', 'Help & support centre | Databroker ')
@section('description', 'New to Databroker? Our Help & support centre covers all the most common questions. Don’t find what you’re looking for? Just contact us!')

@section('content')
<div class="container-fluid app-wapper help">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <h1 class="h1-small help-overview">Help & support centre</h1>
            </div>  
            <div>
                <p class="para">
                    Have a question about buying or selling data? Then check out our knowledge base below for the most common questions. You’ll also find information about our guarantees, how to file a complaint, and an invitation to share your feedback with us!  
                </p>
                <p class="para">
                    And if you can’t find what you’re looking for, just click CONTACT US and send us your question directly.
                </p>
            </div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-4 mgh30">
                        <a href = "{{ route('help.buying_data') }}">
                            <div class="flex-center flex-vertical help-item-container">
                                <div class="icon-75 icon-cart-buying"></div>
                                <p class="h3 text-center">QUESTIONS ABOUT BUYING DATA?</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <a href = "{{ route('help.selling_data') }}">
                            <div class="flex-center flex-vertical help-item-container">
                                <div class="icon-75 icon-cart-selling"></div>
                                <p class="h3 text-center">QUESTIONS ABOUT SELLING DATA?</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container">
                            <div class="divider-green"></div>
                            <p class="h3 text-center">DIDN’T FIND THE ANSWER?</p>
                            <p class="para mgb25 text-center">Don’t hesitate to contact us, <br/> we’ll be happy to help!</p>
                            <a href="{{ route('contact') }}"><button class="customize-btn">CONTACT US</button></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <a href="{{ route('help.guarantee') }}">
                            <div class="flex-center flex-vertical help-item-container small">
                                <div class="divider-green"></div>
                                <p class="h3 text-center">OUR GUARANTEES</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <a href="{{ route('help.file_complaint') }}">
                            <div class="flex-center flex-vertical help-item-container small">
                                <div class="divider-green"></div>
                                <p class="h3 text-center">FILE A COMPLAINT</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mgh30">
                        <a href="{{ route('help.feedback') }}">
                            <div class="flex-center flex-vertical help-item-container small">
                                <div class="divider-green"></div>
                                <p class="h3 text-center">SHARE YOUR FEEDBACK</p>
                            </div>
                        </a>
                        
                    </div>
                    <div class="col-lg-4 mgh30">
                        <div class="flex-center flex-vertical help-item-container small">
                            <div class="divider-green"></div>
                            <p class="h3 text-center">INTERESTED IN OUR <br/>CUSTOM AND WHITELABEL <br/>SOLUTIONS?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection

