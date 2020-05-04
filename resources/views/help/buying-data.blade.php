@extends('layouts.app')

@section('title', 'Buying data | Databroker ')

@section('content')
<div class="container-fluid app-wapper help buying-data">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="h1-small">{{ $texts['title'] }}</h1>
                        <p class="para">{{ $texts['title-description'] }}</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="pull-right">
                            <p class="h3 text-right">Questions?</p>
                            <a href="{{ route('contact') }}"><button class="customize-btn">CONTACT US</button></a>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="blog-content">
                <div class="row mgb80">             
                    @foreach ( $topics as $topic )
                    <div class="col-lg-4 mgh30">
                        <a>
                            <div class="flex-center flex-vertical help-item-container small pd40">
                                <div class="divider-green"></div>
                                <p class="h3 text-center">{{$topic['title']}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @if(count($faqs) > 0)
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="flex-vertical flex-vcenter">
                            <div class="divider-green"></div>
                            <h2 class="h2">{{ $texts['section2'] }}</h2>
                            <div class="faq-list-container">
                                <div class="faq-list">
                                    @foreach ( $faqs as $faq )
                                    <div class="faq-entry flex-hcenter flex-vertical">
                                        <div class="flex-vcenter-justify">
                                            <div class="para question">{{ $faq['faq'] }}</div>
                                            <div class="dropdown-arrow"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 para-small description">{!! $faq['description'] !!}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>  
    </div>
</div>

@endsection

