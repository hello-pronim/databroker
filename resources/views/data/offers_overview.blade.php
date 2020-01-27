@extends('layouts.app')

@section('additional_css')
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer overview">
	<div class="bg-pattern1-left"></div>
    <div class="container">	
		<div class="row mb-20">
			<div class="col-lg-6">
				<div class="blog-header mt-60">
		            <h1>{{ trans('pages.Data_offers_overview') }}</h1>			            
		            <p class="area">{{ trans('pages.data_offer_overview_desc1') }}<a href="javascript:;" class="help-section">{{ trans('pages.help_section') }}</a>.</p>
		        </div>		        
			</div>
			<div class="col-lg-6">
				<a href="{{ route('data_offer_publish') }}"><button type="button" class="btn customize-btn btn-next pull-right">{{ trans('pages.PUBLISH_NEW_DATA_OFFER') }}</button></a>
			</div>
		</div>
		<div class="gridview col2" id="23">			
			@foreach ($offers as $offer)			
				<a class="cell offer {{$offer['status']}}" href="/data/offers/{{$offer['offerIdx']}}">
					<span class="iconify right-arrow" data-icon="bx:bx-right-arrow-alt" data-inline="false"></span>
					<p class="offer-title">{{$offer['offerTitle']}}</p>
					<p class="offer-location region">
						@foreach($offer['region'] as $region)
		            		<span>{{ $region->regionName }}</span>
		            	@endforeach
		            </p>
					<span class="offer-products"><span class="label">{{ trans('pages.data_products') }}: </span> 1 </span>
				</a>
			@endforeach

		</div>
	</div>      
</div>

@endsection

@section('additional_javascript')
@endsection

