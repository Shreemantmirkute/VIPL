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
                        <h4 class="page-title">Accepted Bids</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Accepted Bids</li>
                            </ol>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">
              <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card m-b-30">
                            <!-- <div class="card-header">
                                <h5 class="card-title">Default Tabs</h5>
                            </div> -->
                            <div class="card-body">
<!--                                 <h6 class="card-subtitle">Takes the basic nav from above and adds the <code class="highlighter-rouge">.nav-tabs</code> class to generate a tabbed interface. Use them to create tabbable regions with our tab JavaScript plugin.</h6>
 -->                                <ul class="nav nav-tabs mb-3" id="defaultTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="my-offers-tab" data-toggle="tab" href="#my-offers" role="tab" aria-controls="my-offers" aria-selected="true">Bid/Acceptance(Sellers)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="my-enquiries-tab" data-toggle="tab" href="#my-enquiries" role="tab" aria-controls="my-enquiries" aria-selected="false">Bid/Acceptance(Buyers)</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="defaultTabContent">
                                    <div class="tab-pane fade show active" id="my-offers" role="tabpanel" aria-labelledby="my-offers-tab">
                                        <!-- <p>Below is the list of offers created by you.</p> -->
                                        @if (\Session::has('success'))
						                    <div class="alert alert-success">
						                            <p>{!! \Session::get('success') !!}</p>
						                    </div>
						                @endif
						                @if (\Session::has('fail'))
						                    <div class="alert alert-danger">
						                            <p>{!! \Session::get('fail') !!}</p>
						                    </div>
						                @endif
                                        <div class="table-responsive">
                                          <table id="default-datatable" class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Product</th>
						                          <th>Price</th>
						                          <th>Quantity</th>
						                          <th>Origin</th>
						                          <th class="disabled-sorting text-left">Quick Action</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($productforbuyers as $productforbuyer)
						                          <tr>
						                            <td>{{ \Illuminate\Support\Str::limit($productforbuyer->product, $limit = 15, $end = '...') }}</td>
						                            <td>{{ $productforbuyer->currency }} {{ $productforbuyer->price }} {{ $productforbuyer->perunit }}</td>
						                            <td>{{ $productforbuyer->quantity }} {{ $productforbuyer->unit }}</td>
						                            <td class="td-actions">
						                              <a type="button" rel="tooltip" title="View" class="btn btn-primary btn-link btn-sm" href="{{ url('sellerbidacceptance', [$productforbuyer->id, Auth::user()->id]) }}"><i class="material-icons">visibility</i>
						                              </a>
						                            </td>
						                          </tr>
						                        @endforeach
                                              </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="my-enquiries" role="tabpanel" aria-labelledby="my-enquiries-tab">
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
                                        <div class="table-responsive">
                                          <table id="default-datatable2" class="table table-bordered" style="width: 100%">
                                              <thead>
                                                <tr>
                                                  <th>Product</th>
						                          <th>Price</th>
						                          <th>Quantity</th>
						                          <th>Origin</th>
						                          <th class="disabled-sorting text-left">Quick Action</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($productforsellers as $productforseller)
						                          <tr>
						                            <td>{{ \Illuminate\Support\Str::limit($productforseller->product, $limit = 15, $end = '...') }}</td>
						                            <td>{{ $productforseller->price }}</td>
						                            <td>{{ $productforseller->quantity }}</td>
						                            <td>{{ $productforseller->origin }}</td>
						                            <td class="td-actions">
						                              <a type="button" rel="tooltip" title="View" class="btn btn-primary btn-link btn-sm" href="{{ url('buyerbidacceptance', [$productforseller->id]) }}"><i class="material-icons">visibility</i>
						                              </a>
						                            </td>
						                          </tr>
                        						@endforeach
                                              </tbody>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>   
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            @include('new_footer')
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
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