@extends('layouts.app')

@section('title', 'Wallet | Databroker ')

@section('content')
<div class="container-fluid app-wapper profile" ng-app="myApp" ng-controller="myCtrl">
	<div id="wallet" class="app-section app-reveal-section align-items-center">
	    <div class="top-bg-image"></div>
	    
		<div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-title text-primary">{{ trans('pages.wallet') }}</div>
                    <div class="label">
                        <span>Welcome to your Databroker Wallet. Here you will be able to manage your funds collected, export them via our redemption features and check your transaction history.</span>
                    </div>
                    <li class="more_dropdown">
                        <a href="javascript:;" class="more_info">More Info <i class="material-icons">arrow_drop_down</i>
                            <i class="material-icons open">arrow_drop_up</i>
                        </a>
                        <div>You can also check your Total values in DTX and Euro as well as filling your wallet and exporting it to Apps and cold storage devices.</div>
                    </li>
                </div>                                              
            </div>
            <div class="row mt-40">
                <div class="col-lg-12">
                    <label class="fs-18">Wallet address: <span>{{$address}}</span></label>
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
                <div class="col-lg-12">
                    <span class="fs-30 text-bold"> Total value of your wallet: </span>
                    <span class="text-warning fs-30 text-bold ml-15">DTX {{$balance->balance}}</span>
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
                        @if(count($transactions) > 0)
                            @foreach($transactions as $transaction)
                        <tr>                          
                            <td>{{date('d/m/Y H:i:s', strtotime($transaction->created_at))}}</td>
                            @if($transaction->amount > 0)
                            <td class="text-center">
                                <i class="material-icons text-warning">call_made</i><span class="text-warning">IN</span>
                            </td>
                            <td class="text-right text-warning">
                                € {{$transaction->amount}} ({{$transaction->status}})
                            </td>
                            @elseif($transaction->amount < 0)
                            <td class="text-center">
                                <i class="material-icons text-grey">call_received</i><span class="text-grey">OUT</span>
                            </td>
                            <td class="text-right text-grey">
                                € {{$transaction->amount}} ({{$transaction->status}})
                            </td>
                            @elseif($transaction->amount == 0)
                                @if($transaction->transactionType=="sold")
                            <td class="text-center">
                                <i class="material-icons text-warning">call_made</i><span class="text-warning">IN</span>
                            </td>
                            <td class="text-right text-warning">
                                € {{$transaction->amount}} ({{$transaction->status}})
                            </td>
                                @elseif($transaction->transactionType=="purchased")
                            <td class="text-center">
                                <i class="material-icons text-grey">call_received</i><span class="text-grey">OUT</span>
                            </td>
                            <td class="text-right text-grey">
                                € {{$transaction->amount}} ({{$transaction->status}})
                            </td>
                                @endif
                            @endif
                        </tr>                 
                            @endforeach
                        @endif
                      </tbody>
                    </table>    

                </div>
			</div>
		</div>
	</div>
</div>

@endsection

