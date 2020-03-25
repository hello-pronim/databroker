
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
                        <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                            <!-- <a href="{{ route('admin.usecases') }}" class="m-menu__link" id="usecase-sidebar"> -->
                                <span class="m-menu__link" id="usecase-sidebar">
                                    <i class="m-menu__link-icon"></i>
                                            Use cases
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                
                            <!-- </a> -->
                            <ul class="subsider_ul">
                                <li class="m-menu__sidebar"  aria-haspopup="true"><a href="{{ route('admin.usecases') }}" class="m-menu__link">Transport</a></li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">People</li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">Environment</li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">Agriculture</li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">Energy</li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">Economy</li>
                                <li class="m-menu__sidebar"  aria-haspopup="true">Supply Chain</li>
                            </ul>
                        </li>
                        <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                            <a href="{{ route('admin.updates') }}" class="m-menu__link" id="usecase-sidebar">
                                <i class="m-menu__link-icon"></i>
                                        Updates
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
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
        @yield('additional_javascript')
    </body>
</html>