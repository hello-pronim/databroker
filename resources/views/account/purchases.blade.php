@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section app-reveal-section align-items-center data-detail">
            <div class="blog-header">
                <h1>Bids</h1>
                <div class="purchase-items">
                    <div class="purchase-item">
                        <div class="row">
                            <div class="col col-1">
                                <div class="date-label">
                                    02/02/2007
                                </div>
                            </div>
                            <div class="col col-5">
                                <div class="item-title">
                                    Satellite imagery of buildings and roads
                                </div>
                                <div class="item-location">
                                    Belgium
                                </div>
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
                                            <span style="font-weight:normal;">
                                                (From 02/02/2007 until 03/02/2007)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-3 seller">
                                <div class="seller-company">
                                    Seller company name
                                </div>
                                <div class="seller-price">
                                    €500
                                </div>
                            </div>
                            <div class="col col-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>