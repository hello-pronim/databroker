@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<form method="post" action="{{ route('data.add_offer') }}" id="buy-data">
    		@csrf
	    	<div id="step1" class="app-section app-reveal-section align-items-center step current">
	    		<div class="row header">
		    		<div class="col col-9">
						<div class="h1-small mgh15 text-primary">Please review the data you are about to buy</div>
						<div class="para text-bold">You are buying from Company name</div>
					</div>
				</div>
				<div class="app-monetize-section-item0 ml-0 mt-20"></div>
				<div class="row">
					<div class="col-6">

					</div>
					<div class="col-6">
					</div>
				</div>
		    </div>	
	    	<div id="step2" class="app-section app-reveal-section align-items-center step">  
	    		<div class="row header">
		    		<div class="col col-9">
						<div class="h1-small mgh15 text-primary">{{ trans('pages.data_offer_step_2') }}</div>		
						<div id="Businesses_often_bec" class="sub-title">{{ trans('pages.optional_but_recommended') }}</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class=" description-header flex-vcenter">
							<div id="Our_Most_Valuable_Fe_ra" class="h4_intro">{{ trans('pages.data_offer_step_2_description') }} <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.offer_description_tooltip') }}">help</i></div>
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
		</form>
    </div>
</div>

@endsection