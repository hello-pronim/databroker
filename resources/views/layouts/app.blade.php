
<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.locale') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="{{ trans('data.meta_title') }}">
        <meta name="description" content="{{ trans('data.meta_desc') }}">

        <meta property="og:title" content="">
        <meta property="og:site_name" content="DataBroker">
        <meta property="og:url" content="">
        <meta property="og:description" content="">
        <meta property="og:type" content="">
        <meta property="og:image" content="">

        <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline'; img-src 'self' https:; frame-src 'self' https:; connect-src 'self' https:;"> -->
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="icon" type="image/png" href="{{ asset('images/logos/logo.png') }}" />
        <link rel="shortcut icon" href="{{ asset('images/logos/logo.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logos/apple-icon.png') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">        
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/v4-shims.css') }}">    

        @yield('additional_css')

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        
    </head>
    <body>
        <nav class="fixed_bg">
        	<div class="navbar navbar-expand-lg app-top-nav-bar-container">
        		<div class="container">        		
  	    			<ul class="navbar-nav left">
  	        		<li class="nav-item"><a class="nav-link" href="{{ route('data_offer_publish') }}">{{ trans('home.publish_data_offer') }}</a></li>
  	        		<li class="nav-item dropdown">
  	        			<a class="nav-link dropdown-toggle" id="more_dropdown" data-toggle="dropdown" aaria-haspopup="true" aria-expanded="false">{{ trans('home.more') }}</a>
  	        			<div class="dropdown-menu" aria-labelledby="more_dropdown">
  	        				<a class="dropdown-item" href="{{ route('about.about') }}"> {{ trans('home.about_databroker') }} </a>
                    <a class="dropdown-item" href="{{ route('about.partners') }}"> {{ trans('home.partners') }} </a>
                    <a class="dropdown-item" href="{{ route('about.matchmaking') }}"> {{ trans('home.datamatch') }} </a>
                    <a class="dropdown-item" href="{{ route('about.usecase') }}"> {{ trans('home.usecase') }} </a>
                    <a class="dropdown-item" href="{{ route('help.overview') }}"> {{ trans('home.helpsupport') }} </a>
                    <a class="dropdown-item" href="javascript:;"> {{ trans('home.news') }} </a>
                    <a class="dropdown-item" href="javascript:;"> {{ trans('home.media_center') }} </a>
  	        				<a class="dropdown-item" href="javascript:;"> {{ trans('home.contact_us') }} </a>
  	        			</div>
  	        		</li>
  	        	</ul>	
  	        	<ul class="navbar-nav right">			        		
  	        		<li class="nav-item dropdown">
  	        			<a class="nav-link dropdown-toggle" id="account_dropdown" data-toggle="dropdown" aaria-haspopup="true" aria-expanded="false"><i class="icon material-icons mdl-badge" data-badge="!">person</i>{{ trans('home.account') }}</a>
  	        			<div class="dropdown-menu" aria-labelledby="account_dropdown">
  	        				<h4> {{ Auth::user()->firstname. ' '. Auth::user()->lastname }} </h4>
  	        				<a class="dropdown-item" href="{{ route('account.profile') }}"> {{ trans('home.profile_account_info') }} </a>
  	        				<!-- <a class="dropdown-item" href="{{ route('account.wallet') }}"> {{ trans('home.wallet') }} </a> -->
  	        				<div class="dropdown-divider"></div>
  	        				<h5> {{ trans('home.me_buyer') }} </h5>
  	        				<a class="dropdown-item" href="{{ route('profile.bids') }}"> {{ trans('home.bids') }} </a>
  	        				<a class="dropdown-item" href="{{ route('account.purchases') }}"> {{ trans('home.purchases') }} </a>
  	        				<div class="dropdown-divider"></div>
  	        				<h5> {{ trans('home.me_seller') }} </h5>
  	        				<a class="dropdown-item" href="{{ route('account.company') }}"> {{ trans('home.company_profile') }} </a>
  	        				<a class="dropdown-item" href="{{ route('data_offers_overview' )}}"> {{ trans('home.data_offers') }} </a>
  	        				<div class="dropdown-divider"></div>
  	        				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"> {{ trans('home.signout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
  	        			</div>
  	        		</li>
  	        	</ul>		    
	        	</div>     	
        	</div>        	   	
        </nav>
        <div class="container-fluid app-wapper app-top-bar-container">
            <div class="app-top-bar align-items-center">
                <div class="row app-brand">
                    <a href="/">
                        <svg id="logo-black" xmlns="http://www.w3.org/2000/svg" width="525.314" height="90.848" viewBox="0 0 525.314 90.848">
                          <path id="Path_7836" data-name="Path 7836" d="M207.345,445.195v5.323a1.338,1.338,0,0,0,1.388,1.515h1.11v1.726H208.3a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-95.181 -367.715)" fill="#020a09"></path>
                          <path id="Path_7837" data-name="Path 7837" d="M218.466,448.047v6.211h-2.093v-5.9c0-1.968-1.032-2.643-2.324-2.643a2.383,2.383,0,0,0-2.459,2.662v5.883h-2.1V439.444h2.1V445.5a3.476,3.476,0,0,1,3.067-1.648c2.217,0,3.81,1.408,3.81,4.2" transform="translate(-92.85 -368.214)" fill="#020a09"></path>
                          <path id="Path_7838" data-name="Path 7838" d="M227.979,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609A5.165,5.165,0,0,1,228,447.795Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-89.775 -366.978)" fill="#020a09"></path>
                          <path id="Path_7839" data-name="Path 7839" d="M245.052,446.037v6.983H242.91v-6.308c0-1.591-.868-2.209-1.929-2.209-1.214,0-2.035.8-2.035,2.287v6.23H236.8v-6.308c0-1.591-.858-2.209-1.928-2.209-1.225,0-2.025.8-2.025,2.287v6.23H230.69V442.805h2.152v1.427a3.253,3.253,0,0,1,2.893-1.621,2.906,2.906,0,0,1,2.835,1.621,3.475,3.475,0,0,1,3.01-1.621,3.269,3.269,0,0,1,3.472,3.425" transform="translate(-84.559 -366.975)" fill="#020a09"></path>
                          <path id="Path_7840" data-name="Path 7840" d="M242.441,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02H251.17v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-79.964 -366.975)" fill="#020a09"></path>
                          <path id="Path_7841" data-name="Path 7841" d="M257.957,442.682v2.055c-2.084,0-3.482.762-3.482,3.019v5.237h-2.152V442.778h2.093v1.814a4.136,4.136,0,0,1,3.54-1.91" transform="translate(-76.1 -366.948)" fill="#020a09"></path>
                          <path id="Path_7842" data-name="Path 7842" d="M264.278,454.258l-4.608-5.073v5.073h-2.151V439.444h2.151v9.008l4.041-4.408h2.71l-4.486,4.707,5.143,5.507Z" transform="translate(-74.068 -368.214)" fill="#020a09"></path>
                          <path id="Path_7843" data-name="Path 7843" d="M275.018,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-71.382 -366.978)" fill="#020a09"></path>
                          <path id="Path_7844" data-name="Path 7844" d="M276.314,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726h-1.543a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-68.213 -367.715)" fill="#020a09"></path>
                          <path id="Path_7845" data-name="Path 7845" d="M278.456,442.805h2.151v1.5a4.552,4.552,0,0,1,3.674-1.689,5.306,5.306,0,0,1,0,10.6,4.541,4.541,0,0,1-3.674-1.679v6.289h-2.151Zm8.738,5.112a3.366,3.366,0,1,0-3.366,3.405,3.334,3.334,0,0,0,3.366-3.405" transform="translate(-65.881 -366.975)" fill="#020a09"></path>
                          <rect id="Rectangle_2299" data-name="Rectangle 2299" width="2.152" height="14.814" transform="translate(225.603 71.23)" fill="#020a09"></rect>
                          <path id="Path_7846" data-name="Path 7846" d="M290.918,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486H301.8V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.367,3.367,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-61.008 -366.975)" fill="#020a09"></path>
                          <path id="Path_7847" data-name="Path 7847" d="M300.26,447.908a5.3,5.3,0,0,1,5.46-5.3,5.477,5.477,0,0,1,4.368,2.084l-1.611,1.292a3.24,3.24,0,0,0-2.767-1.447,3.366,3.366,0,1,0,0,6.733,3.248,3.248,0,0,0,2.767-1.456l1.611,1.292a5.477,5.477,0,0,1-4.368,2.084,5.293,5.293,0,0,1-5.46-5.286" transform="translate(-57.355 -366.975)" fill="#020a09"></path>
                          <path id="Path_7848" data-name="Path 7848" d="M318.561,448.219h-8.555a3.289,3.289,0,0,0,3.338,3.2,3.331,3.331,0,0,0,2.882-1.582l1.746.743a5.086,5.086,0,0,1-4.62,2.633,5.305,5.305,0,1,1-.049-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-54.355 -366.978)" fill="#020a09"></path>
                          <path id="Path_7849" data-name="Path 7849" d="M326.709,445.748h-2.519v8.565H322.04v-8.565h-1.669V444.1h1.669v-1.486c0-2.121,1.138-3.308,3.085-3.308a5.656,5.656,0,0,1,1.562.242v1.764a3.126,3.126,0,0,0-1.079-.221c-.868,0-1.419.54-1.419,1.591V444.1h2.519Z" transform="translate(-49.492 -368.268)" fill="#020a09"></path>
                          <path id="Path_7850" data-name="Path 7850" d="M325.358,447.908a5.462,5.462,0,1,1,5.46,5.305,5.3,5.3,0,0,1-5.46-5.305m8.826,0a3.371,3.371,0,1,0-3.376,3.376,3.341,3.341,0,0,0,3.376-3.376" transform="translate(-47.542 -366.975)" fill="#020a09"></path>
                          <path id="Path_7851" data-name="Path 7851" d="M340.36,442.682v2.055c-2.082,0-3.482.762-3.482,3.019v5.237h-2.15V442.778h2.093v1.814a4.135,4.135,0,0,1,3.539-1.91" transform="translate(-43.878 -366.948)" fill="#020a09"></path>
                          <path id="Path_7852" data-name="Path 7852" d="M343.612,449.137a5.186,5.186,0,0,1,5.044-5.314,4.546,4.546,0,0,1,3.685,1.707l.01-6.086h2.141v14.814h-2.151v-1.486a4.548,4.548,0,0,1-3.685,1.689,5.19,5.19,0,0,1-5.044-5.325m8.873,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-40.404 -368.214)" fill="#020a09"></path>
                          <path id="Path_7853" data-name="Path 7853" d="M352.987,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-36.738 -366.975)" fill="#020a09"></path>
                          <path id="Path_7854" data-name="Path 7854" d="M365.784,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726H366.74a2.8,2.8,0,0,1-3.106-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.151v2.825H368.3v1.65Z" transform="translate(-33.227 -367.715)" fill="#020a09"></path>
                          <path id="Path_7855" data-name="Path 7855" d="M367.163,447.9a5.162,5.162,0,0,1,5.045-5.286,4.547,4.547,0,0,1,3.695,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.541,4.541,0,0,1-3.685,1.679,5.182,5.182,0,0,1-5.045-5.315m8.875,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-31.195 -366.975)" fill="#020a09"></path>
                          <path id="Path_7856" data-name="Path 7856" d="M238.535,388.237l-.01,21.81a21.994,21.994,0,1,0,8.7,17.521V388.241ZM225.23,441.281a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-95.295 -388.237)" fill="#020a09"></path>
                          <path id="Path_7857" data-name="Path 7857" d="M274.169,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.248h8.777l.021-41.4Zm-13.305,34.344a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-81.361 -383.364)" fill="#020a09"></path>
                          <path id="Path_7858" data-name="Path 7858" d="M330.006,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.249l8.777,0,.021-41.405ZM316.7,436.408a13.715,13.715,0,1,1,13.714-13.714A13.714,13.714,0,0,1,316.7,436.408" transform="translate(-59.527 -383.364)" fill="#020a09"></path>
                          <path id="Path_7859" data-name="Path 7859" d="M300.168,413.619v-6.687H290.026l.006-18.693h-8.779l-.006,18.693h-6.77v6.687h6.767l-.011,24.1a10.618,10.618,0,0,0,10.618,10.623h8.238v-6.958h-4.767a5.311,5.311,0,0,1-5.311-5.312l.013-22.45Z" transform="translate(-67.437 -388.236)" fill="#020a09"></path>
                          <path id="Path_7860" data-name="Path 7860" d="M449.9,448.318h11.719l-20.331-22.58,18.829-20.192H448.2l-16.8,18.012-.018-35.319H422.68l.029,60.08h8.711l-.01-20.531Z" transform="translate(-9.486 -388.237)" fill="#020a09"></path>
                          <path id="Path_7861" data-name="Path 7861" d="M408.569,400.7a21.995,21.995,0,1,0,22,21.995,22,22,0,0,0-22-21.995m0,35.709a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-23.605 -383.364)" fill="#020a09"></path>
                          <path id="Path_7862" data-name="Path 7862" d="M377.5,408.394l0-6.6-8.886,0L368.6,443.2l8.884,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(-30.634 -383.091)" fill="#020a09"></path>
                          <path id="Path_7863" data-name="Path 7863" d="M495.763,408.394l0-6.6-8.886,0L486.86,443.2l8.885,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(15.609 -383.091)" fill="#020a09"></path>
                          <path id="Path_7864" data-name="Path 7864" d="M331.953,388.24v39.328a22,22,0,1,0,8.7-17.521l-.011-21.807Zm8.279,39.326a13.715,13.715,0,1,1,13.714,13.714,13.715,13.715,0,0,1-13.714-13.714" transform="translate(-44.963 -388.236)" fill="#020a09"></path>
                          <path id="Path_7865" data-name="Path 7865" d="M494.158,422.694a22,22,0,1,0-2.961,11.018l-7.734-3.252a13.709,13.709,0,0,1-24.949-6.468l35.6.018c.026-.435.043-.874.043-1.316M472.163,408.98a13.688,13.688,0,0,1,12.354,7.809H459.808a13.69,13.69,0,0,1,12.355-7.809" transform="translate(1.262 -383.364)" fill="#020a09"></path>
                          <path id="Path_7866" data-name="Path 7866" d="M151.875,411.614a14.475,14.475,0,1,0,20.273,2.849,14.476,14.476,0,0,0-20.273-2.849" transform="translate(-117.631 -380.236)" fill="#78e6d0"></path>
                          <path id="Path_7867" data-name="Path 7867" d="M154.616,412.637h0l0,0a23.216,23.216,0,0,1,37.188,18.5l19.726-14.88.013.017V388.237h-85.91V434.5Z" transform="translate(-125.637 -388.237)" fill="#78e6d0"></path>
                          <path id="Path_7868" data-name="Path 7868" d="M182.565,438.581a23.215,23.215,0,0,1-37.188-18.5l-19.726,14.88-.014-.017v28.07h85.91V416.718Z" transform="translate(-125.637 -377.1)" fill="#78e6d0"></path>
                        </svg>                        
                    </a>
                </div>                
                <div class="clear"></div>
            </div>
        </div>
        <div class="container-fluid app-nav-bar-container">
        	<nav class="navbar bg-white navbar-expand-lg" id="main_menu">
  			    <div class="container">
              <div class="row app-brand">
          			<a href="/">
                  <svg id="logo-black" xmlns="http://www.w3.org/2000/svg" width="525.314" height="90.848" viewBox="0 0 525.314 90.848">
                    <path id="Path_7836" data-name="Path 7836" d="M207.345,445.195v5.323a1.338,1.338,0,0,0,1.388,1.515h1.11v1.726H208.3a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-95.181 -367.715)" fill="#020a09"></path>
                    <path id="Path_7837" data-name="Path 7837" d="M218.466,448.047v6.211h-2.093v-5.9c0-1.968-1.032-2.643-2.324-2.643a2.383,2.383,0,0,0-2.459,2.662v5.883h-2.1V439.444h2.1V445.5a3.476,3.476,0,0,1,3.067-1.648c2.217,0,3.81,1.408,3.81,4.2" transform="translate(-92.85 -368.214)" fill="#020a09"></path>
                    <path id="Path_7838" data-name="Path 7838" d="M227.979,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609A5.165,5.165,0,0,1,228,447.795Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-89.775 -366.978)" fill="#020a09"></path>
                    <path id="Path_7839" data-name="Path 7839" d="M245.052,446.037v6.983H242.91v-6.308c0-1.591-.868-2.209-1.929-2.209-1.214,0-2.035.8-2.035,2.287v6.23H236.8v-6.308c0-1.591-.858-2.209-1.928-2.209-1.225,0-2.025.8-2.025,2.287v6.23H230.69V442.805h2.152v1.427a3.253,3.253,0,0,1,2.893-1.621,2.906,2.906,0,0,1,2.835,1.621,3.475,3.475,0,0,1,3.01-1.621,3.269,3.269,0,0,1,3.472,3.425" transform="translate(-84.559 -366.975)" fill="#020a09"></path>
                    <path id="Path_7840" data-name="Path 7840" d="M242.441,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02H251.17v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-79.964 -366.975)" fill="#020a09"></path>
                    <path id="Path_7841" data-name="Path 7841" d="M257.957,442.682v2.055c-2.084,0-3.482.762-3.482,3.019v5.237h-2.152V442.778h2.093v1.814a4.136,4.136,0,0,1,3.54-1.91" transform="translate(-76.1 -366.948)" fill="#020a09"></path>
                    <path id="Path_7842" data-name="Path 7842" d="M264.278,454.258l-4.608-5.073v5.073h-2.151V439.444h2.151v9.008l4.041-4.408h2.71l-4.486,4.707,5.143,5.507Z" transform="translate(-74.068 -368.214)" fill="#020a09"></path>
                    <path id="Path_7843" data-name="Path 7843" d="M275.018,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-71.382 -366.978)" fill="#020a09"></path>
                    <path id="Path_7844" data-name="Path 7844" d="M276.314,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726h-1.543a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-68.213 -367.715)" fill="#020a09"></path>
                    <path id="Path_7845" data-name="Path 7845" d="M278.456,442.805h2.151v1.5a4.552,4.552,0,0,1,3.674-1.689,5.306,5.306,0,0,1,0,10.6,4.541,4.541,0,0,1-3.674-1.679v6.289h-2.151Zm8.738,5.112a3.366,3.366,0,1,0-3.366,3.405,3.334,3.334,0,0,0,3.366-3.405" transform="translate(-65.881 -366.975)" fill="#020a09"></path>
                    <rect id="Rectangle_2299" data-name="Rectangle 2299" width="2.152" height="14.814" transform="translate(225.603 71.23)" fill="#020a09"></rect>
                    <path id="Path_7846" data-name="Path 7846" d="M290.918,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486H301.8V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.367,3.367,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-61.008 -366.975)" fill="#020a09"></path>
                    <path id="Path_7847" data-name="Path 7847" d="M300.26,447.908a5.3,5.3,0,0,1,5.46-5.3,5.477,5.477,0,0,1,4.368,2.084l-1.611,1.292a3.24,3.24,0,0,0-2.767-1.447,3.366,3.366,0,1,0,0,6.733,3.248,3.248,0,0,0,2.767-1.456l1.611,1.292a5.477,5.477,0,0,1-4.368,2.084,5.293,5.293,0,0,1-5.46-5.286" transform="translate(-57.355 -366.975)" fill="#020a09"></path>
                    <path id="Path_7848" data-name="Path 7848" d="M318.561,448.219h-8.555a3.289,3.289,0,0,0,3.338,3.2,3.331,3.331,0,0,0,2.882-1.582l1.746.743a5.086,5.086,0,0,1-4.62,2.633,5.305,5.305,0,1,1-.049-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-54.355 -366.978)" fill="#020a09"></path>
                    <path id="Path_7849" data-name="Path 7849" d="M326.709,445.748h-2.519v8.565H322.04v-8.565h-1.669V444.1h1.669v-1.486c0-2.121,1.138-3.308,3.085-3.308a5.656,5.656,0,0,1,1.562.242v1.764a3.126,3.126,0,0,0-1.079-.221c-.868,0-1.419.54-1.419,1.591V444.1h2.519Z" transform="translate(-49.492 -368.268)" fill="#020a09"></path>
                    <path id="Path_7850" data-name="Path 7850" d="M325.358,447.908a5.462,5.462,0,1,1,5.46,5.305,5.3,5.3,0,0,1-5.46-5.305m8.826,0a3.371,3.371,0,1,0-3.376,3.376,3.341,3.341,0,0,0,3.376-3.376" transform="translate(-47.542 -366.975)" fill="#020a09"></path>
                    <path id="Path_7851" data-name="Path 7851" d="M340.36,442.682v2.055c-2.082,0-3.482.762-3.482,3.019v5.237h-2.15V442.778h2.093v1.814a4.135,4.135,0,0,1,3.539-1.91" transform="translate(-43.878 -366.948)" fill="#020a09"></path>
                    <path id="Path_7852" data-name="Path 7852" d="M343.612,449.137a5.186,5.186,0,0,1,5.044-5.314,4.546,4.546,0,0,1,3.685,1.707l.01-6.086h2.141v14.814h-2.151v-1.486a4.548,4.548,0,0,1-3.685,1.689,5.19,5.19,0,0,1-5.044-5.325m8.873,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-40.404 -368.214)" fill="#020a09"></path>
                    <path id="Path_7853" data-name="Path 7853" d="M352.987,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-36.738 -366.975)" fill="#020a09"></path>
                    <path id="Path_7854" data-name="Path 7854" d="M365.784,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726H366.74a2.8,2.8,0,0,1-3.106-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.151v2.825H368.3v1.65Z" transform="translate(-33.227 -367.715)" fill="#020a09"></path>
                    <path id="Path_7855" data-name="Path 7855" d="M367.163,447.9a5.162,5.162,0,0,1,5.045-5.286,4.547,4.547,0,0,1,3.695,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.541,4.541,0,0,1-3.685,1.679,5.182,5.182,0,0,1-5.045-5.315m8.875,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-31.195 -366.975)" fill="#020a09"></path>
                    <path id="Path_7856" data-name="Path 7856" d="M238.535,388.237l-.01,21.81a21.994,21.994,0,1,0,8.7,17.521V388.241ZM225.23,441.281a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-95.295 -388.237)" fill="#020a09"></path>
                    <path id="Path_7857" data-name="Path 7857" d="M274.169,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.248h8.777l.021-41.4Zm-13.305,34.344a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-81.361 -383.364)" fill="#020a09"></path>
                    <path id="Path_7858" data-name="Path 7858" d="M330.006,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.249l8.777,0,.021-41.405ZM316.7,436.408a13.715,13.715,0,1,1,13.714-13.714A13.714,13.714,0,0,1,316.7,436.408" transform="translate(-59.527 -383.364)" fill="#020a09"></path>
                    <path id="Path_7859" data-name="Path 7859" d="M300.168,413.619v-6.687H290.026l.006-18.693h-8.779l-.006,18.693h-6.77v6.687h6.767l-.011,24.1a10.618,10.618,0,0,0,10.618,10.623h8.238v-6.958h-4.767a5.311,5.311,0,0,1-5.311-5.312l.013-22.45Z" transform="translate(-67.437 -388.236)" fill="#020a09"></path>
                    <path id="Path_7860" data-name="Path 7860" d="M449.9,448.318h11.719l-20.331-22.58,18.829-20.192H448.2l-16.8,18.012-.018-35.319H422.68l.029,60.08h8.711l-.01-20.531Z" transform="translate(-9.486 -388.237)" fill="#020a09"></path>
                    <path id="Path_7861" data-name="Path 7861" d="M408.569,400.7a21.995,21.995,0,1,0,22,21.995,22,22,0,0,0-22-21.995m0,35.709a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-23.605 -383.364)" fill="#020a09"></path>
                    <path id="Path_7862" data-name="Path 7862" d="M377.5,408.394l0-6.6-8.886,0L368.6,443.2l8.884,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(-30.634 -383.091)" fill="#020a09"></path>
                    <path id="Path_7863" data-name="Path 7863" d="M495.763,408.394l0-6.6-8.886,0L486.86,443.2l8.885,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(15.609 -383.091)" fill="#020a09"></path>
                    <path id="Path_7864" data-name="Path 7864" d="M331.953,388.24v39.328a22,22,0,1,0,8.7-17.521l-.011-21.807Zm8.279,39.326a13.715,13.715,0,1,1,13.714,13.714,13.715,13.715,0,0,1-13.714-13.714" transform="translate(-44.963 -388.236)" fill="#020a09"></path>
                    <path id="Path_7865" data-name="Path 7865" d="M494.158,422.694a22,22,0,1,0-2.961,11.018l-7.734-3.252a13.709,13.709,0,0,1-24.949-6.468l35.6.018c.026-.435.043-.874.043-1.316M472.163,408.98a13.688,13.688,0,0,1,12.354,7.809H459.808a13.69,13.69,0,0,1,12.355-7.809" transform="translate(1.262 -383.364)" fill="#020a09"></path>
                    <path id="Path_7866" data-name="Path 7866" d="M151.875,411.614a14.475,14.475,0,1,0,20.273,2.849,14.476,14.476,0,0,0-20.273-2.849" transform="translate(-117.631 -380.236)" fill="#78e6d0"></path>
                    <path id="Path_7867" data-name="Path 7867" d="M154.616,412.637h0l0,0a23.216,23.216,0,0,1,37.188,18.5l19.726-14.88.013.017V388.237h-85.91V434.5Z" transform="translate(-125.637 -388.237)" fill="#78e6d0"></path>
                    <path id="Path_7868" data-name="Path 7868" d="M182.565,438.581a23.215,23.215,0,0,1-37.188-18.5l-19.726,14.88-.014-.017v28.07h85.91V416.718Z" transform="translate(-125.637 -377.1)" fill="#78e6d0"></path>
                  </svg>                        
                </a>    
              </div>
			        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			          <span class="sr-only">Toggle navigation</span>
			          <span class="navbar-toggler-icon"></span>
			          <span class="navbar-toggler-icon"></span>
			          <span class="navbar-toggler-icon"></span>
			        </button>
  			      <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="navbar-title"><span class="fs-20 text-bold">{{ trans('home.communities') }}</span></div>
  			        <ul class="navbar-nav">
  			          <li class="dropdown nav-item">
    			          <a href="{{ route('data.geographic') }}" class="nav-link">
    			            <span>{{ trans('home.geographics') }} </span>
                      <i class="material-icons">chevron_right</i> 
    			          </a>
  			          </li>
  			          <li class="dropdown nav-item">
  			            <a href="{{ route('data.environment') }}" class="nav-link">
  			              <span>{{ trans('home.environment') }} </span>
                      <i class="material-icons">chevron_right</i>
  			            </a>
  			          </li>
  			          <li class="dropdown nav-item">
  			            <a href="{{ route('data.transport') }}" class="nav-link">
  			              <span>{{ trans('home.transport') }} </span>
                      <i class="material-icons">chevron_right</i>
  			            </a>
  			          </li>			          
                  <li class="dropdown nav-item">
                    <a href="{{ route('data.people') }}" class="nav-link">
                      <span>{{ trans('home.people') }} </span>
                      <i class="material-icons">chevron_right</i>
                    </a>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="{{ route('data.agriculture') }}" class="nav-link">
                      <span>{{ trans('home.agriculture') }} </span>
                      <i class="material-icons">chevron_right</i>
                    </a>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="{{ route('data.energy') }}" class="nav-link">
                      <span>{{ trans('home.energy') }} </span>
                      <i class="material-icons">chevron_right</i>
                    </a>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="{{ route('data.economy') }}" class="nav-link">
                      <span>{{ trans('home.economy') }} </span>
                      <i class="material-icons">chevron_right</i>
                    </a>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="{{ route('data.geographic') }}" class="nav-link">
                      <span>{{ trans('home.supply_chain') }} </span>
                      <i class="material-icons">chevron_right</i>
                    </a>
                  </li>
  			        </ul>
  			      </div>
  			    </div>
  			  </nav>
        </div>
        <dir class="cookie-accept">
            <div class="cookie-accept-container">
                <div class="close_button-container" title="Close">
                    <div class="close_button"></div>
                </div>
                <h3><span>i</span>COOKIES</h3>
                <p>{{ trans('home.cookie_desc') }}</p>
                <button type="button" class="btn accept-btn pure-material-button-outlined">{{ trans('home.accept_cookie') }}</button>
            </div>
        </dir>

        @yield('content')
  		<div class="container-fluid app-wapper">
  			<div class="section_splitor_green"></div>
  			<div class="container footer_section1">
  				<div class="row">
  					<div class="col-md-4 col-lg-3">
  						<h5>{{ trans('home.explore_data_communities') }}</h5>
  						<ul class="list-unstyled" data-turbolinks="false"> 
  							<li><a href="{{ route('data.geographic') }}">{{ trans('home.geographics') }}</a></li> 
                <li><a href="{{ route('data.environment') }}">{{ trans('home.environment') }}</a></li> 
                <li><a href="{{ route('data.transport') }}">{{ trans('home.transport') }}</a></li> 
                <li><a href="{{ route('data.people') }}">{{ trans('home.people') }}</a></li> 
                <li><a href="{{ route('data.agriculture') }}">{{ trans('home.agriculture') }}</a></li> 
                <li><a href="{{ route('data.energy') }}">{{ trans('home.energy') }}</a></li> 
                <li><a href="{{ route('data.economy') }}">{{ trans('home.economy') }}</a></li> 
                <li><a href="{{ route('data.supply_chain') }}">{{ trans('home.supply_chain') }}</a></li>   							
  						</ul>
  					</div>
  					<div class="col-md-4 col-lg-3">
  						<h5>{{ trans('home.about_databroker') }}</h5>
  						<ul class="list-unstyled" data-turbolinks="false"> 
  							<li><a href="{{ route('about.partners') }}">{{ trans('home.partners') }}</a></li> 
  							<li><a href="javascript:;">{{ trans('home.datamatch') }}</a></li>  
  							<li><a href="{{ route('about.usecase') }}">{{ trans('home.usecase') }}</a></li> 
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
              <button type="button" class="btn match-me-up-btn pure-material-button-outlined">{{ trans('home.signup') }}</button>

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
		        	<button class="btn readmore-inourblog-btn pure-material-button-outlined">{{ trans('home.viewall_partners') }}</button>
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
	                    <svg class="site_footer_logo" id="logo-white" xmlns="http://www.w3.org/2000/svg" width="525.314" height="90.848" viewBox="0 0 525.314 90.848">
	                      <path id="Path_7836" data-name="Path 7836" d="M207.345,445.195v5.323a1.338,1.338,0,0,0,1.388,1.515h1.11v1.726H208.3a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-95.181 -367.715)" fill="#fff"></path>
	                      <path id="Path_7837" data-name="Path 7837" d="M218.466,448.047v6.211h-2.093v-5.9c0-1.968-1.032-2.643-2.324-2.643a2.383,2.383,0,0,0-2.459,2.662v5.883h-2.1V439.444h2.1V445.5a3.476,3.476,0,0,1,3.067-1.648c2.217,0,3.81,1.408,3.81,4.2" transform="translate(-92.85 -368.214)" fill="#fff"></path>
	                      <path id="Path_7838" data-name="Path 7838" d="M227.979,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609A5.165,5.165,0,0,1,228,447.795Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-89.775 -366.978)" fill="#fff"></path>
	                      <path id="Path_7839" data-name="Path 7839" d="M245.052,446.037v6.983H242.91v-6.308c0-1.591-.868-2.209-1.929-2.209-1.214,0-2.035.8-2.035,2.287v6.23H236.8v-6.308c0-1.591-.858-2.209-1.928-2.209-1.225,0-2.025.8-2.025,2.287v6.23H230.69V442.805h2.152v1.427a3.253,3.253,0,0,1,2.893-1.621,2.906,2.906,0,0,1,2.835,1.621,3.475,3.475,0,0,1,3.01-1.621,3.269,3.269,0,0,1,3.472,3.425" transform="translate(-84.559 -366.975)" fill="#fff"></path>
	                      <path id="Path_7840" data-name="Path 7840" d="M242.441,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02H251.17v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-79.964 -366.975)" fill="#fff"></path>
	                      <path id="Path_7841" data-name="Path 7841" d="M257.957,442.682v2.055c-2.084,0-3.482.762-3.482,3.019v5.237h-2.152V442.778h2.093v1.814a4.136,4.136,0,0,1,3.54-1.91" transform="translate(-76.1 -366.948)" fill="#fff"></path>
	                      <path id="Path_7842" data-name="Path 7842" d="M264.278,454.258l-4.608-5.073v5.073h-2.151V439.444h2.151v9.008l4.041-4.408h2.71l-4.486,4.707,5.143,5.507Z" transform="translate(-74.068 -368.214)" fill="#fff"></path>
	                      <path id="Path_7843" data-name="Path 7843" d="M275.018,448.219h-8.556a3.291,3.291,0,0,0,3.338,3.2,3.332,3.332,0,0,0,2.884-1.582l1.746.743a5.086,5.086,0,0,1-4.621,2.633,5.305,5.305,0,1,1-.047-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-71.382 -366.978)" fill="#fff"></path>
	                      <path id="Path_7844" data-name="Path 7844" d="M276.314,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726h-1.543a2.805,2.805,0,0,1-3.108-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.152v2.825h2.518v1.65Z" transform="translate(-68.213 -367.715)" fill="#fff"></path>
	                      <path id="Path_7845" data-name="Path 7845" d="M278.456,442.805h2.151v1.5a4.552,4.552,0,0,1,3.674-1.689,5.306,5.306,0,0,1,0,10.6,4.541,4.541,0,0,1-3.674-1.679v6.289h-2.151Zm8.738,5.112a3.366,3.366,0,1,0-3.366,3.405,3.334,3.334,0,0,0,3.366-3.405" transform="translate(-65.881 -366.975)" fill="#fff"></path>
	                      <rect id="Rectangle_2299" data-name="Rectangle 2299" width="2.152" height="14.814" transform="translate(225.603 71.23)" fill="#fff"></rect>
	                      <path id="Path_7846" data-name="Path 7846" d="M290.918,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486H301.8V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.367,3.367,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-61.008 -366.975)" fill="#fff"></path>
	                      <path id="Path_7847" data-name="Path 7847" d="M300.26,447.908a5.3,5.3,0,0,1,5.46-5.3,5.477,5.477,0,0,1,4.368,2.084l-1.611,1.292a3.24,3.24,0,0,0-2.767-1.447,3.366,3.366,0,1,0,0,6.733,3.248,3.248,0,0,0,2.767-1.456l1.611,1.292a5.477,5.477,0,0,1-4.368,2.084,5.293,5.293,0,0,1-5.46-5.286" transform="translate(-57.355 -366.975)" fill="#fff"></path>
	                      <path id="Path_7848" data-name="Path 7848" d="M318.561,448.219h-8.555a3.289,3.289,0,0,0,3.338,3.2,3.331,3.331,0,0,0,2.882-1.582l1.746.743a5.086,5.086,0,0,1-4.62,2.633,5.305,5.305,0,1,1-.049-10.609,5.167,5.167,0,0,1,5.276,5.189Zm-8.43-1.466h6.239a3.007,3.007,0,0,0-3.056-2.44,3.2,3.2,0,0,0-3.183,2.44" transform="translate(-54.355 -366.978)" fill="#fff"></path>
	                      <path id="Path_7849" data-name="Path 7849" d="M326.709,445.748h-2.519v8.565H322.04v-8.565h-1.669V444.1h1.669v-1.486c0-2.121,1.138-3.308,3.085-3.308a5.656,5.656,0,0,1,1.562.242v1.764a3.126,3.126,0,0,0-1.079-.221c-.868,0-1.419.54-1.419,1.591V444.1h2.519Z" transform="translate(-49.492 -368.268)" fill="#fff"></path>
	                      <path id="Path_7850" data-name="Path 7850" d="M325.358,447.908a5.462,5.462,0,1,1,5.46,5.305,5.3,5.3,0,0,1-5.46-5.305m8.826,0a3.371,3.371,0,1,0-3.376,3.376,3.341,3.341,0,0,0,3.376-3.376" transform="translate(-47.542 -366.975)" fill="#fff"></path>
	                      <path id="Path_7851" data-name="Path 7851" d="M340.36,442.682v2.055c-2.082,0-3.482.762-3.482,3.019v5.237h-2.15V442.778h2.093v1.814a4.135,4.135,0,0,1,3.539-1.91" transform="translate(-43.878 -366.948)" fill="#fff"></path>
	                      <path id="Path_7852" data-name="Path 7852" d="M343.612,449.137a5.186,5.186,0,0,1,5.044-5.314,4.546,4.546,0,0,1,3.685,1.707l.01-6.086h2.141v14.814h-2.151v-1.486a4.548,4.548,0,0,1-3.685,1.689,5.19,5.19,0,0,1-5.044-5.325m8.873,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-40.404 -368.214)" fill="#fff"></path>
	                      <path id="Path_7853" data-name="Path 7853" d="M352.987,447.9a5.161,5.161,0,0,1,5.045-5.286,4.544,4.544,0,0,1,3.693,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.539,4.539,0,0,1-3.683,1.679,5.181,5.181,0,0,1-5.045-5.315m8.873,0a3.366,3.366,0,1,0-3.355,3.405,3.311,3.311,0,0,0,3.355-3.405" transform="translate(-36.738 -366.975)" fill="#fff"></path>
	                      <path id="Path_7854" data-name="Path 7854" d="M365.784,445.195v5.323a1.339,1.339,0,0,0,1.388,1.515h1.11v1.726H366.74a2.8,2.8,0,0,1-3.106-2.989v-5.575h-1.668v-1.65h1.668V440.72h2.151v2.825H368.3v1.65Z" transform="translate(-33.227 -367.715)" fill="#fff"></path>
	                      <path id="Path_7855" data-name="Path 7855" d="M367.163,447.9a5.162,5.162,0,0,1,5.045-5.286,4.547,4.547,0,0,1,3.695,1.679v-1.486h2.141V453.02h-2.151v-1.486a4.541,4.541,0,0,1-3.685,1.679,5.182,5.182,0,0,1-5.045-5.315m8.875,0a3.366,3.366,0,1,0-3.357,3.405,3.312,3.312,0,0,0,3.357-3.405" transform="translate(-31.195 -366.975)" fill="#fff"></path>
	                      <path id="Path_7856" data-name="Path 7856" d="M238.535,388.237l-.01,21.81a21.994,21.994,0,1,0,8.7,17.521V388.241ZM225.23,441.281a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-95.295 -388.237)" fill="#fff"></path>
	                      <path id="Path_7857" data-name="Path 7857" d="M274.169,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.248h8.777l.021-41.4Zm-13.305,34.344a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-81.361 -383.364)" fill="#fff"></path>
	                      <path id="Path_7858" data-name="Path 7858" d="M330.006,402.064v3.119a21.994,21.994,0,1,0-.017,35.037v3.249l8.777,0,.021-41.405ZM316.7,436.408a13.715,13.715,0,1,1,13.714-13.714A13.714,13.714,0,0,1,316.7,436.408" transform="translate(-59.527 -383.364)" fill="#fff"></path>
	                      <path id="Path_7859" data-name="Path 7859" d="M300.168,413.619v-6.687H290.026l.006-18.693h-8.779l-.006,18.693h-6.77v6.687h6.767l-.011,24.1a10.618,10.618,0,0,0,10.618,10.623h8.238v-6.958h-4.767a5.311,5.311,0,0,1-5.311-5.312l.013-22.45Z" transform="translate(-67.437 -388.236)" fill="#fff"></path>
	                      <path id="Path_7860" data-name="Path 7860" d="M449.9,448.318h11.719l-20.331-22.58,18.829-20.192H448.2l-16.8,18.012-.018-35.319H422.68l.029,60.08h8.711l-.01-20.531Z" transform="translate(-9.486 -388.237)" fill="#fff"></path>
	                      <path id="Path_7861" data-name="Path 7861" d="M408.569,400.7a21.995,21.995,0,1,0,22,21.995,22,22,0,0,0-22-21.995m0,35.709a13.715,13.715,0,1,1,13.714-13.714,13.714,13.714,0,0,1-13.714,13.714" transform="translate(-23.605 -383.364)" fill="#fff"></path>
	                      <path id="Path_7862" data-name="Path 7862" d="M377.5,408.394l0-6.6-8.886,0L368.6,443.2l8.884,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(-30.634 -383.091)" fill="#fff"></path>
	                      <path id="Path_7863" data-name="Path 7863" d="M495.763,408.394l0-6.6-8.886,0L486.86,443.2l8.885,0s.011-17.928.011-22.532c0-6.191,3.928-10.942,13.949-10.942V401.4a17.275,17.275,0,0,0-13.942,7" transform="translate(15.609 -383.091)" fill="#fff"></path>
	                      <path id="Path_7864" data-name="Path 7864" d="M331.953,388.24v39.328a22,22,0,1,0,8.7-17.521l-.011-21.807Zm8.279,39.326a13.715,13.715,0,1,1,13.714,13.714,13.715,13.715,0,0,1-13.714-13.714" transform="translate(-44.963 -388.236)" fill="#fff"></path>
	                      <path id="Path_7865" data-name="Path 7865" d="M494.158,422.694a22,22,0,1,0-2.961,11.018l-7.734-3.252a13.709,13.709,0,0,1-24.949-6.468l35.6.018c.026-.435.043-.874.043-1.316M472.163,408.98a13.688,13.688,0,0,1,12.354,7.809H459.808a13.69,13.69,0,0,1,12.355-7.809" transform="translate(1.262 -383.364)" fill="#fff"></path>
	                      <path id="Path_7866" data-name="Path 7866" d="M151.875,411.614a14.475,14.475,0,1,0,20.273,2.849,14.476,14.476,0,0,0-20.273-2.849" transform="translate(-117.631 -380.236)" fill="#78e6d0"></path>
	                      <path id="Path_7867" data-name="Path 7867" d="M154.616,412.637h0l0,0a23.216,23.216,0,0,1,37.188,18.5l19.726-14.88.013.017V388.237h-85.91V434.5Z" transform="translate(-125.637 -388.237)" fill="#78e6d0"></path>
	                      <path id="Path_7868" data-name="Path 7868" d="M182.565,438.581a23.215,23.215,0,0,1-37.188-18.5l-19.726,14.88-.014-.017v28.07h85.91V416.718Z" transform="translate(-125.637 -377.1)" fill="#78e6d0"></path>
	                    </svg>                    
	                </div>
	                <div class="app-footer-social-link-container">                      
                      <h4>Follow us on social media</h4>
	                    <div class="app-footer-social-link">                          
	                        <a href="https://www.facebook.com/DataBroker/" rel="nofollow noopener noreferrer" target="_blank">
	                          <img src="{{ asset('/images/facebook.png') }}">
	                        </a>
	                        <a href="https://www.twitter.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
	                          <img src="{{ asset('/images/twitter.png') }}">
	                        </a>
	                        <a href="https://www.pinterest.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
	                          <img src="{{ asset('/images/pinterest.png') }}">
	                        </a>
	                        <a href="https://www.linkedin.com/company/databroker/" rel="nofollow noopener noreferrer" target="_blank">
	                          <img src="{{ asset('/images/linkedin.png') }}">
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
    <!-- <script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>  -->

    @yield('additional_javascript')

    <script src="{{ asset('js/material.min.js') }}"></script>        
    <script src="{{ asset('js/app.js') }}"></script>        
    <script src="{{ asset('js/custom.js') }}"></script>   
    <script src="{{ asset('js/custom2.js') }}"></script>   

    
    <script type="text/javascript">
        $(function(){
            $(".close_button-container").click(function(){
                $(".cookie-accept").animate({ opacity: 0, bottom: "-400px" });
            });
            $(".cookie-accept .accept-btn").click(function(){
                $.cookie('databroker_cookie', (new Date()), { expires: 365, path: '/' });
                $(".cookie-accept").animate({ opacity: 0, bottom: "-400px" });
            })
            if(typeof $.cookie('databroker_cookie') == "undefined")
                $(".cookie-accept").animate({ opacity: 1, bottom: "0px" });           
        });
    </script>
    </body>
</html>

