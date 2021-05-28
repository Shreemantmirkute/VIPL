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
                     <h4 class="page-title">Category</h4>
                     <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                           <li class="breadcrumb-item"><a href="">Catalog</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                     </div>
                  </div>
                  <div class="col-md-4 col-lg-4">
                     <div class="widgetbar">
                        <button id="hide-btn" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add New Category</button>
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
                  {!! \Session::get('fail1') !!}
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
                           <h5 class="card-title">Add New Category</h5>
                        </div>
                        <div class="card-body">
                           <form method="POST" action="{{ url('create-category') }}">
                              @csrf
                              <div class="row">
                                 <div class="col-sm-10">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Category Name">
                                    @error('name')
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
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title">Category List</h5>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="default-datatable" class="table">
                                 <thead>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th data-orderable="false">Quick Actions</th>
                                 </thead>
                                 <!--row start -->
                                 @foreach ($categories as $category)
                                 <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    @if( $category->status  == 'Active')
                                    <td class="text-success font-weight-bold">{{ $category->status }}</td>
                                    @else
                                    <td class="text-danger font-weight-bold">{{ $category->status }}</td>
                                    @endif
                                    <td>
                                       <!-- <button type="button" rel="tooltip" title="View Category" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#viewCategory{{ $category->id }}">
                                          <i class="material-icons">visibility</i>
                                          </button> -->
                                       <!-- Modal -->
                                       <div class="modal fade" id="viewCategory{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel">View Category</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                   </button>
                                                </div>
                                                <div class="modal-body">
                                                   <table class="table table-sm table-bordered">
                                                      <tr>
                                                         <th>Category Id</th>
                                                         <td>{{ $category->id }}</td>
                                                         <th>Category Name</th>
                                                         <td>{{ $category->name }}</td>
                                                      </tr>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!--  <button type="button" rel="tooltip" title="Edit Category" class="btn btn-primary btn-link btn-sm" disabled="disabled">
                                          <i class="material-icons">edit</i>
                                          </button> -->
                                       @if( $category->status == "Active")
                                       <a type="button" rel="tooltip" title="Activate Category" data-toggle="tooltip" data-placement="top" class="btn btn-round btn-success disabled" onclick="return confirm('Are you sure?')" href="{{ url('activate-category', [$category->id]) }}">
                                       <i class="fa fa-check"></i>
                                       </a>
                                       @else
                                       <a type="button" rel="tooltip" title="Activate Category" data-toggle="tooltip" data-placement="top" class="btn btn-round btn-success" onclick="return confirm('Are you sure?')" href="{{ url('activate-category', [$category->id]) }}">
                                       <i class="fa fa-check"></i>
                                       </a>
                                       @endif
                                       @if( $category->status == "Deactive")
                                       <a type="button" rel="tooltip" title="Deactivate Category" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round disabled" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-category', [$category->id]) }}">
                                       <i class="fa fa-close"></i>
                                       </a>
                                       @else
                                       <a type="button" rel="tooltip" title="Deactivate Category" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-category', [$category->id]) }}">
                                       <i class="fa fa-close"></i>
                                       </a>
                                       @endif
                                       <a type="button" rel="tooltip" title="Remove Category" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('delete-category', [$category->id]) }}">
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
      <script>
         $(document).ready(function(){
             $(".category1").addClass("active");
             $(".catalog1").addClass("active");
             $(".catalog-collapse").addClass("show");
             $(".catalog11").attr("aria-expanded","true");
              $(".add_new_product").hide();
         $("#hide-btn").click(function(){
           $(".add_new_product").show("slow");
         });
         });
      </script>
   </body>
</html>