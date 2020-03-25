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
            <div class="blog-header row">                
                <div class="col-md-8">
                    <h1 class="h1-small">{{trans('about.updates')}}</h1>
                </div>                
            </div>          
            <div class="blog-content">
                <div id="usecase-list" class="mgh30">
                    <div class="row">
                        @foreach ( $usecases as $usecase )
                        <div class="col-md-4">
                            <a href="{{ route('about.usecase_detail',  ['id' => $usecase['id']] ) }}">
                                <div class="card card-profile card-plain">                  
                                    <div class="card-header holder">        
                                        <img class="img" src="{{ asset('images/usecases/'.$usecase['image']) }}" />
                                        <div class="small-image-overlay"></div>
                                    </div>
                                    <div class="card-body text-left">
                                        <div class="para-small">
                                            <span class="color-green">{{ $usecase['category'] }}</span>
                                        </div>
                                        <h4 class="offer-title card-title">{{$usecase['title']}}</h4>
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
            <div class="h2">Don't miss any updates!</div>
            <div class="para mgb40">Sign up for our NewsBytes!</div>
            <a href="{{route('register_nl')}}"><button type="button" class="customize-btn button mgt15">SIGN UP</button></a>
        </div>
        <div class="section_splitor_gray h713"></div>
    </div>    
    <div class="container">
        <div class="app-section app-reveal-section align-items-center usecases">
            <div id="usecase-list2" class="mgh30">
                <div class="row">
                    @foreach ( $usecases2 as $usecase )
                    <div class="col-md-4">
                        <a href="{{ route('about.usecase_detail',  ['id' => $usecase['id']] ) }}">
                            <div class="card card-profile card-plain">                  
                                <div class="card-header holder">        
                                    <img class="img" src="{{ asset('images/usecases/'.$usecase['image']) }}" />
                                    <div class="small-image-overlay"></div>
                                </div>
                                <div class="card-body text-left">
                                    <div class="para-small">
                                        <span class="color-green">{{ $usecase['category'] }}</span>
                                    </div>
                                    <h4 class="offer-title card-title">{{$usecase['title']}}</h4>
                                </div>
                            </div>  
                        </a>
                    </div>  
                    @endforeach         
                </div>
            </div>
            <div class="flex-center">
                <button type="button" class="button blue-outline w225">LOAD MORE</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection

