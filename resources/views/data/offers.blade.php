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
				        	<div class="dropdown-container">
		                        <div class="dropdown" tabindex="1">
		                            <div class="select">
		                                <span>{{ trans('pages.please_select') }}</span>
		                            </div>
		                            <input type="hidden" id="regionIdx" name="regionIdx" value="">
		                            <ul class="dropdown-menu" style="display: none;">
		                            @foreach ($countries as $country)
		                                <li value="{{$country->regionIdx}}">{{ $country->regionName }}</li>
		                            @endforeach    
		                            </ul>	                           
		                        </div>
		                        <div class="error_notice"> This field is required</div>
		                    </div>
		                    <label class="pure-material-textfield">In which country are you located?</label>
		                    <label class="pure-material-textfield-outlined">
		                        <input type="text" id="companyUrl" name="companyUrl" class="form-control input_data" placeholder=" "  value="">
		                        <span>{{ trans('pages.enter_url') }}</span>	                        
		                    </label>
		                    <label class="pure-material-textfield mt-20">Please upload your company's logo <i class="material-icons text-grey text-top">error</i></label>
		                    
		                    <div class="fileupload">	                    	
					            <input type="file" name="companyLogo" accept='.xlsx,.xls,image/*,.doc,audio/*,.docx,.ppt,.pptx,.txt,.pdf'>
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
							<div class="char-counter" id="Title_rb">0 / xxx characters</div>
						</div>
						<br>
						<div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.for_what_region') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="dropdown-container">
	                        <div class="custom-dropdown" tabindex="1">
	                            <div class="select">
	                                <span>Please Select</span>
	                            </div>
	                            <input type="hidden" id="region" name="regionNames" value="">
	                            <ul class="custom-dropdown-menu region-select" style="display: none;">
	                            	<h4>{{ trans('pages.select_region') }}:</h4>
	                               	<div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="world">
				                            <span>World</span>
				                        </label>
				                    </div>
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="north america">
				                            <span>North America</span>
				                        </label>
				                    </div>
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="asia">
				                            <span>Asia</span>
				                        </label>
				                    </div>
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="europe">
				                            <span>Europe</span>
				                        </label>
				                    </div>
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="south america">
				                            <span>South America</span>
				                        </label>
				                    </div>
				                    <div class="check_container">
				                        <label class="pure-material-checkbox">
				                            <input type="checkbox" class="form-control no-block check_community" name="region[]" value="to_be_definded">
				                            <span>To be defined</span>
				                        </label>
				                    </div>			                    
	                                <div class="input pure-material-textfield-outlined"><input type="text" placeholder="{{ trans('pages.or_add_country') }}" name="region[]" class="form-control input_data"></div>                              
	                                <div class="buttons flex-vcenter">						
										<button type="button" class="btn customize-btn">{{ trans('pages.confirm') }}</button>
									</div>
	                            </ul>
	                        </div>
	                    </div>    
	                    <div class=" description-header flex-vcenter">
							<div class="section-title">{{ trans('pages.in_which_community') }}</div>
							<div class="gray-icon"><i class="fa fa-question-circle"></i></div>
						</div>
						<div class="dropdown-container">
	                        <div class="dropdown" tabindex="1">
	                            <div class="select">
	                                <span>Please Select</span>
	                            </div>
	                            <input type="hidden" id="community" name="community" value="Agriculture/Mining/Forestry">
	                            <ul class="dropdown-menu" style="display: none;">
	                                <li value="Agriculture/Mining/Forestry">Agriculture/Mining/Forestry</li>
	                                <li value="Advertising/Media/Publishing">Advertising/Media/Publishing</li>
	                                <li value="Automotive">Automotive</li>
	                                <li value="Construction/Engineering/Infrstructure">Construction/Engineering/Infrstructure</li>
	                                <li value="Chemicals">Chemicals</li>
	                                <li value="Creative">Creative</li>
	                                <li value="Education">Education</li>
	                                <li value="Energy/Utilities">Energy/Utilities</li>
	                                <li value="Financial services &amp; insurance">Financial services &amp; insurance</li>
	                                <li value="Government/Non-profit">Government/Non-profit</li>
	                                <li value="Healthcare">Healthcare</li>
	                                <li value="Hospitality/Tourism">Hospitality/Tourism</li>
	                                <li value="IT services">IT services</li>
	                                <li value="Manufacturing">Manufacturing</li>
	                                <li value="Pharmaceutical/Biotech">Pharmaceutical/Biotech</li>
	                                <li value="Retail/Consumer goods">Retail/Consumer goods</li>
	                                <li value="Telecommunications/Electronics">Telecommunications/Electronics</li>
	                                <li value="Transportation/Logistics">Transportation/Logistics</li>
	                                <li value="">Other industry</li>
	                            </ul>
	                        </div>
	                    </div>    
						<div class="fileupload">	                    	
						    <input type="file" name="data_offer_image" accept='.xlsx,.xls,image/*,.doc,audio/*,.docx,.ppt,.pptx,.txt,.pdf'>
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
						<div class="file-drag-drop-zone">
							<div class="drag-drop-dummy">
							</div>
							<div class="row">
							<div class="file-list col-4">
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
						<div class="file-drag-drop-zone">
							<div class="drag-drop-dummy">
							</div>
						</div>
						<div class="description2">{{ trans('pages.data_offer_image_upload_description2') }}</div>
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

