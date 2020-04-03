@extends('layouts.app')

@section('title')
{{ $usecase[0]->meta_title }}
@stop
@section('description')
{{ $usecase[0]->meta_desc }}
@stop

@section('additional_css')
        <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('databroker/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('databroker/css/v4-shims.css') }}">
        <link rel="stylesheet" href="{{ asset('databroker/css/contact.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases detail">
            <div class="article-body">
                <div class="blog-header row">                
                    <div class="col-md-12">
                        <h1 class="h1-small" id="update_title">{{$usecase[0]->articleTitle}}</h1>
                        <p class="fs-18"><b>Published in</b>:&nbsp; <a href="{{ route('data_community.'.str_replace(' ', '_', strtolower($usecase[0]->community->communityName))) }}"><span class="h3" id="matchmaking-detail-category"><b>{{ $usecase[0]->community->communityName }}</b></span></a></p>
                    </div>                
                </div>  
                <br>
                <div class="row">
                        <div class="col-md-12 col-sm-12">
                                <div class="card card-profile card-plain">                  
                                    <div class="card-header holder">        
                                        <img class="img" src="{{ asset('uploads/usecases/'.$usecase[0]->image) }}"  id="news_detail_img"/>
                                    </div>
                                </div>  
                        </div>  
                </div>
                <div class="row">                
                        <div class="col-md-12" id="updates-article-content-sec">
                            {!! $usecase[0]->articleContent !!}
                        </div>                
                </div> 
            </div>
        </div>
    </div>
    <div id="sub-footer" class="sub-footer mgh30">
        <div class="section_splitor_gray"></div>
        <div class="bg-pattern1-both flex-center flex-vertical">
            <div class="divider-green mgb30"></div>
            <div class="h2">What business challenge can we help you solve?</div>
            <div class="para mgb40">Tell us, and we will match you up with the perfect data partner.</div>
            <a href="{{ route('contact') }}"><button type="button" class="customize-btn button mgt15">TRY OUR DATAMATCH SERVICE</button></a>
            <br/>
            <div class="para mgb40">It 's free.</div>
        </div>
        <div class="section_splitor_gray h713"></div>
    </div>    
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div id="usecase-list2" class="mgh30">
            <h1 class="fs-18"><b>More use cases to discover</b></h1>
                <div class="row">
                    @foreach ( $usecases2 as $usecase )
                    <div class="col-md-4">
                        <a href="{{ route('about.usecase_detail',  ['id' => $usecase->articleIdx] ) }}">
                            <div class="card card-profile card-plain">                  
                                <div class="card-header holder" id="resposive-card-header">        
                                    <img class="img" src="{{ asset('uploads/usecases/medium/'.$usecase->image) }}" id="responsive-card-img"/>
                                </div>
                                <div class="card-body text-left">
                                    <div class="para-small">
                                        <span class="color-green"><b>{{ $usecase->community->communityName }}</b></span>
                                    </div>
                                    <h4 class="offer-title card-title">{{ $usecase->articleTitle }}</h4>
                                </div>
                            </div>  
                        </a>
                    </div>  
                    @endforeach         
                </div>
            </div>
            <div class="flex-center">
                <a href="{{ route('about.usecase') }}"><button type="button" class="button blue-outline w225">LOAD MORE</button></a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>    
@endsection

