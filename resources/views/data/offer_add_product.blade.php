@extends('layouts.app')

@section('title', 'Add a new data product | Databroker')
@section('description', '')

@section('additional_css')	
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
<!-- -->
<div class="container-fluid app-wapper help buying-data">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
        	<form id="add_product" action="{{ route('data_offer_submit_product') }}" method="post" novalidate>
        		@csrf        		
        		<input type="hidden" name="offerIdx" value="{{ $offer['offerIdx'] }}">
        		<div class="blog-header mgt60">
	                <h1 class="h1-small">Add a new data product</h1>
	                <h3 class="h3 text-normal">This data product is related to the following data offer:</h3>
	                <h3 class="h3"> {{ $offer['offerTitle'] }} </h3>
	                @if($offer['region'])
	                <span class="para offer-location">
	                	@foreach($offer['region'] as $region)
		            		<span>{{ $region->regionName }}</span>
		            	@endforeach
		            </span>
		            @endif
	            </div>
	            <div class="divider-green mgh40"> </div>
	            <div class="content">
	            	<div class="row">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">What is the specific data product are you selling? <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.what_product_tooltip') }}">help</i></h4>

							<div class="text-wrapper">
								<textarea name="productTitle" class="round-textbox user-message min-h100" placeholder="{{ trans('pages.your_message') }}"  maxlength="100"></textarea>							
								<div class="error_notice productTitle"> This field is required</div>
								<div class="char-counter"><span>0</span> / <span>100</span> characters</div>
							</div>
						</div>
					</div>
	            	<div class="row">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Which region does the data cover? <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_datacover_tooptip') }}">help</i></h4>

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
					                    
					                    <h4 class="h4_intro text-left">Or add country</h4>
                                        <div class="adv-combo-wrapper custom-select2 mt-10">
						                    <select class="" name="region[]" data-placeholder="{{ trans('pages.search_by_country') }}">
												<option></option>
						                    	@foreach ($countries as $country)
					                                <option value="{{$country->regionIdx}}">{{ $country->regionName }}</option>
					                            @endforeach
						                    </select>
						                </div>
		                                <div class="buttons flex-vcenter">						
											<button type="button" class="customize-btn">{{ trans('pages.confirm') }}</button>
										</div>
		                            </ul>
		                        </div>
		                    </div>    
		                    <div class="error_notice offercountry"> This field is required</div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">In which format will the data be provided?<i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_data_provided_tooptip') }}">help</i></h4>
				        	<div class="radio-wrapper format">		                    
			                    <label class="container para">File
								  <input type="radio" name="format" value="File">
								  <span class="checkmark"></span>
								</label>

								<label class="container para">Api flow	
								  <input type="radio" name="format" value="Api flow">
								  <span class="checkmark"></span>
								</label>

								<label class="container para">Stream
								  <input type="radio" name="format" value="Stream">
								  <span class="checkmark"></span>
								</label>
			                </div>
			                <div class="error_notice format"> Please select the data format.</div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-12">
			                <h4 class="h4_intro text-left">How will you handle pricing for this data product?<i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_pricing_tooptip') }}">help</i></h4>
				        	<div class="radio-wrapper period">
				        		<div class="mb-10">
				        			<label class="container para">FREE
										<input type="radio" name="period" value="free">
										<span class="checkmark"></span>
									</label>
									<div class="period_select">
										<span class="para mlr-20">for access to this data for </span>
							        	<div class="adv-combo-wrapper custom-select2">
						                    <select name="free_period" data-placeholder="Please select a period" class="no-search">
						                    	<option></option>
						                    	<option value="day">1 day</option>
						                    	<option value="week">1 week</option>
						                    	<option value="month">1 month</option>
						                    	<option value="year">1 year</option>
						                    </select>						                    
						                </div>
						                <div class="row">
						                	<div class="col-lg-6">
						                		<label class="pure-material-textfield-outlined">
						                			<input type="text" id="dataUrl" name="dataUrl" class="form-control input_data w-100" placeholder=" " value="">
						                			<span>{{ trans('pages.data_url') }}</span>
						                		</label>
						                	</div>
						                </div>				                
									</div>	
									<div class="error_notice free_period"> Please select a period.</div>
									<div class="error_notice dataUrl"> You must provide a URL where the buyer can get the data for free.</div>
				        		</div>		                    		                    
								<div class="mb-10">
									<label class="container para">I will set a price. No bidding is possible.
									  <input type="radio" name="period" value="no_bidding">
									  <span class="checkmark"></span>
									</label>
									<div class="period_select">
										<label class="pure-material-textfield-outlined mb-0 p-0">
					                        <span class="currency">€ </span><input type="number" step="0.01" name="no_bidding_price" class="form-control2 input_data" placeholder="0.00" value=""> 
					                    </label>
					                    <span>(tax incl.)</span>
										<span class="para mlr-20">for access to this data for</span>
							        	<div class="adv-combo-wrapper custom-select2">
						                    <select name="no_bidding_period" data-placeholder="Please select a period" class="no-search">
						                    	<option></option>
						                    	<option value="day">1 day</option>
						                    	<option value="week">1 week</option>
						                    	<option value="month">1 month</option>
						                    	<option value="year">1 year</option>
						                    </select>				                    				                        
						                </div>			
										<div>
											<span class="error_notice no_bidding_price"> Price is required. </span>
								            <span class="error_notice no_bidding_period"> Please select a period.</span>
								            <span class="error_notice no_bidding_price_min"> Price should be more than € 0.5.</span>
								        </div>			                
									</div>
				                </div>
				                <div class="mb-10">
				                	<label class="container para">I will set a price, but buyers can also send bids.
									  <input type="radio" name="period" value="bidding_possible">
									  <span class="checkmark"></span>
									</label>
				                	<div class="period_select">
										<label class="pure-material-textfield-outlined mb-0 p-0">
					                        <span class="currency">€ </span><input type="number" step="0.01" name="bidding_possible_price" class="form-control2 input_data" placeholder="0.00" value=""> 
					                    </label>
					                    <span>(tax incl.)</span>
										<span class="para mlr-20">for access to this data for</span>
							        	<div class="adv-combo-wrapper custom-select2">
						                    <select name="bidding_possible_period" data-placeholder="Please select a period" class="no-search">
						                    	<option></option>
						                    	<option value="day">1 day</option>
						                    	<option value="week">1 week</option>
						                    	<option value="month">1 month</option>
						                    	<option value="year">1 year</option>
						                    </select>				                    				                        
						                </div>
						                <div>
											<span class="error_notice bidding_possible_price"> Price is required. </span>
									        <span class="error_notice bidding_possible_price_min"> Price should be more than € 0.5.</span>
								            <span class="error_notice bidding_possible_period"> Please select a period.</span>
								       	</div>
									</div>
				                </div>							
				                <div class="mb-10">
				                	<label class="container para">I will not set a price. Interested parties can send bids.
									  <input type="radio" name="period" value="bidding_only">
									  <span class="checkmark"></span>
									</label>	
									<div class="period_select">									
										<span class="para mlr-20">for access to this data for</span>
							        	<div class="adv-combo-wrapper custom-select2">
						                    <select name="bidding_only_period" data-placeholder="Please select a period" class="no-search">
						                    	<option></option>
						                    	<option value="day">1 day</option>
						                    	<option value="week">1 week</option>
						                    	<option value="month">1 month</option>
						                    	<option value="year">1 year</option>
						                    </select>				                    				                        
						                </div>
									</div>
									<div class="error_notice bidding_only_period"> Please select a period.</div>
				                </div>
		                   		<div class="error_notice period">Please set how you will handle the pricing for the data.</div>
			                </div>
						</div>
					</div>
					<div class="row mgt30">
						<div class="col-lg-6">
							<h4 class="h4_intro text-left">Identify your data source</h4>
							<div class="row">
								<div class="col col-4">
									<p class="para text-center">Select the DXC</p class="para">
									<ul class="selectable-list list-dxc list-style-none pl-0 text-center border-grey">
										<li class="selectable-list-item active selected" item-id="1">85.120.23.12</li>
										<li class="selectable-list-item" item-id="2">85.120.23.13</li>
									</ul>
								</div>
								<div class="col col-8">
									<p class="para text-center">Select the data</p class="para">
									<table class="table border-grey">
										<thead>
											<tr>
												<th class="text-bold fs-16 text-black">Data</th>
												<th class="text-bold fs-16 text-black">Type</th>
												<th class="text-bold fs-16 text-black">Product name</th>
											</tr>
										</thead>
										<tbody class="selectable-list list-data">
											<tr class="selectable-list-item" parent-id="1">
												<td>Weather-file1.csv</td>
												<td>File</td>
												<td>Weather global</td>
											</tr>
											<tr class="selectable-list-item" parent-id="1">
												<td>Weather-germany1.csv</td>
												<td>File</td>
												<td>Weather germany</td>
											</tr>
											<tr class="selectable-list-item" parent-id="2">
												<td>Weather-file2.csv</td>
												<td>File</td>
												<td>Weather global</td>
											</tr>
											<tr class="selectable-list-item" parent-id="2">
												<td>Weather-germany2.csv</td>
												<td>File</td>
												<td>Weather germany</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Is there any additional information that might be useful for a potential buyer? (optional)<i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_potential_buyer_tooptip') }}">help</i></h4>
				        	<div class="text-wrapper">
								<textarea name="productMoreInfo" class="round-textbox user-message min-h200" placeholder="{{ trans('pages.your_message') }}" maxlength="1000"></textarea>
								<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
							</div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Provide a URL where the buyer can read the data license. <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_license_url_tooptip') }}">help</i></h4>
				        	<label class="pure-material-textfield-outlined">
		                        <input type="text" id="licenseUrl" name="licenceUrl" class="form-control2 input_data" placeholder=" "  value="">
		                        <span>{{ trans('pages.enter_url') }}</span>	                        
		                    </label>
		                   	<div class="error_notice licenceUrl"> You must provide a URL where the buyer can consult the data licence.</div>
						</div>
					</div>
					<div class="row mgt40">
						<div class="col-lg-6">
							<button class="customize-btn" type="submit">PUBLISH NOW</button><!-- submit and redirect to #38 -->
						</div>
					</div>
	            </div>
        	</form>            
        </div>  
    </div>
</div>

@endsection

@section('additional_javascript')
	<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
	<script type="text/javascript">
		let active_id = $('.list-dxc .selectable-list-item.active').attr('item-id');
		$.each($('.list-data .selectable-list-item'), function(key, value){
			if($(value).attr('parent-id')==active_id){
				$(value).addClass('active');
			}
		});
		$('.list-dxc .selectable-list-item').click(function(e){
			let active_id = $(this).attr('item-id');
			$('.list-dxc .selectable-list-item.active').removeClass('active');
			$('.list-dxc .selectable-list-item.selected').removeClass('selected');
			$(this).addClass('active');
			$(this).addClass('selected');
			$('.list-data .selectable-list-item.active').removeClass('active');
			$.each($('.list-data .selectable-list-item'), function(key, value){
				if($(value).attr('parent-id')==active_id){
					$(value).addClass('active')
				}
			});
		});
		$('.list-data .selectable-list-item').click(function(e){
			$('.list-data .selectable-list-item.selected').removeClass('selected');
			$(this).addClass('selected');
		});
	</script>
@endsection
