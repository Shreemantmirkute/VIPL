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
    .myclass{
     like:".form-control";
    }
  </style>
</head>

<body class="">
  <div class="wrapper ">
    @include('pages/sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Add Offer</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <!-- <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li> -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="{{url('/change_password')}}">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      
      <div class="content">
        <div class="container-fluid">          
          <div class="row" id="add_user">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Offer</h4>
                  <p class="card-category">Add offer for better accessbility.</p>
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
                    <div class="row">
                      <div class="card p-3 col-sm-12">
                        <table class="table table-sm table-bordered text-left">
                          @foreach ($sellers as $seller)
                          <tr class="">
                            <th>Offer Id</th>
                            <th>Product</th>
                            <th>Price</th>
                          </tr>
                          <tr class="">
                            <td>{{ $seller->id }}</td>
                            <td>{{ $seller->product }}</td>                        
                            <td>{{ $seller->currency }} {{ $seller->price }} {{ $seller->perunit }}</td>
                          </tr>
                          <tr class="">
                            <th>Quantity</th>
                            <th>Origin</th>
                            <th>Created By</th>
                          </tr>
                          <tr class="">
                            <td>{{ $seller->quantity }} {{ $seller->unit }}</td>
                            <td>{{ $seller->origin }}</td>                        
                            <td>{{ $seller->created_by }}</td>
                          </tr>
                          <tr>
                            <?php foreach (json_decode($seller->product_image)as $picture) { ?>
                              <td><img src="{{ asset('/imageupload/offer/'.$picture) }}" style="height:60px; width:100px"/></td>
                            <?php } ?>
                          </tr>
                          <tr class="">
                            <th>Chemical Specification</th>
                            <th>Physical Specification</th>
                          </tr>
                          <tr class="">
                            <td>{{ $seller->chemical_specification }}</td>
                            <td>{{ $seller->physical_specification }}</td>
                          </tr>
                          <tr class="">
                            <th>Terms and Condition</th>
                            <th>Other Terms and Condition</th>
                          </tr>
                          <tr class="">
                            <td>{{ $seller->tandc }}</td>
                            <td>{{ $seller->otandc }}</td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      @if($bids->count() != 0)
                      <div class="col-sm-5 card p-3 m-1">
                        <h3>Bidding Trails</h3>
                          <table class="table-bordered">
                              <tr>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Instruction</th>
                                <th>Status</th>
                              </tr>
                              <?php
                              $qwerty = 1;
                              $qwerty1 =$bids->count();
                              ?>
                            @foreach($bids as $bid)
                              <?php
                                //$abcd = \App\Bidaccept::where('seller_id', $bid->seller_id)->where('buyer_user_id', $bid->buyer_user_id)->where('bidid', $bid->id)->where('price', $bid->new_price)->where('quantity', $bid->new_quantity)->count();
                                $abcd = \App\Bidaccept::where('seller_id', $bid->seller_id)->where('buyer_user_id', $bid->buyer_user_id)->where('bidid', $bid->id)->count();
                              ?>
                              <tr>
                                <td>{{$bid->currency}}{{$bid->new_price}}{{$bid->perunit}}</td>
                                <td>{{$bid->new_quantity}}{{$bid->unit}}</td>
                                <td>{{$bid->instruction}}</td>
                                <td>
                                  @if($qwerty == $qwerty1)
                                    @if($abcd == 0)
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <button type="button" class="btn btn-warning btn-sm" title="Counter Bid" data-toggle="modal" data-target="#bid{{ $bid->id }}">CounterBid to User {{$bid->buyer_user_id}}</button>
                                          <a type="button" rel="tooltip" title="Accept" class="btn btn-success btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('accept-bids', [$bid->seller_id, $bid->buyer_user_id, $bid->new_price, $bid->id, $bid->new_quantity]) }}">Accept</a>
                                        </div>
                                    @else
                                        <!--<a class="btn btn-warning disabled" type="button">Accepted By User {{$bid->buyer_user_id}}</a>-->
                                    @endif
                                  @endif
                                  <?php
                                  $qwerty += 1;
                                  ?>
                                </td>
                              </tr>                          
                            <!-- Modal -->
                                    <div class="modal fade" id="bid{{ $bid->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Counter Bid/Accept</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <!--<div class="row">                                        
                                                <a type="button" rel="tooltip" title="Accept" class="btn btn-success col-sm-10 btn-sm ml-4 mr-4" onclick="return confirm('Are you sure?')" href="{{ url('accept-bids', [$bid->seller_id, $bid->buyer_user_id, $bid->new_price, $bid->id, $bid->new_quantity]) }}">Accept
                                                </a>
                                            </div>-->
                                            <!--<form method="POST" action="{{ url('counter-bid') }}">
                                              @csrf                                        
                                              <br>
                                              <div class="row">
                                                <div class="col-sm-4">
                                                  <input type="text" class="form-control" name="new_price" required autocomplete="new_price" autofocus placeholder="Price">
                                                  <input type="text" class="form-control d-none" name="bid_id" value="{{ $bid->id }}">
                                                </div>
                                                <div class="col-sm-4">
                                                  <input type="text" class="form-control" name="new_quantity" required placeholder="Quantity">
                                                </div>
                                                <div class="col-sm-4">
                                                  <input type="text" class="form-control" name="instruction" required placeholder="Instruction">
                                                </div>
                                                <div class="col-sm-2">
                                                  <button type="submit" class="btn btn-primary btn-sm">Counter Bid</button>                 
                                                </div>
                                              </div>
                                            </form>-->
                                            <form method="POST" action="{{ url('counter-bid') }}">
                                              @csrf
                                              <label class="col-sm-3">New Price</label>
                                              <label class="col-sm-3">New Quantity</label>
                                              <label class="col-sm-5">Instruction</label>
                                              <input required="required" placeholder="New Price" class=" myclass col-sm-3"  type="text" name="new_price">                                              
                                              <input required="required" placeholder="New Quantity" class=" myclass col-sm-3"  type="text" name="new_quantity">                                              
                                              <input required="required" placeholder="Instruction" class=" myclass col-sm-5"  type="text" name="instruction">
                                              <input class="d-none"  type="text" name="bid_id" value="{{ $bid->id }}"><br>
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                            <!--Modal -->
                            @endforeach
                          </table>
                      </div>
                      <div class="col-sm-6 card p-3 m-1 ml-4">
                        <h3>Counterbid Trails</h3>
                          <table class="table-bordered">
                            <tr>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Instruction</th>
                              <th>Status</th>
                            </tr>
                            <?php
                            $xyz7 = 1;
                            $xyz8 = 2;
                            ?>
                            @foreach($counterbids as $counterbid)
                            <tr>
                              <td>{{$counterbid->new_price}}</td>
                              <td>{{$counterbid->new_quantity}}</td>
                              <td>{{$counterbid->instruction}}</td>
                              <td>
                                <?php
                                  $bidto = \App\Bid::where('id', '=', $counterbid->bid_id)->get()->pluck('buyer_user_id')->first();                                  
                                ?>
                                @foreach($acceptedbids as $acceptedbid)
                                @if($acceptedbid->buyer_user_id == $bidto)
                                  @if($acceptedbid->admin_confirmation == 'Approved')
                                    @if($xyz7 == $counterbids->count())
                                      <span class="text-success"><strong>Accepted By User {{$bidto}} and Approved</strong></span>
                                    @endif
                                    <?php
                                    $xyz7 = $xyz7+1;
                                    ?>
                                  @else
                                    @if($xyz7 == $counterbids->count())
                                      <span class="text-info"><strong>Accepted By User {{$bidto}} and Approval Pending</strong></span>
                                    @endif
                                    <?php
                                    $xyz7 = $xyz7+1;
                                    ?>
                                  @endif
                                @else
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#counterbid{{ $counterbid->id }}">Counterbid to User {{$bidto}}</button>
                                <!-- Modal -->
                                    <div class="modal fade" id="counterbid{{ $counterbid->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Counter Bid</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            @foreach($sellers as $seller)
                                            <?php
                                              $abcd = \App\Bidaccept::where('price', $counterbid->new_price)->where('quantity', $counterbid->new_quantity)->where('seller_id', $seller->id)->where('bidid', $counterbid->bid_id)->count();
                                            ?>
                                            @endforeach
                                            @if($abcd == 0)
                                              <p>Waiting for buyer action...</p>
                                            @else
                                              <p>Bid Accepted</p>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <!--Modal -->
                                @endif
                                @endforeach

                              </td>
                            </tr>
                            @endforeach
                          </table>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
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
      $(".offer1").addClass("active");
  });
  </script>
</body>

</html>