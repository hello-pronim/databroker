@extends('layouts.app')

@section('title', 'My sales | Databroker ')

@section('content')
<div class="container-fluid app-wapper app-purchase-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center data-detail">
            <div class="blog-header">
                <h1>My sales</h1>
                <p class="para">Here you can find an overview of all the data products you have sold or shared.</p>
                <p class="para">
                    <span class="text-grey">Total value of your sales:</span> <span class="text-red text-bold">€ XXX / DTX XXX</span><br/>
                    This amount includes all sales that have been fully completed, i.e. where you have redeemed the DTX amount at the end of the 30-day warranty period. 
                </p>
                <p class="para">
                    <a href="{{route('account.wallet')}}">Go to my wallet</a>
                </p>
                <div class="purchase-items">
                    @if(count($sales))
                        @foreach($sales as $key=>$sale)
                    <div class="purchase-item">
                        <div class="row">
                            <div class="col-xl-1 col-lg-2 col-md-3 col-sm-3">
                                <div class="date-label">
                                    {{date('d/m/Y', strtotime($sale->from))}}
                                </div>
                            </div>
                            <div class="col-xl-11 col-lg-10 col-md-9 col-sm-9">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12">
                                        <div class="mb-20">
                                            <h4 class="text-bold">
                                                {{$sale->productTitle}}
                                            </h4>
                                            <div class="item-location">
                                                @foreach($sale->region as $region)
                                                    {{$region->regionName}}
                                                @endforeach
                                            </div>
                                            <br>
                                            <div class="field-table">
                                                <div class="row field-row">
                                                    <div class="col-4 field-label">
                                                        Format:
                                                    </div>
                                                    <div class="col-8 field-value">
                                                        {{$sale->productType}}
                                                    </div>
                                                </div>
                                                <div class="row field-row">
                                                    <div class="col-4 field-label">
                                                        Price:
                                                    </div>
                                                    <div class="col-8 field-value">
                                                        @if($sale->productBidType=="free")
                                                        <span>Free</span>
                                                        @else
                                                        <span>€ {{$sale->bidPrice!=0 ? $sale->bidPrice : $sale->productPrice}} (tax incl.)</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row field-row">
                                                    <div class="col-4 field-label">
                                                        Access to this data:
                                                    </div>
                                                    <div class="col-8 field-value">
                                                        1 {{$sale->productAccessDays}}
                                                        <span class="text-normal">
                                                            (From {{date('d/m/Y', strtotime($sale->from))}} to {{date('d/m/Y', strtotime($sale->to))}})
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 seller">
                                                <div class="mb-20">
                                                    <h4 class="company">
                                                        {{$sale->buyerCompanyName}}
                                                    </h4>
                                                    @if($sale->productBidType=="free")
                                                    <div class="price">Free</div>
                                                    @else
                                                    <div class="price">
                                                        € {{$sale->bidPrice!=0 ? $sale->bidPrice : $sale->productPrice}} <span class="color-black">(tax incl.)</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 warranty">
                                                <div class="mb-20">
                                                    <h4>
                                                        Warranty expires on
                                                    </h4>
                                                    <div class="date">
                                                        {{date('d/m/Y', strtotime($sale->to))}}
                                                    </div>
                                                    @if($sale->productMoreInfo)
                                                    <li class="more_dropdown">
                                                        <a href="javascript:;" class="more_info">More Info <i class="material-icons">arrow_drop_down</i>
                                                            <i class="material-icons open">arrow_drop_up</i>
                                                        </a>
                                                        <div>
                                                            {{$sale->productMoreInfo}}
                                                        </div>
                                                    </li>
                                                    @endif
                                                    <div class="mt-20">Problems with the data?</div>
                                                    <a href="{{route('help.send_file_complaint').'?pid='.$sale->pid}}">File a complaint</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        @if(date('Y-m-d')>date('Y-m-d', strtotime($sale->to)))
                                        <div class="text-grey">The link to the data product expired on {{date('d/m/Y', strtotime($sale->to))}}</div>
                                        @else
                                        <a href="{{route('account.sales_detail', ['sid'=>$sale->saleIdx])}}">
                                            <button class="btn readmore-inourblog-btn pure-material-button-outlined btn-transparent mt-0">
                                                View data product
                                            </button>
                                        </a>
                                        <div class="text-grey">Link expires on {{date('d/m/Y', strtotime($sale->to))}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>