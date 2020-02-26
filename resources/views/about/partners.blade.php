@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper partners">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center">
            <div class="blog-header">
                <h1>Databroker partner network</h1>
                <div class="row">
                    <div class="col-lg-6 para">We are proud to work with a global network of trusted partners. Together we share the vision of transforming data into real business value, for both data buyers and sellers.</div>
                    <div class="col-lg-6 flex-end">
                        <div class="h4_intro text-right mgh30">Interested in teaming up with Databroker?</div>
                        <a href="{{route('contact')}}"><button class="button customize-btn pull-right">LET’S CONNECT</button></a>
                    </div>
                </div>
            </div>  
            <div class="divider-green mgt30"></div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-4 flex-vcenter mgh30">
                        <h3 class="text-bold">Technology partners</h3>
                    </div>
                </div>
                <div id="partner-list" class="mgh30">
                    <div class="row">
                        @foreach ( $partners as $partner )
                        <div class="col-lg-2 partner-cell-wrapper flex-vfill pd15">
                            <div class="partner-cell pd25 flex-vfill">
                                <div class="partner-logo" style="background-image: url('{{asset($partner['logo'])}}');"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  
    </div>  
    <div id="sub-footer" class="sub-footer mgh60 container-fluid">
        <div class="section_splitor_gray"></div>
        <div class="bg-pattern1-both blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pd15 blog-cell-wrapper">
                        <div class="blog-cell pd40 flex-center flex-vertical">
                            <div class="double-quote mgb25"></div>
                            <div class="h4_intro text-center">"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."</div>
                            <div class="h4_intro color-gray4 mg40">Name, role, company</div>
                        </div>
                    </div>
                    <div class="col-lg-6 pd15 blog-cell-wrapper">
                        <div class="blog-cell pd40 flex-center flex-vertical">
                            <div class="double-quote mgb25"></div>
                            <div class="h4_intro text-center">"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."</div>
                            <div class="h4_intro color-gray4 mg40">Name, role, company</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_splitor_gray h713"></div>
    </div>    
    <div class="container">
        <div class="app-section align-items-center">
            <h3 class="text-bold">Integrators & resellers</h3>
        </div>
        <div id="partner-list2" class="">
            <div class="row">
                @foreach ( $resellers as $reseller )
                <div class="col-lg-2 partner-cell-wrapper flex-vfill pd15">
                    <div class="partner-cell pd25 flex-vfill">
                        <div class="partner-logo" style="background-image: url('{{asset($reseller['logo'])}}');"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
     <div id="sub-footer2" class="sub-footer mgt60 container-fluid">
        <div class="section_splitor_gray"></div>
        <div class="bg-pattern1-both blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pd15 blog-cell-wrapper">
                        <div class="blog-cell pd40 flex-center flex-vertical">
                            <div class="double-quote mgb25"></div>
                            <div class="h4_intro text-center">"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."</div>
                            <div class="h4_intro color-gray4 mg40">Name, role, company</div>
                        </div>
                    </div>
                    <div class="col-lg-6 pd15 blog-cell-wrapper">
                        <div class="blog-cell pd40 flex-center flex-vertical">
                            <div class="double-quote mgb25"></div>
                            <div class="h4_intro text-center">"Here comes a quote of a dataprovider, illustrating the value. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet."</div>
                            <div class="h4_intro color-gray4 mg40">Name, role, company</div>
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

