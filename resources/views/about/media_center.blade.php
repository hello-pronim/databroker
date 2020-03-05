@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!--- xd #79 -->
<div class="container-fluid app-wapper about media-center">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center mgb30">
            <div class="blog-header">
                <h1 class="h1-small mgt60">Media centre</h1>
            </div>          
            <div class="blog-content">
                <div class="press-list">
                    <div class="row">
                        @foreach ( $press_list as $press )
                        <div class="col-lg-6">
                            <div class="press-item-container gray-border flex-column justify-content-between">
                                <div>
                                    <p class="h3 text-left">{{ $press['title'] }}</p>
                                    <p class="para-small">{{ $press['text'] }}</p>
                                </div>
                                @if($press['link']!="")
                                <a href="{{ route($press['link']) }}">
                                    <button class="customize-btn button mgh15">{{ $press['action'] }}</button>
                                </a>
                                @else
                                <span>
                                    <button class="customize-btn button mgh15">{{ $press['action'] }}</button>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="">
                    <p class="h2 text-left mgt30">Databroker in the media</p>
                    <p class="para">Browse some of the media coverage we've received.</p>
                    <div class="partner-list">
                        <div class="row">
                        @foreach ( $partners as $partner )
                            @if($partner['link']!="")        
                            <a href="{{$partner['link']}}" target="_blank" class="col-lg-2 partner-cell-wrapper flex-vfill pd15">
                                <div class="partner-cell pl-25 pr-25 flex-vfill @if($partner['logo']=='') partner-cell-empty @endif">
                                    <div class="partner-logo" style="background-image: url('{{asset($partner['logo'])}}');"></div>
                                </div>
                            </a>
                            @else
                            <div class="col-lg-2 partner-cell-wrapper flex-vfill pd15">
                                <div class="partner-cell pl-25 pr-25 flex-vfill @if($partner['logo']=='') partner-cell-empty @endif">
                                    <div class="partner-logo" style="background-image: url('{{asset($partner['logo'])}}');"></div>
                                </div>
                            </div>
                            @endif
                        @endforeach
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

