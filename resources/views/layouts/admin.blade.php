
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="@yield('title')">
        <meta name="description" content="@yield('description')">

        <meta property="og:title" content="@yield('title')">
        <meta property="og:site_name" content="{{ config('app.name') }} ">
        <meta property="og:url" content="{{ config('app.url') }} ">
        <meta property="og:description" content="@yield('description')">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ config('app.url') }}/images/Databroker_social-share.jpg">

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logos/apple-icon.png') }}">

         <!--begin::Web font -->
            <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
            <script>
            WebFont.load({
                google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                },
                active: function() {
                sessionStorage.fonts = true;
                }
            });
            </script>
        <!--end::Web font -->

        <link href="{{ asset('adminpanel/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminpanel/css/admin.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('adminpanel/assets/demo/default/media/img/logo/logo.png') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
        @yield('additional_css')      
    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
                <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{{ route('admin.dashboard') }}" class="m-brand__logo-wrapper">
                            <img alt="" src="{{ asset('/images/logos/site_logo.png') }}" id="admin_logo"/>
                        </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>
                        <!-- END -->
                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->
                        </div>
                    </div>
                    </div>
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    </div>
                </div>
                </div>
            </header>
            <!-- END: Header -->
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->
                <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
                </button>
                <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
                    
                    <!-- BEGIN: Aside Menu -->
                    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
                        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                            <div class="sidebar_header">
                                <i class="fa fa-newspaper-o" style="font-size: 30px;"></i>
                                <!-- <img src="https://image.flaticon.com/icons/svg/1063/1063385.svg" width="24" height="24" alt="Cms free icon" title="Cms free icon"> -->
                                CMS
                            </div>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <span class="m-menu__link menu-home" id="usecase-sidebar">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                            Home
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                <ul class="subsider_ul menu-home" style="display: none;">
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.home_featured_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Featured Data</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.home_trending') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Trending</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.home_marketplace') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Marketplace</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.home_teampicks') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Team Pics</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.home_featured_provider') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Providers</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 6 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Top Usecases</a></li>
                                </ul>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                            About
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-group" aria-hidden="true"></i>
                                            Partners
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                            DataMatch
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                    <span class="m-menu__link menu-usecases" id="usecase-sidebar">
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                Use cases
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                    
                                <ul class="subsider_ul menu-usecases" style="display: none;">
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 1 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Geographics</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 2 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Environment</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 7 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Transport</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 3 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;People</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 5 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Agriculture</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 6 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Energy</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 8 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Economy</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 9 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Supply Chain</a></li>
                                </ul>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <span class="m-menu__link menu-help" id="usecase-sidebar">
                                    <i class="fa fa-deaf" aria-hidden="true"></i>
                                            Help 
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                <ul class="subsider_ul menu-help" style="display: none;">
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.help.faqs') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;FAQs</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.help.buying_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Buying data</a></li>
                                    <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.help.selling_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Selling data</a></li>
                                </ul>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a href="{{ route('admin.updates') }}" class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            Updates
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a href="{{ route('admin.media_library') }}" class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            Media
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a class="m-menu__link" id="usecase-sidebar">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            Contact us
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <div class="sidebar_header">
                                <i class="fa fa-user" style="font-size:30px;"></i>
                                Users
                            </div>
                            <div class="sidebar_header">
                                <a href="{{route('admin.logout')}}">
                                    <i class="fa fa-sign-out" style="font-size:30px" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </div>
                        </ul>
                    </div>
                    <!-- END: Aside Menu -->
                </div>
                <!-- END: Left Aside -->    
                <div id="admin_container">
                    @yield('content')
                </div>
            </div>
            <!-- end:: Body -->
        </div>
        <!-- end:: Page -->
        <script src="{{ asset('adminpanel/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('adminpanel/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
        <script>
            var prop_usecases = true;
            $('.m-menu__link.menu-usecases').click(function(){
                if(prop_usecases == true)
                {
                    $('.subsider_ul.menu-usecases').css('display', 'inherit');
                }
                else
                {
                    $('.subsider_ul.menu-usecases').css("display", "none");
                }
                prop_usecases = prop_usecases?false:true;
            });
            var prop_home = true;
            $('.m-menu__link.menu-home').click(function(){
                if(prop_home == true)
                {
                    $('.subsider_ul.menu-home').css('display','inherit');
                }
                else
                {
                    $('.subsider_ul.menu-home').css('display','none');
                }
                prop_home = prop_home?false:true;
            });
            var prop_help = true;
            $('.m-menu__link.menu-help').click(function(){
                if(prop_help == true)
                {
                    $('.subsider_ul.menu-help').css('display','inherit');
                }
                else
                {
                    $('.subsider_ul.menu-help').css('display','none');
                }
                prop_help = prop_help?false:true;
            })
            
        </script>
        @yield('additional_javascript')
    </body>
</html>