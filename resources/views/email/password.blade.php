<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
		<meta content="width=device-width" name="viewport"/>
		<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=DM+Sans" rel="stylesheet" type="text/css"/>
		<style>
			body{padding: 30px 25px;background: #f8f8f8 0% 0% no-repeat padding-box;font-family: "DM Sans";}
			table,td,tr {vertical-align: top;border-collapse: collapse;}
			a:hover{color: #06038D;}
			.fs-14{font-size: 14px;}
			.fs-16{font-size: 16px;}
			.fs-18{font-size: 18px;}
			.fs-30{font-size: 30px;}
			.fs-40{font-size: 40px;}
			.lh-21{line-height: 21px;}
			.lh-24{line-height: 24px;}
			.lh-27{line-height: 27px;}
			.lh-30{line-height: 30px;}
			.lh-36{line-height: 36px;}
			.lh-44{line-height: 44px;}
			.m-0{margin: 0px;}
			.m-auto{margin: auto;}
			.mb-20{margin-bottom: 20px;}
			.mb-30{margin-bottom: 30px;}
			.mb-50{margin-bottom: 50px;}
			.py-10{padding-top: 10px; padding-bottom: 10px;}
			.py-25{padding-top: 25px; padding-bottom: 25px;}
			.w-100{width: 100%;}
			#container{max-width: 750px;margin: auto;padding: 30px 25px;background-color: #f8f8f8;}
			#body >tbody >tr >td{background-color: white; padding: 30px 50px;}
			#footer{background-color: #f8f8f8; padding: 50px 0px 20px 0px;}
			#bodyTable{width: 100%;}
			#app-brand svg{width: 260px;height: 45px;margin: 50px 0px;}
			#socialIcons .social-button{color: transparent;}
			#socialIcons .social-button img{display: inline-block;cursor: pointer;width: 50px;height: 50px;margin-right: 0.25rem;margin-bottom: 0.25rem;}
			#socialIcons .social-button:hover, #socialIcons .social-button:focus {-webkit-transform: rotate(360deg);-ms-transform: rotate(360deg);transform: rotate(360deg);}
			.text-highlight{color: #78E6D0;}
			.text-grey{color: #DAE1E5;}
			.d-block{display: block;}
			.color-black{color: #020A09;}
			.text-center{text-align: center;}
			.text-bold{font-weight: bold;}
			.text-link{cursor: pointer;}
			.text-link:hover{color: #06038D;}
			.btn{width: 100%;height: 80px;border-radius: 40px;margin: 10px 0px;text-transform: uppercase;font-size: 24px;line-height: 30px;font-weight: bold;cursor: pointer;outline: none;}
			.btn.btn-primary{background: #FF6B6B 0% 0% no-repeat padding-box;border: none;color: white;}
			.btn.btn-secondary{background-color: white;border: 2px solid #06038D;color: #06038D;}
		</style>
	</head>
	<body>	
		<div id="container">
			<table id="body" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>
							<table id="bodyTable" width="100%" height="100%" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" role="presentation" >
								<tbody>
									<tr>
										<td>
											<table id="app-brand" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr>
														<td>
															<a href="/">
										                        <img src="{{ asset('images/logos/site_logo.png') }}" style="width: 300px; margin-bottom: 30px;"/>
									                    	</a>
									                    </td>
									                </tr>
									            </tbody>
						                    </table>
										</td>
									</tr>
									<tr>
										<td>
											<table class="mb-20" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr>
														<td class="fs-40 lh-44 text-bold py-25">
															Dear {{$firstname}},
														</td>
													</tr>
													<tr>
														<td class="fs-18 lh-27 py-10">
															We’ve received a request to reset your password. If you want to set a new password for your account, click the link below and follow the instructions.
														</td>
													</tr>
													<tr>
														<a href="{{ url('/password/reset', $token) }}">
															<button class="btn btn-primary">Reset password</button>
														</a>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table class="mb-20" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr>
														<td class="fs-18 lh-27 py-25">
															If you didn’t make the request, you can ignore this email. Your password will not be changed.
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</table>
			<table id="footer" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>
							<table id="footerTable" class="mb-50" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" >
								<tbody>
									<tr>
										<td>
											<table class="mb-50" width="100%" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr>
														<td class="text-center text-bold fs-30 lh-36 py-25">
															We'd love to hear from you!
														</td>
													</tr>
													<tr>
														<td class="fs-18 lh-24 d-block text-center">
															Help us improve by sharing your feedback in this short <a href="#" class="color-black">survey</a>.
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table id="socialIcons" width="100%" class="mb-50 text-center" cellpadding="0" cellspacing="0" border="0">
												<tbody>
													<tr>
														<td>
															<a class="social-button facebook" href="https://www.facebook.com/DataBroker/" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/facebook.png') }}">
									                        </a>
									                        <a class="social-button facebook" href="https://twitter.com/databroker_gl" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/twitter.png') }}">
									                        </a>
									                        <a class="social-button facebook" href="https://www.reddit.com/r/DatabrokerDAO/" rel="nofollow noopener noreferrer" target="_blank">
									                          <i class="fa fa-reddit fa-3x"></i>
									                        </a>
									                        <a class="social-button facebook" href="https://www.linkedin.com/company/databroker-dao/" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/linkedin.png') }}">
									                        </a>   
									                        <a class="social-button facebook" href="https://medium.com/databrokerdao" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/medium.png') }}">
									                        </a>   
									                        <a class="social-button facebook" href="https://github.com/databrokerglobal" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/github.png') }}">
									                        </a>   
									                        <a class="social-button facebook" href="https://t.me/databrokerdao" rel="nofollow noopener noreferrer" target="_blank">
									                          <img src="{{ asset('/images/social/telegram.png') }}">
									                        </a>                          
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<span class="text-grey d-block text-center fs-14 lh-21">Copyright &copy; 2019 Databroker. All Rights Reserved.</span>
											<span class="text-grey d-block text-center fs-14 lh-21"><span class="text-link">help@databroker.com</span> | 1(800)123-90-87</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>

</html>