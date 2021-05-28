<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="VyapaarNetwork">
		<meta name="author" content="Themesbox">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>VyapaarNetwork</title>
		<!-- Fevicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">
		<!-- Start css -->
		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.js"></script>
		<!-- Pnotify css -->
		<link href="{{ asset('admin_assets/plugins/pnotify/css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css">
		
		<!-- Slick css -->
		<link href="{{ asset('admin_assets/plugins/slick/slick.css') }}" rel="stylesheet">
		<link href="{{ asset('admin_assets/plugins/slick/slick-theme.css') }}" rel="stylesheet">
		<link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('admin_assets/css/icons.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('admin_assets/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet" type="text/css">
		<!-- End css -->
		
		<style type="text/css">
		
		body {
		}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}
		input[type=number] {
		-moz-appearance: textfield;
		}
		#svg_form_time {
		height: 15px;
		max-width: 80%;
		margin: 40px auto 20px;
		display: block;
		}
		#svg_form_time circle,
		#svg_form_time rect {
		fill: #d4d8de;
		}
		.button {
		background: #deb302;
		padding: 15px 25px;
		display: inline-block;
		margin: 10px;
		font-weight: bold;
		color: white;
		cursor: pointer;
		border: none;
		}
		.disabled {
		display:none;
		}
		.error{
		color:red;
		}
		
		input[type="file"]{
		-webkit-appearance: none;
		text-align: left;
		-webkit-rtl-ordering:  left;
		}
		input[type="file"]::-webkit-file-upload-button{
		-webkit-appearance: none;
		float: left;
		margin: 0 0 0 5px;
		border: 1px solid #aaaaaa;
		background-image: -webkit-gradient(linear, left bottom, left top, from(#d2d0d0), to(#f0f0f0));
		background-image: -moz-linear-gradient(90deg, #d2d0d0 0%, #f0f0f0 100%);
		}
		.btn-select-file {
		border: 1px solid lightgrey;
		width: 100%;
		padding: 4px;
		margin-top: 4px;
		background-color: white;
		}
		input[type="file"] {
		/*display: none;*/
		opacity: 0;
		height: 0;
		padding: 0;
		margin:0;
		}
		.notice
		{
			font-size: 10px;
			line-height: 0.5;
		}
		</style>
		<!-- End css -->
	</head>
	<body class="vertical-layout">
		<!-- Start Containerbar -->
		<div id="containerbar" class="containerbar authenticate-bg">
			<!-- Start Container -->
			<div class="container">
				<div class="auth-box register-box">
					<!-- Start row -->
					<div class="row no-gutters align-items-center justify-content-center">
						<!-- Start col -->
						<div class="col-md-6 col-lg-8">
							<!-- Start Auth Box -->
							<div class="auth-box-right">
								<div class="card">
									<div class="card-body">
										<form method="POST" action="{{url('test001')}}" enctype="multipart/form-data" id="myform">
											@csrf
											<div class="form-head">
												<a href="index.html" class="logo"><img src="{{ asset('admin_theme_assets/img/logoblack.png') }}" class="img-fluid" alt="logo"></a>
											</div>
											<div id="svg_wrap"></div>
											<section id="personal_details">
												<h5 class="card-title">Personal Details</h5>
												<span class="notice text-danger">Fiels marked with * are mandatory.</span>
												<div class="form-row">
													<div class="form-group col-md-6">
														<input id="name" type="text" class=" @error('name') is-invalid @enderror form-control" name="name" id="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Name*">
														@error('name')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>
													<div class="form-group col-md-6">
														<input type="email" class=" @error('email') is-invalid @enderror form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email*">
														@error('email')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<select class="form-control country form-control" data-style="btn btn-link" name="company_country" id="company_country">
															<option value="">Select Country*</option>
														</select>
													</div>
													<div class="form-group col-md-6">
														<input id="phone" type="tel" class=" @error('phone') is-invalid @enderror form-control" pattern="^[0-9]*$" name="phone" placeholder="Phone*">
														@error('phone')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<input id="password" type="password" class=" @error('password') is-invalid @enderror form-control" name="password"  autocomplete="new-password" placeholder="Password*">
														@error('password')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>
													<div class="form-group col-md-6">
														<input id="password_confirm" type="password" class=" form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password*">
														@error('password_confirm')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
														@enderror
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<select  class="form-control" data-style="btn btn-link" id="areyouid" name="are_you" id="are_you">
															<option value="">Are You*</option>
														</select>
													</div>
													<div class="col">
													</div>
												</div>
											</section>
											<section id="company_details">
												<h5 class="card-title">Company details</h5>
												<span class="notice text-danger">Fiels marked with * are mandatory.</span>
												
												<div class="form-row">
													<div class="form-group col-md-6">
														<input type="text" class="  form-control" placeholder="Company Name*" name="company_name" >
													</div>
													<div class="form-group col-md-6">
														<input type="text" class="  form-control" placeholder="Company Registration No*" name="registration_no" >
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<input type="text" class="  form-control" placeholder="Contact Person*" name="contact_person" >
													</div>
													<div class="form-group col-md-6">
														<div class="file-block">
															<button class="btn-select-file" type="button">Attach Company Logo</button>
															<input type="file" class="form-control" id="company_logo" placeholder="Company Logo" name="company_logo">
														</div>
													</div>
												</div>
												<div class="form-row" id="india_gst">
													<div class="form-group col-md-6">
														<!-- <p>Registration details</p> -->
														<input type="text" class="  form-control" placeholder="GSTIN*" name="gstin" >
													</div>
													<div class="form-group col-md-6" >
														<input type="text" class="  form-control" placeholder="IEC Code*" name="iec_code" id="iec_code" >
													</div>
													<div class="form-group col-md-6">
														<div class="file-block">
															<button class="btn-select-file" type="button">Attach GST Certificate*</button>
															<span class="notice">File Format allowed: jpg, jpeg, png or pdf. Max File Size allowed: 2mb</span>
															<input type="file" id="gstimg" name="gstimg" class="form-control" >
														</div>
													</div>
													<div class="form-group col-md-6">
														<div class="file-block">
															<button class="btn-select-file" type="button">Attach PAN Card*</button>
															<span class="notice">File Format allowed: jpg, jpeg, png or pdf. Max File Size allowed: 2mb</span>
															<input type="file" name="panimg" id="panimg" class="form-control" >
														</div>
													</div>
												</div>
												<br>
												<h5 class="card-title">Office details</h5>
												<span class="notice text-danger">Fiels marked with * are mandatory.</span>
												<div class="form-row">
													<div class="form-group col-md-6">
														<input type="number" class="  form-control" placeholder="Office Phone Number*" name="office_number" pattern="^[0-9]*$">
													</div>
													<div class="form-group col-md-6">
														<input type="number" class="  form-control" placeholder="Alternate Phone Number" name="alternate_number" pattern="^[0-9]*$">
													</div>
												</div>
												
												<div class="form-row">
													<div class="form-group col-md-6">
														<input type="number" class="  form-control" placeholder="Mobile Number*" name="mobile_number" pattern="^[0-9]*$">
													</div>
													<div class="form-group col-md-6">
														<input type="email" class="  form-control" placeholder="Office Phone Email*" name="office_email">
													</div>
												</div>
												
												<div class="form-row">
													<div class="form-group col-md-6">
														<select type="text" class="form-control country  form-control" style="margin-top: 10px" data-style="btn btn-link"  placeholder="Country*" name="office_country" id="office_country">
															<option value="">Select Country*</option>
														</select>
													</div>
													
													<div class="form-group col-md-6">
														<select type="text" class="form-control  form-control" style="margin-top: 10px" data-style="btn btn-link" placeholder="Office State*" name="office_state" id="office_state" >
															<option value="">Select State*</option>
														</select>
													</div>
												</div>
												
												<div class="form-row">
													
													<div class="form-group col-md-6">
														<input type="text" class=" form-control" placeholder="Office Address*" name="office_address" >
													</div>
													
													<div class="form-group col-md-6">
														<input type="text" class=" form-control" placeholder="Office Area*" name="office_area" >
													</div>
												</div>
												
												<div class="form-row">
													
													<div class="form-group col-md-6">
														<input type="text" class=" form-control" placeholder="Office City*" name="office_city" >
													</div>
													<div class="form-group col-md-6">
														<input type="number" class=" form-control" placeholder="Office pincode*" pattern="[0-9]{6}" name="office_pincode" >
														<span class="notice">Only Numberic Values allowed</span>
													</div>
												</div>
												<br>
												<div class="work_details">
													<h5 class="card-title">Work details</h5>
													<span class="notice text-danger">Fiels marked with * are mandatory.</span>
													<div class="form-row work_details">
														<div class="form-group col-md-6">
															<input type="number" class=" form-control" placeholder="Work Number*" name="factory_number" pattern="^[0-9]*$">
														</div>
													</div>
													<div class="form-row work_details">
														<div class="form-group col-md-6">
															<select type="text" class="form-control country form-control" data-style="btn btn-link"   placeholder="Country*" name="factory_country" id="factory_country">
																<option value="">Select Country*</option>
															</select>
														</div>
														
														<div class="form-group col-md-6">
															<select type="text" class="form-control form-control" data-style="btn btn-link" placeholder="Office State*" name="factory_state" id="factory_state" >
																<option value="">Select State*</option>
															</select>
														</div>
														
													</div>
													
												</div>
												
												
												<div class="form-row work_details">
													<div class="form-group col-md-6">
														<input type="text" class="form-control" placeholder="Work Address*" name="factory_address" >
													</div>
													<div class="form-group col-md-6">
														<input type="text" class="form-control" placeholder="Work Area*" name="factory_area" >
													</div>
													
												</div>
												
												<div class="form-row work_details">
													<div class="form-group col-md-6">
														<input type="text" class="form-control" placeholder="Work City" name="factory_city" >
													</div>
													<div class="form-group col-md-6">
														<input type="number" class="form-control pincode" placeholder="Work Pincode*" name="factory_pincode" >
														<span class="notice">Only Numberic Values allowed</span>
													</div>
												</div>
												
												
												<br>
											</section>
											<section>
												<button class="btn btn-success btn-success1 btn-sm" type="button" id="btn1" style="position: absolute;right: 0;"><i class="glyphicon glyphicon-plus"></i>Add</button>
												<div id="product">
													<h5 class="card-title">Product</h5>
													<span class="notice text-danger">Fiels marked with * are mandatory.</span>
													<div class="increment control-group input-group">
														<div class="container" style="margin-top: 10px;">
															<div class="form-row">
																<div class="form-group col-md-6">
																	<select class="form-control category11" data-style="btn btn-link" name="category[]" id="category1">
																		<option value="">Select Category*</option>
																	</select>
																</div>
																<div class="form-group col-md-6">
																	<select class="form-control subcategory11" data-style="btn btn-link" id="subcategory1" name="subcategory[]" >
																		<option value="">Select Product*</option>
																		
																	</select>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<!-- <select class="form-control product11 select123 sub_product" style="margin-top: 10px" data-style="btn btn-link" id="product1" name="product[]"> -->
																	<select class="form-control product11 sub_product" data-style="btn btn-link" id="product1" name="product[]">
																		<option>Select Sub Product*</option>
																	</select>
																</div>
																<div class="form-group col-md-6">
																	<select class="form-control registeredas" data-style="btn btn-link" id="registerasid" name="register_as[]" >
																		<option value="">Registering As*</option>
																	</select>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-3">
																	<select name="currency[]" class="form-control currencyselect" id="currencyselect">
																		
																	</select>
																</div>
																<div class="form-group col-md-5">
																	<input type="number" class="form-control" min="0" name="comission[]"  autocomplete="price" autofocus="" placeholder="Comission*" required>
																</div>
																<div class="form-group col-md-4">
																	<select name="perunit[]" class="form-control units">
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="clone d-none">
														<div class="control-group  input-group">
															<button class="btn btn-danger btn-danger1 btn-sm" type="button" style="position: absolute;right: 0;">
															<i class="glyphicon glyphicon-remove"></i> Remove
															</button>
															<div class="container" style="margin-top: 40px;" id="clonecontainer">
																
																<div class="form-row">
																	
																	<div class="form-group col-md-6">
																		<select class="form-control registeredas" data-style="btn btn-link" id="registerasid" name="register_as[]" >
																			<option value="">Registering As*</option>
																		</select>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-3">
																		<select name="currency[]" class="form-control currencyselect" id="currencyselect">
																			
																		</select>
																	</div>
																	<div class="form-group col-md-5">
																		<input type="number" class="form-control" min="0" name="comission[]"  autocomplete="price" autofocus="" placeholder="Comission*" required>
																	</div>
																	<div class="form-group col-md-4">
																		<select name="perunit[]" class="form-control units">
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</section>
											<section>
												<h5 class="card-title">Terms & Conditions</h5>
												<span class="notice text-danger">Fiels marked with * are mandatory.</span>
												<div  style="overflow-y: auto; height:80vh;"><span class="text-left">
													<!-- <h4>Agreement to terms</h4> -->
													<p>These terms of use constitute a legally binding agreement made between the user who register on this portal, whether personally or on behalf of an entity (“you”) and vyapaar network ("company", “we”, “us”, or “our”), concerning your access to and use of the https://www.vyapaarnetwork.com website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the “site”). You agree that by accessing the site, you have read, understood, and agreed to be bound by all of these terms of use.<br>
														Supplemental terms and conditions or documents that may be posted on the site from time to time are hereby expressly incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to these terms of use at any time and for any reason. It is your responsibility to periodically review these terms of use to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised terms of use by your continued use of the site after the date such revised terms of use are posted.
														<br>
														The information provided on the site is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the site from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.
														<br>
													The site is intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use or register for the site. </p>
													
													<h6>User registration</h6>
													
													<p>You may be required to register with the site. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.<br>
														
														As a buyer you can not register as a seller within the same product. You can be a buyer and seller for different products only. One individual has the right to maintain both buyer and seller profiles but with the distinction as mentioned above.
													</p>
													<h6>Prohibited activities</h6>
													
													<p>You may not access or use the site for any purpose other than that for which we make the site available. The site may not be used in connection with any commercial endeavours except those that are specifically endorsed or approved by us.
														<br>
														As a user of the site, you agree not to:
														<br>
														1. Systematically retrieve data or other content from the site to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.
														<br>
														2. Disparage, tarnish, or otherwise harm, in our opinion, us and/or the site.
														<br>
														3. Make improper use of our support services or submit false reports of your business and false information misleading purchases.
														<br>
														4. Upload or transmit (or attempt to upload or to transmit) viruses, trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party’s uninterrupted use and enjoyment of the site or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the site.
														<br>
														5. Delete the copyright or other proprietary rights notice from any content.
														<br>
														6. Attempt to impersonate another user or person or use the username of another user.
														<br>
													7. Sell or otherwise transfer your profile.</p>
													
													<h6>Privacy policy</h6>
													
													<p>We care about data privacy and security. By using the site, you agree to be bound by our privacy policy posted on the site, which is incorporated into these terms of use. Please be advised the site is hosted in India. If you access the site from any other region of the world with laws or other requirements governing personal data collection, use, or disclosure that differ from applicable laws in India, then through your continued use of the site, you are transferring your data to India, and you agree to have your data transferred to and processed in India.</p>
													
													<h6>Term and Termination</h6>
													
													<p>These terms of use shall remain in full force and effect while you use the site. Without limiting any other provision of these terms of use, we reserve the right to, in our sole discretion and without notice or liability, deny access to and use of the site (including blocking certain ip addresses) and any person for any reason or no reason at all. These rights lie with the admin of the site and the decisions made by him.</p>
													
													<h6>Limitations of Liability</h6>
													
													<p>In no event will we or our admin, directors, employees, or agents be liable to you or any third party for any direct, indirect, consequential, exemplary, incidental, special, or punitive damages, including lost profit, lost revenue, loss of data, or other damages arising from your use of the site.</p>
													
													<h6>Contact us </h6>
													
													<p>In order to resolve a complaint regarding the site or to receive further information regarding use of the site, please contact us at: </p>
													
													<p>
														Vyapaar Network<br>
														__________<br>
														India<br>
														Phone: 9999899766<br>
													Vipl.com<br></p>
												</span>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1">
													<label class="custom-control-label pl-4" for="customCheck1">I / We agree and accept the terms and conditions.</label>
												</div>
											</div>
										</section>
										<div class="button" type="button" id="prev">&larr; Previous</div>
										<div class="button" type="button" id="next">Next &rarr;</div>
										<button type="submit" class="button bg-light submitBtn" id="submit" data-toggle="tooltip" data-placement="top" title="Please Accept Terms and Conditions" disabled style="cursor: default; pointer-events: none;">Agree and Submit Application</button>
									</form>
									<p class="mb-0 mt-3">Already have an account? <a href="{{ url('login') }}">Log in</a></p>
								</div>
							</div>
						</div>
						<!-- End Auth Box -->
					</div>
					<!-- End col -->
				</div>
				<!-- End row -->
			</div>
		</div>
		<!-- End Container -->
	</div>
	<!-- End Containerbar -->
	<!-- Start js -->
	<!-- Forms Validations Plugin -->
	<script src="{{ asset('admin_theme_assets/js/plugins/jquery.validate.min.js') }}"></script>
	<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
	<script src="{{ asset('admin_theme_assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
	
	<script>
	const fileBlocks = document.querySelectorAll('.file-block')
	const buttons = document.querySelectorAll('.btn-select-file')
	;[...buttons].forEach(function (btn) {
	btn.onclick = function () {
	btn.parentElement.querySelector('input[type="file"]').click()
	}
	})
	;[...fileBlocks].forEach(function (block) {
	block.querySelector('input[type="file"]').onchange = function () {
	const filename = this.files[0].name
	block.querySelector('.btn-select-file').textContent = 'File selected: ' + filename
	}
	})
	$( document ).ready(function() {
		// $("#myform").submit(function () {
	 //        $("#submit").attr("disabled", true);
	 //        return true;
	 //    });
	 	$("#submit").click(function(){
				$('#submit').addClass('bg-light');
		        $('#submit').attr('disabled');
		        $('#submit').attr('title', 'Please Accept Terms and Conditions');
		        $('#submit').css({"cursor":"default","pointer-events":"none"});
		});
		$("#customCheck1").change(function() {
		    if(this.checked) {
		        $('#submit').removeClass('bg-light');
		        $('#submit').removeAttr('disabled');
		        $('#submit').attr('title', 'Click To Continue');
		        $('#submit').removeAttr("style");
		    }
		    else
		    {
		    	$('#submit').addClass('bg-light');
		        $('#submit').attr('disabled');
		        $('#submit').attr('title', 'Please Accept Terms and Conditions');
		        $('#submit').css({"cursor":"default","pointer-events":"none"});
		    }
		});
		/* duplicate script for product selected check start */
		var $select = $(".product11");
		$select.on("change", function() {
		$('#product .sub_product option').prop("disabled", false);
		selected = []
		$.each($select, function(index, select) {
		if (select.value !== "") { selected.push(select.value); }
		});
		//for (var index in selected) { $('option[value="'+selected[index]+'"]').hide(); }
		});
		/* duplicate script for product selected check start */
	$( "#name" ).keypress(function(e) {
	var regex = new RegExp("^[a-zA-Z ]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#phone" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#office_number" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#alternate_number" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#mobile_number" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#factory_number" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( ".pincode" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	$( "#factory_pincode" ).keypress(function(e) {
	var regex = new RegExp("^[0-9]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) {
	return true;
	}
	else
	{
	e.preventDefault();
	return false;
	}
	});
	});
	</script>
	<script type="text/javascript">
	var base_color = "#d4d8de";
	var active_color = "#deb302";
	var child = 1;
	var length = $("section").length - 1;
	$("#prev").addClass("disabled");
	$("#submit").addClass("disabled");
	$("section").not("section:nth-of-type(1)").hide();
	$("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');
	var svgWidth = length * 200 + 24;
	$("#svg_wrap").html(
	'<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
					svgWidth +
	' 24" xml:space="preserve"></svg>'
	);
	function makeSVG(tag, attrs) {
	var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
	for (var k in attrs) el.setAttribute(k, attrs[k]);
	return el;
	}
	for (i = 0; i < length; i++) {
	var positionX = 12 + i * 200;
	var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
	document.getElementById("svg_form_time").appendChild(rect);
// <g><rect x="12" y="9" width="200" height="6"></rect></g>'
var circle = makeSVG("circle", {
cx: positionX,
cy: 12,
r: 12,
width: positionX,
height: 6
});
document.getElementById("svg_form_time").appendChild(circle);
}
var circle = makeSVG("circle", {
cx: positionX + 200,
cy: 12,
r: 12,
width: positionX,
height: 6
});
document.getElementById("svg_form_time").appendChild(circle);
$("circle:nth-of-type(1)").css("fill", active_color);
$(".button").click(function () {
$("#svg_form_time rect").css("fill", active_color);
$("#svg_form_time circle").css("fill", active_color);
var id = $(this).attr("id");
if (id == "next") {
var form = $("#myform");
var is_supported_browser = !!window.File,
fileSizeToBytes,
formatter = $.validator.format;
fileSizeToBytes = (function () {
var units = ["B", "KB", "MB", "GB", "TB"];
return function (size, unit) {
var index_of_unit = units.indexOf(unit),
coverted_size;
if (index_of_unit === -1) {
coverted_size = false;
} else {
while (index_of_unit > 0) {
size *= 1024;
index_of_unit -= 1;
}
coverted_size = size;
}
return coverted_size;
};
}());
$.validator.addMethod(
"maxFileSize",
function (value, element, params) {
var files,
unit = params.unit || "KB",
size = params.size || 100,
max_file_size = fileSizeToBytes(size, unit),
is_valid = false;
if (!is_supported_browser || this.optional(element)) {
is_valid = true;
} else {
files = element.files;
if (files.length < 1) {
is_valid = false;
} else {
is_valid = files[0].size <= max_file_size;
}
}
return is_valid;
},
function (params, element) {
return formatter(
"File cannot be larger than {0}{1}.",
[params.size || 100, params.unit || "KB"]
);
}
);
$.validator.addMethod("emailfull", function(value, element) {
return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
}, "Please enter valid email address!");
$.validator.addMethod("alphanumeric", function(value, element) {
return this.optional(element) || /^[\w]+$/i.test(value);}, "Letters, numbers, and underscores only please");
jQuery.validator.addMethod("gstnumber", function(value, element) {
return this.optional(element) || /^[A-Za-z0-9]+$/i.test(value);
}, "Please Enter a valid GST No.");
$.validator.addMethod( "extension", function( value, element, param ) {
param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
}, $.validator.format( "Please select file in jpg, jpeg, png or pdf format." ) );
//validate
form.validate({
		rules: {
			user_name: {
				required: true,
			},
			name: {
				required: true,
			},
			email: {
				required: true,
				email:true,
				emailfull:true
			},
			phone: {
				required: true,
				minlength: 10
			},
			company_country: {
				required: true,
			},
			password : {
				required: true,
				minlength: 8,
			},
			password_confirmation : {
				required: true,
				equalTo: '#password',
			},
			are_you: {
				required: true,
			},
			company_name: {
				required: true,
			},
			registration_no: {
				required: true,
			},
			contact_person: {
				required: true,
			},
			gstin: {
				required: true,
				gstin: true,
			},
			gstimg: {
				required: true,
				extension: "png|jpg|jpeg|pdf"
			},
			panimg: {
				required: true,
				extension: "png|jpg|jpeg|pdf"
			},
			iec_code: {
				required: true,
			},
			office_number:{
				required: true,
				minlength: 10,
			},
			mobile_number:{
				required: true,
				minlength: 10,
			},
			factory_number:{
				required: true,
				minlength: 10,
			},
			office_address:{
				required: true,
			},
			office_area:{
				required: true,
			},
			office_city:{
				required: true,
			},
			office_state:{
				required: true,
			},
			office_country:{
				required: true,
			},
			office_pincode:{
				required: true,
			},
			office_email:{
				required: true,
				email:true,
				emailfull:true
			},
			factory_address:{
				required: true,
			},
			factory_area:{
				required: true,
			},
			factory_city:{
				required: true,
			},
			factory_country:{
				required: true,
			},
			factory_pincode:{
				required: true,
			},
			factory_state:{
				required: true,
			},
			register_as:{
				required: true,
			},
			company_logo:
			{
				extension: "png|jpg|jpeg"
			}
		},
		messages: {
			company_logo:
			{
				extension: "Please select file in jpg, jpeg or png format."
			},
			name: {
				required: "Field Required",
			},
			email: {
				required: "Field Required",
				email:"Please Enter a Valid Email Address",
			},
			phone: {
				required: "Please Enter Valid Mobile Number",
				minlength:"Please Enter atleast 10 digits"
			},
			company_country: {
				required: "Please Select Your Country",
			},
			user_name: {
				required: "Field Required",
			},
			password : {
				required: "Field Required",
				minlength:"Password must be minimum 8 characters",
			},
			password_confirmation : {
				required: "Field Required",
				equalTo: "Passwords does not match",
			},
			are_you: {
				required: "Please Select a Option",
			},
			company_name: {
				required: "Field Required",
			},
			registration_no: {
				required: "Field Required",
			},
			contact_person: {
				required: "Field Required",
			},
			gstin: {
				required: "Field Required",
				gstin: "Please specify a valid GSTTIN Number"
			},
			gstimg: {
				required: "Please choose a file",
				extension: "Please select file in jpg, jpeg or png format."
			},
			panimg: {
				required: "Please choose a file",
				extension: "Please select file in jpg, jpeg or png format."
			},
			iec_code: {
				required: "Field Required",
			},
			office_number:{
				required: "Field Required",
				minlength:"Please Enter atleast 10 digits"
			},
			mobile_number:{
				required: "Field Required",
				minlength:"Please Enter atleast 10 digits"
			},
			factory_number:{
				required: "Field Required",
				minlength:"Please Enter atleast 10 digits"
			},
			office_address:{
				required: "Field Required",
			},
			office_area:{
				required: "Field Required",
			},
			office_city:{
				required: "Field Required",
			},
			office_state:{
				required: "Field Required",
			},
			office_country:{
				required: "Field Required",
			},
			office_pincode:{
				required: "Field Required",
			},
			office_email:{
				required: "Field Required",
				email:"Please Enter a Valid Email Address",
			},
			factory_address:{
				required: "Field Required",
			},
			factory_area:{
				required: "Field Required",
			},
			factory_city:{
				required: "Field Required",
			},
			factory_country:{
				required: "Field Required",
			},
			factory_pincode:{
				required: "Field Required",
			},
			factory_state:{
				required: "Field Required",
			},
			register_as:{
				required: "Field Required",
			},
		}
	});
//validation close
if (form.valid() == true){
$("#prev").removeClass("disabled");
if (child >= length) {
$(this).addClass("disabled");
$('#submit').removeClass("disabled");
}
if (child <= length) {
child++;
}
}
} else if (id == "prev") {
$("#next").removeClass("disabled");
$('#submit').addClass("disabled");
if (child <= 2) {
$(this).addClass("disabled");
}
if (child > 1) {
child--;
}
}
var circle_child = child + 1;
$("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
"fill",
base_color
);
$("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
"fill",
base_color
);
var currentSection = $("section:nth-of-type(" + child + ")");
currentSection.fadeIn();
currentSection.css('transform','translateX(0)');
currentSection.prevAll('section').css('transform','translateX(-100px)');
currentSection.nextAll('section').css('transform','translateX(100px)');
$('section').not(currentSection).hide();
});
</script>
<!-- End js -->
<script type="text/javascript">
$("#email").blur(function(){
var email12 = $(this).val();
$.get("ajax-allemail", {cid: email12}, function(data, status)
{
if(data == 0){
}
else{
$("#email").val("");
new PNotify( {
title: 'Error', text: 'Email Address Already Registered', type: 'danger'
});
}
});
});
$("#phone").blur(function(){
var phone12 = $(this).val();
$.get("ajax-allphone", {cid: phone12}, function(data, status)
{
if(data == 0){
}
else{
$("#phone").val("");
new PNotify( {
title: 'Error', text: 'Phone Number Already Registered', type: 'danger'
});
}
});
});
</script>
<script>
$(document).ready(function(){
$("#india_gst").hide();
$("#other_gst").hide();
$("#company_country").change(function(){
$(this).find("option:selected").each(function(){
var optionValue = $(this).attr("value");
if(optionValue == 'USA'){
$("#india_gst").hide();
$("#other_gst").show();
}
else if(optionValue == 'India') {
$("#india_gst").show();
$("#other_gst").hide();
}
else{
$("#india_gst").hide();
$("#other_gst").hide();
}
});
});
$("#work_address").hide();
$("#iec_code").prop('required',false);
$("#areyouid").change(function(){
var optionValue = $(this).attr("value");
$(this).find("option:selected").each(function(){
var optionValue = $(this).attr("value");
$.get("ajax-businesstype", {cid: optionValue}, function(data, status)
{
$.each(data,function(index,subcatObj)
{
var myObj = JSON.parse(subcatObj["default_currency"]);
var myObj1 = JSON.parse(subcatObj["registered_as"]);
var work_details = JSON.parse(subcatObj["work_details"]);
console.log("work details")
console.log(work_details)
$(".currencyselect").empty();
$(".registeredas").empty();
$(".registeredas").append('<option value ="">Registering as</option>');
for(var k in myObj)
{
$(".currencyselect").append('<option value ="'+myObj[k]+'">'+myObj[k]+'</option>');
}
for(var k in myObj1)
{
$(".registeredas").append('<option value ="'+myObj1[k]+'">'+myObj1[k]+'</option>');
}
if(work_details ==null) {
$(".work_details").hide();
}
else {
$(".work_details").show();
}
});
});
if(optionValue == 'Manufacturer'){
$("#work_address").show();
$("#iec_code").prop('required',false);
}
else if(optionValue == 'Manufacturer and Importer'){
$("#iec_code").prop('required',true);
$("#work_address").show();
}
else if(optionValue == 'Exporter'){
$("#iec_code").prop('required',true);
$("#work_address").hide();
}
else if(optionValue == 'Trader'){
$("#iec_code").prop('required',false);
$("#work_address").hide();
}
else if(optionValue == 'Trader and Importer'){
$("#iec_code").prop('required',true);
}
else{
$("#iec_code").prop('required',false);;
$("#work_address").hide();
}
});
});
});
</script>
<script>
$(document).ready(function(){
$('#office_country').change(function(){
$(this).find("option:selected").each(function(){
var optionValue = $(this).attr("value");
$.get("ajax-state", {cid: optionValue}, function(data, status)
{
$("#office_state").empty();
$("#office_state").append('<option value ="">Select State</option>');
$.each(data,function(index,subcatObj)
{
$("#office_state").append('<option value ="'+subcatObj.name+'">'+subcatObj.name+'</option>');
});
});
});
});
$('#factory_country').change(function(){
$(this).find("option:selected").each(function(){
var optionValue = $(this).attr("value");
$.get("ajax-state", {cid: optionValue}, function(data, status)
{
$("#factory_state").empty();
$("#factory_state").append('<option value ="">Select State</option>');
$.each(data,function(index,subcatObj)
{
$("#factory_state").append('<option value ="'+subcatObj.name+'">'+subcatObj.name+'</option>');
});
});
});
});
});
</script>
<script>
$(document).ready(function(){
$(".product11").addClass("active");
$(".subcategory11").change(function()
{
var prod = $(this).val();
$.get("ajax-allprod", {cid: prod}, function(data, status)
{
//alert("Data: " + data + "\nStatus: " + status);
$(".product11").empty();
$(".product11").append('<option value="">Select Sub Product</option>');
$.each(data,function(index,subcatObj)
{
$(".product11").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
// $(".product11").append('<option value="others">Other</option>');
});
});
});
</script>
<script>
$(document).ready(function(){
	$("#gstimg").on("change", function () {
if(this.files[0].size > 5000000) {
	$(this).val('');
	new PNotify( {
		title: 'Error', text: 'Please upload file less than 5MB. Thanks!!', type: 'danger'
		});

}
});

/* GSTIN Validation*/
$.validator.addMethod("gstin", function(value3, element3) {
    var gst_value = value3.toUpperCase();
    var reg = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
    if (this.optional(element3)) {
      return true;
    }
    if (gst_value.match(reg)) {
      return true;
    } else {
      return false;
    }

  }, "Please specify a valid GSTTIN Number");
/*end of the code*/
$("#panimg").on("change", function () {
if(this.files[0].size > 5000000) {
	$(this).val('');
	var ext = $("#panimg").val().split('.').pop();
            alert(ext);
	new PNotify( {
		title: 'Error', text: 'Please upload file less than 5MB. Thanks!!', type: 'danger'
		});

}
});
$("#company_logo").on("change", function () {
if(this.files[0].size > 2000000) {
	$(this).val('');
	new PNotify( {
		title: 'Error', text: 'Please upload file less than 2MB. Thanks!!', type: 'danger'
		});

}
});
$.get("ajax-allcat", function(data, status)
{
// alert('h');
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
$.each(data,function(index,subcatObj)
{
$("#category1").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
$("#category11").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
$(".category11").append('<option value="others">Other</option>');
});
$("#category1").change(function()
{
var prod = $(this).val();
$.get("ajax-allsubcat", {cid: prod}, function(data, status)
{
//alert("Data: " + data + "\nStatus: " + status);
$("#subcategory1").empty();
$("#subcategory1").append('<option value="">Select Product</option>');
$.each(data,function(index,subcatObj)
{
$("#subcategory1").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
$("#subcategory1").append('<option value="others">Other</option>');
});
});
$("#category12").change(function()
{
var prod = $(this).val();
$.get("ajax-allsubcat", {cid: prod}, function(data, status)
{
//alert("Data: " + data + "\nStatus: " + status);
$("#subcategory12").empty();
$("#subcategory12").append('<option value="">Select Product</option>');
$.each(data,function(index,subcatObj)
{
$("#subcategory12").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
$("#subcategory12").append('<option value="others">Other</option>');
});
});
});
</script>
<script>
$(document).ready(function(){
$.get("ajax-allbusiness", function(data, status)
{
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
// $('#areyouid').append('<option value="">Are you</option>');
$.each(data,function(index,subcatObj)
{
$('#areyouid').append('<option value ="'+subcatObj.name+'">'+subcatObj.name+'</option>');
});
});
});
</script>
<script>
$(document).ready(function(){
$.get("ajax-country", function(data, status)
{
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
// $('#areyouid').append('<option value="">Are you</option>');
$.each(data,function(index,subcatObj)
{
$('.country').append('<option value ="'+subcatObj.name+'">'+subcatObj.name+' (+'+subcatObj.phonecode+')</option>');
});
});
});
</script>
<script>
$(document).ready(function(){
$.get("ajax-unit", function(data, status)
{
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
$(".units").append('<option value="">Choose Unit</option>');
$.each(data,function(index,subcatObj)
{
$(".units").append('<option value ="/'+subcatObj.code+'">/'+subcatObj.code+'</option>');
});
});
});
</script>
<script type="text/javascript">
var count = 5;
var selected = [];
$(document).ready(function() {
var x = 0;
var $select = $(".select123");
$select.on("change", function() {
$.each($select, function(index, select) {
if (select.value !== "") { selected.push(select.value); }
});
$("option").prop("disabled", false);
$('option').attr("disabled", false);
for (var index in selected) { $('option[value="'+selected[index]+'"]').attr("disabled", "disabled"); }
// alert(selected);
});
// $btn = $('button[type="submit"]');
$(".btn-success1").click(function(){

	/* duplicate script for product selected check start */
		var $select = $(".product11");
		$select.on("change", function() {
		$('#product .sub_product option').prop("disabled", false);
		selected = []
		$.each($select, function(index, select) {
		if (select.value !== "") { selected.push(select.value); }
		});
		$('option').show();
		//for (var index in selected) { $('option[value="'+selected[index]+'"]').hide(); }
		});
		/* duplicate script for product selected check start */
// var html = $(".clone").html();
// count--;
// if ( count == 0 )
// {
//   $('#btn1').prop('disabled', true);
// }
// $(".increment").after(html);
if (x < 9) { //max input box allowed
x++;
$(".increment").append('<div class="control-group cloned_form input-group"> <button class="btn btn-danger btn-danger1 btn-sm" type="button" style="position: absolute;right: 0;"> <i class="glyphicon glyphicon-remove"></i> Remove </button> <div class="container" style="margin-top: 40px;"> <div class="form-row"> <div class="form-group col-md-6"> <select class="form-control category11" data-style="btn btn-link" name="category[]" id="category1'+x+'"> <option value="">Select Category</option> </select> </div><div class="form-group col-md-6"> <select class="form-control subcategory11" data-style="btn btn-link" id="subcategory1'+x+'" name="subcategory[]" > <option value="">Select Product</option> </select> </div></div><div class="form-row"> <div class="form-group col-md-6"> <select class="form-control product11 sub_product select123" data-style="btn btn-link" id="product1'+x+'" name="product[]" > <option>Select Subproduct</option> </select> </div><div class="form-group col-md-6"> <select class="form-control registeredas" data-style="btn btn-link" id="registeredasid'+x+'" name="register_as[]" > <option value="">Registering As</option> </select> </div></div><div class="form-row"> <div class="form-group col-md-3"> <select name="currency[]" class="form-control currencyselect" id="currencyselect'+x+'"> </select> </div><div class="form-group col-md-5"> <input type="number" class="form-control" min="0" name="comission[]" autocomplete="price" autofocus="" placeholder="Comission" required> </div><div class="form-group col-md-4"> <select name="perunit[]" class="form-control units" id="perunitid'+x+'"> </select> </div></div></div></div>');
$.get("ajax-allcat", function(data, status)
{
// alert('h');
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
$.each(data,function(index,subcatObj)
{
$("#category1"+x).append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
$("#category1"+x).append('<option value="others">Other</option>');
});
$("#category1"+x).change(function()
{
var prod = $(this).val();
$.get("ajax-allsubcat", {cid: prod}, function(data, status)
{
//alert("Data: " + data + "\nStatus: " + status);
$("#subcategory1"+x).empty();
$("#subcategory1"+x).append('<option value="">Select Product</option>');
$.each(data,function(index,subcatObj)
{
$("#subcategory1"+x).append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
});
$("#subcategory1"+x).append('<option value="others">Other</option>');
});
});
//alert(selected);
$("#subcategory1"+x).change(function()
{
var prod = $(this).val();
$.get("ajax-allprod", {cid: prod}, function(data, status)
{
//alert("Data: " + data + "\nStatus: " + status);
$("#product1"+x).empty();
$("#product1"+x).append('<option value="">Select Sub Product</option>');
$.each(data,function(index,subcatObj)
{
/*            for (var index in selected) { alert(selected[index]); }
if it is enable then add else add with disabled
*/          if($.inArray(subcatObj, selected) < 0){
// $("#product1"+x).append('<option disabled value ="'+subcatObj+'">'+subcatObj+'</option>');
//alert('This is not disabled'+subcatObj);
$("#product1"+x).append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
}
else{
// $("#product1"+x).append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
//alert('This is disabled'+subcatObj);
$("#product1"+x).append('<option disabled value ="'+subcatObj+'">'+subcatObj+'</option>');
}
}
);
// $("#product1"+x).append('<option value="others">Other</option>');
});
});
var $select = $(".product11");
$select.on("change", function() {
$('#product .sub_product option').prop("disabled", false);
selected = []
$.each($select, function(index, select) {
if (select.value !== "") { selected.push(select.value); }
});
//for (var index in selected) { $('option[value="'+selected[index]+'"]').hide(); }
});
$.get("ajax-unit", function(data, status)
{
// alert("Data: " + data + "\nStatus: " + status);
//$('.category11').empty();
$("#perunitid"+x).append('<option value="">Choose Unit</option>');
$.each(data,function(index,subcatObj)
{
$("#perunitid"+x).append('<option value ="/'+subcatObj.code+'">/'+subcatObj.code+'</option>');
});
});
var optionValue = $('#areyouid').val();
$.get("ajax-businesstype", {cid: optionValue}, function(data, status)
{
	$.each(data,function(index,subcatObj)
	{
		var myObj = JSON.parse(subcatObj["default_currency"]);
		var myObj1 = JSON.parse(subcatObj["registered_as"]);
		$("#currencyselect"+x).empty();
		$("#registeredasid"+x).empty();
		$("#registeredasid"+x).append('<option value ="">Registering as</option>');
			for(var k in myObj)
			{
				$("#currencyselect"+x).append('<option value ="'+myObj[k]+'">'+myObj[k]+'</option>');
			}
			for(var k in myObj1)
			{
				$("#registeredasid"+x).append('<option value ="'+myObj1[k]+'">'+myObj1[k]+'</option>');
			}
	});
});
}
});
$("body").on("click",".btn-danger1",function(){
	sub_product = $(this).parents(".cloned_form").find(".sub_product option:selected").text();
	selected.splice($.inArray(sub_product, selected), 1);
	$('option[value="'+sub_product+'"]').prop("disabled", false);
	$(this).parents(".cloned_form").remove();
		/* duplicate script for product selected check start */
		// var $select = $(".product11");
		// $select.on("change", function() {
		// $('#product .sub_product option').prop("disabled", false);
		// selected = []
		// $.each($select, function(index, select) {
		// if (select.value !== "") { selected.push(select.value); }
		// });
		// });
		/* duplicate script for product selected check start */
});
});
</script>

</body>
</html>