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
                        <h4 class="page-title">Accepted Bid Details</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Accepted Bid Details</li>
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
                          <div class="table-responsive">
                            <table id="default-datatable" class="table">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th data-orderable="false">Upload Documents</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($finalbids as $finalbid)
                                    <tr>
                                      <td>{{$finalbid->created_at}}</td>
                                      <?php $product_name = \App\Seller::where('id', $finalbid->offer_id)->pluck('product_name')->first();
                                      $buyer_name = \App\Profile::where('user_id', $finalbid->buyer_id)->pluck('company_name')->first();
                                      $seller_name = \App\Profile::where('user_id', $finalbid->seller_id)->pluck('company_name')->first(); ?>
                                      <td>{{$product_name}}</td>
                                      <td>{{$seller_name}}</td>
                                      <td>{{$buyer_name}}</td>
                                      <td>{{$finalbid->new_currency}}{{$finalbid->new_price}}{{$finalbid->new_perunit}}</td>
                                      <td>{{$finalbid->new_quantity}}{{$finalbid->new_unit}}</td>
                                      @if(Auth::user()->id == $finalbid->seller_id)
                                      <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Offer" class="btn btn-primary btn-round" href="{{ url('upload-document-seller', [$finalbid->id]) }}"><i class="fa fa-upload"></i></a></td>
                                      @else
                                      <td><a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Offer" class="btn btn-primary btn-round" href="{{ url('upload-document-buyer', [$finalbid->id]) }}"><i class="fa fa-upload"></i></a></td>
                                      @endif
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
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
    <script src="../admin_assets/js/jquery.min.js"></script>
    @include('header_script')
    <script src="../admin_assets/js/popper.min.js"></script>
    <script src="../admin_assets/js/bootstrap.min.js"></script>
    <script src="../admin_assets/js/modernizr.min.js"></script>
    <script src="../admin_assets/js/detect.js"></script>
    <script src="../admin_assets/js/jquery.slimscroll.js"></script>
    <script src="../admin_assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="../admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Datatable js -->
    <script src="../admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../admin_assets/plugins/datatables/jszip.min.js"></script>
    <script src="../admin_assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="../admin_assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../admin_assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="../admin_assets/js/custom/custom-table-datatable.js"></script>

    <!-- Sweet-Alert js -->
    <script src="../admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="../admin_assets/js/custom/custom-sweet-alert.js"></script>
    
    <!-- Core js -->
    <script src="../admin_assets/js/core.js"></script>
    <!-- End js -->   

</body>
</html>