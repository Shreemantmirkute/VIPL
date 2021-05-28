
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
                      <h4 class="page-title">Sub-Products</h4>
                      <div class="breadcrumb-list">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Sub-Products</li>
                          </ol>
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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! \Session::get('fail') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                @endif
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <!-- Start row -->
                       <div class="row" id="add_user">
            <div class="col-md-12">
              <div class="card m-b-30">
                <div class="card-header card-header-primary">
                  <h5 class="card-title">All Sub-Products</h5>
                </div>
               
                <div class="card-body">
                       
                      <div class="table-responsive">
                        <table id="datatable-buttons" class="table">
                        <form>
                        <thead>  
                          <tr>
                            <th class="disabled-sorting text-left">Id</th>
<!--                             <th>Created On</th>
 -->                            <th>Category</th>
                            <th>Product</th>
                            <th>Sub-Product</th>
                            <th>Created By</th>
                            <th>Registered As</th>
                            <th>Status</th>
                            <th>Comission</th>
                            <th data-orderable="false">Quick Actions</th>
                          </tr>
                        </thead>
                        @foreach($items as $item)
                          @foreach($users as $user)
                            @if($user->id == $item->created_by)
                              <?php $creator = $user->name; 
                              $profile_name = \App\Profile::where('user_id', $user->id)->get()->pluck('company_name')->first();?>
                            @endif
                          @endforeach
                          <tr>
                            <td>{{$item->id }}</td>
<!--                             <td>{{$item->created_at}}</td>
 -->                        <td>{{$item->category}}</td>
                            <td>{{$item->subcategory}}</td>                            
                            <td>{{$item->product}}</td>
                            <td>{{$profile_name}}</td>
                            <td>{{$item->register_as}}</td>
                            
                            @if($item->status == 'Rejected')
                            <td class="text-danger font-weight-bold">{{$item->status}}</td>
                            @elseif($item->status == 'Pending')
                            <td class="text-info font-weight-bold">{{$item->status}}</td>
                            @else
                            <td class="text-success font-weight-bold">{{$item->status}}</td>
                            @endif

                            <td>{{$item->currency}}{{$item->comission}}{{$item->perunit}}</td>
                            <td>
                              <!-- <a type="button" rel="tooltip" title="View" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#view{{ $item->id }}"><i class="material-icons">visibility</i>
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
                                          <label class="col-sm-3">Unit</label>
                                          <label></label>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-2">
                                            <input type="text" name="id" readonly="readonly" value="{{ $item->id }}">
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="text" class="" name="comission" required autocomplete="Comission" autofocus placeholder="Comission" value="{{ $item->comission }}">
                                          </div>
                                           <div class="col-sm-3">
                                             <input type="text" class="" name="perunit" required autocomplete="Unit" autofocus placeholder="Unit" value="{{ $item->perunit }}">
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
                              <!-- <a type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('admin-delete-item', [$item->id]) }}">
                                <i class="material-icons">close</i>
                              </a> -->
                              @if($item->status == "Approved")
                              <a type="button" rel="tooltip" title="Approve Product" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round disabled" onclick="return confirm('Are you sure?')" href="{{ url('approve-item', [$item->id]) }}">
                                 <i class="fa fa-check"></i></a>
                              @else
                              <a type="button" rel="tooltip" title="Approve Product" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('approve-item', [$item->id]) }}"> <i class="fa fa-check"></i></a>
                              @endif
                              @if($item->status == "Rejected")
                              <a type="button" rel="tooltip" title="Reject Product" class="btn btn-danger btn-round text-white disabled" data-toggle="modal" data-target="#disapprove{{ $item->id }}" > <i class="fa fa-close"></i></a>
                              @else
                              <a type="button" rel="tooltip" title="Reject Product" class="btn btn-danger btn-round text-white" data-toggle="modal" data-target="#disapprove{{ $item->id }}" > <i class="fa fa-close"></i></a>
                              @endif
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
                      </table>
                    </div>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
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
    <script>
    // $(document).ready(function() {
    // $('#example').DataTable( {
    //     "order": [[ 3, "desc" ]]
    //     } );
    // } );
   </script>
    <!-- End js -->
</body>
</html>