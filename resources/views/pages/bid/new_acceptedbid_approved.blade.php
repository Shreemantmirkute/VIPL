<!DOCTYPE html>
<html lang="en">
@include('new_head')

<body class="vertical-layout">    
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
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="defaultTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active" id="my-offers-tab" data-toggle="tab" href="#my-offers" role="tab" aria-controls="my-offers" aria-selected="true">My Offers</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="my-enquiries-tab" data-toggle="tab" href="#my-enquiries" role="tab" aria-controls="my-enquiries" aria-selected="false">My Enquiries</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="other-offers-tab" data-toggle="tab" href="#other-offers" role="tab" aria-controls="other-offers" aria-selected="false">Other Offers</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="other-enquiries-tab" data-toggle="tab" href="#other-enquiries" role="tab" aria-controls="other-offers" aria-selected="false">Other Enquiries</a>
                              </li>
                            </ul>
                              <div class="tab-content" id="defaultTabContent">
                                  <div class="tab-pane fade show active" id="my-offers" role="tabpanel" aria-labelledby="my-offers-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable" class="table">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Offer Product</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonmyoffers as $allbids)
                                              @if($allbids->offer_id != '')
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>
                                                  <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                                                  $buyer_name = \App\Profile::where('user_id', $allbids->buyer_id)->pluck('company_name')->first(); ?>
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$buyer_name}}</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Offer" class="btn btn-primary btn-round" href="{{ url('new-acceptedbid-approved-details', [$allbids->id]) }}"><i class="fa fa-eye"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="my-enquiries" role="tabpanel" aria-labelledby="my-enquiries-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable2" class="table" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Enquiry Product</th>
                                                <th>Seller</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonmyenquiries as $allbids)
                                              @if($allbids->enquiry_id != '')
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>
                                                  <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first(); ?>
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Enquiry" class="btn btn-primary btn-round" href="{{ url('new-acceptedbid-approved-details', [$allbids->id]) }}"><i class="fa fa-eye"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="other-offers" role="tabpanel" aria-labelledby="other-offers-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable3" class="table table-bordered" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Offer Product</th>
                                                <th>Buyer</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonoffers as $allbids)
                                              
                                              @if($allbids->offer_id != '')
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>
                                                  <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first(); ?>
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Offer" class="btn btn-primary btn-round" href="{{ url('new-acceptedbid-approved-details', [$allbids->id]) }}"><i class="fa fa-eye"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="other-enquiries" role="tabpanel" aria-labelledby="other-enquiries-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable4" class="table table-bordered" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Enquiry Product</th>
                                                <th>Seller</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonenquiries as $allbids)
                                              
                                              @if($allbids->enquiry_id != '')
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>
                                                  <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first(); ?>
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Enquiry" class="btn btn-primary btn-round" href="{{ url('new-acceptedbid-approved-details', [$allbids->id]) }}"><i class="fa fa-eye"></i></a></td>
                                                </tr>
                                              @endif
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