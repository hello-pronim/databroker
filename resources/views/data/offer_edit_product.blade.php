@extends('layouts.app')

@section('title', 'Edit data product | Databroker')
@section('description', '')

@section('additional_css')	
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
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
        		<input type="hidden" name="productIdx" value="{{ $product['productIdx'] }}">
        		<div class="blog-header mgt60">
	                <h1 class="h1-small">Update data product</h1>
	                <h3 class="h3 text-normal">This data product is related to the following data offer:</h3>
	                <h3 class="h3"> {{ $offer['offerTitle'] }} </h3>
	                <span class="para offer-location">
	                	@foreach($offer['region'] as $region)
		            		<span>{{ $region->regionName }}</span>
		            	@endforeach
		            </span>
	            </div>
	            <div class="divider-green mgh40"> </div>
	            <div class="content">
	            	<div class="row">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">What is the specific data product are you selling? <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.what_product_tooltip') }}">help</i></h4>

							<div class="text-wrapper">
								<textarea name="productTitle" class="round-textbox user-message min-h100" placeholder="{{ trans('pages.your_message') }}" maxlength="0100">{{$product['productTitle']}}</textarea>							
								<div class="error_notice productTitle"> This field is required</div>
								<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
							</div>
						</div>
					</div>
	            	<div class="row">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Which region does the data cover? <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_datacover_tooptip') }}">help</i></h4>
				        	<div class="custom-dropdown-container">
		                        <div class="custom-dropdown" tabindex="1">
		                            <div class="select">
		                                <span>{{implode(',', array_values($regionCheckList))}}</span>
		                            </div>
		                            <input type="hidden" id="offercountry" name="offercountry" value="{{implode(',', array_keys($regionCheckList))}}">
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
		                        <div class="error_notice offercountry"> This field is required</div>
		                    </div>    
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">In which format will the data be provided?<i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_data_provided_tooptip') }}">help</i></h4>
				        	<div class="radio-wrapper format">
				        		@foreach ($prodTypeList as $prodType)	
				        		<div class="mb-10">	                    
				                    <label class="container para">{{$prodType}}
									  <input type="radio" @if ($prodType == $product['productType']) checked="checked" @endif name="format" value="{{$prodType}}">
									  <span class="checkmark"></span>
									</label>
								</div>
								@endforeach
			                </div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-12">
			                <h4 class="h4_intro text-left">How will you handle pricing for this data product? <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_pricing_tooptip') }}">help</i></h4>
				        	<div class="radio-wrapper period">
				        		@foreach ($bidTypes as $bidtype)
				        		<div class="mb-10" id="{{$bidtype['type']}}">
				        			<label class="container para">{{$bidtype['label']}}
										<input type="radio" @if ($bidtype['type'] == $product['productBidType']) checked="checked" @endif name="period" value="{{$bidtype['type']}}">
										<span class="checkmark"></span>
									</label>
									<div class="period_select">
										@if ($bidtype['biddable'])
										<label class="pure-material-textfield-outlined mb-0 p-0">
					                        <span class="currency">€ </span><input type="number" step="0.01" name="{{$bidtype['type']}}_price" class="form-control2 input_data" placeholder="0.00" value="{{$product['productPrice']}}"> 
					                    </label>
					                    <span>(tax incl.)</span>
					                    @endif
										<span class="para mlr-20">for access to this data for</span>
							        	<div class="adv-combo-wrapper custom-select2">
						                    <select name="{{$bidtype['type']}}_period" data-placeholder="Please select" class="no-search">
						                    	<option></option>
						                    	@foreach ($accessPeriodList as $period)
						                    	<option value="{{$period['key']}}" @if ($product['productAccessDays'] == $period['key']) selected @endif>{{$period['label']}}</option>
						                    	@endforeach
						                    </select>						                    
						                </div>		
						                @if($bidtype['type']=='free')
						                <div class="row">
						                	<div class="col-lg-6">
						                		<label class="pure-material-textfield-outlined">
						                			<input type="text" id="dataUrl" name="dataUrl" class="form-control input_data w-100" placeholder=" " value="{{$product->productUrl}}">
						                			<span>{{ trans('pages.data_url') }}</span>
						                		</label>
						                	</div>
						                </div>
						                @endif			         
						                <div>
											<span class="error_notice {{$bidtype['type']}}_price"> Price is required. </span>
											@if($bidtype['type']=="no_bidding" || $bidtype['type']=="bidding_possible")
											<span class="error_notice {{$bidtype['type']}}_price_min"> Price should be higher than € 0.50</span>
											@elseif($bidtype['type']=='free')
											<span class="error_notice dataUrl">You must provide a URL where the buyer can get the data for free.</span>
											@endif
											<span class="error_notice {{$bidtype['type']}}_period"> Please select a period.</span>
						                </div>       
									</div>	
				        		</div>
				        		@endforeach								
			                </div>
						</div>
					</div>
					@if(count($dxcs)>0)
					<div class="row mgt30">
						<div class="col-6">
							<h4 class="h4_intro text-left">Identify your data source</h4>
							<div class="row">
								<div class="col col-3">
									<div class="list-dxc-container">
										<p class="para text-center fs-16 lh-1">Select the DXC</p>
										<input type="hidden" name="dxc" id="dxc" value="{{$product->dxc?$product->dxc:$dxcs[0]->host}}">
										<ul class="selectable-list list-dxc list-style-none pl-0 text-center border-grey">
											@foreach($dxcs as $key=>$dxc)
												@if($dxc->acceptanceStatus=="ACCEPTED")
											<li class="selectable-list-item" item-id="{{$key+1}}">{{$dxc->host}}</li>
												@endif
											@endforeach
										</ul>
									</div>
								</div>
								<div class="col col-9 pl-0">
									<div class="table-dxc-data-container">
										<p class="para text-center fs-16 lh-1">Select the data</p>
										<input type="hidden" name="did" id="did" value="{{$product->did}}">
										<table class="table border-grey table-dxc-data">
											<thead>
												<tr>
													<th class="text-bold fs-16 text-black">Data</th>
													<th class="text-bold fs-16 text-black">Type</th>
												</tr>
											</thead>
											<tbody class="selectable-list list-data">
												@foreach($dxcs as $key=>$dxc)
													@if($dxc->acceptanceStatus=="ACCEPTED")
														@foreach($dxc->datasources as $index=>$pp)
															@if($pp->available)
												<tr class="selectable-list-item @if($product->did==$pp->did) selected @endif" did="{{$pp->did}}" parent-id="{{$key+1}}">
													<td>{{$pp->name}}</td>
													<td>{{$pp->type}}</td>
												</tr>
															@endif
														@endforeach
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<span class="error_notice dxc">Please select the DXC.</span>
					<span class="error_notice did">Please select your data source.</span>
					@endif
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Is there any additional information that might be useful for a potential buyer? (optional) <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_potential_buyer_tooptip') }}">help</i></h4>
				        	<div class="text-wrapper">
								<textarea name="productMoreInfo" class="round-textbox user-message min-h200" placeholder="{{ trans('pages.your_message') }}" maxlength="1000">
									{{$product['productMoreInfo']}}
								</textarea>
								<div class="char-counter"><span>0</span> / <span>1000</span> characters</div>
							</div>
						</div>
					</div>
	            	<div class="row mgt30">
	            		<div class="col-lg-6">
			                <h4 class="h4_intro text-left">Provide a URL where the buyer can read the data license. <i class="material-icons text-grey text-top" data-toggle="tooltip" data-placement="auto"  title="" data-container="body" data-original-title="{{ trans('description.product_license_url_tooptip') }}">help</i></h4>
				        	<label class="pure-material-textfield-outlined">
		                        <input type="text" id="licenseUrl" name="licenceUrl" class="form-control2 input_data" placeholder=" "  value="{{$product['productLicenseUrl']}}">
		                        <span>{{ trans('pages.enter_url') }}</span>	                        
		                    </label>
		                   	<div class="error_notice licenceUrl"> You must provide a URL where the buyer can consult the data licence. </div>
						</div>
					</div>
					<div class="row mgt40">
						<div class="col-lg-6">
							<button class="customize-btn" type="submit">UPDATE</button><!-- submit and redirect to #38 -->
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
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
	<script type="text/javascript">
		let dxc = $('input[name="dxc"]').val();
		let active_id = 1;
		if(dxc){
			$.each($('.list-dxc .selectable-list-item'), function(key, value){
				if($(value).html()==dxc){
					$(value).addClass('active');
					$(value).addClass('selected');
					active_id = $(value).attr('item-id');
				}
			});
		}else{
			$('.list-dxc .selectable-list-item:first-child').addClass('active');
			$('.list-dxc .selectable-list-item:first-child').addClass('selected');
		}
		$.each($('.list-data .selectable-list-item'), function(key, value){
			if($(value).attr('parent-id')==active_id){
				$(value).addClass('active');
			}
		});
		$('.list-dxc .selectable-list-item').click(function(e){
			let dxc = $(this).html();
			$("input[name='dxc']").val(dxc);
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
			let did = $(this).attr('did');
			$('input[name="did"]').val(did);
			$('.list-data .selectable-list-item.selected').removeClass('selected');
			$(this).addClass('selected');
		});

		// Initialize datatable with ability to add rows dynamically
	    var initTableWithDynamicRows = function() {
	        var table = $('.table-dxc-data');

	        var settings = {
	            responsive: true,

	            lengthMenu: [5, 10, 25, 50],

	            pageLength: 10,

	            language: {
	                'lengthMenu': 'Display _MENU_',
	            },
	        };

	        board_data_table = table.dataTable(settings);
	    }

	    initTableWithDynamicRows();
	</script>
@endsection
