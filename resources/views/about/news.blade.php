@extends('layouts.app')

@section('title', 'Databroker updates | Databroker')
@section('description', 'Read about the latest Databroker developments, updates, events and products. Sign up for our NewsBytes to get the latest updates straight in your inbox!')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div class="blog-header row">                
                <div class="col-md-8">
                    <h1 class="h1-small">Get inspired by real-life updates for data</h1>
                    <p class="fs-18">Looking for inspiration for how data can help supercharge your business? Browse our updates to discover practical and innovative ways that data can solve real-life challenges, lead to better decision-making and drive more strategic business moves.</p>
                </div>                
            </div>          
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-6 flex-vcenter mgh30 col-sm-12" id="usecase-whole">
                    </div>
                </div>
                <div id="usecase-list" class="mgh30">
                    <div class="row">
                        @foreach ( $updates as $update )
                        <div class="col-md-4">
                            <a href="{{ route('about.news_detail',  ['id' => $update->articleIdx] ) }}">
                                <div class="card card-profile card-plain">                  
                                    <div class="card-header holder" id="resposive-card-header">        
                                        <img class="img" src="{{ asset('uploads/usecases/tiny/'.$update->image) }}" id="responsive-card-img"/>
                                        <div class="small-image-overlay"></div>
                                    </div>
                                    <div class="card-body text-left">
                                        <div class="para-small">
                                            <span class="color-green"><b>- By&nbsp;{{ $update->author }}&nbsp;|&nbsp;{{ date_format($update->published,"F d, Y") }}</b></span>
                                        </div>
                                        <h4 class="offer-title card-title">{{ $update->articleTitle }}</h4>
                                    </div>
                                </div>  
                            </a>
                        </div>  
                        @endforeach         
                    </div>
                </div>
            </div>
        </div>  
    </div>  
    <div id="sub-footer" class="sub-footer mgh30">
        <div class="section_splitor_gray"></div>
        <div class="bg-pattern1-both flex-center flex-vertical">
            <div class="divider-green mgb30"></div>
            <div class="h2">Find out about new updates</div>
            <div class="para mgb40">Sign up for our NewsBytes!</div>
            <a href="{{route('register_nl')}}"><button type="button" class="customize-btn button mgt15">SIGN UP</button></a>
        </div>
        <div class="section_splitor_gray h713"></div>
    </div>    
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div id="usecase-list2" class="mgh30">
                <div class="row" id="load-data">
                    @foreach ( $updates2 as $update )
                    <div class="col-md-4">
                        <a href="{{ route('about.news_detail',  ['id' => $update->articleIdx] ) }}">
                            <div class="card card-profile card-plain">                  
                                <div class="card-header holder" id="resposive-card-header">        
                                    <img class="img" src="{{ asset('uploads/usecases/tiny/'.$update->image) }}" id="responsive-card-img"/>
                                    <div class="small-image-overlay"></div>
                                </div>
                                <div class="card-body text-left">
                                    <div class="para-small">
                                        <span class="color-green"><b>- By&nbsp;{{ $update->author }}&nbsp;|&nbsp;{{ date_format($update->published,"F d, Y") }}</b></span>
                                    </div>
                                    <h4 class="offer-title card-title">{{ $update->articleTitle }}</h4>
                                </div>
                            </div>  
                        </a>
                    </div>  
                    @endforeach         
                </div>
            </div>
            <div class="flex-center" id="remove-row">
                <button type="button" class="button blue-outline w225" id="btn-more" data-id="{{ $updates2[2]->published }}">LOAD MORE</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>   
    <script src="{{ asset('js/loadmore.js') }}"></script>     
@endsection

