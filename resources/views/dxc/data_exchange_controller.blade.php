@extends('layouts.app')

@section('title', 'Data exchange controller | Databroker ')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <style type="text/css">
    	.sweet-alert.showSweetAlert .btn.confirm{
    		background: #FF6B6B 0% 0% no-repeat padding-box;
    		display: inline-block;
		    font-size: 14px;
		    font-weight: bold;
		    width: auto;
		    padding-left: 20px;
		    padding-right: 20px;
		    margin: 15px 0px 15px 20px;
		    min-width: 150px;
		    border-radius: 25px;
    	}
    	.sweet-alert.showSweetAlert .btn.confirm:hover{
    		background-color: #E15757;
    	}
    	.sweet-alert.showSweetAlert .btn.cancel{
    		display: inline-block;
    		font-size: 14px;
		    font-weight: bold;
		    width: auto;
		    padding-left: 20px;
		    padding-right: 20px;
		    margin: 15px 0px 15px 20px;
		    min-width: 150px;
		    border-radius: 25px;
    	}
    	.sweet-alert.showSweetAlert .btn.cancel:hover{background-color: grey;}
    </style>
@endsection

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center">
    		<div class="row blog-header">
	    		<div class="col col-12">
					<h1>DXC availability</h1>
				</div>
			</div>
			<div class="app-monetize-section-item0 ml-0 mt-20"></div>
			<div class="blog-content">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="address" id="address" value="{{$address}}">
	                    <label class="fs-18">Account ID: <span class="text-black">{{$address}}</span></label>
	                    <br>
	                    <label class="fs-18">API key: <span class="text-black">{{$apiKey}}</span></label>
	                    <a href="#" class="ml-30 btn-newKey">New key</a>
	                    <br>
					</div>
				</div>
				<div class="row">
					<div class="col col-6">
						<table class="table mt-30">
					        <thead>
					          	<tr>
					          		<th>
					          			<div class="form-check">
							                <label class="form-check-label">
							                	<input type="checkbox" class="form-check-input form-check-input-all">
							                	<span class="form-check-sign">
			                                        <span class="custom-check check"></span>
			                                    </span>
							                </label>
							            </div>
					          		</th>
						            <th scope="col">DXC IP Address</th>
						            <th scope="col">#Data Sources</th>
						            <th scope="col">Status</th>
					          	</tr>
					        </thead>
					        <tbody>
					        	@if(count($dxcs)>0)
					        		@foreach($dxcs as $dxc)
					          	<tr>
						            <td>
										<div class="form-check">
							            	<label class="form-check-label">
							                	<input type="checkbox" class="form-check-input">
							                	<span class="form-check-sign">
			                                        <span class="custom-check check"></span>
			                                    </span>
							                </label>
							            </div>
						            </td>
						            <td>{{$dxc->host}}</td>
						            <td><a href="#">{{count($dxc->datasources)}}</a></td>
						        	<td>
						        		@if($dxc->acceptanceStatus=="ACCEPTED")
						        		<div class="dot-success"></div>
						        		@elseif($dxc->acceptanceStatus!="ACCEPTED")
						        		<div class="dot-error"></div>
						        		@endif
						        	</td>
					          	</tr>
					          		@endforeach
					          	@endif
					        </tbody>
				      	</table>
					</div>
				</div>
				<div class="row">
					<div class="col col-6">
						<div class="buttons flex-vcenter">
							<button type="submit" class="customize-btn">Accept</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('additional_javascript')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
    	$(".form-check-input-all").change(function(e){
    		$(".form-check-input").prop('checked', $(this).prop('checked'));
    	});
    	$(".form-check-input").change(function(e){
    		if(!$(this).prop('checked'))
    			$('.form-check-input-all').prop('checked', false);
    	});
    	$(".btn-newKey").click(function(){
    		var address = $("#address").val();
    		swal({
			    title: "Are you sure to generate a new key?",
			    text: "You will need to update all running DXC's after you confirm.",
			    type: "warning",
			    showCancelButton: true,
			    confirmButtonClass: "btn-danger",
			    confirmButtonText: "Confirm",
			    cancelButtonText: "No",
			    closeOnConfirm: false,
			    closeOnCancel: true
			  },
			  function(isConfirm) {
			    if (isConfirm) {
			      	$.ajax({
				        headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				        url: '/dxc/updateApiKey/'+address,
				        method: 'get',
				        success: function(res){
				          if(res == "success"){
				            window.location.href = "/dxc";
				          }
				        }
			      	});
			    }
			});
    	});
    </script>
@endsection