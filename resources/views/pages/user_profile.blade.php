<!DOCTYPE html>
<html lang="en">
@include('new_head')

<body class="vertical-layout">    
    <!-- Start Infobar Setting Sidebar -->
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close"></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Payment Reminders</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Stock Updates</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Open for New Products</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Enable SMS</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Newsletter Subscription</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Show Map</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">e-Statement</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8"><h6 class="mb-0">Monthly Report</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
      @include('new_sidebar')
      <!-- End Leftbar -->
      <!-- Start Rightbar -->
      <div class="rightbar">
        <!-- Start Topbar Mobile -->
        @include('new_header')
        <!-- End Topbar -->
        <!-- Start Breadcrumbbar -->                    
        <div class="breadcrumbbar">
            <div class="row align-items-center">
                <div class="col-md-8 col-lg-8">
                    <h4 class="page-title">Profile</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                <!--<div class="col-md-4 col-lg-4">
                    <div class="widgetbar">
                      <a href="{{ url('/logout') }}" class="btn btn-primary-rgba"><i class="feather icon-log-out mr-2"></i>Log Out</a>
                    </div>                        
                </div>-->
            </div>          
        </div>
        <!-- End Breadcrumbbar -->
        <!-- Start Contentbar -->    
        <div class="contentbar">
          @foreach ($profiles as $profile)
            @if ($profile->user_id == Auth::user()->id)
              <!-- Start row -->
              <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-5 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-header">                                
                                <h5 class="card-title mb-0">My Account</h5>
                            </div>
                            <div class="card-body">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link mb-2 active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="feather icon-grid mr-2"></i>Dashboard</a>
                                    <a class="nav-link mb-2" id="v-pills-basic-details-tab" data-toggle="pill" href="#v-pills-basic-details" role="tab" aria-controls="v-pills-basic-details" aria-selected="false"><i class="feather icon-user mr-2"></i>Basic Details</a>
                                    <a class="nav-link mb-2" id="v-pills-office-details-tab" data-toggle="pill" href="#v-pills-office-details" role="tab" aria-controls="v-pills-office-details" aria-selected="true"><i class="feather icon-home mr-2"></i>Office Details</a>
                                    <a class="nav-link mb-2" id="v-pills-work-details-tab" data-toggle="pill" href="#v-pills-work-details" role="tab" aria-controls="v-pills-work-details" aria-selected="false"><i class="feather icon-map-pin mr-2"></i>Work Details</a>
                                    <!--<a class="nav-link mb-2" id="v-pills-kyc-documents-tab" data-toggle="pill" href="#v-pills-kyc-documents" role="tab" aria-controls="v-pills-kyc-documents" aria-selected="false"><i class="feather icon-paperclip mr-2"></i>KYC Documents</a>-->
                                   <!-- <a class="nav-link mb-2" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false"><i class="feather icon-bell mr-2"></i>Notifications</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-7 col-xl-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <!-- Dashboard Start -->
                            <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Dashboard</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="profilebox py-4 text-center">
                                            <img src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" class="img-fluid mb-3" alt="profile" style="width:150px;">
                                            <div class="profilename">
                                                <h5>{{ $profile->company_name }}</h5>
                                            </div>
                                              <div class="button-list">
                                                <a href="#" class="btn btn-primary-rgba font-18"><i class="feather icon-facebook"></i></a>
                                                <a href="#" class="btn btn-info-rgba font-18"><i class="feather icon-twitter"></i></a>
                                                <a href="#" class="btn btn-danger-rgba font-18"><i class="feather icon-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard End -->
                            <!-- My Addresses Start -->
                            <div class="tab-pane fade" id="v-pills-work-details" role="tabpanel" aria-labelledby="v-pills-work-details-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Edit Work Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Work Number</label>
                                                    <input type="phone" class="form-control" id="username" disabled value="{{ $profile->factory_number }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Country</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->factory_country }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">State</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->factory_state }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Address</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->factory_address }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Area</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->factory_area }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">City</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->factory_city }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Pincode</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->factory_pincode }}">
                                                </div>
                                            </div>
                                           <!-- <button type="submit" class="btn btn-primary-rgba font-16"><i class="feather icon-save mr-2"></i>Update</button>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- My Addresses End -->
                            <!-- My Wishlist Start -->
                            <div class="tab-pane fade" id="v-pills-kyc-documents" role="tabpanel" aria-labelledby="v-pills-kyc-documents-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Edit Work Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">GST Number</label>
                                                    <input type="number" class="form-control" id="usermobile" disabled value="{{ $profile->gstin }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">IEC Code</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->iec_code }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">GST Certificate</label><br>
                                                    <img src="{{ asset('/imageupload/profile/'.$profile->gstimg) }}" style="height:80px; width:80px"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Pan Card</label><br>
                                                    <img src="{{ asset('/imageupload/profile/'.$profile->panimg) }}" style="height:80px; width:80px"/>
                                                </div>
                                            </div>
                                          <!--  <button type="submit" class="btn btn-primary-rgba font-16"><i class="feather icon-save mr-2"></i>Update</button>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- My Wishlist End -->
                            <!-- My Wallet Start -->
                            <div class="tab-pane fade" id="v-pills-office-details" role="tabpanel" aria-labelledby="v-pills-office-details-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Edit Office Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Office Number</label>
                                                    <input type="phone" class="form-control" id="username" disabled value="{{ $profile->office_number }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="useremail">Alternate Number</label>
                                                    <input type="phone" class="form-control" id="useremail" disabled value="{{ $profile->alternate_number }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Mobile Number</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->mobile_number }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Email</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->office_email }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Country</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->office_country }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">State</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->office_state }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Address</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->office_address }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Area</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->office_area }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">City</label>
                                                    <input type="phone" class="form-control" id="usermobile" disabled value="{{ $profile->office_city }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Pincode</label>
                                                    <input type="email" class="form-control" id="userbirthdate" disabled value="{{ $profile->office_pincode }}">
                                                </div>
                                            </div>
                                           <!-- <button type="submit" class="btn btn-primary-rgba font-16"><i class="feather icon-save mr-2"></i>Update</button>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- My Wallet End -->
                            <!-- My Notifications Start -->
                            <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Notifications</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="ecom-notification-box">
                                            <ul class="list-unstyled">
                                                <li class="media">
                                                    <span class="mr-3 action-icon badge badge-success-inverse"><i class="feather icon-check"></i></span>
                                                    <div class="media-body">
                                                        <h5 class="action-title">Payment Success !!!</h5>
                                                        <p class="my-3">We have received your payment toward ad Account : 9876543210. Your Ad is Running.</p>
                                                        <p><span class="badge badge-danger-inverse">INFO</span><span class="badge badge-info-inverse">STATUS</span><span class="timing">Today, 09:39 PM</span></p>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <span class="mr-3 action-icon badge badge-primary-inverse"><i class="feather icon-calendar"></i></span>
                                                    <div class="media-body">
                                                        <h5 class="action-title">Nobita Applied for Leave.</h5>
                                                        <p class="my-3">Nobita applied for leave due to personal reasons on 22nd Feb.</p>
                                                        <p><span class="badge badge-success">APPROVE</span><span class="badge badge-danger">REJECT</span><span class="timing">Yesterday, 05:25 PM</span></p>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <span class="mr-3 action-icon badge badge-danger-inverse"><i class="feather icon-alert-triangle"></i></span>
                                                    <div class="media-body">
                                                        <h5 class="action-title">Alert</h5>
                                                        <p class="my-3">There has been new Log in fron your account at Melbourne. Mark it safe or report.</p>
                                                        <p><i class="feather icon-check text-success mr-3"></i><a href="#" class="mr-2">Report Now</a><span class="timing">5 Jan 2019, 02:13 PM</span></p>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <span class="mr-3 action-icon badge badge-warning-inverse"><i class="feather icon-award"></i></span>
                                                    <div class="media-body">
                                                        <h5 class="action-title">Congratulations !!!</h5>
                                                        <p class="my-3">Your role in the organization has been changed from Editor to Chief Strategist.</p>
                                                        <p><span class="badge badge-danger-inverse">ACTIVITY</span><span class="timing">10 Jan 2019, 08:49 PM</span></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Notifications End -->
                            <!-- My Profile Start -->
                            <div class="tab-pane fade" id="v-pills-basic-details" role="tabpanel" aria-labelledby="v-pills-basic-details-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Company Logo</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="profilebox pt-4 text-center">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#" class="btn btn-success-rgba font-18"><i class="feather icon-edit"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <img src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" class="img-fluid" alt="profile" style="width:150px;">
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="btn btn-danger-rgba font-18"><i class="feather icon-trash"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Edit Basic Informations</h5>
                                    </div>
                                    @if (\Session::has('success'))
                                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Great!</strong> {!! \Session::get('success') !!}
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      @endif
                                    <div class="card-body">
                                        
                                        <form method="POST" action="{{url('/update-password')}}">
                                            @csrf
                                          <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Company  Name</label>
                                                    <input type="text" class="form-control" id="username" disabled value="{{ $profile->company_name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="useremail">Company Registeration Number</label>
                                                    <input type="number" class="form-control" id="useremail" disabled value="{{ $profile->registration_no }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Contact Name</label>
                                                    <input type="text" class="form-control" id="username" disabled value="{{ $profile->contact_person }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="useremail">Registered Email</label>
                                                    <input type="email" class="form-control" id="useremail" disabled value="{{ $profile->email }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="usermobile">Mobile Number</label>
                                                    <input type="text" class="form-control" id="usermobile" disabled value="{{ $profile->phone }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userbirthdate">Are you?</label>
                                                    <input type="text" class="form-control" id="userbirthdate" disabled value="{{ $profile->are_you }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" name="password" id="userpassword">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="userconfirmedpassword">Confirmed Password</label>
                                                    <input type="password" name="confirmpassword" class="form-control" id="userconfirmedpassword">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary-rgba font-16"><i class="feather icon-save mr-2"></i>Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- My Profile End -->                       
                        </div>                        
                    </div>
                    <!-- End col -->
              </div>
              <!-- End row -->
            @endif
          @endforeach
        </div>
        <!-- End Contentbar -->
        <!-- Start Footerbar -->
        @include('new_footer')
        <!-- End Footerbar -->
      </div>
      <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="admin_assets/js/jquery.min.js"></script>
    @include('header_script')
    <script src="admin_assets/js/popper.min.js"></script>
    <script src="admin_assets/js/bootstrap.min.js"></script>
    <script src="admin_assets/js/modernizr.min.js"></script>
    <script src="admin_assets/js/detect.js"></script>
    <script src="admin_assets/js/jquery.slimscroll.js"></script>
    <script src="admin_assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Datatable js -->
    <script src="admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/jszip.min.js"></script>
    <script src="admin_assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="admin_assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="admin_assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="admin_assets/js/custom/custom-table-datatable.js"></script>

    <!-- Sweet-Alert js -->
    <script src="admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="admin_assets/js/custom/custom-sweet-alert.js"></script>
    
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->   
</body>
</html>