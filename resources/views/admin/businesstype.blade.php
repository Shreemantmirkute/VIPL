<!DOCTYPE html>
<html lang="en">
	@include('admin/new_head')
	<body class="vertical-layout">
		<!-- Start Containerbar -->
		<div id="containerbar">
			<!-- Start Leftbar -->
			@include('admin/new_sidebar')
			<!-- End Leftbar -->
			<!-- Start Rightbar -->
			<div class="rightbar">
				<!-- Start Topbar Mobile -->
				@include('admin/new_header')
				<!-- End Topbar -->
				<div class="breadcrumbbar">
					<div class="row align-items-center">
						<div class="col-md-8 col-lg-8">
							<h4 class="page-title">Business Type</h4>
							<div class="breadcrumb-list">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="">Masters</a></li>
									<li class="breadcrumb-item active" aria-current="page">Business Type</li>
								</ol>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="widgetbar">
								<button id="hide-btn" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add New Business Type</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Start Contentbar -->
				<div class="contentbar">
					@if (\Session::has('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{!! \Session::get('success') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (\Session::has('fail'))
					<div class="alert alert-danger">
						<p>{!! \Session::get('fail') !!}</p>
					</div>
					@endif
					@if (\Session::has('successdeleted'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{!! \Session::get('successdeleted') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (\Session::has('faildeleted'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{!! \Session::get('faildeleted') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (\Session::has('success1'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{!! \Session::get('success1') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (\Session::has('fail1'))
					<div class="alert alert-danger">
						<p>{!! \Session::get('fail1') !!}</p>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					<!-- Start row -->
					<div class="row">
						<!-- Start col -->
						<div class="col-lg-12 add_new_product" style="display: none;">
							<!-- Start row -->
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="card-title">Add New Business Type</h5>
								</div>
								<div class="card-body">
									
									<form method="POST" action="{{ url('create-businesstype') }}" id="addbusinesstype">
										@csrf
										<div class="row">
											<div class="col-sm-4">
												<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
												@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
											<div class="col-sm-2">
												<label>Default Currency</label>
												@foreach ($currencies as $currency)
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input currency-group" type="checkbox" value="{{ $currency->code }} {{ $currency->symbol }}" name="default_currency[]"> {{ $currency->code }} {{ $currency->symbol }}
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
												@endforeach
												<div class=".errorcurrency"></div>
											</div>
											<div class="col-sm-2">
												<label>Registered as</label>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="Buyer" name="registered_as[]"> Buyer
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="Seller" name="registered_as[]"> Seller
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</div>
											
											<div class="col-sm-2">
												<label>Show Details</label>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" value="Work" name="work_details[]">Work Details
														<span class="form-check-sign">
															<span class="check"></span>
														</span>
													</label>
												</div>
											</div>
											<div class="col-sm-2">
												<button type="submit" class="btn btn-primary">Add</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="card-title">Business Type List</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="default-datatable" class="table">
											<thead>
												<th>Id</th>
												<th>Name</th>
												<th data-orderable="false">Currency</th>
												<th data-orderable="false">Can be Registered As</th>
												<th data-orderable="false">Work details</th>
												<th data-orderable="false">Quick Actions</th>
											</thead>
											<!--row start -->
											@foreach ($businesstypes as $key=>$businesstype)
											<tr>
												<td>{{ $key+1}}</td>
												<td>{{ $businesstype->name }}</td>
												<td>
													<?php
													$currency = json_decode($businesstype->default_currency, true);
													$comma_separated = implode(", ", $currency);
													echo $comma_separated;
													?>
												</td>
												<td>
													<?php
													$registered_as = json_decode($businesstype->registered_as, true);
													$comma_separated = implode(", ", $registered_as);
													echo $comma_separated; ?>
												</td>
												@if($businesstype->work_details == "null")
												<td>-</td>
												@else
												<td>
													<?php
													$work =str_replace (array('["', '"]'), '' , $businesstype->work_details);
													echo $work;
													?>
												</td>
												@endif
												<td>
													<!--  <button type="button" rel="tooltip" title="Edit Category" class="btn btn-primary btn-link btn-sm" disabled="disabled">
													<i class="material-icons">edit</i>
													</button> -->
													<!-- <a type="button" rel="tooltip" title="Activate" class="btn btn-success btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('activate-category', [$businesstype->id]) }}">
														<i class="material-icons">verified_user</i>
													</a>
													<a type="button" rel="tooltip" title="Deactivate" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-category', [$businesstype->id]) }}">
														<i class="material-icons">warning</i>
													</a> -->
													<a type="button" rel="tooltip" title="Remove Business Type" class="btn btn-danger btn-round" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure?')" href="{{ url('delete-businesstype', [$businesstype->id]) }}">
														<i class="fa fa-trash"></i>
													</a>
													<a href="{{url('/edit/businesstype')}}/{{$businesstype->id}}" title="Edit Business Type" class="btn btn-primary btn-round" data-toggle="tooltip" data-placement="top" ><i class=" fa fa-edit"></i></a>
												</td>
											</tr>
											@endforeach
											<!--row end -->
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End row -->
				</div>
				<!-- End col -->
				<!-- End row -->
			</div>
			<!-- End Contentbar -->
			<!-- Start Footerbar -->
			@include('admin/new_footer')
			<!-- End Footerbar -->
		</div>
		<!-- End Rightbar -->
	</div>
	<!-- End Containerbar -->
	<!-- Start js -->
	<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/detect.js') }}"></script>
	<script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('admin_assets/js/vertical-menu.js') }}"></script>
	<!-- Datatable js -->
	<script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/jszip.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/pdfmake.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/vfs_fonts.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/buttons.print.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/custom/custom-table-datatable.js') }}"></script>
	<script src="{{ asset('admin_assets/js/custom/custom-form-datepicker.js') }}"></script>
	<!-- Switchery js -->
	<script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
	<!-- Apex js -->
	<script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('admin_assets/plugins/apexcharts/irregular-data-series.js') }}"></script>
	<!-- Slick js -->
	<script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>
	<!-- Custom Dashboard js -->
	<script src="{{ asset('admin_assets/js/custom/custom-dashboard.js') }}"></script>
	<!-- Core js -->
	<script src="{{ asset('admin_assets/js/core.js') }}"></script>
	<!-- End js -->
	<script>
	$(document).ready(function(){
	
	$(".add_new_product").hide();
	$("#hide-btn").click(function(){
	$(".add_new_product").show("slow");
	});
	});
	</script>
</body>
</html>