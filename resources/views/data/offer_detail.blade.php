@extends('layouts.app')

@section('title', 'Data products | Databroker ')
@section('description', '')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer detail">
	<div class="bg-pattern1-left"></div>
    <div class="container">	
    	<div class="app-section app-reveal-section align-items-center">
    		<a href="{{ route('data_offers_overview') }}" class="back-icon"><i class="material-icons">keyboard_backspace</i><span>{{ trans('pages.Back_to_data_offer_overview') }}</span></a>
	        <div class="blog-header">
	            <h1>{{ trans('pages.Data_offer') }}</h1>
	            <div class="offer">
					<div class="offer-title">{{$offer['offerTitle']}}</div>
					<div class="region offer-location">
						@foreach($offer['region'] as $region)
		            		<span>{{ $region->regionName }}</span>
		            	@endforeach
		            </div>
					<div class="status-block publish">
						<div>
							<span class="offer-publish-status">
								<span class="label">{{ trans('pages.Status') }}: </span>
								@if ( $offer['status'] == 1 )
									{{ trans('pages.published') }}
								@else
									{{ trans('pages.unpublished') }}
								@endif
							</span>
							<a class="link-market" href="{{$link_to_market}}">{{ trans('pages.view_on_marketplace') }}</a>
						</div>
						<div class="buttons">
							<a href="{{route('data_offer_edit', ['id'=>$id])}}">
								<span class="icon-button btn-edit color-gray5" >
									<i class="icon material-icons">
										edit
									</i>
									{{ trans('pages.edit') }}
								</span>
							</a>
							<span class="seperator">|</span>
						@if ( $offer['status'] == 1 )							
							<a class="icon-button btn-delete data_unpublish" data-toggle="modal" data-target="#unpublishOfferModal" data-id="{{ $offer['offerIdx'] }}" data-type="offer">
								<i class="icon material-icons">
									cancel
								</i>								
								{{ trans('pages.unpublish') }}
							</a>
						@else
							<a class="icon-button btn-publish data_publish" data-id="{{ $offer['offerIdx'] }}" data-type="offer">
								<i class="icon material-icons">
									publish
								</i>
								{{ trans('pages.publish') }}
							</a>
						@endif	
						</div>
					</div>
					<div class="divider-green"></div>
		        </div>
	        </div>
	        <div class="blog-content">
				<span class="offer-products">
					<div class="row products-header">
						<div class="col-6">
							<span class="label text-black">{{ trans('pages.data_products') }}: </span>
							<span class="count">{{ count($products) }}</span>
							<p class="para">Before you can sell or share a data product, you need to make sure that the Data eXchange Controller (DXC) has been installed and that you have activated the data product using its unique ID.</p>
							<p class="para">Need help? You can find detailed instructions in our <a href="{{ route('help.buying_data') }}" class="link-market">{{ trans('pages.help_section') }}</a></p>
						</div>
						<div class="col-6">
							@if ( $offer['status'] == 1)	
							<a href="{{ route('data_offer_add_product', ['id'=>$id]) }}"><button type="button" class="customize-btn btn-add pull-right">{{ trans('pages.ADD_DATA_PRODUCT') }}</button>	<!-- goto #29 --></a>
							@else						
							<a class="" data-toggle="modal" data-target="#pubRecommendModal" data-id="{{ $offer['offerIdx'] }}" data-type="offer">
								<button type="button" class="customize-btn btn-add pull-right">{{ trans('pages.ADD_DATA_PRODUCT') }}</button>
							</a>
							@endif
						</div>
					</div>
					<div class="product-list">
						@foreach ($products as $product)
						<div class="product-container">
							<div class="product-title">{{ $product['productTitle']}}</div>							
							<div class="product-region offer-location">
								@foreach($product['region'] as $region)
				            		<span>{{ $region->regionName }}</span>
				            	@endforeach
				            </div>
							<div class="row product-fields-block">
								<div class="col col-6 product-fields">
									<div class="row field-format">
										<div class="col col-3"><span class="label">{{ trans('pages.format') }}:</span></div>
										<div class="col col-9 value">{{ $product['productType'] }}</div>
									</div>
									<div class="row field-price">
										<div class="col col-3"><span class="label">{{ trans('pages.price') }}:</span></div>
										<div class="col-9">
											@if($product['productBidType']=="bidding_only")
											N/A
											@elseif($product['productBidType']=="free")
											<span class="value text-warning">FREE</span>
											@else
											<span class="value text-warning">
												<span class="currency">??? </span>{{ round($product['productPrice']) }}
											</span>
											<span>(tax incl.)</span>
											@endif
										</div>
									</div>
									<div class="row field-access">	
										<div class="col col-3"></div>
										<div class="col-9 value text-warning">{{ str_replace('_', ' ',$product['productBidType']) }}</div>
									</div>
									<div class="row field-period">
										<div class="col col-3"><span class="label">{{ trans('pages.Access_to_this_data') }}:</span></div>
										<div class="col-9 value">1 {{ $product['productAccessDays'] }}</div>
									</div>
								</div>
								<div class="col-6 status-block product flex-vcenter">
									<div class="w-100">								
										<span class="offer-publish-status product">
											<span class="label">{{ trans('pages.Status') }}: </span>

											@if ( $product['productStatus'] == 1 )
												{{ trans('pages.published') }}
											@else
												{{ trans('pages.unpublished') }}
											@endif
										</span>
										<div class="buttons">
											<a class="icon-button btn-edit" href="{{route('data_offer_edit_product', ['id'=>$id, 'pid'=>$product['productIdx']])}}">
												<i class="icon material-icons">
													edit
												</i>
												{{ trans('pages.edit') }}
											</a>
											<span class="seperator">|</span>
											@if ( $product['productStatus'] == 0 )
											<a class="icon-button btn-edit data_publish" data-id="{{ $product['productIdx'] }}" data-type="product">
												<i class="icon material-icons">
													publish
												</i>	
												{{ trans('pages.publish') }}
											</a>	
											@else	
											<a class="icon-button btn-delete data_unpublish" data-toggle="modal" data-target="#unpublishProductModal" data-id="{{ $product['productIdx'] }}" data-type="product">
												<i class="icon material-icons">
													cancel
												</i>	
												{{ trans('pages.unpublish') }}
											</a>	
											@endif												
										</div>
										<!-- <div class="sell_pending_hint_container">
											<i class="icon material-icons">info</i>
											<span class="sell_pending_hint">{{ trans('pages.sell_pending_hint') }}</span>
										</div>
										<div class="user-id">
											<span class="label">{{ trans('pages.id') }} :</span>
											{{ trans('pages.hidden_numbers') }}
										</div>
										<div class="copy-id"><a class="link-market">{{trans('pages.Copy_ID')}}</a></div> -->
										@if(count($dxcs)>0)
										<div class="row">
											<div class="col-lg-12">
												<div class="row">
													<div class="col col-6">
														<div class="buttons flex-vcenter">
															<button type="submit" class="customize-btn">Map with data in DXC</button>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<div class="row">
															<div class="col col-4">
																<div class="list-dxc-container">
																	<p class="para text-center fs-16 lh-1">Select the DXC</p>
																	<ul class="selectable-list list-dxc list-style-none pl-0 text-center border-grey">
																		@foreach($dxcs as $key=>$dxc)
																			@if($dxc->acceptanceStatus=="ACCEPTED")
																		<li class="selectable-list-item @if($key==0) active selected @endif" item-id="{{$key+1}}">{{$dxc->host}}</li>
																			@endif
																		@endforeach
																	</ul>
																</div>
															</div>
															<div class="col col-8 pl-0">
																<div class="table-dxc-data-container">
																	<p class="para text-center fs-16 lh-1">Select the data</p>
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
																			<tr class="selectable-list-item {{$pp->did==$product['did']?'selected':''}}" parent-id="{{$key+1}}">
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
											</div>
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</span>
	        </div>
	    </div>
	</div>      
</div>

<div class="modal fade" id="unpublishOfferModal" tabindex="-1" role="dialog" aria-labelledby="unpublishOfferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="para">Unpublishing a data offer means the related data products will no longer be available for purchase.</p>
        <p class="para">Are you sure you want to unpublish?</p>
      </div>      
      <input type="hidden" name="data_type" value="">
      <input type="hidden" name="data_id" value="">
      <div class="modal-footer">        
        <button type="button" class="button primary-btn unpublish">Yes, Unpublish</button>
        <button type="button" class="button secondary-btn" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="unpublishProductModal" tabindex="-1" role="dialog" aria-labelledby="unpublishProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="para">Unpublishing this data product means it will no longer be available for purchase.</p>
        <p class="para">Are you sure you want to unpublish?</p>
      </div>      
      <input type="hidden" name="data_type" value="">
      <input type="hidden" name="data_id" value="">
      <div class="modal-footer">        
        <button type="button" class="button primary-btn unpublish">Yes, Unpublish</button>
        <button type="button" class="button secondary-btn" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pubRecommendModal" tabindex="-1" role="dialog" aria-labelledby="pubRecommendModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="para">
        	You need to publish the data offer first before you can actually sell the product.

        	Do you want to publish the data offer?
        </p>
      </div>      
      <input type="hidden" name="data_type" value="">
      <input type="hidden" name="data_id" value="">
      <div class="modal-footer">        
        <button type="button" class="button primary-btn publish btn-publish data_publish" data-id="{{ $offer['offerIdx'] }}" data-type="offer">Yes, publish it!</button>
        <a href="{{ route('data_offer_add_product', ['id'=>$id]) }}" data-window='external' data-dismiss="modal" data-target="#"><button type="button" class="button secondary-btn" data-dismiss="modal">Add product</button></a>
      </div>
    </div>
  </div>
</div>

@endsection

@section('additional_javascript') 
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
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

