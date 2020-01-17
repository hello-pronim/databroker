@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper">
	<div class="bg-pattern1-left"></div>
    <div class="container">
    	<div class="app-section app-reveal-section align-items-center data-detail">    		
	        <div class="blog-header">
	            <h1>Bids</h1>	            
	            
	            <div id="bids" class="row">
		            <div class="col-lg-4 nav nav-tabs" data-tabs="tabs">
		            	<div class="bid nav-item open">
		            		<a class="nav-link active" href="#tab1" data-toggle="tab"><h4 class="fs-20 text-bold">Satellite imagery of buildings and roads</h4></a>
		            		<p>Belgium</p>
		            		<p>Seller Company Name</p>
		            		<div class="mt-20">
		            			<label>Format:</label><span>API Flow</span> <br>
		            			<label>Price:</label><span class="text-warning">€500</span> <br>
		            			<label>Access to this data:</label><span>1 day</span>
		            		</div>
		            	</div>	
		            	<div class="bid nav-item">
		            		<a  class="nav-link" href="#tab2" data-toggle="tab"><h4 class="fs-20 text-bold">Satellite imagery of buildings and roads</h4></a>
		            		<p>Europe</p>
		            		<p>Seller Company Name</p>
		            		<div class="mt-20">
		            			<label>Format:</label><span>API Flow</span> <br>
		            			<label>Price:</label><span class="text-warning">€500</span> <br>
		            			<label>Access to this data:</label><span>1 day</span>
		            		</div>
		            	</div>	
		            	<div class="bid nav-item">
		            		<a class="nav-link" href="#tab1" data-toggle="tab"><h4 class="fs-20 text-bold">Satellite imagery of buildings and roads</h4></a>
		            		<p>Worldwide</p>
		            		<p>Seller Company Name</p>
		            		<div class="mt-20">
		            			<label>Format:</label><span>API Flow</span> <br>
		            			<label>Price:</label><span class="text-warning">€500</span> <br>
		            			<label>Access to this data:</label><span>1 day</span>
		            		</div>
		            	</div>	
		            </div>
		            <div class="bids_list col-lg-8 tab-content">
		            	<div class="tab-pane active" id="tab1">
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Accepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            			
		            			<div class="row">
		            				<div class="col-md-2">
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">You can <a class="text-green">buy the data via this link</a> at the agreed price. <br>You will also receive an email including the link.</p>			            					
		            				</div>
		            			</div>		            			
		            		</div>		            		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Buyer Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>		            			            			
		            		</div>		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Recepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>	
		            	</div>
		            	<div class="tab-pane" id="tab2">
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€800</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Buyer Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>		            			            			
		            		</div>	
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2020 - 14:34</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€800</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Accepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            			
		            			<div class="row">
		            				<div class="col-md-2">
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">You can <span class="text-green">buy the data via this link</span> at the agreed price. <br>You will also receive an email including the link.</p>			            					
		            				</div>
		            			</div>		            			
		            		</div>		            				            			
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€800</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Recepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€1200</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>	
		            	</div>
		            	<div class="tab-pane" id="tab3">
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€1200</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Accepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            			
		            			<div class="row">
		            				<div class="col-md-2">
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">You can <span class="text-green">buy the data via this link</span> at the agreed price. <br>You will also receive an email including the link.</p>			            					
		            				</div>
		            			</div>		            			
		            		</div>		            		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€1200</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Buyer Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>		            			            			
		            		</div>		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Recepted By:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>		
		            		<div class="bid_desc">
		            			<div class="row">
		            				<div class="col-md-2">		            					
		            				</div>
		            				<div class="col-md-10">
		            					<p class="text-grey">02/02/2007 - 13:57</p>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Bid:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<span class="text-warning">€500</span>
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>From:</label>		
		            				</div>
		            				<div class="col-md-10">		            					
		            					<p class="text-bold">Seller Company Name </p>
				            			<p class="text-bold">Mark Spencer</p>	
		            				</div>
		            			</div>
		            			<div class="row">
		            				<div class="col-md-2">
		            					<label>Message:</label>		
		            				</div>
		            				<div class="col-md-10">
		            					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et sapien nisi. Vestibulum sed lacinia quam, quis auctor nulla. Aenean auctor felis id convallis dapibus. Vivamus vitae nulla scelerisque, faucibus metus vel, fermentum purus. Aliquam sit amet lectus velit. Ut vel lectus tempus nisl tempus feugiat. Fusce maximus, urna non consequat viverra, magna ante fringilla turpis, pellentesque placerat libero justo eget leo.</p>			            					
		            				</div>
		            			</div>		            					            			            			
		            		</div>	
		            	</div>
		            </div>
		        </div>    
	        </div>
	    </div>
	</div>
</div>
@endsection	
