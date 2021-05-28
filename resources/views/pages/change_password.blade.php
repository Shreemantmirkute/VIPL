<!DOCTYPE html>
<html lang="en">
  
  @include('new_head')
  <body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar">
      <!-- Start Leftbar -->
      @include('new_sidebar')
      <!-- Start Rightbar -->
      <div class="rightbar">
        <!-- Start Topbar Mobile -->
        @include('new_header')
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
              <h4 class="page-title">Change Password</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->
        
        <div class="contentbar">
          @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Great!</strong> {!! \Session::get('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if (\Session::has('fail'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>{!! \Session::get('fail') !!}</p>
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
          <div class="row" id="change-password">
            <div class="col-md-12">
              
              <div class="card m-b-30">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Change Password</h4>
                  <p class="card-category">Let's Get More Secure By Changing Your Password</p>
                </div>
                <div class="card-body">
                  
                  <form method="POST" action="{{ url('change_password') }}">
                    @csrf
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Old Password</label>
                          <input type="text" class="form-control" name="old_password">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">New Password</label>
                          <input type="text" class="form-control" name="new_password">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="text" class="form-control" name="confirm_password">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('new_footer')
      </div>
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
    <!-- Switchery js -->
    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
    
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->
  </body>
</html>