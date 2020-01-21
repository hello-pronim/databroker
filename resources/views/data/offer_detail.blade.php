@extends('layouts.app')

@section('additional_css')
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
					<div class="offer-title">{{$offer['title']}}</div>
					<div class="region">{{$offer['region']}}</div>
					<div class="status-block publish">
						<div>
							<span class="offer-publish-status">
								<span class="label">{{ trans('pages.Status') }}: </span>
								{{ $offer['publish_status'] }}
							</span>
							<a class="link-market">{{ trans('pages.view_on_marketplace') }}</a>
						</div>
						<div class="buttons">
							<a class="icon-button btn-edit">
								<i class="icon material-icons">
									edit
								</i>
								{{ trans('pages.edit') }}
							</a>
							<span class="seperator">|</span>							
							<a class="icon-button btn-delete">
								<span class="iconify icon" data-icon="ant-design:close-circle-filled" data-inline="false"></span>
								{{ trans('pages.unpublish') }}
							</a>
						</div>
					</div>
					<div class="divider-green"></div>
		        </div>
	        </div>
	        <div class="blog-content">
				<span class="offer-products">
					<div class="row products-header">
						<div class="col-6">
							<span class="label">{{ trans('pages.data_products') }}: </span>
							<span class="count">{{ count($products) }}</span>
							<p class="area">{{ trans('pages.data_offer_overview_desc1') }}<a href="" class="help-section">{{ trans('pages.help_section') }}</a>.</p>
						</div>
						<div class="col-6">
							<button type="button" class="customize-btn btn-add pull-right">{{ trans('pages.ADD_DATA_PRODUCT') }}</button>	<!-- goto #29 -->        
						</div>
					</div>
					<div class="product-list">
						@foreach ($products as $product)
						<div class="product-container">
							<div class="product-title">{{ $product['title']}}</div>
							<div class="product-region">{{ $product['region']}}</div>
							<div class="row product-fields-block">
								<div class="col col-6 product-fields">
									<div class="row field-format">
										<div class="col col-3"><span class="label">{{ trans('pages.format') }}</span></div>
										<div class="col col-9 value">{{ $product['format'] }}</div>
									</div>
									<div class="row field-price">
										<div class="col col-3"><span class="label">{{ trans('pages.price') }}</span></div>
										<div class="col-9 value">{{ $product['price'] }}</div>
										<div class="col-9 value">{{ $product['price_status'] }}</div>
									</div>
									<div class="row field-period">
										<div class="col col-3"><span class="label">{{ trans('pages.Access_to_this_data') }}</span></div>
										<div class="col-9 value">{{ $product['period'] }}</div>
									</div>
								</div>
								<div class="col-6 status-block product flex-vcenter">	
									<div>								
										<span class="offer-publish-status product">
											<span class="label">{{ trans('pages.Status') }}: </span>
											{{ $product['status'] }}
										</span>
										<div class="buttons">
											<a class="icon-button btn-edit">
												<i class="icon material-icons">
													edit
												</i>
												{{ trans('pages.edit') }}
											</a>
											<span class="seperator">|</span>							
											<a class="icon-button btn-delete">
												<span class="icon iconify" data-icon="ant-design:close-circle-filled" data-inline="false"></span>
												{{ trans('pages.unpublish') }}
											</a>
										</div>
										<div class="sell_pending_hint_container">
											<i class="icon material-icons">info</i>
											<span class="sell_pending_hint">{{ trans('pages.sell_pending_hint') }}</span>
										</div>
										<div class="user-id">
											<span class="label">{{ trans('pages.id') }} :</span>
											{{ trans('pages.hidden_numbers') }}
										</div>
										<div class="copy-id"><a class="link-market">{{trans('pages.Copy_ID')}}</a></div>
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

@endsection

@section('additional_javascript')
@endsection

