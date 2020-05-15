@php
    $menu_item_parent = request()->session()->get('menu_item_parent');
    $menu_item_child = request()->session()->get('menu_item_child');
    $menu_item_child_child = request()->session()->get('menu_item_child_child');
@endphp
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
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
                                <span class="m-menu__link menu-home {{$menu_item_parent=='home'?'active':''}}" id="usecase-sidebar">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                            Home
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                <ul class="subsider_ul menu-home {{$menu_item_parent=='home'?'':'hide'}}">
                                    <li class="m-menu__sidebar {{$menu_item_child=='home_featured_data'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.home_featured_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Featured Data</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='home_trending'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.home_trending') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Trending</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='home_marketplace'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.home_marketplace') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Marketplace</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='home_teampicks'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.home_teampicks') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Team Picks</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='home_featured_provider'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.home_featured_provider') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Providers</a></li>
                                    <!-- <li class="m-menu__sidebar {{$menu_item_child=='home_top_usecases'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 6 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Top use cases</a></li> -->
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
                                <span class="m-menu__link menu-usecases {{$menu_item_parent=='usecases'?'active':''}}" id="usecase-sidebar">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            Use cases
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                    
                                <ul class="subsider_ul menu-usecases {{$menu_item_parent=='usecases'?'':'hide'}}">
                                    <li class="m-menu__sidebar {{$menu_item_child==1?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 1 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Geographics</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==2?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 2 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Environment</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==7?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 7 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Transport</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==3?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 3 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;People</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==5?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 5 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Agriculture</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==6?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 6 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Energy</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==8?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 8 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Economy</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child==9?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.usecases', [ 'id' => 9 ]) }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Supply Chain</a></li>
                                </ul>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <span class="m-menu__link menu-help {{$menu_item_parent=='help'?'active':''}}" id="usecase-sidebar">
                                    <i class="fa fa-deaf" aria-hidden="true"></i>
                                            Help 
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                                <ul class="subsider_ul menu-help {{$menu_item_parent=='help'?'':'hide'}}">
                                    <li class="m-menu__sidebar m-menu__item m_menu-item--parent"  aria-haspopup="true">
                                        <span class="m-menu__link menu-sub-buying">
                                            <i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Buying data
                                        </span>
                                        <ul class="subsider_sub_ul menu-sub-buying {{$menu_item_child=='buying_data'?'':'hide'}}">
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='buying_title_intro'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.buying_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Title and intro</a></li>
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='buying_topics'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.buying_data_topics') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Content</a></li>
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='buying_faqs'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.buying_data_faqs') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;FAQs</a></li>
                                        </ul>
                                    </li>
                                    <li class="m-menu__sidebar m-menu__item m_menu-item--parent"  aria-haspopup="true">
                                        <span class="m-menu__link menu-sub-selling">
                                            <i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Selling data
                                        </span>
                                        <ul class="subsider_sub_ul menu-sub-selling {{$menu_item_child=='selling_data'?'':'hide'}}">
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='selling_title_intro'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.selling_data') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Title and intro</a></li>
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='selling_topics'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.selling_data_topics') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Content</a></li>
                                            <li class="m-menu__sidebar {{$menu_item_child_child=='selling_faqs'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.selling_data_faqs') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;FAQs</a></li>
                                        </ul>
                                    </li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='guarantee'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.guarantee') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Guarantee</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='complaint'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.complaint') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;File a complaint</a></li>
                                    <li class="m-menu__sidebar {{$menu_item_child=='feedback'?'active':''}}"  aria-haspopup="true"><a href="{{ route('admin.help.feedback') }}" class="m-menu__link"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Feedback</a></li>
                                </ul>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a href="{{ route('admin.updates') }}" class="m-menu__link {{$menu_item_parent=='updates'?'active':''}}" id="usecase-sidebar">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            Updates
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent"  aria-haspopup="true">
                                <a href="{{ route('admin.media_library') }}" class="m-menu__link {{$menu_item_parent=='media'?'active':''}}" id="usecase-sidebar">
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
                            <a href="{{ route('admin.users') }}" class="m-menu__link {{$menu_item_parent=='users'?'active':''}}">
                                <div class="sidebar_header">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Users
                                </div>
                            </a>
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
            $('.m-menu__link.menu-usecases').click(function(){
                    $('.m-menu__item.m-menu__item--parent .m-menu__link.active').removeClass('active');
                    $('.m-menu__link.menu-usecases').addClass('active');
                if($('.subsider_ul.menu-usecases').hasClass('hide')){
                    $('.subsider_ul.menu-usecases').removeClass('hide');
                }
                else
                    $('.subsider_ul.menu-usecases').addClass("hide");
            });
            $('.m-menu__link.menu-home').click(function(){
                $('.m-menu__item.m-menu__item--parent .m-menu__link.active').removeClass('active');
                $('.m-menu__link.menu-home').addClass('active');
                if($('.subsider_ul.menu-home').hasClass('hide')){
                    $('.subsider_ul.menu-home').removeClass('hide');
                }
                else
                    $('.subsider_ul.menu-home').addClass('hide');
            });
            $('.m-menu__link.menu-help').click(function(){
                $('.m-menu__item.m-menu__item--parent .m-menu__link.active').removeClass('active');
                $('.m-menu__link.menu-help').addClass('active');
                if($('.subsider_ul.menu-help').hasClass('hide'))
                    $('.subsider_ul.menu-help').removeClass('hide');
                else
                    $('.subsider_ul.menu-help').addClass('hide');
            });
            $('.m-menu__link.menu-sub-buying').click(function(){
                $('.m-menu__item.m-menu__item--parent .m-menu__link.active').removeClass('active');
                if($('.subsider_sub_ul.menu-sub-buying').hasClass('hide'))
                    $('.subsider_sub_ul.menu-sub-buying').removeClass('hide');
                else
                    $('.subsider_sub_ul.menu-sub-buying').addClass('hide');
            });
            $('.m-menu__link.menu-sub-selling').click(function(){
                $('.m-menu__item.m-menu__item--parent .m-menu__link.active').removeClass('active');
                if($('.subsider_sub_ul.menu-sub-selling').hasClass('hide'))
                    $('.subsider_sub_ul.menu-sub-selling').removeClass('hide');
                else
                    $('.subsider_sub_ul.menu-sub-selling').addClass('hide');
            });
        </script>
        @yield('additional_javascript')
    </body>
</html>