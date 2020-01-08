@extends('layouts.app')


@section('content')
<div class="container-fluid app-wapper profile" ng-app="myApp" ng-controller="myCtrl">
    <div class="top-bg-image"></div>
    <svg class="Path_10666" viewBox="143.241 204.635 690.685 330.511">
		<path fill="rgba(218,225,229,1)" id="Path_10666" d="M 794.2346801757813 263.7075805664063 L 653.8280029296875 369.6185302734375 C 653.7975463867188 335.0404663085938 642.9666137695313 300.1841430664063 620.5549926757813 270.4426879882813 C 565.63134765625 197.556640625 462.0213623046875 182.995361328125 389.1353759765625 237.9188385009766 C 389.1270446777344 237.9249725341797 389.119384765625 237.9326019287109 389.1094055175781 237.9395294189453 L 389.1086120605469 237.9387359619141 L 143.240966796875 423.4013671875 L 182.9316101074219 476.0725708007813 L 323.3382568359375 370.1632080078125 C 323.3689575195313 404.7398071289063 334.2004089355469 439.5968627929688 356.611572265625 469.3375854492188 C 411.5350036621094 542.2235717773438 515.1456298828125 556.7848510742188 588.0309448242188 501.8613891601563 L 833.925537109375 316.3788452148438 L 794.2346801757813 263.7075805664063 Z M 550.591796875 452.1780395507813 C 505.1453247070313 486.4237060546875 440.5414733886719 477.3448486328125 406.2949523925781 431.8983154296875 C 372.0491027832031 386.4526977539063 381.1289367675781 321.84814453125 426.5745544433594 287.6022338867188 C 472.02099609375 253.3556976318359 536.62548828125 262.4356079101563 570.8715209960938 307.8818969726563 C 605.1171875 353.3275756835938 596.0374145507813 417.9321899414063 550.591796875 452.1780395507813">
		</path>
	</svg>
	<div class="container">
		<div class="page-title">Account information</div>
		<div class="label companyname">
			<span>Company Name</span>
		</div>
		<div class="label adminname">
			<span>{{ $companyName }}</span>
		</div>

		<div class="app-section profileinfo">
			<div class="sectiontitle">Profile information</div>
                <form method="POST" action="{{ route('account.profile.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-2 info-label">First name:</div>
                        <div class="col info-text">
                            <input type="text" id="firstname" name="firstname" class="form-control input_data @error('firstname')  is-invalid @enderror" placeholder=" "  value="{{ old('firstname', $firstname) }}" required autocomplete="firstname" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'First name']) }}</div>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Last name:</div>
                        <div class="col info-text">
                            <input type="text" id="lastname" name="lastname" class="form-control input_data @error('lastname')  is-invalid @enderror" placeholder=" "  value="{{ old('lastname', $lastname) }}" required autocomplete="lastname" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Last name']) }}</div>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Email address:</div>
                        <div class="col info-text">
                            <input type="text" id="emailAddress" name="emailAddress" class="form-control input_data @error('emailAddress')  is-invalid @enderror" placeholder=" "  value="{{ old('emailAddress', $emailAddress) }}" required autocomplete="emailAddress" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="error_notice">{{ trans('validation.required', ['attribute' => 'Email address']) }}</div>
                        @error('emailAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Job title:</div>
                        <div class="col info-text">
                            <input type="text" id="jobTitle" name="jobTitle" class="form-control input_data @error('jobTitle')  is-invalid @enderror" placeholder=" "  value="{{ old('jobTitle', $jobTitle) }}" autocomplete="jobTitle" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Industry:</div>
                        <div class="col info-text">
                            <input type="text" id="businessName" name="businessName" class="form-control input_data @error('businessName')  is-invalid @enderror" placeholder=" "  value="{{ old('businessName', $businessName) }}" autocomplete="businessName" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Old password:</div>
                        <div class="col info-text">
                            <input type="password" id="oldPassword" name="oldPassword" class="form-control input_data @error('oldPassword')  is-invalid @enderror" placeholder=" "  value="{{ old('oldPassword') }}" autocomplete="password" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">New password:</div>
                        <div class="col info-text">
                            <input type="password" id="password" name="password" class="form-control input_data @error('password')  is-invalid @enderror" placeholder=" "  value="" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">Confirm password:</div>
                        <div class="col info-text">
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control input_data @error('password-confirm')  is-invalid @enderror" placeholder=" "  value="" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col info-text">
                            <button type="submit" class="btn customize-btn">UPDATE PROFILE</button>
                        </div>
                    </div>
            </form>
		</div>
		<svg class="Line_ua" viewBox="0 0.5 28 2">
			<path fill="transparent" stroke="rgba(120,230,208,1)" stroke-width="2px" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="10" shape-rendering="auto" id="Line_ua" d="M 0 0.5 L 28 0.5">
			</path>
		</svg>

		<div id="Group_2476" class="app-section users">
			<div class="sectiontitle">
				<span>Users</span>
			</div>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col" class="col-name"></th>
			      <th scope="col" class="col-since">Active Since</th>
			      <th scope="col" class="col-action"></th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td class="col-name">Marks Spencer (administrator)</td>
			      <td class="col-since">02/02/2007</td>
			      <td class="col-action">
    					<div class="action-button-delete flex-center">
    						<svg viewBox="0 0 16 16" class="ic-delete-16">
    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
    							</path>
    						</svg>
    						<div class="label-delete">
    							<span>Delete</span>
    						</div>
    					</div>
    				</td>
			    </tr>
			    <tr>
			      <td class="col-name">Sarah Collins</td>
			      <td class="col-since">12/09/2011</td>
			      <td class="col-action">
    					<div class="action-button-delete flex-center">
    						<svg viewBox="0 0 16 16" class="ic-delete-16">
    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
    							</path>
    						</svg>
    						<div class="label-delete">
    							<span>Delete</span>
    						</div>
    					</div>
    				</td>
			    </tr>
			    <tr>
			      <td class="col-name">Lisa Daniels</td>
			      <td class="col-since">24/12/2014</td>
			      <td class="col-action">
    					<div class="action-button-delete flex-center">
    						<svg viewBox="0 0 16 16" class="ic-delete-16">
    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
    							</path>
    						</svg>
    						<div class="label-delete">
    							<span>Delete</span>
    						</div>
    					</div>
  					</td>
			    </tr>
			  </tbody>
			</table>
			<div class="Buttons_Round_Hero flex-center">
				<svg class="bg_tg" viewBox="0 0 170 50">
					<path fill="transparent" stroke="rgba(6,3,141,1)" stroke-width="2px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" id="bg_tg" d="M 25.54827880859375 0 L 144.2711944580078 0 C 158.3811340332031 0 169.8194732666016 11.19288063049316 169.8194732666016 25 C 169.8194732666016 38.80712127685547 158.3811340332031 50 144.2711944580078 50 L 25.54827880859375 50 C 11.4383544921875 50 0 38.80712127685547 0 25 C 0 11.19288063049316 11.4383544921875 0 25.54827880859375 0 Z">
					</path>
				</svg>
				<div class="label">
					<span>INVITE USERS</span>
				</div>
			</div>
			<div class="description">
				<span>You can deactivate your Databroker account anytime you want. </span><span style="color:rgba(120,230,208,1);">Read more</span>
			</div>
		</div>
	</div>
</div>

@endsection

