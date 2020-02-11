@extends('layouts.app')

@section('title', 'Account and profile info | Databroker')
@section('description', '')

@section('additional_css')    
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper profile">
    <div class="bg-pattern1-left"></div>
	<div class="app-section app-reveal-section align-items-center">	    
		<div class="container">
			<div class="h1">Account info</div>
			<div class="label companyname1">
				<span>Account name: </span>
                <span class="adminname">{{$user->companyName}}</span>
			</div>
			<div class="label ">
    			<span>Administrator: </span>
                <span class="adminname">{{$user->firstname}} {{$user->lastname}}</span>
			</div>

            <div class="app-section profileinfo">
                <div id="profile-display-section">       
                    <div class="profile-section-header flex-vcenter-justify mb-10">                
                        <div class="sectiontitle">My profile</div>
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
                        <div class="col info-text">{{ $user->email }}</div>
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
                                <input type="text" id="email" name="email" class="form-control" placeholder=" "  value="{{ old('email', $user->email) }}" autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback email ml-15" role="alert">
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

			<div class="divider-green mgt30"></div>

			<div id="Group_2476" class="app-section users">
				<div class="sectiontitle">
					<span>Other users linked to this account</span>
				</div>
                @if(sizeof($users) >0 )
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col" class="col-name"></th>
				      <th scope="col" class="col-since">{{ trans('pages.Active_Since') }}</th>
				      <th scope="col" class="col-action"></th>
				    </tr>
				  </thead>
				  <tbody>
                    @foreach($users as $company_user)
				    <tr>
				      <td class="col-name">{{ $company_user->firstname }} {{ $company_user->lastname }} @if($company_user->userStatus == 1) (administrator) @endif</td>
				      <td class="col-since">{{ date('d/m/Y', strtotime($company_user->created_at)) }}</td>
                      @if($user->userStatus == 1)
				      <td class="col-action">
                        <a class="action-button-delete" data-toggle="modal" data-target="#deleteModal" user-id="{{ $company_user->userIdx }}">
                            <div class="flex-center justify-end color-gray5">
                                <i class="icon material-icons ">
                                    cancel
                                </i>                                
                                <span class="label-delete">{{ trans('pages.Delete') }}</span>
                            </div>
                        </a>
	    			  </td>
                      @endif
				    </tr>
                    @endforeach				    
				  </tbody>
				</table>
                @endif
                @if($user->userStatus == 1)
				<button type="button" class="button secondary-btn mt-20" data-toggle="modal" data-target="#inviteModal">{{ trans('pages.INVITE_USERS') }}</button>
                @endif
				<div class="description mt-10">
					<span>{{ trans('pages.profile_description') }} </span><span style="color:rgba(120,230,208,1);">{{ trans('pages.Read_more') }}</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="unpublishModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="post" post>
            @csrf
            <input type="hidden" name="invite_userIdx" value="{{$user->userIdx}}">
            <p class="para">
                An email will be sent to these recipients, inviting them to register on Databroker
            </p>    
            <div class="email_lists cat-body">
                <div class="error_notice">Please add email address.</div>
                <label class="pure-material-textfield-outlined">
                    <input type="email" name="linked_email[]" class="form-control2 input_data" placeholder=" "  value="">
                    <span>Email 1</span>                    
                    <div class="error_notice">Email format is incorrect.</div>
                </label>
                <label class="pure-material-textfield-outlined">
                    <input type="email" name="linked_email[]" class="form-control2 input_data" placeholder=" "  value="">
                    <span>Email 2</span> 
                    <div class="error_notice">Email format is incorrect.</div>                        
                </label>
                <label class="pure-material-textfield-outlined">
                    <input type="email" name="linked_email[]" class="form-control2 input_data" placeholder=" "  value="">
                    <span>Email 3</span> 
                    <div class="error_notice">Email format is incorrect.</div>                        
                </label>                
            </div>
            <a class="more_email pull-right mb-20" href="javascript:;">+ more</a>
        </form>        
      </div>            
      <div class="modal-footer">        
        <button type="button" class="button primary-btn invite">Invite</button>
        <button type="button" class="button secondary-btn" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="unpublishModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="post" post>
            @csrf
            <input type="hidden" name="list_userIdx" value="">
            <p class="para">
                Are you sure you want to delete this user?
            </p>                
        </form>        
      </div>            
      <div class="modal-footer">        
        <button type="button" class="button primary-btn confirm">Confirm</button>
        <button type="button" class="button secondary-btn" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('additional_javascript')    
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection