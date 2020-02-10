
<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.locale') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="@yield('title')">
        <meta name="description" content="@yield('description')">

        <meta property="og:title" content="@yield('title')">
        <meta property="og:site_name" content="DataBroker">
        <meta property="og:url" content="">
        <meta property="og:description" content="@yield('description')">
        <meta property="og:type" content="">
        <meta property="og:image" content="">

        <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline'; img-src 'self' https:; frame-src 'self' https:; connect-src 'self' https:;">
         -->
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="icon" type="image/png" href="{{ asset('images/logos/logo.png') }}" />
        <link rel="shortcut icon" href="{{ asset('images/logos/logo.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logos/apple-icon.png') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/v4-shims.css') }}">  

        @yield('additional_css')      

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">   
        <link rel="stylesheet" href="{{ asset('css/custom2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> 
        
    </head>
    <body>       
      <div class="auth" class="container-fluid app-wapper app-top-bar-container">
          <div class="app-top-bar align-items-center">
              <div class="row app-brand">
                    <a href="{{route('home') }}">
                        <img src="{{ asset('/images/logos/site_logo.png') }}" />                       
                    </a>
                </div>                                
              <div class="clear"></div>
          </div>
      </div>        

      @yield('content')
  		<div class="container-fluid app-wapper">
        <div class="section_splitor_green"></div>
        <div class="container footer_section1">
          <div class="row">
            <div class="col-md-4 col-lg-3">
              <h5>{{ trans('home.explore_data_communities') }}</h5>
              <ul class="list-unstyled" data-turbolinks="false"> 
                <li><a href="{{ route('data_community.geographics') }}">{{ trans('home.geographics') }}</a></li> 
                <li><a href="{{ route('data_community.environment') }}">{{ trans('home.environment') }}</a></li> 
                <li><a href="{{ route('data_community.transport') }}">{{ trans('home.transport') }}</a></li> 
                <li><a href="{{ route('data_community.people') }}">{{ trans('home.people') }}</a></li> 
                <li><a href="{{ route('data_community.agriculture') }}">{{ trans('home.agriculture') }}</a></li> 
                <li><a href="{{ route('data_community.energy') }}">{{ trans('home.energy') }}</a></li> 
                <li><a href="{{ route('data_community.economy') }}">{{ trans('home.economy') }}</a></li> 
                <li><a href="{{ route('data_community.supply_chain') }}">{{ trans('home.supply_chain') }}</a></li>                
              </ul>
            </div>
            <div class="col-md-4 col-lg-3">
              <h5>{{ trans('home.about_databroker') }}</h5>
              <ul class="list-unstyled" data-turbolinks="false"> 
                <li><a href="javascript:;">{{ trans('home.partners') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.datamatch') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.partners') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.usecase') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.updates') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.media_center') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.contact_us') }}</a></li> 
              </ul>
            </div>
            <div class="col-md-4 col-lg-3">
              <h5>{{ trans('home.helpsupport') }}</h5>
              <ul class="list-unstyled" data-turbolinks="false"> 
                <li><a href="javascript:;">{{ trans('home.buying_data') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.selling_data') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.privacy_security') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.our_gurantee') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.file_complaint') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.give_feedback') }}</a></li>                 
              </ul>
            </div>
            <div class="col-md-12 col-lg-3 footer-newsletter">
              <h5>{{ trans('home.signupbox') }}</h5>
              <p class="text-thick-grey fs-18"> {{ trans('home.signupbox_desc') }} </p>
              <a href="{{ route('register') }}"><button type="button" class="btn match-me-up-btn pure-material-button-outlined">{{ trans('home.signup') }}</button></a>

            </div>
          </div>

          <div class="app-section app-monetize-section align-items-center">
              <div class="app-monetize-section-item0"></div>
              <div class="app-monetize-section-item1">
                  <h1 class="fs-30">Databroker is supported by our trusted partners.</h1>                               
              </div>
          </div>
          <div class="app-partner-items row">
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/partner_1.png') }}">
                      </div>        
                </div>
              </div>
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/partner_2.png') }}">
                      </div>        
                </div>
              </div>
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/partner_3.png') }}">
                      </div>        
                </div>
              </div>
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/partner_4.png') }}">
                      </div>        
                </div>
              </div>
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/partner_5.png') }}">
                      </div>        
                </div>
              </div>
              <div class="col-md-4 col-lg-2">
                <div class="app-partner-item">
              <div class="img">
                <img src="{{ asset('images/europense.png') }}">
                      </div>        
                </div>
              </div>
            </div>    
            <div class="row">             
              <a class="m0-auto" href="{{ route('about.partners') }}">
                <button class="btn readmore-inourblog-btn pure-material-button-outlined">{{ trans('home.viewall_partners') }}</button>  
              </a>    
            </div>
        </div>
      </div>

        <div class="container-fluid app-wapper footer-section">
          <div class="container">
            <div class="app-section app-footer-section align-items-center">
              <div class="app-footer-link">
                      <!--a href="">Terms and Conditions</a-->
                      <a href="/terms-conditions">{{ trans('home.terms_conditions') }}</a>
                      <a href="/privacy-policy">{{ trans('home.privacy_policy') }}</a>
                      <a href="/cookie-policy" style="padding-right: 0;">{{ trans('home.cookie_policy') }}</a>
                  </div>
                  <div class="site_footer_logo_container">
                      <img src="{{ asset('/images/logos/site_footer_logo.png') }}">               
                  </div>
                  <div class="app-footer-social-link-container">
                      <h4>Follow us on social media</h4>
                      <div class="app-footer-social-link">
                          <a href="https://www.facebook.com/DataBroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/facebook.png') }}">
                          </a>
                          <a href="https://www.twitter.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/twitter.png') }}">
                          </a>
                          <a href="https://www.pinterest.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/pinterest.png') }}">
                          </a>
                          <a href="https://www.linkedin.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/linkedin.png') }}">
                          </a>   
                          <a href="https://www.linkedin.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/medium.png') }}">
                          </a>   
                          <a href="https://www.github.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/github.png') }}">
                          </a>   
                          <a href="https://www.telegram.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
                            <img src="{{ asset('/images/social/telegram.png') }}">
                          </a>                          
                      </div>
                  </div>                  
              </div>
          </div>            
        </div>
        <span class="et_pb_scroll_top et-pb-icon" title="TOP"></span>

    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>    
    <script src="{{ asset('js/plugins/jquery.cookie.js') }}"></script>    

    @yield('additional_javascript')

    <script src="{{ asset('js/app.js') }}"></script>        
    <script src="{{ asset('js/custom.js') }}"></script>   
    <script src="{{ asset('js/custom2.js') }}"></script>   

    
    <script type="text/javascript">
        $(function(){
            $(".close_button-container").click(function(){
                $(".cookie-accept").animate({ opacity: 0, bottom: "-160px" });
            });
            $(".cookie-accept .accept-btn").click(function(){
                $.cookie('databroker_cookie', (new Date()), { expires: 365, path: '/' });
                $(".cookie-accept").animate({ opacity: 0, bottom: "-160px" });
            })
            if(typeof $.cookie('databroker_cookie') == "undefined")
                $(".cookie-accept").animate({ opacity: 1, bottom: "0px" });           
        });
    </script>
    </body>
</html>