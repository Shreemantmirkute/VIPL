<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
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
                  <h4 class="card-title">Ongoing Bids</h4>
                  <p class="card-category">Let's Start Buying from your Potential Sellers/Buyers</p>
                </div>
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
                <div class="card-body">
                  <div class="card p-3">
                  <div class="material-datatables">
                      <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                      <th>Date</th>
                      <th>Offer/Enquiry Product</th>
                      <th>Buyer/Seller</th>
                      <th>Status</th>
                      <th class="disabled-sorting text-left td-actions">Quick Actions</th>
                    </thead>
                  @foreach($bidonmyoffers->unique('offer_id') as $allbids)
                  @if($allbids->offer_id != '')
                  <tr>
                    <td>{{$allbids->created_at}}</td>
                    <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                    $buyer_name = \App\User::where('id', $allbids->buyer_id)->pluck('name')->first(); ?>
                    <td>{{$product_name}}-Offer</td>
                    <td>{{$buyer_name}}-Buyer</td>
                    <td>{{$allbids->status}}</td>
                    <td><a type="button" rel="tooltip" title="Bid" class="btn btn-primary btn-link btn-sm" href="{{ url('counterbidbyseller', [$allbids->offer_id, $allbids->seller_id, $allbids->buyer_id]) }}"><i class="material-icons">gavel</i></a></td>
                  </tr>
                  @endif
                  @endforeach

                  @foreach($bidonmyenquiries as $allbids)
                    @if($allbids->enquiry_id != '')
                    <tr>
                      <td>{{$allbids->created_at}}</td>
                      <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();
                      $seller_name = \App\User::where('id', $allbids->seller_id)->pluck('name')->first(); ?>
                      <td>{{$product_name}}-Enquiry</td>
                      <td>{{$seller_name}}-Seller</td>
                      <td>{{$allbids->status}}</td>
                      <td><a type="button" rel="tooltip" title="Bid" class="btn btn-primary btn-link btn-sm" href="{{ url('counterbidbybuyer', [$allbids->enquiry_id, $allbids->buyer_id, $allbids->seller_id]) }}"><i class="material-icons">gavel</i></a></td>
                    </tr>
                    @endif
                    @endforeach

                    @foreach($bidonoffers->unique('offer_id') as $allbids)
                    @if($allbids->offer_id != '')
                    <tr>
                      <td>{{$allbids->created_at}}</td>
                      <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                      $seller_name = \App\User::where('id', $allbids->seller_id)->pluck('name')->first(); ?>
                      <td>{{$product_name}}-Offer</td>
                      <td>{{$seller_name}}-Seller</td>
                      <td>{{$allbids->status}}</td>
                      <td><a type="button" rel="tooltip" title="Bid" class="btn btn-primary btn-link btn-sm" href="{{ url('bidbybuyer', [$allbids->offer_id, $allbids->seller_id, $allbids->buyer_id]) }}"><i class="material-icons">gavel</i></a></td>
                    </tr>
                    @endif
                    @endforeach

                    @foreach($bidonenquiries->unique('enquiry_id') as $allbids)
                    @if($allbids->enquiry_id != '')
                    <tr>
                      <td>{{$allbids->created_at}}</td>
                      <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();
                      $buyer_name = \App\User::where('id', $allbids->buyer_id)->pluck('name')->first(); ?>
                      <td>{{$product_name}}-Enquiry</td>
                      <td>{{$buyer_name}}-Buyer</td>
                      <td>{{$allbids->status}}</td>
                      <td><a type="button" rel="tooltip" title="Bid" class="btn btn-primary btn-link btn-sm" href="{{ url('bidbyseller', [$allbids->enquiry_id, $allbids->buyer_id, $allbids->seller_id]) }}"><i class="material-icons">gavel</i></a></td>
                    </tr>
                    @endif
                    @endforeach
                  </table>
                </div>
                  </div>
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
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        /*columnDefs: [
            { width: 100, targets: 1 },
            { width: 80, targets: 3 },
            { width: 120, targets: 4 },
            { width: 80, targets: 5 },
            { width: 80, targets: 6 }
        ],*/
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search enquiries",
        }
      });
      $('#datatables11').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        /*columnDefs: [
            { width: 100, targets: 1 },
            { width: 80, targets: 3 },
            { width: 120, targets: 4 },
            { width: 80, targets: 5 },
            { width: 80, targets: 6 }
        ],*/
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search enquiries",
        }
      });
      $('#datatables12').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        /*columnDefs: [
            { width: 100, targets: 1 },
            { width: 80, targets: 3 },
            { width: 120, targets: 4 },
            { width: 80, targets: 5 },
            { width: 80, targets: 6 }
        ],*/
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search enquiries",
        }
      });
      $('#datatables13, #buyer_seller_trial_count_table').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        /*columnDefs: [
            { width: 100, targets: 1 },
            { width: 80, targets: 3 },
            { width: 120, targets: 4 },
            { width: 80, targets: 5 },
            { width: 80, targets: 6 }
        ],*/
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search enquiries",
        }
      });
    });
  </script>
  <script>
  $(document).ready(function(){
      $(".bids").addClass("active");
      $(".ongoing-bids").addClass("active");
      $(".bids-collapse").addClass("show");
      $(".bids-link").attr("aria-expanded","true");
  });
  </script>
</body>

</html>