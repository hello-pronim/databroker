@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div id="step2" class="app-section app-reveal-section align-items-center step2">  
    		<div class="row">  	
	    		<div class="col col-9">
					<div class="page-title text-primary">Step 2 of 4: Description of the data </div>		
					<div id="Businesses_often_bec" class="sub-title">Optional but recommended</div>
					
				</div>
				<div class="col col-3">
				</div>
			</div>
			<div class="row">			
				<div class="col-6">
					<div class=" description-header flex-vcenter">
						<div id="Our_Most_Valuable_Fe_ra" class="description">Describe the data more in detail. What extra info can help potential buyers ...</div>
						<div id="Component_157___20" class="Component_157___20 ic-question flex-center">
							<svg class="Ellipse_18">
								<ellipse fill="rgba(186,192,197,1)" id="Ellipse_18" rx="7" ry="7" cx="7" cy="7">
								</ellipse>
							</svg>
							<div id="__re" class="text-white font-11-bold label">?</div>
						</div>
					</div>
					<div class="text-wrapper">
						<textarea class="user-message" placeholder="Your message"></textarea>
						<div class="char-counter" id="Title_rb">0 / xxx characters</div>
					</div>
					<div class="buttons flex-vcenter">
						<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a><!-- goto 44 -->
						<button type="button" class="btn customize-btn btn-next">Next</button><!-- goto 48 -->
					</div>
				</div>
				<div class="col-3">
				</div>
				<div class="col-3">
					<div class="font-21-bold">Not sure what to enter?</div>
					<div class="example-link">View an example (pdf)</div>
				</div>
			</div>
	    </div>	
    	<div id="step3" class="app-section app-reveal-section align-items-center step3">  
    		<div class="row">  	
	    		<div class="col col-9">
					<div class="page-title text-primary">Step 3 of 4: Use cases</div>		
					<div id="Businesses_often_bec" class="sub-title">Optional but recommended</div>
					
				</div>
				<div class="col col-3">
				</div>
			</div>
			<div class="row">			
				<div class="col-6">
					<div class=" description-header flex-vcenter">
						<div id="Our_Most_Valuable_Fe_ra" class="description">What are some typical use cases for your data? What business challenges do </div>
						<button type="button" class="btn btn-circle btn-sm btn-question">?</button>
					</div>
					<div class="text-wrapper">
						<textarea class="user-message" placeholder="Your message"></textarea>
						<div class="char-counter" id="Title_rb">0 / xxx characters</div>
					</div>
					<div class="buttons flex-vcenter">
						<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
						<button type="button" class="btn customize-btn btn-next">Next</button>
					</div>
				</div>
				<div class="col-3">
				</div>
				<div class="col-3">
					<div class="font-21-bold">Not sure what to enter?</div>
					<div class="example-link">View an example (pdf)</div>
				</div>
			</div>
	    </div>	
    </div>      
</div>

@endsection

