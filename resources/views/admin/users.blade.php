
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
                    <h4 class="page-title">Users</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <!-- Start row -->
                        <div class="row">
                            <!-- Start col -->
                            <div class="col-lg-12 col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                       
                                        <div class="table-responsive">
                                            <table id="default-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Joined On</th>
                                                        <th>Status</th>
                                                        <th data-orderable="false">Quick Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)                          
                                                        @if( $user->name != 'Admin')
                                                        <!--all active user data-->
                                                        <tr>
                                                          <td>{{ $user->name }}</td>
                                                          <td>{{ $user->email }}</td>
                                                          <td>{{ $user->phone }}</td>
                                                          <td>{{ $user->created_at }}</td>
                                                          @if($user->status == 'Active')
                                                          <td class="text-success font-weight-bold">{{$user->status}}</td>
                                                          @elseif($user->status == 'Pending')
                                                          <td class="text-info font-weight-bold">{{$user->status}}</td>
                                                          @else
                                                          <td class="text-danger font-weight-bold">{{$user->status}}</td>
                                                          @endif
                                                          <td>
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View User Profile" class="btn btn-round btn-primary" href="{{ url('admin/user-details', [$user->id]) }}">
                                                              <i class="fa fa-eye"></i>
                                                            </a>
                                                            <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                                                            <div class="modal-dialog" role="document">
	                                                              <div class="modal-content">
	                                                                <div class="modal-header">
	                                                                  <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
	                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                                                    <span aria-hidden="true">&times;</span>
	                                                                  </button>
	                                                                </div>
	                                                                <div class="modal-body">
	                                                                  <form method="POST" action="{{ url('update-user') }}">
	                                                                    @csrf
	                                                                    <div class="row">                                  
	                                                                      <div class="col-sm-6">
	                                                                        <input type="text" class="form-control" name="id" required autocomplete="id" autofocus readonly="readonly" value="{{ $user->id }}">
	                                                                      </div>
	                                                                      <div class="col-sm-6">
	                                                                         <input type="text" class="form-control" name="name" required autocomplete="name" autofocus placeholder="Name" value="{{ $user->name }}">                
	                                                                      </div>
	                                                                      <div class="col-sm-6">
	                                                                         <input type="text" class="form-control" name="email" required autocomplete="email" autofocus placeholder="Email" value="{{ $user->email }}">                
	                                                                      </div>
	                                                                      <div class="col-sm-6">
	                                                                         <input type="text" class="form-control" name="phone" required autocomplete="phone" autofocus placeholder="Phone" value="{{ $user->phone }}">                
	                                                                      </div>
	                                                                    </div><br>
	                                                                    <div class="row">                                          
	                                                                      <div class="col-sm-12">
	                                                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>                 
	                                                                      </div>
	                                                                    </div>
	                                                                  </form>
	                                                                </div>
	                                                              </div>
	                                                            </div>
                                                          	</div>
                                                            @if( $user->status == "Active")
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Activate User" class="btn btn-round btn-success disabled" onclick="return confirm('Are you sure?')" href="{{ url('activate-user', [$user->id]) }}">
                                                              <i class="fa fa-check"></i>
                                                            </a>
                                                            @else
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Activate User" class="btn btn-round btn-success" onclick="return confirm('Are you sure?')" href="{{ url('activate-user', [$user->id]) }}">
                                                              <i class="fa fa-check"></i>
                                                            </a>
                                                            @endif
                                                            @if( $user->status == "Deactive")
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Deactivate User" class="btn btn-round btn-danger disabled" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-user', [$user->id]) }}">
                                                              <i class="fa fa-close"></i>
                                                            </a>
                                                            @else
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Deactivate User" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-user', [$user->id]) }}">
                                                              <i class="fa fa-close"></i>
                                                            </a>
                                                            @endif
                                                            <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove User" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('delete-user', [$user->id]) }}">
                                                              <i class="fa fa-trash"></i>
                                                            </a>
                                                          </td>
                                                        </tr>
                                                        <!--all active user data end-->
                                                        @endif
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
    <!-- End js -->
</body>
</html>