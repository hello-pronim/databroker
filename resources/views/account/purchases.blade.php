@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center data-detail">
            <div class="blog-header">
                <h1>My purchases</h1>
                <p class="desc">Here you can find an overview of all the data products you have purchased, including any products that were shared with you at no cost. 
                    <br>
                    Purchases are shown in chronological order, with the most recent activity at the top.
                </p>
                <div class="purchase-items">
                    <div class="purchase-item">
                        <div class="row">
                            <div class="col col-xl-1 col-sm-3">
                                <div class="date-label">
                                    02/02/2007
                                </div>
                            </div>
                            <div class="col col-xl-5 col-sm-9">
                                <h4 class="text-bold">
                                    Satellite imagery of buildings and roads
                                </h4>
                                <div class="item-location">
                                    Belgium
                                </div>
                                <br>
                                <div class="field-table">
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Format:
                                        </div>
                                        <div class="col col-8 field-value">
                                            API flow
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Price:
                                        </div>
                                        <div class="col col-8 field-value">
                                            €500
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Access to this data:
                                        </div>
                                        <div class="col col-8 field-value">
                                            1 day
                                            <span class="text-normal">
                                                (From 02/02/2007 to 03/02/2007)
                                            </span>
                                        </div>
                                    </div>
                                    <button class="btn readmore-inourblog-btn pure-material-button-outlined btn-transparent">View data product</button>
                                    <div class="text-grey">Link expires on 03/02/2007</div>
                                </div>
                            </div>
                            <div class="col col-xl-3 col-sm-6 seller">
                                <h4 class="company">
                                    Seller company name
                                </h4>
                                <div class="price">
                                    €500 / DTX300
                                </div>
                                <a class="text-green">Request invoice from seller</a>
                            </div>
                            <div class="col col-xl-3 col-sm-6 warranty">
                                <h4>
                                    Warranty expires on
                                </h4>
                                <div class="date">
                                    03/02/2007
                                </div>
                                <li class="more_dropdown">
                                    <a href="javascript:;" class="more_info">More Info <i class="material-icons">arrow_drop_down</i>
                                        <i class="material-icons open">arrow_drop_up</i>
                                    </a>
                                    <div>
                                        Databroker offers a 30-day warranty on all data purchased. In the event of problems with data you purchase, you can file a complaint before the end of the warranty period. 
                                    </div>
                                </li>
                                <div class="mt-30">Problems with the data?</div>
                                <a class="text-green">File a complaint</a>
                            </div>
                        </div>
                    </div>

                    <div class="purchase-item">
                        <div class="row">
                            <div class="col col-xl-1 col-sm-3">
                                <div class="date-label">
                                    02/02/2007
                                </div>
                            </div>
                            <div class="col col-xl-5 col-sm-9">
                                <h4 class="text-bold">
                                    Satellite imagery of buildings and roads
                                </h4>
                                <div class="item-location">
                                    Belgium
                                </div>
                                <br>
                                <div class="field-table">
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Format:
                                        </div>
                                        <div class="col col-8 field-value">
                                            API flow
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Price:
                                        </div>
                                        <div class="col col-8 field-value">
                                            €500
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Access to this data:
                                        </div>
                                        <div class="col col-8 field-value">
                                            1 day
                                            <span class="text-normal">
                                                (From 02/02/2007 to 03/02/2007)
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-grey mt-40">The link to the data product <br> expired on 03/02/2007</div>
                                </div>
                            </div>
                            <div class="col col-xl-3 col-sm-6 seller">
                                <h4 class="company">
                                    Seller company name
                                </h4>
                                <div class="price">
                                    €500 / DTX300
                                </div>
                                <a class="text-green">Request invoice from seller</a>
                            </div>
                            <div class="col col-xl-3 col-sm-6 warranty">
                                <h4>
                                    Warranty expires on
                                </h4>
                                <div class="date">
                                    03/02/2007
                                </div>
                                <a href="javascript:;" class="more_info">More Info <i class="material-icons">arrow_drop_down</i></a>
                                
                                <div class="mt-30">Problems with the data?</div>
                                <a class="text-green">File a complaint</a>
                            </div>
                        </div>
                    </div>

                    <div class="purchase-item">
                        <div class="row">
                            <div class="col col-xl-1 col-sm-3">
                                <div class="date-label">
                                    02/02/2007
                                </div>
                            </div>
                            <div class="col col-xl-5 col-sm-9">
                                <h4 class="text-bold">
                                    Satellite imagery of buildings and roads
                                </h4>
                                <div class="item-location">
                                    Belgium
                                </div>
                                <br>
                                <div class="field-table">
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Format:
                                        </div>
                                        <div class="col col-8 field-value">
                                            API flow
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Price:
                                        </div>
                                        <div class="col col-8 field-value">
                                            €500
                                        </div>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col col-4 field-label">
                                            Access to this data:
                                        </div>
                                        <div class="col col-8 field-value">
                                            1 day
                                            <span class="text-normal">
                                                (From 02/02/2007 to 03/02/2007)
                                            </span>
                                        </div>
                                    </div>
                                    <button class="btn readmore-inourblog-btn pure-material-button-outlined btn-transparent">View data product</button>
                                    <div class="text-grey">Link expires on 03/02/2007</div>
                                </div>
                            </div>
                            <div class="col col-xl-3 col-sm-6 seller">
                                <h4 class="company">
                                    Seller company name
                                </h4>
                                <div class="price">
                                    €500 / DTX300
                                </div>
                                <a class="text-green">Request invoice from seller</a>
                            </div>
                            <div class="col col-xl-3 col-sm-6 warranty">
                                <h4>
                                    Warranty expires on
                                </h4>
                                <div class="date">
                                    03/02/2007
                                </div>
                                <a href="javascript:;" class="more_info">More Info <i class="material-icons">arrow_drop_down</i></a>
                                
                                <div class="mt-30">Problems with the data?</div>
                                <a class="text-green">File a complaint</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>