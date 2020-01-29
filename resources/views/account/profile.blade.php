@extends('layouts.app')

@section('additional_css')    
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper profile">
    <div class="bg-pattern1-left"></div>
	<div class="app-section app-reveal-section align-items-center">	    
		<div class="container">
			<div class="page-title text-primary">{{ trans('pages.account_information') }}</div>
			<div class="label companyname">
				<span>{{ trans('pages.company_name') }}</span>
			</div>
			<div class="label adminname">
			<span>{{ $user->companyName }}</span>
			</div>

            <div class="app-section profileinfo">
                <div id="profile-display-section">       
                    <div class="profile-section-header flex-vcenter-justify mb-10">                
                        <div class="sectiontitle">{{ trans('pages.profile_information') }}</div>
                        <div id="edit-button" class="action-button-edit flex-center" onClick="document.getElementById('profile-edit-section').style.display = 'block';document.getElementById('profile-display-section').style.display = 'none';">
                            <i class="material-icons">edit</i> {{ trans('pages.edit') }}
                        </div>
                    </div>             
                    <div class="row">
                        <div class="col-2 info-label">{{ trans('pages.name') }}:</div>
                        <div class="col info-text">{{ $user->firstname }} {{ $user->lastname }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 info-label">{{ trans('pages.email_address') }}:</div>
                        <div class="col info-text">{{ $user->emailAddress }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">{{ trans('pages.job_title') }}:</div>
                        <div class="col info-text">{{ $user->jobTitle }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">{{ trans('pages.industry') }}:</div>
                        <div class="col info-text">{{ $user->businessName }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2 info-label">{{ trans('pages.Password') }}:</div>
                        <div class="col info-text">**************</div>
                    </div>
                </div><!--profile-display-section-->

                <div id="profile-edit-section" style="display: none;" >
                    <div id="cancel-button" class="top-right flex-center" onClick="document.getElementById('profile-edit-section').style.display = 'none';document.getElementById('profile-display-section').style.display = 'block';">
                       <i class="material-icons">close</i> Cancel
                    </div>
                    <br />
                    <form method="POST" action="{{ route('account.profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-3 info-label flex-vend">First name:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder=" "  value="{{ old('firstname', $user->firstname) }}" autocomplete="firstname" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback firstname ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Last name:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder=" "  value="{{ old('lastname', $user->lastname) }}" autocomplete="lastname" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback lastname ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Email address:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="text" id="emailAddress" name="emailAddress" class="form-control" placeholder=" "  value="{{ old('emailAddress', $user->emailAddress) }}" autocomplete="emailAddress" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback emailAddress ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Job title:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="text" id="jobTitle" name="jobTitle" class="form-control" placeholder=" "  value="{{ old('jobTitle', $user->jobTitle) }}" autocomplete="jobTitle" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vcenter">Industry:</div>
                            <div class="col dropdown-container flex-vcenter mb-10">
                                <div class="adv-combo-wrapper custom-select2 no-border">
                                    <select id="businessName" name="businessName" data-placeholder="Search business name.">
                                        <option></option>
                                        @foreach ($business as $busi)
                                            @if( $user->businessName == $busi->businessName )
                                            <option value="{{$busi->businessName}}" selected>{{$busi->businessName}}</option>
                                            @else
                                            <option value="{{$busi->businessName}}">{{$busi->businessName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="error_notice businessName"> This field is required</div>
                                </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Old password:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder=" "  value="{{ old('oldPassword') }}" autocomplete="password" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">New password:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="password" id="password" name="password" class="form-control" placeholder=" "  value="" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Confirm password:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder=" "  value="" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback password ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col info-text flex-vend">
                                <button type="submit" class="customize-btn">UPDATE PROFILE</button>
                            </div>
                        </div>
                    </form>
                </div><!--profile-edit-section-->

			</div><!--app-section profileinfo-->

			<svg class="Line_ua" viewBox="0 0.5 28 2">
				<path fill="transparent" stroke="rgba(120,230,208,1)" stroke-width="2px" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="10" shape-rendering="auto" id="Line_ua" d="M 0 0.5 L 28 0.5">
				</path>
			</svg>

			<div id="Group_2476" class="app-section users">
				<div class="sectiontitle">
					<span>{{ trans('pages.users') }}</span>
				</div>
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col" class="col-name"></th>
				      <th scope="col" class="col-since">{{ trans('pages.Active_Since') }}</th>
				      <th scope="col" class="col-action"></th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td class="col-name">Marks Spencer (administrator)</td>
				      <td class="col-since">02/02/2007</td>
				      <td class="col-action">
	    					<div class="action-button-delete flex-center justify-end">
	    						<svg viewBox="0 0 16 16" class="ic-delete-16">
	    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
	    							</path>
	    						</svg>
	    						<div class="label-delete">
	    							<span>{{ trans('pages.Delete') }}</span>
	    						</div>
	    					</div>
	    				</td>
				    </tr>
				    <tr>
				      <td class="col-name">Sarah Collins</td>
				      <td class="col-since">12/09/2011</td>
				      <td class="col-action">
	    					<div class="action-button-delete flex-center justify-end">
	    						<svg viewBox="0 0 16 16" class="ic-delete-16">
	    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
	    							</path>
	    						</svg>
	    						<div class="label-delete">
	    							<span>{{ trans('pages.Delete') }}</span>
	    						</div>
	    					</div>
	    				</td>
				    </tr>
				    <tr>
				      <td class="col-name">Lisa Daniels</td>
				      <td class="col-since">24/12/2014</td>
				      <td class="col-action">
	    					<div class="action-button-delete flex-center justify-end">
	    						<svg viewBox="0 0 16 16" class="ic-delete-16">
	    							<path fill="rgba(186,192,197,1)" id="__Color_ts" d="M 8 16 C 5.860402584075928 16 3.850702285766602 15.16867923736572 2.341103315353394 13.6591682434082 C 0.8314242959022522 12.14957714080811 0 10.13978099822998 0 8 C 0 5.860482692718506 0.8314242959022522 3.85078239440918 2.341103315353394 2.341103315353394 C 3.85078239440918 0.8314242959022522 5.860482692718506 0 8 0 C 10.13978099822998 0 12.14957714080811 0.8314242959022522 13.6591682434082 2.341103315353394 C 15.16867923736572 3.850702285766602 16 5.860402584075928 16 8 C 16 10.13986110687256 15.16867923736572 12.14965724945068 13.6591682434082 13.6591682434082 C 12.14965724945068 15.16867923736572 10.13986110687256 16 8 16 Z M 8 9.12825870513916 L 8.000567436218262 9.128819465637207 L 10.87210845947266 12.00035953521729 L 12.00035953521729 10.87210845947266 L 9.128251075744629 8 L 12.00035953521729 5.127891540527344 L 10.87210845947266 4.000360012054443 L 8 6.871748447418213 L 5.127891540527344 4.000360012054443 L 4.000360012054443 5.127891540527344 L 6.871748447418213 8 L 4.000360012054443 10.87210845947266 L 5.127891540527344 12.00035953521729 L 7.99943208694458 9.128819465637207 L 8 9.12825870513916 Z">
	    							</path>
	    						</svg>
	    						<div class="label-delete">
	    							<span>{{ trans('pages.Delete') }}</span>
	    						</div>
	    					</div>
	  					</td>
				    </tr>
				  </tbody>
				</table>
				<button type="button" class="btn btn-outline-primary btn-rounded waves-effect Buttons_Round_Hero">{{ trans('pages.INVITE_USERS') }}</button>
				<div class="description">
					<span>{{ trans('pages.profile_description') }} </span><span style="color:rgba(120,230,208,1);">{{ trans('pages.Read_more') }}</span>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('additional_javascript')    
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection