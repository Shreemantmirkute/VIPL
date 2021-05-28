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
                        <h4 class="page-title">Product</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba" id="hide-btn"><i class="feather icon-plus mr-2"></i>Add New Product</button>
                        </div>                        
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">
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
                <!-- Start row -->
                <div class="row">

                    <!-- Start col -->
                    <div class="col-lg-12 add_new_product" style="display: none;">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Add New Product</h5>
                            </div>
                            <div class="card-body">
                                
                              <form method="POST" action="{{ url('add_item') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="row">
                                  @foreach($profiles as $profile)
                                   <?php $registered_as1 = $profile->are_you; ?>
                                  @endforeach
                                  
                                   <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect322">Category</label>
                                              </div>
                                              <select class="custom-select category11" id="exampleFormControlSelect322" name="category" required="required">
                                                  <option value="">Choose</option>
                                              </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect1">Product</label>
                                              </div>
                                              <select class="custom-select subcategory11" id="exampleFormControlSelect1" name="subcategory" required="required">
                                                  <option value="">Choose</option>
                                              </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect2">Sub-Product</label>
                                              </div>
                                              <select class="custom-select product11" id="exampleFormControlSelect2" name="product" required="required">
                                                  <option value="">Choose</option>
                                              </select>
                                    </div>
                                  </div> 
                                  <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect3">Registering As</label>
                                              </div>
                                              <select class="custom-select" id="exampleFormControlSelect3" name="register_as" required="required">
                                                  <option value="">Choose</option>
                                                    @foreach($businesstypes as $businesstype)
                                                    <?php if($businesstype->name == $registered_as1){
                                                      foreach (json_decode($businesstype->registered_as) as $register_name) { ?>
                                                      <option value="{{ $register_name }}">{{ $register_name }}</option>
                                                    <?php } }?>
                                                    @endforeach
                                              </select>
                                    </div>
                                  </div>                     
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <input type="text" name="otherproduct" id="color" style="display:none;" placeholder="Product Name" class="form-control">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <input type="text" name="user_type" style="display:none;" value="{{ Auth::user()->type }}">
                                  <input type="text" name="created_by" style="display:none;" value="{{ Auth::user()->id }}">
                                  

                                  <div class="col-md-3">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect2">Currency</label>
                                              </div>
                                              <select class="custom-select currency" id="exampleFormControlSelect2" name="currency" required="required">
                                                    @foreach($businesstypes as $businesstype)
                                                      <?php if($businesstype->name == $registered_as1){
                                                        foreach (json_decode($businesstype->default_currency) as $currency1) { ?>
                                                          @foreach($currencies as $currency)
                                                            <?php if(strpos($currency1,$currency->code)!==false){ ?>
                                                              <option value="{{ $currency->symbol }}">{{ $currency->symbol }}</option>
                                                            <?php } ?>
                                                          @endforeach
                                                      <?php } }?>
                                                    @endforeach
                                              </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3 commission">
                                    <!-- <label for="" class="bmd-label-floating">Enter Commission</label> -->
                                    <div class="form-group">
                                      <input type="number" name="comission" id="color" pattern="[0-9]{2}" placeholder="Enter commission" class="form-control" required="required" min="0">
                                    </div>
                                  </div>
                                  <div class="col-md-3 perunit">
                                    <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                  <label class="input-group-text" for="exampleFormControlSelect2">Unit</label>
                                              </div>
                                              <select class="custom-select currency" id="exampleFormControlSelect2" name="perunit" required="required">
                                                    @foreach($units as $unit)
                                                      <option class="/{{$unit->code}}">/{{$unit->code}}</option>
                                                    @endforeach
                                              </select>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit Product</button>
                                  </div>
                                  </div>
                                  
                                <div class="clearfix"></div>
                              </form>
                              <!-- <script>
                                 $(function(){
                                    $("input[type = 'submit']").click(function(){
                                       var $fileUpload = $("input[type='file']");
                                       if (parseInt($fileUpload.get(0).files.length) > 5){
                                          alert("You are only allowed to upload a maximum of 5 files");
                                       }
                                    });
                                 });
                              </script> -->
                                
                          </div>
                    </div>
                    <!-- End col -->

                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Product List</h5>
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
                                    <table id="datatable-buttons" class="table">
                                        <thead>
                                          <tr>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Sub Product</th>
                                            <th>Comission</th>
                                            <th>As</th>
                                            <th>Status</th>
                                            <th data-orderable="false">Quick Actions</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($items as $item)
                                            @if ($item->created_by == auth()->user()->id)
                                          <tr>    
                                            <td>
                                              {{ $item->created_at }}
                                            </td>
                                            <td>
                                                {{ $item->category }}
                                            </td>
                                            <td>
                                              {{ $item->subcategory }}
                                            </td>
                                            <td>
                                              {{ $item->product }}
                                            </td>
                                            <td>
                                              {{ $item->currency }}{{ $item->comission }}{{ $item->perunit }}
                                            </td>
                                            <td>
                                              {{ $item->register_as }}
                                            </td>
                                            @if( $item->status  == 'Approved')
                                            <td class="text-success font-weight-bold">{{ $item->status }}</td>
                                            @else
                                            <td class="text-danger font-weight-bold">{{ $item->status }}</td>
                                            @endif
                                            <td>
                                            @if (\App\Buyer::where('product', '=', $item->id)->where('created_by', '=', Auth::user()->id)->exists() or \App\Seller::where('product', '=', $item->id)->where('created_by', '=', Auth::user()->id)->exists())         
                                              <a type="button" rel="tooltip" tdata-toggle="tooltip" data-placement="top" title="Delete Product" class="btn btn-danger btn-round disabled" onclick="return confirm('Are you sure?')" href="{{ url('delete-item', [$item->id]) }}">
                                                  <i class="mdi mdi-close"></i>
                                              </a>
                                            @else
                                              <a type="button" data-toggle="tooltip" data-placement="top" title="Delete Product" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('delete-item', [$item->id]) }}">
                                                <i class="mdi mdi-close"></i>
                                              </a>
                                            @endif

                                            </td>
                                          </tr>
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


  <script>
  $(document).ready(function(){
    $(".add_new_product").hide();
      $("#hide-btn").click(function(){
        if($(".add_new_product").is(":visible"))
        {
          $(".add_new_product").hide("slow");
          $("#hide-btn").html("<i class='feather icon-plus mr-2'></i> Add New Product");
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