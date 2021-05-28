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
                     <h4 class="page-title">Country</h4>
                     <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                           <li class="breadcrumb-item"><a href="">Masters</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Country</li>
                        </ol>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-4">
                     <div class="widgetbar">
                        <button id="hide-btn" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add New Country</button>
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
               <div class="alert alert-danger">
                  <p>{!! \Session::get('fail') !!}</p>
               </div>
               @endif
               @if (\Session::has('successdeleted'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {!! \Session::get('successdeleted') !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
               @if (\Session::has('faildeleted'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {!! \Session::get('faildeleted') !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
               @if (\Session::has('success1'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {!! \Session::get('success1') !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
               @if (\Session::has('fail1'))
               <div class="alert alert-danger">
                  <p>{!! \Session::get('fail1') !!}</p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
               <!-- Start row -->
               <div class="row">
                  <!-- Start col -->
                  <div class="col-lg-12 add_new_product" style="display: none;">
                     <!-- Start row -->
                     <div class="card m-b-30">
                        <div class="card-header">
                           <h5 class="card-title">Add New Currency</h5>
                        </div>
                        <div class="card-body">
                           <form method="POST" action="{{ url('create-country') }}" id="addcountry">
                              @csrf
                              <div class="row">
                                 <div class="col-sm-3">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus placeholder="Code (2 letters only)">
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                                 <div class="col-sm-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Country Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                                 <div class="col-sm-3">
                                    <input id="phonecode" type="text" class="form-control @error('phonecode') is-invalid @enderror" name="phonecode" value="{{ old('phonecode') }}" required autocomplete="phonecode" autofocus placeholder="Phone Code (Digits only)">
                                    @error('phonecode')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                                 <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <div class="card m-b-30">
                        <div class="card-header">
                           <h5 class="card-title">Country List</h5>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="default-datatable" class="table">
                                 <thead>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Country</th>
                                    <th data-orderable="false">Phone Code</th>
                                    <th data-orderable="false">Quick Actions</th>
                                 </thead>
                                 <!--row start -->
                                 @foreach ($countries as $country)
                                 <tr>
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->code }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->phonecode }}</td>
                                    <td>
                                       <!-- <button type="button" rel="tooltip" title="View Category" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#viewCategory{{ $country->id }}">
                                       <i class="material-icons">visibility</i>
                                       </button> -->
                                       <!-- Modal -->
                                       <div class="modal fade" id="viewCategory{{ $country->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel">View Country</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                   </button>
                                                </div>
                                                <div class="modal-body">
                                                   <table class="table table-sm table-bordered">
                                                      <tr>
                                                         <th>Category Id</th>
                                                         <td>{{ $country->id }}</td>
                                                         <th>Category Name</th>
                                                         <td>{{ $country->name }}</td>
                                                      </tr>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!--  <button type="button" rel="tooltip" title="Edit Category" class="btn btn-primary btn-link btn-sm" disabled="disabled">
                                       <i class="material-icons">edit</i>
                                       </button> -->
                                       <!-- <a type="button" rel="tooltip" title="Activate" class="btn btn-success btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('activate-category', [$country->id]) }}">
                                          <i class="material-icons">verified_user</i>
                                       </a>
                                       <a type="button" rel="tooltip" title="Deactivate" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-category', [$country->id]) }}">
                                          <i class="material-icons">warning</i>
                                       </a> -->
                                       <a type="button" rel="tooltip" title="Remove Country" class="btn btn-danger btn-round" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure?')" href="{{ url('delete-country', [$country->id]) }}">
                                          <i class="fa fa-trash"></i>
                                       </a>
                                    </td>
                                 </tr>
                                 @endforeach
                                 <!--row end -->
                              </table>
                           </div>
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
<!-- Switchery js -->
<script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
<!-- Apex js -->
<script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/apexcharts/irregular-data-series.js') }}"></script>
<!-- Slick js -->
<script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>
<!-- Custom Dashboard js -->
<script src="{{ asset('admin_assets/js/custom/custom-dashboard.js') }}"></script>
<!-- Core js -->
<script src="{{ asset('admin_assets/js/core.js') }}"></script>
<!-- End js -->
<script>
$(document).ready(function(){

$(".add_new_product").hide();
$("#hide-btn").click(function(){
$(".add_new_product").show("slow");
});
});
</script>
</body>
</html>