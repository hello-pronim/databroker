@extends('layouts.app')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper profile">
    <div class="bg-pattern1-left"></div>
	<div class="app-section app-reveal-section align-items-center">	    
		<div class="container">
			<div class="page-title text-primary">{{ trans('pages.company_profile') }}</div>
			<div class="label companyname">
				<span>{{ trans('pages.company_profile_desc') }}</span>
			</div>			

            <div class="app-section profileinfo">
                <div id="company-profile-display-section">
                    <div id="edit-button" class="action-button-edit top-right flex-center" onClick="document.getElementById('company-profile-edit-section').style.display = 'block';document.getElementById('company-profile-display-section').style.display = 'none';">
                        <i class="material-icons">edit</i> {{ trans('pages.edit') }}
                    </div>                        
                        <div class="row">
                            <div class="col-2 info-label">Company:</div>
                            <div class="col info-text">{{ $company->companyName }}</div>
                        </div>

                        <div class="row">
                            <div class="col-2 info-label">Location:</div>
                            <div class="col info-text">{{ $company->region->regionName }}</div>
                        </div>
                        <div class="row">
                            <div class="col-2 info-label">URL:</div>
                            <div class="col info-text"><a class="text-green" href="{{ $company->companyURL }}">{{ $company->companyURL }}</a></div>
                        </div>
                        <div class="row">                            
                            <div class="col companylogo">
                                @if($company->companyLogo)
                                <img src="{{ asset('/uploads/company/'.$company->companyLogo) }}">
                                @endif
                            </div>
                        </div>                        
                    </div><!--profile-display-section-->

                <div id="company-profile-edit-section" style="display: none;" >
                    <div id="cancel-button" class="top-right flex-center" onClick="document.getElementById('company-profile-edit-section').style.display = 'none';document.getElementById('company-profile-display-section').style.display = 'block';">
                       <i class="material-icons">close</i> Cancel
                    </div>
                    <br />
                    <form method="POST" action="{{ route('account.company.update') }}">
                        @csrf
                        <input type="hidden" id="providerIdx" name="providerIdx" value="{{ $company->providerIdx }}">
                        <input type="hidden" name="old_companyLogo" value="{{ $company->companyLogo }}">
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Company</div>
                            <div class="col info-text flex-vcenter">
                                <p class="info-text mb-0">{{ $company->companyName }}</p>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback companyName ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">Location:</div>
                            <div class="col info-text flex-vcenter">
                                <div class="adv-combo-wrapper custom-select2 no-border">
                                    <select name="regionIdx" data-placeholder="{{ trans('pages.search_by_country') }}">
                                        <option></option>
                                        @foreach ($countries as $country)
                                            @if( $country->regionIdx == $company->regionIdx )
                                            <option value="{{$country->regionIdx}}" selected>{{ $country->regionName }}</option>
                                            @else
                                            <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="error_notice regionIdx"> This field is required</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback lastname ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>
                        <div class="row">
                            <div class="col-3 info-label flex-vend">URL:</div>
                            <div class="col info-text flex-vcenter">
                                <input type="text" id="companyURL" name="companyURL" class="form-control" placeholder=" "  value="{{ old('companyURL', $company->companyURL) }}" autocomplete="companyURL" autofocus>
                            </div>
                        </div>
                        <div class="row">                                                        
                            <span class="invalid-feedback companyURL ml-15" role="alert">
                                <strong></strong>
                            </span>                            
                        </div>                       
                        <div class="fileupload data-offer">                            
                            <input type="file" name="companyLogo" accept='image/*'>
                            <div class="error_notice companyLogo"> This field is required</div>
                        </div>
                        <div class="row">
                            <div class="col info-text flex-vend">
                                <button type="submit" class="customize-btn">UPDATE COMPANY</button>
                            </div>
                        </div>
                    </form>
                </div><!--profile-edit-section-->
			</div>
		</div>
	</div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>        
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>        
@endsection