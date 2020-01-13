@extends('layouts.app')

@section('additional_css')
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer overview">
	<div class="bg-pattern1-left"></div>
    <div class="container">	
		<div class="row">
			<div class="col-lg-6">
				<div class="blog-header">
		            <h1>{{ trans('pages.Data_offers_overview') }}</h1>			            
		            <p class="area">{{ trans('pages.data_offer_overview_desc1') }}<a href="" class="help-section">{{ trans('pages.help_section') }}</a>.</p>
		        </div>		        
			</div>
			<div class="col-lg-6">
				<button type="button" class="btn customize-btn btn-next pull-right">{{ trans('pages.PUBLISH_NEW_DATA_OFFER') }}</button>	        
			</div>
		</div>
		<div class="gridview col2" id="23">
			@foreach ($offers as $offer)
				<a class="cell offer {{$offer['status']}}" href="/data/offers/{{$offer['id']}}">
					<span class="iconify right-arrow" data-icon="bx:bx-right-arrow-alt" data-inline="false"></span>
					<p class="offer-title">{{$offer['title']}}</p>
					<p class="region">{{$offer['region']}}</p>
					<span class="offer-products"><span class="label">{{ trans('pages.data_products') }}: </span>{{$offer['products']}}</span>
				</a>
			@endforeach
		</div>
	</div>      
</div>

@endsection

@section('additional_javascript')
@endsection

