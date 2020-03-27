@extends('layouts.data')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side app-wapper-success">
	<div class="container">
        <div class="app-section app-reveal-section align-items-center">
        	<div class="row blog-header">
                <div class="col-md-12">
        			<h1>{{trans('data.your_payment_success')}}</h1>
                	<p class="para text-bold">{{trans('data.ready_to_use')}}</h4>
                </div>
    		</div>
            <div class="app-monetize-section-item0 ml-0 mt-20"></div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="fs-16">
                                    Download the file now.<br/>
                                    We also sent you a confirmation via email including a link to download the data.<br/>
                                    The link expires at dd/mm/yyyy so make sure you download the data before this data.<br/>
                                    You can also access it via <a href="{{route('account.purchases')}}">purchases in your account</a>.
                                </p>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-md-12">
                                <p class="fs-24 para text-bold mb-0">{{$product->productTitle}}</p>
                                <p class="para fs-16">
                                    @foreach($product->region as $region)
                                        <span>{{ $region->regionName }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><div class="info-label">{{ trans('data.from') }}: </div></td>
                                            <td><div class="col info-text">{{$product->companyName}}</div></td>
                                        </tr>
                                        <tr>
                                            <td><div class="info-label">{{ trans('data.format') }}: </div></td>
                                            <td><div class="col info-text">{{$product->productType}}</div></td>
                                        </tr>
                                        <tr>
                                            <td><div class="info-label">{{ trans('data.access_to_this_data') }}: </div></td>
                                            <td><div class="col info-text">1 {{$product->productAccessDays}}(
                                                @if($product->productAccessDays=="day")
                                                    From : {{date('d/m/Y', strtotime($product->createdAt))}} until {{date('d/m/Y', strtotime('+1 day', strtotime($product->createdAt)))}}
                                                @elseif($product->productAccessDays=="week")
                                                    From : {{date('d/m/Y', strtotime($product->createdAt))}} until {{date('d/m/Y', strtotime('+7 day', strtotime($product->createdAt)))}}
                                                @elseif($product->productAccessDays=='month')
                                                    From : {{date('d/m/Y', strtotime($product->createdAt))}} until {{date('d/m/Y', strtotime('+1 month', strtotime($product->createdAt)))}}
                                                @elseif($product->productAccessDays=='year')
                                                    From : {{date('d/m/Y', strtotime($product->createdAt))}} until {{date('d/m/Y', strtotime('+1 year', strtotime($product->createdAt)))}}
                                                @endif
                                            )</div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-md-12">
                            @if($product->productType=="Api flow")
                                <p class="fs-16">{{$product->offerDescription}}</p>
                                <div class="mt-20">
                                    <span class="info-label">{{trans('data.api_key')}}:</span>
                                    <span class="info-text">*************************************</span>
                                </div>
                            @elseif($product->productType=="Stream")
                                <p class="fs-16">{{$product->offerDescription}}</p>
                                <div class="buttons flex-vcenter mt-20">
                                    <button type="button" class="customize-btn btn-next">{{ trans('data.configure_now') }}</button>
                                </div>
                            @elseif($product->productType=="File")
                                <div class="buttons flex-vcenter">
                                    <button type="button" class="customize-btn btn-next">{{ trans('data.download_file') }}</button>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection