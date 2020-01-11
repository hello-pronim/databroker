@extends('layouts.data')

@section('additional_css')
	<link rel="stylesheet" href="{{ asset('css/imageuploadify.min.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<form method="post" action="{{ route('data.add_offer') }}" id="data-offer">
    		@csrf    		
	    	<div id="before" class="app-section app-reveal-section align-items-center step current">
	    		<div class="row">
	    			<div class="col-lg-6">
	    				<div class="blog-header">
				            <h1>Before we start</h1>			            
				            <p class="area">Please provide us some extra information about your company first. <br>
				            We need this info to publish it on the marketplace together with your data offer.</p>
				        </div>
				        <div class="blog-content">
				        	<label class="pure-material-textfield">In which country are you located?</label>
				        	<div class="adv-combo-wrapper">
			                    <select class="">
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
		                    <label class="pure-material-textfield mt-20">Please upload your company's logo <i class="material-icons text-grey text-top">error</i></label>
		                    
		                    <div class="fileupload">	                    	
					            <input type="file" name="companyLogo" accept='image/*'>
					            <div class="error_notice companyLogo"> This field is required</div>
		                    </div>
		                    <div class="buttons text-right">						
								<button type="button" class="btn customize-btn btn-next pull-right">{{ trans('pages.next') }}</button>
							</div>
				        </div>	
	    			</div>
	    		</div>	        
		    </div>	
	    	<div id="step1" class="app-section app-reveal-section align-items-center step">  
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
							<div class="section-title">{{ trans('pages.data_offer_step_1_description') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="text-wrapper">
							<textarea name="offerTitle" class="user-message min-h100" placeholder="{{ trans('pages.your_message') }}"></textarea>							
							<div class="error_notice offerTitle"> This field is required</div>
							<div class="char-counter" id="Title_rb">0 / xxx characters</div>	
						</div>
						
						<br>
						<div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.for_what_region') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="custom-dropdown-container">
	                        <div class="custom-dropdown" tabindex="1">
	                            <div class="select">
	                                <span>Please Select</span>
	                            </div>
	                            <input type="hidden" id="offercountry" name="offercountry" value="">
	                            <ul class="custom-dropdown-menu region-select" style="display: none;">
	                            	<h4>{{ trans('pages.select_region') }}:</h4>
	                            	@foreach ($regions as $region)
		                               	<div class="check_container">
					                        <label class="pure-material-checkbox">
					                            <input type="checkbox" class="form-control no-block check_community" name="region[]" region="{{$region->regionName}}" value="{{$region->regionIdx}}">
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
	                                <div class="dropdown-container country_list" style="display: none;">				                        
			                            <div class="adv-combo-wrapper">
			                            	<select class="" placeholder="{{ trans('pages.or_add_country') }}">
			                            		<option></option>
						                    	@foreach ($countries as $country)
					                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
					                            @endforeach
						                    </select>
						                </div>
			                            <input type="hidden" name="region[]" value="">
				                    </div>                             
	                                <div class="buttons flex-vcenter">						
										<button type="button" class="btn customize-btn">{{ trans('pages.confirm') }}</button>
									</div>
	                            </ul>
	                        </div>
	                        <div class="error_notice offercountry"> This field is required</div>
	                    </div>    
	                    <br>
	                    <div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.in_which_community') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="dropdown-container">
	                        <div class="dropdown2" tabindex="1">
	                            <input type="hidden" id="communityIdx" name="communityIdx" value="">
	                            <div class="adv-combo-wrapper">
	                            	<select class="">
	                            		<option></option>
	                                @foreach ($communities as $community)
		                                <option value="{{$community->communityIdx}}">{{ $community->communityName }}</option>
		                            @endforeach  
			                         </select>
				                </div>	                            
	                        </div>
	                        <div class="error_notice communityIdx"> This field is required</div>
	                    </div>    
	                    <br>
	                    <br>
						<div class="fileupload">	                    	
						    <input type="file" name="offerImage" accept='image/*' description="{{ trans('pages.data_offer_image_upload_description2') }}">
						    <div class="error_notice offerImage"> This field is required</div>
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
							<button type="button" class="btn customize-btn btn-next">{{ trans('pages.next') }}</button>
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
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.data_offer_step_2_description') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="text-wrapper">
							<textarea name="offerDescription" class="user-message" placeholder="{{ trans('pages.your_message') }}"></textarea>
							<div class="char-counter" id="Title_rb">0 / xxx characters</div>
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a><!-- goto 44 -->
							<button type="button" class="btn customize-btn btn-next">{{ trans('pages.next') }}</button><!-- goto 48 -->
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
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.data_offer_step_3_description') }} </div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="text-wrapper">
							<textarea name="useCaseContent" class="user-message" placeholder="{{ trans('pages.your_message') }}"></textarea>
							<div class="char-counter" id="Title_rb">0 / xxx characters</div>
						</div>
						<div class="buttons flex-vcenter">
							<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
							<button type="button" class="btn customize-btn btn-next">{{ trans('pages.next') }}</button>
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
						<div id="Businesses_often_bec" class="description">{{ trans('pages.dummy_text') }}</div>
						
					</div>
					<div class="col col-3 right-block">
						<div class="font-21-bold">{{ trans('pages.not_sure_what_to_enter') }}</div>
						<div class="example-link">{{ trans('pages.view_an_example_pdf') }}</div>
					</div>
				</div>
				<div class="row files-block">			
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.files') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="fileupload">                            
	                        <input type="file" name="offersample_files" accept='.xlsx,.xls,.doc,audio/*,.docx,.ppt,.pptx,.txt,.pdf' multiple filelist>
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
							<div id="Our_Most_Valuable_Fe_ra" class="section-title">{{ trans('pages.images') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="description1">{{ trans('pages.data_offer_image_upload_description1') }}</div>
						<div class="fileupload">                            
	                        <input type="file" name="offersample_images" accept='image/*' multiple description="{{ trans('pages.data_offer_image_upload_description2') }}">
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
							<button type="sbumit" class="btn customize-btn">{{ trans('pages.publish_on_marketplace') }}</button>
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
@endsection

