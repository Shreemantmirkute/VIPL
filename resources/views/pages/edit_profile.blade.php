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
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <!--error msg-->
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                            <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif
                @if (\Session::has('fail'))
                    <div class="alert alert-danger">
                            <p>{!! \Session::get('fail') !!}</p>
                    </div>
                @endif
                <div class="card-header card-header-primary">
                  <h4 class="card-title">View Profile</h4>
                  <p class="card-category">Have a look to your profile</p>
                </div>
                @foreach ($profiles as $profile)
                @if ($profile->user_id == Auth::user()->id)
                <div class="card-body">
                  <form method="POST" action="{{ url('update-profile') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                      <div class="col" style="display:none;">
                        <!--<input type="text" class="form-control" placeholder="First name">-->
                        <input id="name" type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                      </div>
                      <div class="col">
                        <!--<input type="text" class="form-control" placeholder="First name">-->
                        <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" placeholder="Name" readonly>
                      </div>
                      <div class="col">
                        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" placeholder="Email" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input type="tel" class="form-control" value="{{ Auth::user()->phone }}" readonly name="phone" pattern="[0-9]{10}" required>
                      </div>
                      <div class="col">
                        <input type="text" class="form-control" placeholder="User name" name="user_name" value="{{ $profile->user_name }}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="Company Name" value="{{ $profile->company_name }}" name="company_name" required>
                      </div>
                      <div class="col">
                        <label>Company Logo</label>
                        <img src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" style="height:40px; width:40px"/>
                        <input type="file" class="form-control" placeholder="Company Logo" name="company_logo" value="{{$profile->company_logo}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="Contact Person" value="{{ $profile->contact_person }}" name="contact_person" required>
                      </div>
                      <div class="col">
                        <input type="tel" class="form-control" placeholder="Office Number" value="{{ $profile->office_number }}" name="office_number" pattern="[0-9]{10}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input type="tel" class="form-control" placeholder="Alternate Number" value="{{ $profile->alternate_number }}" name="alternate_number" pattern="[0-9]{10}" required>
                      </div>
                      <div class="col">
                        <input type="tel" class="form-control" placeholder="Mobile Number" value="{{ $profile->mobile_number }}" name="mobile_number" pattern="[0-9]{10}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input type="email" class="form-control" placeholder="Office Email" value="{{ $profile->office_email }}" name="office_email" required>
                      </div>
                      <div class="col">
                        <!--<input type="text" class="form-control" placeholder="Factory Address" name="factory_address">-->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8">
                        <input type="text" class="form-control" placeholder="Office Address" value="{{ $profile->office_address }}" name="office_address" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Office Area" value="{{ $profile->office_area }}" name="office_area" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Office City" value="{{ $profile->office_city }}" name="office_city" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Office State" value="{{ $profile->office_state }}" name="office_state" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Office Pincode" value="{{ $profile->office_pincode }}" name="office_pincode" pattern="[0-9]{6}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8">
                        <input type="text" class="form-control" placeholder="Factory Address" value="{{ $profile->factory_address }}" name="factory_address" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Factory Area" value="{{ $profile->factory_area }}" name="factory_area" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Factory City" value="{{ $profile->factory_city }}" name="factory_city" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Factory State" value="{{ $profile->factory_state }}" name="factory_state" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="Factory Pincode" value="{{ $profile->factory_pincode }}" name="factory_pincode" pattern="[0-9]{6}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="are_you" required>
                            <option value="">Are You</option>
                            <option>Manufactrer</option>
                            <option>Trader</option>
                            <option>Broker</option>
                            <option>Exporter</option>
                            <option>Importer</option>
                          </select>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="GSTIN" name="gstin" value="{{ $profile->gstin }}" required>
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder="IEC Code" name="iec_code" value="{{ $profile->iec_code }}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label>GST Certificate</label>
                        <img src="{{ asset('/imageupload/profile/'.$profile->gstimg) }}" style="height:40px; width:40px"/>
                        <input type="file" name="gstimg" class="form-control" value="{{ $profile->gstimg }}">
                      </div>
                      <div class="col-sm-6">
                        <label>PAN Picture</label>
                        <img src="{{ asset('/imageupload/profile/'.$profile->panimg) }}" style="height:40px; width:40px"/>
                        <input type="file" name="panimg" class="form-control" value="{{ $profile->panimg }}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <select name="currency" class="form-control pl-2 pr-2" name="currency" required>
                          <option value="">Select Currency</option>
                          <option class=""> ¥ </option>
                          <option class=""> ₹ </option>
                          <option class=""> € </option>
                          <option class=""> $ </option>
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="register_as" required>
                            <option value="">Registering As</option>
                            <option>Buyer</option>
                            <option>Seller</option>
                          </select>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="" required>
                                <a href="{{ url('tandc') }}">Accept Terms and Condition</a>
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                      </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    <img class="img" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}" />
                  </a>
                </div>
                
                <div class="card-body">
                  <h6 class="card-category text-gray">                  
                  {{ $profile->company_name }}
                  </h6>
                  <h4 class="card-title">{{ $profile->name }}</h4>
                  <p class="card-description">
                    I am a {{ $profile->are_you }} registerd as {{ $profile->register_as }} on vipl. I joined vipl on {{ $profile->created_at }}. My office address is {{ $profile->office_address }}
                  </p>
                  <!--<a href="javascript:;" class="btn btn-primary btn-round">Follow</a>-->
                </div>
                 @endif
                 @endforeach
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
  $(document).ready(function(){
      $(".profile1").addClass("active");
  });
  </script>
</body>

</html>