
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
                      <h4 class="page-title">Completed Bid</h4>
                      <div class="breadcrumb-list">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Completed Bid</li>
                          </ol>
                      </div>
                  </div>
              </div>          
            </div>
            <!-- Start Contentbar -->    
            <div class="contentbar"> 

                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <!-- Start row -->

                        <div class="card m-b-30">
                          <div class="card-body">
                            <form>
                                  @csrf
                                    <div class="table-responsive">
                                      <table id="default-datatable" class="table">
                                  <thead>
                                    <th>Id</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                    <th>Sub-Product</th>
                                    <th>Status</th>
                                   <!-- <th data-orderable="false">Quick Actions</th>-->
                                    <th data-orderable="false">Quick Actions</th>
                                  </thead>
                                  @foreach($completedbids as $acceptedbid)
                                    <tr>
                                      <?php
                                      $buyer12 = \App\User::where('id', $acceptedbid->buyer_id)->get()->pluck('name')->first();
                                      $seller12 = \App\User::where('id', $acceptedbid->seller_id)->get()->pluck('name')->first();
                                      $buyer1 = \App\Profile::where('user_id', $acceptedbid->buyer_id)->get()->pluck('company_name')->first();
                                      $seller1 = \App\Profile::where('user_id', $acceptedbid->seller_id)->get()->pluck('company_name')->first();
                                      $sellername1 = $seller1;
                                      if($acceptedbid->offer_id != '')
                                      {
                                        $productname1 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('product_name')->first();
                                      }
                                      else
                                      {
                                        $productname1 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('product_name')->first();
                                      }
                                      ?>
                                      <td >{{ $acceptedbid->id }}</td>
                                      <td >{{$seller1}}</td>                            
                                      <td >{{$buyer1}}</td>
                                      <td >{{$productname1}}</td>
                                      @if($acceptedbid->admin_confirmation == 'Pending')
                                      
                                      <td class="text-info font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                                      @elseif($acceptedbid->admin_confirmation == 'Approved')
                                      <td class="text-success font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                                      @else
                                      <td class="text-danger font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                                      @endif
                                          <td class="td-actions">
                                        <a rel="tooltip" title="View" class="btn btn-primary btn-round" href="{{ url('admin/admin-bidaccepted-single-view', [$acceptedbid->id, $acceptedbid->buyer_id, $acceptedbid->seller_id]) }}"><i class="fa fa-eye"></i>
                                        </a>
                                        <!-- <a type="button" rel="tooltip" title="View" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#view{{ $acceptedbid->new_price }}"><i class="material-icons">visibility</i>
                                        </a> -->
                                        <!--Modal Start -->
                                        <div class="modal fade" id="view{{ $acceptedbid->new_price }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <td>{{ $acceptedbid->id }}</td>
                                                    <th>Seller</th>
                                                    <td>{{ $sellername1 }}</td>
                                                  </tr>
                                                  <tr>
                                                    <th>Buyer</th>
                                                    <td>{{ $buyer1 }}</td>
                                                    <th>Product Name</th>
                                                    <td>{{$productname1}}</td>
                                                  </tr>
                                                  <tr>
                                                    <th>Price</th>
                                                    <td>{{ $acceptedbid->new_price }}</td>
                                                    <th>Quantity</th>
                                                    <td>{{ $acceptedbid->new_quantity }}</td>
                                                  </tr>
                                                  <tr>
                                                    <th>Status</th>
                                                    <td>{{ $acceptedbid->admin_confirmation }}</td>
                                                    <th>Created On</th>
                                                    <td>{{ $acceptedbid->created_at }}</td>
                                                  </tr>
                                                  <tr>
                                                    <th>Approve</th>
                                                    <td>
                                                      <a type="button" rel="tooltip" title="Approve" class="btn btn-success btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('approve-acceptedbid', [$acceptedbid->id]) }}"><i class="material-icons">verified_user</i></a>
                                                    </td>
                                                    <th>Disapprove</th>
                                                    <td>
                                                      <a type="button" rel="tooltip" title="Dispprove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('disapprove-acceptedbid', [$acceptedbid->id]) }}"><i class="material-icons">warning</i></a>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal End -->
                                      </td>
                                    </tr>
                                  @endforeach
                                </table>
                              </div>
                              <div class="clearfix"></div>
                            </form>
                          </div>
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- End col -->
                </div>
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
    <!-- Switchery js -->
    <script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
    <!-- Apex js -->
    <script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/apexcharts/irregular-data-series.js') }}"></script>    
    <!-- Slick js -->
    <script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>4

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