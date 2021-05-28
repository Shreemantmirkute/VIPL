<!DOCTYPE html>
<html lang="en">

@include('admin/new_head')

<body class="vertical-layout">
      <div id="containerbar">
     @include('admin/new_sidebar')
         <div class="rightbar">
        @include('admin/new_header')
      <!-- End Navbar -->
      
      <div class="content">
        <div class="container-fluid">          
          <div class="row" id="add_user">            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Bidding Trails (Seller)</h4>
                  <p class="card-category">Below are the bidding trails with buyer.</p>
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
                    @foreach($buyers as $buyer)

                    
                    @if(1 != 0)
                    <div class="row">
                      <div class="col-sm-12">
                          <?php
                          $xyz1 = 1;
                          $xyz2 = 1;
                          ?>
                          <div class="bidding-trails-window">
                          <ul class="bidding-trails">

                          @foreach($bidbysellers as $bidbyseller)
                          <li>

                          @if($bidbyseller->bidtype=='bid')
                          <div class="card float-right col-md-8 col-sm-10">
                          @else
                          <div class="card left-chat col-md-8 col-sm-10">
                          @endif

                           <div class="card-body">
                              @foreach($profiles as $profile)
                                @if($bidbyseller->bidtype == 'bid')
                                  @if($profile->user_id == $bidbyseller->seller_id)
                                    <div class="avatar">
                                      <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                    </div>
                                    <div class="text text-l">
                                      <h5 class="title-chat font-weight-bold"> 
                                        {{$bidbyseller->bidtype}} by {{$profile->company_name}}
                                      </h5>
                                  @endif
                                @else
                                  @if($profile->user_id == $bidbyseller->buyer_id)
                                    <div class="avatar">
                                      <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                    </div>
                                    <div class="text text-l">
                                      <h5 class="title-chat font-weight-bold"> 
                                      {{$bidbyseller->bidtype}} by {{$profile->company_name}}
                                      </h5>
                                  @endif
                                @endif
                              @endforeach
                               <p><span>Price: </span>{{$bidbyseller->new_currency}} {{$bidbyseller->new_price}} {{$bidbyseller->new_perunit}} &nbsp;&nbsp;<span>Quantity: </span>{{$bidbyseller->new_quantity}} {{$bidbyseller->new_unit}}</p>
                                  <p><span>Instructions: </span>{{$bidbyseller->instruction}}</p>

                              <?php
                            $abcd = \App\Bidaccept::where('seller_id', $buyer->id)->where('buyer_user_id', Auth::user()->id)->count();
                            ?>
                              @if($abcd == 0)
                              @if($xyz1 == $bidbysellers->count() && $bidbyseller->bidtype == 'counterbid')
                              @if($bidbyseller->status == 'Ongoing')

                              <div class="" role="group" aria-label="Basic example">
                                <a class="btn btn-primary btn-round text-white" data-toggle="modal" data-target="#bid{{ $bidbyseller->id }}">Bid</a>
                                <button type="button" class="btn btn-success btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidbyseller->id]) }}" class="text-white"><i class="material-icons">done</i></a>
                                </button>
                                <button type="button" class="btn btn-danger btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidbyseller->id]) }}" class="text-white"><i class="material-icons">close</i></a>
                                </button>
                              </div>

                              @endif
                              
                              
                              <div class="modal fade" id="bid{{ $bidbyseller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Start Bidding</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ url('/start-bidding') }}">
                                        @csrf
                                        <div class="">
                                              <input type="text" class="myclass" name="new_currency" value="{{ $bidbyseller->new_currency }}" readonly="">
                                              <input type="text" class="myclass" name="new_price" value="{{ $bidbyseller->new_price }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_perunit" value="{{ $bidbyseller->new_perunit }}" readonly="">
                                              <input type="text" name="enquiry_id" value="{{ $buyer->id }}" class="d-none">
                                              <input type="text"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                                              <input type="text"  name="buyer_id"  value="{{ $buyer->created_by }}" class="d-none">  
                                              <input type="text" class="myclass" name="new_quantity" value="{{ $bidbyseller->new_quantity }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_unit" value="{{ $bidbyseller->new_unit }}" readonly="">
                                              <input required="required" placeholder="Instruction" class=" myclass col-sm-12"  type="text" name="instruction">
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">

                                        </div>                                              
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div>
                                
                              @else                        
                              @endif
                              <?php
                              $xyz1 = $xyz1+1;
                              ?>
                              @else
                              @if($xyz2 == $bids->count())
                              @endif
                              <?php
                              $xyz2 = $xyz2+1;
                              ?>
                              @endif
                              @if($bidbyseller->status == 'Ongoing')
                                  <p><small>Status: <span class="text-warning">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @elseif($bidbyseller->status == 'Approved')
                                  <p><small>Status: <span class="text-success">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @else
                                  <p><small>Status: <span class="text-danger">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @endif
                            </div>
                          </div>
                        </li>
                        @if($bidbyseller->status == 'Completed')
                          @if($bidbyseller->admin_confirmation == 'Pending')
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Bid Accepted Waiting For Admin Approval
                          </div>
                          @endif
                          @if($bidbyseller->admin_confirmation == 'Approved')
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Bid Accepted Approved By Admin
                          </div>                                              
                          @endif
                          @if($bidbyseller->admin_confirmation == 'Disapproved')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Bid Accepted Disapproved By Admin       
                          </div>                 
                          @endif
                        @endif
                        @endforeach
                        </ul>
                      </div>
                      </div>
                                           
                    </div>
                    @endif

                    
                    @endforeach
                    <div class="clearfix"></div>

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
</body>

</html>