<!DOCTYPE html>
<html lang="en">

@include('new_head')

<body class="vertical-layout">
  <!-- Start Infobar Setting Sidebar -->
  <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
      <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
          <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close"></a>
      </div>
      <div class="infobar-settings-sidebar-body">
          <div class="custom-mode-setting">
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Payment Reminders</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-first" checked /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Stock Updates</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-second" checked /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Open for New Products</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-third" /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Enable SMS</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Newsletter Subscription</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">Show Map</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-sixth" /></div>
              </div>
              <div class="row align-items-center pb-3">
                  <div class="col-8"><h6 class="mb-0">e-Statement</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
              </div>
              <div class="row align-items-center">
                  <div class="col-8"><h6 class="mb-0">Monthly Report</h6></div>
                  <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
              </div>
          </div>
      </div>
  </div>
  <div class="infobar-settings-sidebar-overlay"></div>
  <!-- End Infobar Setting Sidebar -->

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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                              <script>
                                 $(function(){
                                    $("input[type = 'submit']").click(function(){
                                       var $fileUpload = $("input[type='file']");
                                       if (parseInt($fileUpload.get(0).files.length) > 5){
                                          alert("You are only allowed to upload a maximum of 5 files");
                                       }
                                    });
                                 });
                              </script>
                                
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
    
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->
    <script type="text/javascript">
    var count = 2;
      $(document).ready(function() {      
        $btn = $('button[type="submit"]');
        $(".btn-success").click(function(){ 
            var html = $(".clone").html();
            count--;         
            if ( count == 0 )
            {
              $('#btn1').prop('disabled', true);
            }
            $(".increment").after(html);
        });
        $("body").on("click",".btn-danger",function(){ 
          count++;
          if ( count != 0 )
            {
              $('#btn1').prop('disabled', false);
            }
          $(this).parents(".control-group").remove();
        });
      });
  </script>
  <script>
  $(document).ready(function(){
      $("#prod").change(function()
      {
        var prod = $(this).val();
        $.get("ajax-atri", {cid: prod}, function(data, status)
        {
          //alert("Data: " + data + "\nStatus: " + status);
          $('#atri').empty();
          $.each(data,function(index,subcatObj)
          {
          $('#atri').append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
          });
        });
      });


      $("#exampleFormControlSelect3").change(function()
      {
        var businesstype = $(this).val();
        $.get("productsBusinessTypeWise", {businesstype: businesstype}, function(data, status)
        {
          // console.log("Response yaha ayega")
          console.log(data)
          data = $.parseJSON(data)
          console.log(data)
          // console.log(status)
          //alert("Data: " + data + "\nStatus: " + status);
          $('#exampleFormControlSelect1').empty();
          $.each(data,function(index,obj)
          {
          $('#exampleFormControlSelect1').append('<option value ="'+obj.product+'">'+obj.product+'</option>');
          });
        });
      });

      $('#thisProductBusinesType').hide();
      $("#thisUserProducts").change(function()
      {
        register_as = $(this).find("option:selected").attr("data-id")
        data_currency = $(this).find("option:selected").attr("data-currency")
        data_units = $(this).find("option:selected").attr("data-units")

        if (register_as == "0") {
          $('#thisProductBusinesType').hide();
        }
        else {

          $('#thisProductBusinesType').show();
        }
        $('#thisProductBusinesType').empty();
        $("select[name='currency']").empty();
        $("select[name='perunit'], select[name='unit'], select[name='minimum_order_unit']").empty();

        $("#thisProductBusinesType").append("<option value='"+register_as+"' selected>"+register_as+"</option>")
        
        $("select[name='currency']").append("<option value='"+data_currency+"' selected>"+data_currency+"</option>")

        $("select[name='perunit'], select[name='unit'], select[name='minimum_order_unit']").append("<option value='"+data_units+"' selected>"+data_units+"</option>")



      });

  });



  </script>
</body>

</html>