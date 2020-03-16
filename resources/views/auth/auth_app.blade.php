
<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.locale') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="DataBroker">
        <meta name="description" content="">

        <meta property="og:title" content="">
        <meta property="og:site_name" content="DataBroker">
        <meta property="og:url" content="">
        <meta property="og:description" content="">
        <meta property="og:type" content="">
        <meta property="og:image" content="">

        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline'; img-src 'self' https:; frame-src 'self' https:; connect-src 'self' https:;">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="icon" type="image/png" href="{{ asset('images/logos/logo.png') }}" />
        <link rel="shortcut icon" href="{{ asset('images/logos/logo.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logos/apple-icon.png') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">

        @yield('additional_css')

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/v4-shims.css') }}">        
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">      
        <link rel="stylesheet" href="{{ asset('css/custom2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        
    </head>
    <body>       
      <div id="auth" class="container-fluid app-wapper app-top-bar-container">
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
              <h5>{{ trans('home.more') }}</h5>
              <ul class="list-unstyled" data-turbolinks="false"> 
                <li><a href="{{ route('about.about') }}">{{ trans('home.about_databroker') }}</a></li> 
                <li><a href="{{ route('about.partners') }}">{{ trans('home.partners') }}</a></li> 
                <li><a href="{{ route('about.matchmaking') }}">{{ trans('home.datamatch') }}</a></li>  
                <li><a href="{{ route('about.usecase') }}">{{ trans('home.usecase') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.updates') }}</a></li> 
                <li><a href="{{ route('about.media_center') }}">{{ trans('home.media_center') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.contact_us') }}</a></li> 
              </ul>
            </div>
            <div class="col-md-4 col-lg-3">
              <h5>{{ trans('home.helpsupport') }}</h5>
              <ul class="list-unstyled" data-turbolinks="false"> 
                <li><a href="javascript:;">{{ trans('home.buying_data') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.selling_data') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.privacy_security') }}</a></li> 
                <li><a href="{{ route('about.privacy_policy') }}">{{ trans('home.our_gurantee') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.file_complaint') }}</a></li> 
                <li><a href="javascript:;">{{ trans('home.give_feedback') }}</a></li>                 
              </ul>
            </div>
            <div class="col-md-12 col-lg-3 footer-newsletter">
              <h5>{{ trans('home.signupbox') }}</h5>
              <p class="text-thick-grey fs-18"> {{ trans('home.signupbox_desc') }} </p>
              <a href="{{ route('register_nl') }}"><button type="button" class="button customize-btn mgh25 w225">{{ trans('home.signup') }}</button></a>

            </div>
          </div>

          <div class="app-section app-monetize-section align-items-center">
              <div class="app-monetize-section-item0"></div>
              <div class="app-monetize-section-item1">
                  <h1 class="fs-30">We’re proud to partner with</h1>                               
              </div>
          </div>
          <div class="app-partner-items row">
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
                </div>        
              </div>
            </div>
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
                </div>        
              </div>
            </div>
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
                </div>        
              </div>
            </div>
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
                </div>        
              </div>
            </div>
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
                </div>        
              </div>
            </div>
            <div class="col-md-4 col-lg-2">
              <div class="app-partner-item">
                <div class="img">
                  <img src="{{ asset('images/blogs/logo_def.jpg') }}">
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
          <div class="container" id="footer-section-container">
            <div class="app-section app-footer-section align-items-center">
              <div class="app-footer-link">
                      <!--a href="">Terms and Conditions</a-->
                      <a href="{{route('about.terms_conditions')}}" target="_blank">{{ trans('home.terms_conditions') }}</a>
                      <a href="{{route('about.privacy_policy')}}" target="_blank">{{ trans('home.privacy_policy') }}</a>
                      <a href="{{route('about.cookie_policy')}}" target="_blank" style="padding-right: 0;">{{ trans('home.cookie_policy') }}</a>
                  </div>
                  <div class="site_footer_logo_container">
                      <img src="{{ asset('/images/logos/site_footer_logo.png') }}">               
                  </div>
                  <div class="app-footer-social-link-container">                      
                      <h4>Follow us on social media</h4>
                      <div class="app-footer-social-link">
                        <a href="https://www.facebook.com/Databroker.global/" rel="nofollow noopener noreferrer" target="_blank">
                          <img src="{{ asset('/images/social/facebook.png') }}">
                        </a>
                        <a href="https://twitter.com/databroker_gl" rel="nofollow noopener noreferrer" target="_blank">
                          <img src="{{ asset('/images/social/twitter.png') }}">
                        </a>
                        <a href="https://www.reddit.com/r/DatabrokerDAO/" rel="nofollow noopener noreferrer" target="_blank">
                          <!-- <i class="fa fa-reddit fa-3x"></i> -->
                          <img src="{{ asset('/images/social/reddit.png') }}">
                        </a>
                        <a href="https://www.linkedin.com/company/databroker-global/" rel="nofollow noopener noreferrer" target="_blank">
                          <img src="{{ asset('/images/social/linkedin.png') }}">
                        </a>                           
                        <a href="https://t.me/databrokerdao" rel="nofollow noopener noreferrer" target="_blank">
                          <img src="{{ asset('/images/social/telegram.png') }}">
                        </a>  
                        <a href="https://www.youtube.com/channel/UCUmxSlaliIuF0Z3yNw8y_uA/featured" rel="nofollow noopener noreferrer" target="_blank">
                          <img src="{{ asset('/images/social/youtube.png') }}">                         
                    </div>
                  </div>                  
              </div>
          </div>            
        </div>
        <span class="et_pb_scroll_top et-pb-icon" title="TOP"></span>

    <script src="{{ asset('js/core/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>    
    <script src="{{ asset('js/plugins/jquery.cookie.js') }}"></script>
    
    @yield('additional_javascript')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom2.js') }}"></script>
        
    <script type="text/javascript">
        $(function(){
            $(".close_button-container").click(function(){
                $(".cookie-accept").animate({ opacity: 0, bottom: "-160px", display: 'none' });
                $(".cookie-accept").css('display', 'none');
            });
            $(".cookie-accept .accept-btn").click(function(){
                $.cookie('databroker_cookie', (new Date()), { expires: 365, path: '/' });
                $(".cookie-accept").animate({ opacity: 0, bottom: "-160px", display: 'none' });
                $(".cookie-accept").css('display', 'none');
            })
            if(typeof $.cookie('databroker_cookie') == "undefined")
                $(".cookie-accept").animate({ opacity: 1, bottom: "0px" });
            else $(".cookie-accept").css('display', 'none');
            $('.dropdown-container .dropdown').click(function () {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-menu').slideToggle(300);    
            });
            $('.dropdown-container .dropdown').focusout(function () {
                $(this).removeClass('active');
                $('.dropdown-container .dropdown-menu').slideUp(300);
            });
            if($('#businessName2').val()=='Other industry') $(".other-industry").css('display', 'block'); //other industry
            else $(".other-industry").css('display', 'none');
            $('#businessName2').change(function () {
                if($(this).val()=='Other industry') $(".other-industry").css('display', 'block'); //other industry
                else $(".other-industry").css('display', 'none');
            });

            if($('#role2').val()=='Other') $(".other-role").css('display', 'block'); //other industry
            else $(".other-role").css('display', 'none');
            $('#role2').change(function () {
                if($(this).val()=='Other') $(".other-role").css('display', 'block'); //other role
                else $(".other-role").css('display', 'none');
            });

            if($('form .is-invalid').length>0)
              $('html, body').scrollTop($("form .is-invalid:first-child").offset().top-30);  
        });
    </script>
    </body>
</html>

