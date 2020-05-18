@extends('layouts.app')

@section('title', 'Data exchange controller | Databroker ')

@section('content')
<div class="container-fluid app-wapper data-offer">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center">
    		<div class="row blog-header">
	    		<div class="col col-12">
					<h1>Display DXC availability and accept its authentication</h1>
				</div>
			</div>
			<div class="app-monetize-section-item0 ml-0 mt-20"></div>
			<div class="blog-content">
				<div class="row">
					<div class="col-md-6">
	                    <label class="fs-18">Wallet address: <span class="text-black">{{$address}}</span></label>
	                    <br>
	                    <label class="fs-18">API key: <span class="text-black">{{$apiKey}}</span></label>
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
						            <th scope="col">#Data Products</th>
						            <th scope="col">Status</th>
					          	</tr>
					        </thead>
					        <tbody>
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
						            <td>85.120.23.12</td>
						            <td><a href="#">3</a></td>
						        	<td><div class="dot-error"></div></td>
					          	</tr>
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
						            <td>85.120.23.13</td>
						            <td><a href="#">3</a></td>
						        	<td><div class="dot-success"></div></td>
					          	</tr>
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
						            <td>85.120.23.14</td>
						            <td><a href="#">3</a></td>
						            <td><a href="#">Pending</a></td>
					          	</tr>
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
    <script type="text/javascript">
    	$(".form-check-input-all").change(function(e){
    		$(".form-check-input").prop('checked', $(this).prop('checked'));
    	});
    	$(".form-check-input").change(function(e){
    		if(!$(this).prop('checked'))
    			$('.form-check-input-all').prop('checked', false);
    	});
    </script>
@endsection