<!DOCTYPE html>
<html lang="en">

@include('new_head')

<body class="vertical-layout">
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
                        <h4 class="page-title">Manage Users</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba" id="hide-btn"><i class="feather icon-plus mr-2"></i>Add New User</button>
                        </div>                        
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
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
                    <div class="col-lg-12 add_new_product" style="display: none;">
                      <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">Add New User</h5>
                        </div>
                        <div class="card-body">
                          <form method="POST" class="form-validate needs-validation" action="{{ url('/subuser-store') }}">
                            @csrf
                            <div class="form-row">
                              <div class="form-group col-md-3 mb-3">
                                <label for="val-username">User name</label>
                                <div>
                                  <input type="text" class="form-control" id="val-username" placeholder="User name" required="true" name="name">
                                </div>
                              </div>
                              <div class="form-group col-md-3 mb-3">
                                <label for="val-email">Email</label>
                                <div>
                                  <input type="email" class="form-control" id="val-email" placeholder="Email" required="true" name="email">
                                </div>
                              </div>
                              <div class="form-group col-md-3 mb-3">
                                <label for="val-password">Password</label>
                                <div>
                                  <input type="password" class="form-control" id="val-password" placeholder="Password" required="true" name="password">
                                </div>
                              </div>
                              <div class="form-group col-md-3 mb-3">
                                <label for="val-skill">Role</label>
                                <div>
                                  <input type="text" class="form-control" id="val-skill" placeholder="Role" required="true" name="role">
                                </div>
                              </div>
                              <div class="col-md-3 d-none">
                                <div class="form-group">
                                  <label class="bmd-label-floating">Parent</label>
                                  <input type="text" class="form-control" name="parent" value="{{Auth::user()->id}}">
                                </div>
                              </div>
                            </div>
                            @foreach($users as $user)
                            @if($user->subusercount != 3)
                            <button type="submit" class="btn btn-primary pull-right">Add User</button>
                            @else
                            <a class="btn pull-right disabled">Add User</a>
                            @endif
                            @endforeach
                            <div class="clearfix"></div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End col -->

                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Users List</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                                @if (\Session::has('success1'))                          
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                {!! \Session::get('success1') !!}
                                    </div>
                                @endif
                                @if (\Session::has('fail1'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      {!! \Session::get('fail1') !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($subusers as $subuser)
                                            <tr>
                                              <td>{{$subuser->name}}</td>
                                              <td>{{$subuser->email}}</td>
                                              <td>{{$subuser->role}}</td>
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

    <!-- Parsley js -->
    <script src="admin_assets/plugins/validatejs/validate.min.js"></script>
    <!-- Validate js -->
    <script src="admin_assets/js/custom/custom-validate.js"></script>
    <script src="admin_assets/js/custom/custom-form-validation.js"></script>
    
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->   

  <script>
  $(document).ready(function(){
    $(".add_new_product").hide();
      $("#hide-btn").click(function(){
        if($(".add_new_product").is(":visible"))
        {
          $(".add_new_product").hide("slow");
          $("#hide-btn").html("<i class='feather icon-plus mr-2'></i> Add New User");
        }
        else
        {
          $(".add_new_product").show("slow");
          $("#hide-btn").html("<i class='feather icon-minus mr-2'></i> Close");
        }
      });

      $(".product1").addClass("active");

      $(".subcategory11").change(function()
      {
        var prod = $(this).val();
        $.get("ajax-my-allprod", {cid: prod}, function(data, status)
        {
          //alert("Data: " + data + "\nStatus: " + status);
          $(".product11").empty();
          $(".product11").append('<option value="">Choose</option>');
          $.each(data,function(index,subcatObj)
          {
          $(".product11").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
          });
          /*$(".product11").append('<option value="others">Other</option>');*/
        });
      });
  });
  </script>
  <script>
  $(document).ready(function(){

    $.get("ajax-allcat", function(data, status)
        {
          // alert('h');
          // alert("Data: " + data + "\nStatus: " + status);
          //$('.category11').empty();
          $.each(data,function(index,subcatObj)
          {
          $(".category11").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
          });
          /*$(".category11").append('<option value="others">Other</option>');*/
        });

      $(".category11").change(function()
      {
        var prod = $(this).val();
        $.get("ajax-allsubcat", {cid: prod}, function(data, status)
        {
          //alert("Data: " + data + "\nStatus: " + status);
          $(".subcategory11").empty();
          $(".subcategory11").append('<option value="">Choose</option>');
          $.each(data,function(index,subcatObj)
          {
          $(".subcategory11").append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
          });
          /*$(".subcategory11").append('<option value="others">Other</option>');*/
        });
      });
  });
  </script>
</body>

</html>