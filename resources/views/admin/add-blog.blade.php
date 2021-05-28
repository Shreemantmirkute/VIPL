
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
                      <h4 class="page-title">Blogs</h4>
                      <div class="breadcrumb-list">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="">Web Master</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                          </ol>
                      </div>
                  </div>
                  <div class="col-md-4 col-lg-4">
                      <div class="widgetbar">
                        <button id="hide-btn" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add New Blog</button>
                      </div>                        
                  </div>
              </div>          
            </div>
            <!-- Start Contentbar -->    
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
                          <div class="alert alert-danger">
                                  <p>{!! \Session::get('fail') !!}</p>
                          </div>
                      @endif
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 add_new_product" style="display: none;">
                        <!-- Start row -->
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Blog</h5>
                </div>
                <div class="card-body">
                  
                      
                      <form method="POST" action="{{ url('admin/add-blog') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                          <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" required  placeholder="Blog Title">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" name="link" required placeholder="Link">
                          </div>
                        </div>
                        <br>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <textarea id="description" name="description" name="area">Enter description</textarea>
                          </div>
                        </div>
                        <br>
                        <div class="form-row">
                          <div class="col-sm-10">
                            <input type="file" name="image[]" class="form-control">
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
                  <h5 class="card-title">Blogs List</h5>
                </div>
                <div class="card-body">
                <div class="" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <form class="form-inline my-2 my-lg-0 " method="POST" action="{{ url('admin/filter-blog') }}">
                      @csrf
                      <label class="mr-4 text-dark">Select Date Range: </label>
                      <input class="form-control mr-sm-2" type="date" placeholder="date" name="from_date">
                      <input class="form-control mr-sm-2" type="date" placeholder="date" name="to_date">
                      <button class="btn btn-outline-success my-2 my-sm-0 btn-sm ml-2" type="submit">Filter</button>
                    </form>
                  </ul>
                </div>
                <br>

              <div class="table-responsive">
                                      <table id="default-datatable" class="table">
                  <thead>
                    <th>Date</th>
                    <th>Title</th>
                    <th data-orderable="false">Description</th>
                    <th data-orderable="false">Link</th>
                    <th data-orderable="false">Image</th>
                  </thead>
                  @foreach($blogs as $blog)
                  <tr>
                    <td>
                      {{$blog->created_at}}
                    </td>
                    <td>
                      {{$blog->title}}
                    </td>
                    <td>
                      {{$blog->description}}
                    </td>
                    <td>
                      {{$blog->link}}
                    </td>
                    <?php foreach (json_decode($blog->image)as $picture) { ?>
                      <td><img src="{{ asset('/imageupload/blog/'.$picture) }}" style="height:auto; width:100px"/></td>
                    <?php } ?> 
                  </tr>
                  @endforeach
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
    <!-- Switchery js -->
    <script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
     <!-- Wysiwig js -->
    <script src="{{ asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>

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
         if($("#description").length > 0) {
        tinymce.init({
            selector: "textarea#description",
            theme: "modern",
            height:320,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    }
           $(".add_new_product").hide();
      $("#hide-btn").click(function(){
        $(".add_new_product").show("slow");
      });
      });
      </script>
</body>
</html>