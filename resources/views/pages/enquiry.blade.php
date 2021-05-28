<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin_theme_assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('admin_theme_assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    VyapaarNetwork
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('admin_theme_assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('admin_theme_assets/demo/demo.css') }}" rel="stylesheet" />
  <style type="text/css">
    .input-group.border {
        /*border-radius: 5px;*/
        border: 1px solid #ccc;
        /*box-shadow: 1px 1px 1px #888888;*/
    }
    .form-control {
      background-image: none !important;
    }
    input, select {
      padding-left: 5% !important;
      /*padding-top: 5% !important;*/
    }
    textarea {
      border: 1px solid #ccc !important;
      border-radius: 5px !important;
      padding: 1% !important;
      border-radius: 5px !important;
      /*box-shadow: 1px 1px 1px #888888 !important;*/

    }
    input[type="file"] {
      border-radius: 5px !important;
      border: 1px solid #ccc !important;
      border-radius: 5px;
      /*box-shadow: 1px 1px 1px #888888;*/
    }
    .input-group-prepend {
      background-color: #aec6cf;
    }
  </style>
</head>

<body class="">
  <div class="wrapper ">
    @include('pages/sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('/header')
      <!-- End Navbar -->
      
      <div class="content">
        <div class="container-fluid">          
          <div class="row" id="add_user">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Enquiry</h4>
                  <p class="card-category">Create a new enquiry to buy a product.</p>
                </div>
                <div class="card-body">
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

                  <form method="POST" action="{{ url('/enquiry-post') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <select class="form-control input-group border" data-style="btn btn-link" id="exampleFormControlSelect1" name="product" onchange='CheckColors(this.value);'>
                            <option>Select Product</option>
                            @foreach ($useritems as $useritem)
                            @if($useritem->status == 'Approved')                              
                              <option value="{{ $useritem->id }}">{{ $useritem->product }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <input type="text" name="created_by" style="display:none;" value="{{ Auth::user()->id }}">
                            <div class="col-md-3">
                                <div class="form-group">
                                  <select class="form-control input-group border" id="prod" name="state">
                                      <option value="">Select State</option>
                                      @foreach ($states->unique('city_state') as $state)                            
                                        <option>{{ $state->city_state }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group border">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                  <select name="currency" class="form-control pl-2 pr-2">
                                    <option class=""> ₹ </option>
                                    <option class=""> $ </option>
                                  </select>
                                </span>
                              </div>
                              <input type="number" name="price" placeholder="Price" class="form-control">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                  <select name="perunit" class="form-control pl-1 pr-1">
                                    <option class="">/Kg</option>
                                    <option class="">/MT</option>
                                    <option class="">/Peice</option>
                                    <option class="">/Meter</option>
                                  </select>
                                </span>
                              </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group border">

                                <input type="number" name="quantity" placeholder="Quantity" class="form-control"  id="quantity">

                                <span class="text-danger quantity_error"></span>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <select name="unit" class="form-control pl-1 pr-1">
                                      <option class="">/Kg</option>
                                      <option class="">MT</option>
                                      <option class="">Peice</option>
                                      <option class="">Meter</option>
                                    </select>
                                  </span>
                                </div>
                            </div> 
                        </div>
                      </div>


                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group border">
                                <input type="number" name="minimum_order_quantity" placeholder="Minimum quantity order" class="form-control" id="minimum_order_quantity">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <select name="minimum_order_unit" class="form-control pl-1 pr-1">
                                      <option class="">/Kg</option>
                                      <option class="">MT</option>
                                      <option class="">Peice</option>
                                      <option class="">Meter</option>
                                    </select>
                                  </span>
                                </div>
                            </div> 
                        </div>
                      </div>

                      <div class="col-md-3">
                                <div class="form-group">
                                  <select class="form-control input-group border" id="" name="">
                                      <option value="">Tax Class</option>                         
                                        <option></option>
                                  </select>
                              </div>
                      </div>

                    </div>

                    <br>
                    <div class="row">
                      <div class="col-md-4">
                        <!--<div class="mt-3">                                           
                          <input type="file" name="product_image[]" class="form-control">
                        </div>-->
                        <div class="input-group control-group increment" >
                          <input type="file" name="product_image[]" class="form-control">
                          <div class="input-group-btn"> 
                            <button class="btn btn-success btn-sm" type="button" id="btn1"><i class="glyphicon glyphicon-plus"></i>Add</button>
                          </div>
                        </div>
                        <div class="clone d-none">
                          <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="product_image[]" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-danger btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>13%
                          </div>
                        </div>  
                      </div>                      
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <textarea rows="3" name="chemical_specification" placeholder="Chemical Specification / Grade" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <textarea rows="3" name="physical_specification" placeholder="Physical Specification / Size" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <textarea rows="2" name="tandc" placeholder="Payment Terms" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">                          
                          <textarea rows="2" name="otandc" placeholder="Other terms and condition" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Add Offer</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      @include('/footer')
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('admin_theme_assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_theme_assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin_theme_assets/js/core/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('admin_theme_assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('admin_theme_assets/js/plugins/moment.min.js') }}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('admin_theme_assets/js/plugins/sweetalert2.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('admin_theme_assets/js/plugins/jquery.validate.min.js') }}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('admin_theme_assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('admin_theme_assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('admin_theme_assets/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('admin_theme_assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('admin_theme_assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('admin_theme_assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('admin_theme_assets/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('admin_theme_assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('admin_theme_assets/js/plugins/nouislider.min.js') }}"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js') }}"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('admin_theme_assets/js/plugins/arrive.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="{{ asset('admin_theme_assets/js/plugins/chartist.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('admin_theme_assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin_theme_assets/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('admin_theme_assets/demo/demo.js') }}"></script>


  <script type="text/javascript">
    $(document).ready(function(){
   $("#quantity").on("keyup", function(){
    var quantity = parseInt($("#quantity").val());
    var minimum_order_quantity = parseInt($("#minimum_order_quantity").val());
    if (quantity < minimum_order_quantity) {
      $(".quantity_error").html("Quantity should be equal or greater than MOQ")
      console.log("if")
      console.log(quantity)
      console.log(quantity < minimum_order_quantity)
    }
    else {
      console.log("ELse ")
      console.log(quantity)
      console.log(quantity < minimum_order_quantity)
      $(".quantity_error").hide()
    }
});

});
  </script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
  <script>
  $(document).ready(function(){
      $(".offer").addClass("active");
      $(".add-offer").addClass("active");
      $(".offer-collapse").addClass("show");
      $(".offer-link").attr("aria-expanded","true");
  });
  </script>
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

  });
  </script>
</body>

</html>