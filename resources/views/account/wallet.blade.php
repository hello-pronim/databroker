@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper profile" ng-app="myApp" ng-controller="myCtrl">
	<div id="wallet" class="app-section app-reveal-section align-items-center">
	    <div class="top-bg-image"></div>
	    
		<div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-title text-primary">{{ trans('pages.account_information') }}</div>
                    <div class="label">
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.</span>
                    </div>
                    <label class="more_info fs-14">More Info <i class="material-icons">arrow_drop_down</i></label>
                </div>                                              
            </div>

            <div class="row mt-40">
                <div class="col-lg-6">
                    <label class="fs-18">Wallet address</label>
                    <br>
                    <div class="wallet_fill">
                        <a class="download" href="http://dev.databroker.com/uploads/offersample/ipro1-2-2020_20200110.docx"><i class="material-icons rotated">get_app</i><span>Fill wallet</span></a>    
                    </div>
                    <span class="hr-h text-grey">|</span>
                    <div class="wallet_fill">
                        <a class="download" href="http://dev.databroker.com/uploads/offersample/ipro1-2-2020_20200110.docx"><i class="material-icons">get_app</i><span>Export wallet</span></a>    
                    </div>                    
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-lg-6">
                    <span class="fs-30 text-bold"> Total value of your wallet: </span>
                    <span class="text-warning fs-30 text-bold ml-15">DTX xxx / € xxx</span>
                </div>    
            </div>
            
			<div class="app-monetize-section-item0 ml-0 mt-30"></div>

            
			<div id="transactions" class="row">
                <div class="col-lg-6">
                    <h3 class="fs-30 text-bold">
                        <span>{{ trans('pages.transactions') }}</span>
                    </h3>                        
                    <table class="table">                      
                      <tbody>
                        <tr>                          
                            <td>02/02/2007</td>
                            <td class="text-center">
                                <i class="material-icons">call_received</i><span class="text-grey">OUT</span>
                            </td>
                            <td class="text-right text-warning">
                                DTX xxx / € xxx
                            </td>
                        </tr>
                        <tr>                          
                            <td>02/02/2007</td>
                            <td class="text-center">
                                <i class="material-icons text-warning">call_made</i><span class="text-warning">IN</span>
                            </td>
                            <td class="text-right text-warning">
                                DTX xxx / € xxx
                            </td>
                        </tr>  
                        <tr>                          
                            <td>02/02/2007</td>
                            <td class="text-center">
                                <i class="material-icons">call_received</i><span class="text-grey">OUT</span>
                            </td>
                            <td class="text-right text-warning">
                                DTX xxx / € xxx
                            </td>
                        </tr>
                        <tr>                          
                            <td>02/02/2007</td>
                            <td class="text-center">
                                <i class="material-icons text-warning">call_made</i><span class="text-warning">IN</span>
                            </td>
                            <td class="text-right text-warning">
                                DTX xxx / € xxx
                            </td>
                        </tr>                        
                      </tbody>
                    </table>    

                </div>
			</div>
		</div>
	</div>
</div>

@endsection

