@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">	
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center">
    		<a href="javascript:;" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>Back</span></a>
	        <div class="cat-header">
	        	<div class="row">
	        		<div class="col-lg-6">
	        			<h4 class="text-green">{{ trans('pages.explore_data_offer') }}</h4>
			            <h1 class="mt-0">Geographics Community</h1>
			            <p class="desc">
			            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
			            </p>	            
			            <button type="button" class="btn btn-round sendmessage-btn">{{ trans('pages.read_more') }}</button>
	        		</div>	
	        	</div>	        	
	        </div>	        
	        <div class="app-monetize-section-item0 ml-0 mt-20"></div>
	        <div class="cat-body">
	        	<div class="row">
	        		<div class="col-lg-4">
	        			<label class="cat-label">{{ trans('pages.explore') }}</label>
	        			<div class="dropdown-container cat-select">
	                        <div class="dropdown" tabindex="1">
	                            <div class="select">
	                                <span>{{ trans('pages.please_select') }}</span>
	                            </div>
	                            <input type="hidden" id="regionIdx" name="regionIdx" value="">
	                            <ul class="dropdown-menu" style="display: none;">
	                            @foreach ($communities as $community)
	                                <li value="{{$community->communityIdx}}">{{ $community->communityName }}</li>
	                            @endforeach    
	                            </ul>
	                        </div>	                        
	                    </div>
	        		</div>
	        		<div class="col-lg-4">
	        			<label class="cat-label">{{ trans('pages.for_data_about') }}</label>
	        			<div class="custom-dropdown-container cat-select">
	                        <div class="custom-dropdown" tabindex="1">
	                            <div class="select">
	                                <span>{{ trans('pages.all_themes') }}</span>
	                            </div>
	                            <input type="hidden" id="regionIdx" name="regionIdx" value="">
	                            <ul class="dropdown-menu" style="display: none;">
	                            @foreach ($communities as $community)
	                                <li value="{{$community->communityIdx}}">{{ $community->communityName }}</li>
	                            @endforeach    
	                            </ul>
	                        </div>	                        
	                    </div>
	        		</div>
	        		<div class="col-lg-4">
	        			<label class="cat-label">{{ trans('pages.in') }}</label>
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
				                        <div class="dropdown" tabindex="1">
				                            <div class="select">
				                                <span>{{ trans('pages.or_add_country') }}</span>
				                            </div>
				                            <input type="hidden" name="region[]" value="">
				                            <ul class="dropdown-menu" style="display: none;">
				                            @foreach ($countries as $country)
				                                <li value="{{$country->regionIdx}}">{{ $country->regionName }}</li>
				                            @endforeach    
				                            </ul>	                           
				                        </div>				                        
				                    </div>                             
	                                <div class="buttons flex-vcenter">						
										<button type="button" class="btn customize-btn">{{ trans('pages.confirm') }}</button>
									</div>
	                            </ul>
	                        </div>
	                        <div class="error_notice offercountry"> This field is required</div>
	                    </div>  
	        		</div>
	        	</div>
	        </div>
    	</div>		    
    </div>      
</div>

@endsection