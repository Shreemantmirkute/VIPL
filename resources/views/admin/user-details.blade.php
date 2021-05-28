<!DOCTYPE html>
<html lang="en">
	@include('admin/new_head')
	<body class="vertical-layout">
		<div id="containerbar">
			<!-- Start Leftbar -->
			@include('admin/new_sidebar')
			<!-- End Leftbar -->
			<div class="rightbar">
				<!-- Start Topbar Mobile -->
				@include('admin/new_header')
				<!-- End Topbar -->
				<div class="breadcrumbbar">
					<div class="row align-items-center">
						<div class="col-md-8 col-lg-8">
							<h5 class="page-title">User Details</h5>
							<div class="breadcrumb-list">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/admin/users') }}">Users</a></li>
									<li class="breadcrumb-item active" aria-current="page">User Details</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- Start Contentbar -->
				<div class="contentbar ">
					@if (\Session::has('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						{!! \Session::get('success') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					@if (\Session::has('fail'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						{!! \Session::get('fail') !!}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					<!-- End Navbar -->
					<div class="row" id="add_user">
						<div class="col-md-12">
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="card-title">KYC Details</h5>
									<!-- <p class="card-category">User Products for better accessbility.</p> -->
								</div>
								
								<div class="card-body">
									<div class="row">
										@foreach($users as $user)
										<!-- Id:{{$user->id}}<br> -->
										<div class="col-md-2">
											<b>Name</b>
											<p class="card-title">{{$user->name}}</p>
										</div>
										<div class="col-md-2">
											<b>Email</b>
											<p class="card-title">{{$user->email}}</p>
										</div>
										<div class="col-md-2">
											<b>Phone</b>
											<p class="card-title">{{$user->phone}}</p>
										</div>
										<div class="col-md-2">
											<b>User Joining Date</b>
											<p class="card-title">{{$user->created_at}}</p>
										</div>
										<div class="col-md-2">
											<b>User Status</b>
											@if($user->status == 'Active')
											<p class="card-title text-success font-weight-bold">{{$user->status}}</p>
											@elseif($user->status == 'Pending')
											<p class="card-titlet text-info font-weight-bold">{{$user->status}}</p>
											@else
											<p class="card-title text-danger font-weight-bold">{{$user->status}}</p>
											@endif
										</div>
										<div class="col-md-2">
											<b>Quick Actions</b>
											<p class="card-title">
												<a type="button" rel="tooltip" title="Activate User" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('activate-user', [$user->id]) }}">
													<i class="fa fa-check"></i>
												</a>
												<a type="button" rel="tooltip" title="Deactivate User" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-user', [$user->id]) }}">
													<i class="fa fa-close"></i>
												</a>
											</p>
										</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						@foreach($profiles as $profile)
						<div class="col-md-12">
							<div class="card m-b-30">
								
								<div class="card-header" style="margin: 20px 15px 0;padding: 0;position: relative;">
									<div class="card-icon img-fluid mb-3" style="display: inline-block;">
										<img src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" style="height:40px; width:40px"/>
									</div>
									<h5 class="card-title" style="display: inline-block;margin-left: 10px;">Company Details - {{$profile->are_you}} - {{$profile->company_country}}</h5>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3">
											<b>Company Name</b>
											<p class="card-title">{{$profile->company_name}}</p>
										</div>
										<div class="col-md-3">
											<b>Company Registeration No.</b>
											<p class="card-title">{{$profile->company_name}}</p><!-- data need to be called-->
										</div>
										<div class="col-md-3">
											<b>Contact Person</b>
											<p class="card-title">{{$profile->contact_person}}</p>
										</div>
										<div class="col-md-3">
											<b>Phone</b>
											<p class="card-title">{{$user->phone}}</p>
										</div>
										<!-- <div class="col-md-2">
												<b>Logo</b>
												<p><img src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" style="height:80px; width:80px"/></p>
										</div> -->
									</div>
									<br>
									<div class="row">
										<div class="col-md-3">
											<b>GST Number</b>
											<p class="card-title">{{$profile->gstin}}</p>
										</div>
										<div class="col-md-3">
											<b>IEC Code</b>
											<p class="card-title">{{$profile->iec_code}}</p>
										</div>
										<div class="col-md-3">
											<b>GST Certificate</b>
											<p class="card-title text-info font-weight-bold"><a class="text-info font-weight-bold" href="{{ asset('/imageupload/profile/'.$profile->gstimg) }}">Click to View GST Certificate</a></p>
										</div>
										<div class="col-md-3">
											<b>Pan Card</b>
											<p class="card-title text-info font-weight-bold"><a class="text-info font-weight-bold" href="{{ asset('/imageupload/profile/'.$profile->panimg) }}">Click to View PAN Certificate</a></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<h5 class="card-title" style="font-size: 16px;">Office Details</h5>
										</div>
										<div class="col-md-3">
											<b>Office Number</b>
											<p class="card-title">{{$profile->office_number}}</p>
										</div>
										<div class="col-md-3">
											<b>Alternate Number</b>
											<p class="card-title">{{$profile->alternate_number}}</p>
										</div>
										<div class="col-md-3">
											<b>Mobile Number</b>
											<p class="card-title">{{$profile->mobile_number}}</p>
										</div>
										<div class="col-md-3">
											<b>Office Email</b>
											<p class="card-title">{{$profile->office_email}}</p>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-3">
											<b>Office Address</b>
											<p class="card-title">{{$profile->office_address}}</p>
										</div>
										<div class="col-md-3">
											<b>Office Area</b>
											<p class="card-title">{{$profile->office_area}}</p>
										</div>
										<div class="col-md-3">
											<b>Office City</b>
											<p class="card-title">{{$profile->office_city}}</p>
										</div>
										<div class="col-md-3">
											<b>Office State</b>
											<p class="card-title">{{$profile->office_state}}</p>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-3">
											<b>Office Pincode</b>
											<p class="card-title">{{$profile->office_pincode}}</p>
										</div>
										<div class="col-md-3">
											<b>Office Country</b>
											<p class="card-title">{{$profile->office_country}}</p>
										</div>
									</div>
									@if($profile->factory_address != '')
									
									<hr>
									<div class="row">
										<div class="col-md-12">
											<h5 class="card-title" style="font-size: 16px;">Work Details</h5>
										</div>
										<div class="col-md-3">
											<b>Work Address</b>
											<p class="card-title">{{$profile->factory_address}}</p>
										</div>
										<div class="col-md-3">
											<b>Work Area</b>
											<p class="card-title">{{$profile->factory_area}}</p>
										</div>
										<div class="col-md-3">
											<b>Work City</b>
											<p class="card-title">{{$profile->factory_city}}</p>
										</div>
										<div class="col-md-3">
											<b>Work State</b>
											<p class="card-title">{{$profile->factory_state}}</p>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-3">
											<b>Work Pincode</b>
											<p class="card-title">{{$profile->factory_pincode}}</p>
										</div>
										<div class="col-md-3">
											<b>Work Country</b>
											<p class="card-title">{{$profile->factory_country}}</p>
										</div>
									</div>
									
									@endif
								</div>
							</div>
						</div>
						@endforeach
						
						<div class="col-md-12">
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="card-title">Products</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="datatable-buttons" class="table">
											<thead>
												<tr>
													<th>Category</th>
													<th>Product</th>
													<th>Sub-Product</th>
													<th>Registered As</th>
													<th>Commission</th>
													<th>Date</th>
													<th>Status</th>
													<th data-orderable="false">Quick Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach($items as $item)
												<tr>
													<td>{{ $item->category }}</td>
													<td>{{ $item->subcategory }}</td>
													<td>{{ $item->product }}</td>
													<td>{{ $item->register_as }}</td>
													<td>{{$item->currency}}{{$item->comission}}{{$item->perunit}}</td>
													<td>{{$item->created_at}}</td>
													@if($item->status == 'Rejected')
													<td class="text-danger font-weight-bold">{{$item->status}}</td>
													@elseif($item->status == 'Pending')
													<td class="text-info font-weight-bold">{{$item->status}}</td>
													@else
													<td class="text-success font-weight-bold">{{$item->status}}</td>
													@endif
													
													<td>
														<!-- <a type="button" rel="tooltip" title="View Product" class="btn btn-primary btn-link btn-fab" data-toggle="modal" data-target="#view{{ $item->id }}"><i class="material-icons">visibility</i>
														</a> -->
														<a type="button" rel="tooltip" title="Edit Product" class="btn btn-primary btn-round text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa fa-edit"></i>
														</a>
														<!--Modal Start -->
														<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form method="POST" action="{{ url('admin-update-item') }}">
																			@csrf
																			<div class="row">
																				<label class="col-sm-2">Id</label>
																				<label class="col-sm-3">Comission</label>
																				<label></label>
																			</div>
																			<div class="row">
																				<div class="col-sm-2">
																					<input type="text" name="id" readonly="readonly" value="{{ $item->id }}">
																				</div>
																				<div class="col-sm-3">
																					<input type="text" class="" name="comission" required autocomplete="Comission" autofocus placeholder="Comission" value="{{ $item->comission }}">
																				</div>
																				<div class="col-sm-5">
																					<button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
														<!-- Modal End -->
														@if($item->status == "Approved")
														<a type="button" rel="tooltip" title="Approve Product" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round disabled" onclick="return confirm('Are you sure?')" href="{{ url('approve-item', [$item->id]) }}"><i class="fa fa-check"></i></a>
														@else
														<a type="button" rel="tooltip" title="Approve Product" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('approve-item', [$item->id]) }}"><i class="fa fa-check"></i></a>
														@endif
														@if($item->status == "Rejected")
														<a type="button" rel="tooltip" title="Dispprove Product" class="btn btn-danger btn-round text-white disabled" data-toggle="modal" data-target="#disapprove{{ $item->id }}" ><i class="fa fa-close"></i></a>
														@else
														<a type="button" rel="tooltip" title="Dispprove Product" class="btn btn-danger btn-round text-white" data-toggle="modal" data-target="#disapprove{{ $item->id }}" ><i class="fa fa-close"></i></a>
														@endif
														<a type="button" rel="tooltip" title="Remove Product" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round text-white" onclick="return confirm('Are you sure?')" href="{{ url('admin-delete-item', [$item->id]) }}">
															<i class="fa fa-trash"></i>
														</a>
														<!--Modal Start -->
														<div class="modal fade" id="view{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<table class="table table-sm table-bordered">
																			<tr>
																				<th>Id</th>
																				<td>{{ $item->id }}</td>
																				<th>Category</th>
																				<td>{{ $item->category }}</td>
																			</tr>
																			<tr>
																				<th>Product</th>
																				<td>{{$item->product }}</td>
																				<th>Regsiter As</th>
																				<td>{{$item->register_as}}</td>
																			</tr>
																			<tr>
																				<th>Status</th>
																				<td>{{ $item->status }}</td>
																				<th>Comission</th>
																				<td>{{$item->currency}}{{$item->comission}}{{$item->perunit}}</td>
																			</tr>
																			@if($item->status == 'Rejected')
																			<tr>
																				<th>Reason For Rejection</th>
																				<td>{{$item->rejectionreason}}</td>
																			</tr>
																			@endif
																		</table>
																	</div>
																</div>
															</div>
														</div>
														<!-- Modal End -->
														<!--Modal Start -->
														<div class="modal fade" id="disapprove{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Disapprove</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form method="POST" action="{{ url('admin-reject-item') }}">
																			@csrf
																			<div class="row">
																				<label class="col-sm-2">Id</label>
																				<label class="col-sm-6">Reason</label>
																				<label class="col-sm-4"></label>
																			</div>
																			<div class="row">
																				<div class="col-sm-2">
																					<input type="text" name="id" readonly="readonly" value="{{ $item->id }}">
																				</div>
																				<div class="col-sm-6">
																					<input type="text" class="" name="rejectionreason" required autocomplete="Comission" autofocus placeholder="Reason For Rejection" value="{{ $item->rejectionreason }}">
																				</div>
																				<div class="col-sm-4">
																					<button type="submit" class="btn btn-primary btn-sm float-right">Reject</button>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
														<!-- Modal End -->
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<!-- end content-->
							</div>
							<!--  end card  -->
						</div>
						<!-- end col-md-12 -->
						<!-- end row -->
					</div>
				</div>
				
				@include('admin/new_footer')
			</div>
			<!-- Start js -->
			<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
			<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
			<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>
			<script src="{{ asset('admin_assets/js/detect.js') }}"></script>
			<script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
			<script src="{{ asset('admin_assets/js/vertical-menu.js') }}"></script>
			<!-- Slick js -->
			<script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>
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
			<!-- Custom Dashboard js -->
			<script src="{{ asset('admin_assets/js/custom/custom-dashboard.js') }}"></script>
			<!-- Core js -->
			<script src="{{ asset('admin_assets/js/core.js') }}"></script>
			<!-- End js -->
		</body>
	</html>