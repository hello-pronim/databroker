@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div id="step2" class="app-section app-reveal-section align-items-center step2">  
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
						<div id="Component_157___20" class="Component_157___20 ic-question flex-center">
							<svg class="Ellipse_18">
								<ellipse fill="rgba(186,192,197,1)" id="Ellipse_18" rx="7" ry="7" cx="7" cy="7">
								</ellipse>
							</svg>
							<div id="__re" class="text-white font-11-bold label">?</div>
						</div>
					</div>
					<div class="text-wrapper">
						<textarea class="user-message" placeholder="{{ trans('pages.your_message') }}"></textarea>
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
    	<div id="step3" class="app-section app-reveal-section align-items-center step3">  
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
						<button type="button" class="btn btn-circle btn-sm btn-question">?</button>
					</div>
					<div class="text-wrapper">
						<textarea class="user-message" placeholder="{{ trans('pages.your_message') }}"></textarea>
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
    	<div id="step4" class="app-section app-reveal-section align-items-center step4">  
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
						<button type="button" class="btn btn-circle btn-sm btn-question">?</button>
					</div>
					<div class="file-drag-drop-zone">
						<div class="drag-drop-dummy">
						</div>
						<div class="file-list">
							<div class="file-entry">
								document.pdf
								<button type="button" class="btn btn-circle btn-sm btn-delete">×</button>
							</div>
							<div class="file-entry">
								document.pdf
								<button type="button" class="btn btn-circle btn-sm btn-delete">×</button>
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
						<button type="button" class="btn btn-circle btn-sm btn-question">?</button>
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
						<button type="button" class="btn customize-btn btn-next">{{ trans('pages.publish_on_marketplace') }}</button>
					</div>
				</div>
				<div class="col-3">
				</div>
				<div class="col-3">
				</div>
			</div>
	    </div>	
    </div>      
</div>

@endsection

