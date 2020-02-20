@extends('layouts.data')

@section('title', 'Publishing a data offer | Databroker')
@section('description', '')

@section('additional_css')
	<link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	<!-- <link rel="stylesheet" href="{{ asset('bower_components/select2/select2.css') }}"> -->
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer" ng-app="offerApp" ng-cloak ng-controller="offerCtrl">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	@if (isset($offer))
    	<form method="post" action="{{ route('data.update_offer', ['id'=> $offerIdx]) }}" id="data-offer">
    	@else
    	<form method="post" action="{{ route('data.add_offer') }}" id="data-offer">
    	@endif
    		@csrf    		
    		@if ($current_step == 'before')
    		<div id="before" class="app-section app-reveal-section align-items-center step current">
    		@else
	    	<div id="before" class="app-section app-reveal-section align-items-center step">
	    	@endif
	    		<div class="row">
	    			<div class="col-lg-6">
	    				<div class="blog-header">
				            <h1>Before we start</h1>
				            <p class="area">Please tell us a little more about your company.<br>
							This information will be published in the marketplace along with your data offer.</p>
				        </div>
				        <div class="blog-content">
				        	<label class="pure-material-textfield">Which country are you located in? </label>
				        	<div class="adv-combo-wrapper custom-select2">
			                    <select name="regionIdx" data-placeholder="{{ trans('pages.search_by_country') }}">
			                    	<option></option>
			                    	@foreach ($countries as $country)
		                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
		                            @endforeach
			                    </select>
		                        <div class="error_notice regionIdx"> This field is required</div>
			                </div>
		                    <label class="pure-material-textfield">{{ trans('pages.what_company_name') }}</label>
		                    <label class="pure-material-textfield-outlined">
		                        <input type="text" id="companyName" name="companyName" class="form-control input_data" placeholder=" "  value="">
		                        <span>{{ trans('pages.enter_name') }}</span>	                        
		                        <div class="error_notice companyName"> This field is required</div>
		                    </label>
		                    <label class="pure-material-textfield">{{ trans('pages.what_company_url') }}</label>
		                    <label class="pure-material-textfield-outlined">
		                        <input type="text" id="companyUrl" name="companyUrl" class="form-control input_data" placeholder=" "  value="">
		                        <span>{{ trans('pages.enter_url') }}</span>	                        
		                    </label>
		                    <label class="pure-material-textfield mt-20">Please upload your company's logo <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.company_logo_tooltip') }}">help</i></label>
		                    <div class="fileupload">	                    	
					            <input type="file" name="companyLogo" accept='image/*'>
					            <div class="error_notice companyLogo"> This field is required</div>
		                    </div>
		                    <div class="buttons text-right">						
								<button type="button" class="customize-btn btn-next pull-right">{{ trans('pages.next') }}</button>
							</div>
				        </div>	
	    			</div>
	    		</div>	        
		    </div>	
    		@if ($current_step == 'step1')
	    	<div id="step1" class="app-section app-reveal-section align-items-center step current">
	    	@else  
	    	<div id="step1" class="app-section app-reveal-section align-items-center step">  
	    	@endif
	    		<div class="row header">  	
		    		<div class="col col-9">
						<div class="page-title text-primary">{{ trans('pages.data_offer_step_1') }}</div>		
						<div id="Businesses_often_bec" class="sub-title">{{ trans('pages.minmum_publishing') }}</div>
						
					</div>
					<div class="col col-3 right-block">
						<div class="font-21-bold">{{ trans('pages.not_sure_what_to_enter') }}</div>
						<div class="example-link">{{ trans('pages.view_an_example_pdf') }}</div>
					</div>
				</div>
				<div class="row">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.data_offer_step_1_description') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.what_offer_tooltip') }}">help</i></div>
						</div>
						<div class="text-wrapper">							
							<textarea name="offerTitle" class="user-message min-h100" placeholder="{{ trans('pages.your_message') }}" maxlength="1000">{{ $offer['offerTitle'] ?? ''}}</textarea>
							<div class="error_notice offerTitle">This field is required</div>
							<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
						</div>
						
						<br>
						<div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.for_what_region') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_region_tooltip') }}">help</i></div>
						</div>
						<div class="custom-dropdown-container">
	                        <div class="custom-dropdown" tabindex="1">
	                            <div class="select">
	                            	@if (isset($regionCheckList) && count($regionCheckList) > 0)
	                                <span>{{implode(',', array_values($regionCheckList))}}</span>
	                            	@else
	                                <span>Please Select</span>
	                                @endif
	                            </div>
	                            @if (isset($regionCheckList))
	                            <input type="hidden" id="offercountry" name="offercountry" value="{{implode(',', array_keys($regionCheckList))}}">
	                            @else
	                            <input type="hidden" id="offercountry" name="offercountry" value="">
	                            @endif
	                            <ul class="custom-dropdown-menu region-select" style="display: none;">
	                            	<h4>{{ trans('pages.select_region') }}:</h4>
	                            	@foreach ($regions as $region)
		                               	<div class="check_container">
					                        <label class="pure-material-checkbox">
					                        	@if (isset($regionCheckList[$region->regionIdx]) && $regionCheckList[$region->regionIdx] != '')
					                            <input type="checkbox" class="form-control no-block check_community" name="region[]" region="{{$region->regionName}}" value="{{$region->regionIdx}}" checked>
					                            @else
					                            <input type="checkbox" class="form-control no-block check_community" name="region[]" region="{{$region->regionName}}" value="{{$region->regionIdx}}">
					                            @endif
					                            <span>{{$region->regionName}}</span>
					                        </label>
					                    </div>
					                @endforeach    
				                    
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" id="to_be_definded">
				                            <span>{{ trans('pages.other') }}</span>
				                        </label>
				                    </div>			                    
				                    <div class="adv-combo-wrapper custom-select2 mt-10" style="display: none;">
					                    <select class="" name="region[]" data-placeholder="{{ trans('pages.search_by_country') }}">
											<option></option>
					                    	@foreach ($countries as $country)
					                    		@if (isset($regionCheckList[$country->regionIdx]) && $regionCheckList[$country->regionIdx] != '')
				                                <option value="{{$country->regionIdx}}" selected>{{ $country->regionName }}</option>
				                                @else
				                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
				                                @endif
				                            @endforeach
					                    </select>
					                </div>
	                                <div class="buttons flex-vcenter">						
										<button type="button" class="customize-btn">{{ trans('pages.confirm') }}</button>
									</div>
	                            </ul>
	                        </div>
	                        <div class="error_notice offercountry"> This field is required</div>
	                    </div>  

	                    <br>
	                    <div class=" description-header flex-vcenter">
							<div id="community_title" class="section-title">{{ trans('pages.in_which_community') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="Please select maximum 1 community">help</i><br>							
							</div>
						</div>
						<div class="dropdown-container">
	                        <div class="dropdown2" tabindex="1">	                            
	                            <div class="adv-combo-wrapper">
	                            	<select ui-select2 id="community_box" name="communityIdx" ng-model="communityIdx" data-placeholder="Please Select">
	                            		<option></option>
	                                @foreach ($communities as $community)
	                                @if (isset($offer) && $offer['communityIdx'] == $community->communityIdx)
		                                <option value="{{$community->communityIdx}}" tooltip-text="{{ trans('description.community_'.str_replace(' ', '_', $community->communityName)	.'_tooltip') }}" selected>{{ $community->communityName }}</option>
		                            @else
		                                <option value="{{$community->communityIdx}}" tooltip-text="{{ trans('description.community_'.str_replace(' ', '_', $community->communityName)	.'_tooltip') }}">{{ $community->communityName }}</option>
		                            @endif
		                            @endforeach  
			                         </select>
				                </div>	                            
	                        </div>
	                        <div class="error_notice communityIdx"> This field is required</div>
	                    </div>    
						
						<div class="description-header" ng-show="themes[communityIdx].length > 0">
							<div class="h4_intro text-left mgh25">What themes fit your data offer? (max. 3)</div>
							<div class="row limited-check-group" max-check="3">
								<input type="hidden" id="offertheme" name="offertheme" value="">
                               	<div class="check_container col-xl-4"  ng-repeat="theme in themes[communityIdx]">
			                        <label class="pure-material-checkbox">
			                            <input type="checkbox" class="form-control no-block check_theme" key="<%= theme.id %>">
			                            <span ng-bind="theme.name" class="para"></span>
			                        </label>
			                    </div>
			            	</div>
						</div>

	                    <br>
	                    <br>
	                    <div class=" description-header flex-vcenter mb-10">
							<div class="section-title">Please add an image that can be used to represent your data offer <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_image_tooltip') }}">help</i><br>							
							</div>
						</div>	                    
						<div class="fileupload">
							@if (isset($offer_path))
						    <input type="file" name="offerImage" accept='image/*' description="{{ trans('pages.data_offer_image_upload_description2') }}" remotefile="{{ json_encode($offer_images) ?? '' }}" remoteroot="{{ $offer_path ?? ''}}" remotefiletype="image">
						    @else
						    <input type="file" name="offerImage" accept='image/*' description="{{ trans('pages.data_offer_image_upload_description2') }}">
						    @endif
						    <div class="error_notice offerImage"> This field is required</div>
						</div>
						<div class="buttons flex-vcenter">
							@if ($current_step == 'before')
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
							@else
							<span></span>
							@endif
							<button type="button" class="customize-btn btn-next">{{ trans('pages.next') }}</button>
						</div>
					</div>
					<div class="col-3">
					</div>
					<div class="col-3">
					</div>
				</div>
		    </div>	
	    	<div id="step2" class="app-section app-reveal-section align-items-center step">  
	    		<div class="row header">  	
		    		<div class="col col-9">
						<div class="page-title text-primary">{{ trans('pages.data_offer_step_2') }}</div>		
						<div id="Businesses_often_bec" class="sub-title">{{ trans('pages.optional_but_recommended') }}</div>
						
					</div>
					<div class="col col-3 right-block">
						<div class="font-21-bold">{{ trans('pages.not_sure_what_to_enter') }}</div>
						<div class="example-link">{{ trans('pages.view_an_example_pdf') }}</div>
					</div>
				</div>
				<div class="row">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.data_offer_step_2_description') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_description_tooltip') }}">help</i></div>							
						</div>
						<div class="text-wrapper">
							<textarea name="offerDescription" class="user-message" placeholder="{{ trans('pages.your_message') }}" maxlength="1000">{{$offer['offerDescription'] ?? ''}}</textarea>
							<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a><!-- goto 44 -->
							<button type="button" class="customize-btn btn-next">{{ trans('pages.next') }}</button><!-- goto 48 -->
						</div>
					</div>
					<div class="col-3">
					</div>
					<div class="col-3">
					</div>
				</div>
		    </div>	
	    	<div id="step3" class="app-section app-reveal-section align-items-center step">  
	    		<div class="row header">
		    		<div class="col col-9">
						<div class="page-title text-primary">{{ trans('pages.data_offer_step_3') }}</div>		
						<div id="Businesses_often_bec" class="sub-title">{{ trans('pages.optional_but_recommended') }}</div>
						
					</div>
					<div class="col col-3 right-block">
						<div class="font-21-bold">{{ trans('pages.not_sure_what_to_enter') }}</div>
						<div class="example-link">{{ trans('pages.view_an_example_pdf') }}</div>
					</div>
				</div>
				<div class="row">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.data_offer_step_3_description') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_usecase_tooltip') }}">help</i></div>							
						</div>
						<div class="text-wrapper">
							<textarea name="useCaseContent" class="user-message" placeholder="{{ trans('pages.your_message') }}" maxlength="1000">{{$usecase['useCaseContent'] ?? ''}}</textarea>
							<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>	
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
							<button type="button" class="customize-btn btn-next">{{ trans('pages.next') }}</button>
						</div>
					</div>
					<div class="col-3">
					</div>
					<div class="col-3">
					</div>
				</div>
		    </div>	
	    	<div id="step4" class="app-section app-reveal-section align-items-center step">  
	    		<div class="row header">  	
		    		<div class="col col-9">
						<div class="page-title text-primary">{{ trans('pages.data_offer_step_4') }}</div>		
						<div id="Businesses_often_bec" class="sub-title">{{ trans('pages.optional_but_recommended') }}</div>
						<div id="Businesses_often_bec" class="description">{{ trans('pages.data_offer_step_4_description') }}</div>
						
					</div>
					<div class="col col-3 right-block">
						<div class="font-21-bold">{{ trans('pages.not_sure_what_to_enter') }}</div>
						<div class="example-link">{{ trans('pages.view_an_example_pdf') }}</div>
					</div>
				</div>
				<div class="row files-block">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.files') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_sample_file_tooltip') }}">help</i></div>						
						</div>
						<div class="fileupload">                            
							@if (isset($sample_files))
	                        <input type="file" name="offersample_files" accept='.xlsx,.xls,.doc,audio/*,.docx,.ppt,.pptx,.txt,.pdf,.zip,.rar' multiple filelist  remotefile="{{ json_encode($sample_files) ?? '' }}" remoteroot="{{ $offersample_path ?? ''}}" remotefiletype="file">
	                        @else
	                        <input type="file" name="offersample_files" accept='.xlsx,.xls,.doc,audio/*,.docx,.ppt,.pptx,.txt,.pdf,.zip,.rar' multiple filelist>
	                        @endif
	                    </div>
						<div class="file-drag-drop-zone">
							<div class="drag-drop-dummy">
							</div>
							<div class="row">
								<div class="file-entries col-4">
									<div class="file-entry flex-vcenter">
										document.pdf
										<div class="icon-delete"><span class="iconify" data-icon="ant-design:close-circle-filled" data-inline="false"></span></div>
									</div>
									<div class="file-entry flex-vcenter">
										document.xxx
										<div class="icon-delete"><span class="iconify" data-icon="ant-design:close-circle-filled" data-inline="false"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row images-block">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.images') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_sample_file_tooltip') }}">help</i></div>							
						</div>
						<div class="description1">{{ trans('pages.data_offer_image_upload_description1') }}</div>
						<div class="fileupload">                 
							@if (isset($sample_files))
	                         <input type="file" name="offersample_images" accept='image/*' multiple description="{{ trans('pages.data_offer_image_upload_description2')}}"  remotefile="{{ json_encode($sample_images) ?? '' }}" remoteroot="{{ $offersample_path ?? ''}}" remotefiletype="image">
	                        @else
	                        <input type="file" name="offersample_images" accept='image/*' multiple description="{{ trans('pages.data_offer_image_upload_description2') }}">
	                        @endif
	                    </div>
						<div class="images-list">
							<div class="row">
								<div class="image-item col flex-center">1</div>
								<div class="image-item col flex-center">2</div>
							</div>
							<div class="row">
								<div class="image-item col flex-center">3</div>
								<div class="image-item col flex-center">4</div>
							</div>
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>{{ trans('pages.previous_step') }}</span></a>
							@if (isset($offer))
							<button type="sbumit" class="customize-btn">Update Offer</button>
							@else
							<button type="sbumit" class="customize-btn">{{ trans('pages.publish_on_marketplace') }}</button>
							@endif
						</div>
					</div>
					<div class="col-3">
					</div>
					<div class="col-3">
					</div>
				</div>
		    </div>	
		</form>
    </div>      
</div>

@endsection

@section('additional_javascript')
	<script src="{{ asset('js/plugins/imageuploadify.min.js') }}"></script>
	<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
	<!-- <script src="{{ asset('bower_components/select2/select2.min.js') }}"></script> -->
	<script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
	<script src="{{ asset('bower_components/angular-ui-select2/src/select2.js') }}"></script>
	<script type="text/javascript">
		var themes = <?php echo $theme_json; ?>;
		var communityIdx;
		@if (isset($offer['communityIdx']))
		communityIdx = `{{$offer['communityIdx']}}`;
		@endif
		var app = angular.module('offerApp', []) 

		  .config(function($interpolateProvider) {
		    // To prevent the conflict of `{{` and `}}` symbols
		    // between Blade template engine and AngularJS templating we need
		    // to use different symbols for AngularJS.

		    $interpolateProvider.startSymbol('<%=');
		    $interpolateProvider.endSymbol('%>');
		  });

		app.controller('offerCtrl', function($scope) {
			$scope.themes = themes;
			if (communityIdx) {
				$scope.communityIdx = communityIdx;
			}
		});
	</script>
@endsection

