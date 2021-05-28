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
                      @foreach($finalbids as $finalbid)
                        <div class="card-body">
                          @if (\Session::has('success'))                          
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              {!! \Session::get('success') !!}
                            </div>
                          @endif

                            @if (\Session::has('warning'))                          
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                {!! \Session::get('warning') !!}
                              </div>
                          @endif
                          @if (\Session::has('fail'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                 {!! \Session::get('fail') !!}
                              </div>
                          @endif
                          <form method="POST" action="{{ url('upload-doc-buyer') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <input type="text" name="bid_id" class="form-control" style="display: none;" value="{{$finalbid->id}}">
                                  <label>Date</label>
                                  <input type="date" name="purchase_date" placeholder="Date" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Purchase Order Number</label>
                                  <input type="text" name="purchase_order_no" placeholder="Purchase Order Number" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Purchase Order Slip</label>
                                  <input type="file" name="purchase_order_slip" placeholder="Purchase Order Slip" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Purchase Order Date</label>
                                  <input type="date" name="purchase_order_date" class="form-control" placeholder="Purchase Order Date" aria-describedby="basic-addon5" />
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <br>
                                  <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        @endforeach
                      </div>
                  </div>
                  <!-- End col -->
              </div>   
              <!-- End row -->
              <!-- Start row -->
              <div class="row">
                <!-- Start col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                      <div class="table-responsive">
                        <table id="default-datatable4" class="table table-bordered" style="width: 100%">
                            <thead>
                              <tr>
                                <th>Bid Id</th>
                                <th>Purchase Date</th>
                                <th>Purchase Order No</th>
                                <th>Purchase Order Date</th>
                                <th>Sell Date</th>
                                <th>Acknowledgement</th>
                                <th>Order Slip</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Delivery Date</th>
                                <th>LR Number</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($uploaded_documents as $doc)
                                <tr>
                                  <td>{{$doc->bid_id}}</td>
                                  <td>{{$doc->purchase_date}}</td>
                                  <td>{{$doc->purchase_order_no}}</td>
                                  <td>{{$doc->purchase_order_date}}</td>
                                  <td>{{$doc->sale_date}}</td>
                                  <td>{{$doc->acknowledgement}}</td>
                                  <td>{{$doc->purchase_order_slip}}</td>
                                  <td>{{$doc->quantity}}</td>
                                  <td>{{$doc->amount}}</td>
                                  <td>{{$doc->delivery_date}}</td>
                                  <td>{{$doc->lr_no}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
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