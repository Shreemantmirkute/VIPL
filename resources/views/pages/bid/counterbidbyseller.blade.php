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
  <!--jquery -->
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
                  <h4 class="card-title">Offer Product Details<!-- <span class="badge badge-light float-right">888</span> --></h4>
                  <p class="card-category">Below are the details.</p>
                </div>
                <div class="card-body">
                  <div class="row">
                    @foreach($sellers as $seller)
                    <div class="col-md-4">
                      <?php foreach (json_decode($seller->product_image)as $picture) { if($picture==""){
                          $picture="noimage.png";
                        }?>
                        <img src="{{ asset('/imageupload/offer/'.$picture) }}" style="height:150px; width:250px"/>
                      <?php } ?>
                      <?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                      ?>
                    </div>
                    <div class="col-md-8">
                      <table class="col-sm-12">
                        <thead>
                          <th>Name</th>
                          <th>Price</th>
                          <th>MOQ</th>
                          <th>Quantity</th>
                          <th>Created By</th>
                          <th>Origin</th>
                        </thead>
                        <tr>
                          <td>{{ $seller->product_name }}</td>
                          <td>{{ $seller->currency }} {{ $seller->price }} {{ $seller->perunit }}</td>
                          <td>{{ $seller->minimum_order_quantity }} {{$seller->minimum_order_unit}}</td>
                          <td>{{ $seller->quantity-$b1 }} {{ $seller->unit }}</td>
                          <?php
                          $sellercurrency = $seller->currency;
                          $sellerperunit = $seller->perunit;
                          $sellerunit = $seller->unit;
                          ?>
                          @foreach($profiles as $profile2)
                            @if($seller->created_by == $profile2->user_id)
                              <?php $user5 = $profile2->company_name; ?>
                            @endif
                          @endforeach
                          <td>{{ $user5 }}</td>
                          <td>{{ $seller->state }}</td>
                        </tr>
                      </table>
                      <div id="accordion" role="tablist">
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#collapseOnee" aria-expanded="false" aria-controls="collapseOnee" class="collapsed">
                                Tax Class
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOnee" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                              <?php $taxclass = \App\TaxClass::where('id', $seller->taxclass)->pluck('name')->first(); ?>
                              {{ $taxclass }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                Chemical Specification / Grade
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                              {{ $seller->chemical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Physical Specification / Size
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                              {{ $seller->physical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Payment Terms
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                             {{ $seller->tandc }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingFour">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Other Terms and Conditions
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                             {{ $seller->otandc }}
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity'); 
                          $b2 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->pluck('new_unit')->first(); 
                          ?>
                          @if($b1 == $seller->quantity)
                          <div class="alert alert-danger show" role="alert">
                            SOLD OUT
                          </div>
                          @elseif($b1 != 0)
                          <div class="alert alert-warning show" role="alert">
                            {{$seller->quantity-$b1}} {{$b2}} LEFT
                          </div>
                          @endif
                    </div>                   
                   @endforeach
                 </div>
                    <div class="clearfix"></div>

                </div>
              </div>
            </div>
          </div>         
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
                    @foreach($sellers as $seller)

                    <!-- Bidding Trails Start -->
                    <?php $xyz1 = 1; ?>
                    <div class="bidding-trails-window">
                      <ul class="bidding-trails">
                        @foreach($bidonmyoffers as $bidonmyoffer)
                          <li>
                          @if($bidonmyoffer->bidtype=='bid')
                              <div class="card left-chat col-md-8 col-sm-10">
                          @else
                              <div class="card float-right col-md-8 col-sm-10">
                          @endif
                                <div class="card-body">
                                  @foreach($profiles as $profile)
                                    @if($bidonmyoffer->bidtype == 'bid')
                                      @if($profile->user_id == $bidonmyoffer->buyer_id)
                                        <div class="avatar">
                                          <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                        </div>
                                        <div class="text text-l">
                                          <h5 class="title-chat font-weight-bold"> 
                                          {{$bidonmyoffer->bidtype}} by {{$profile->company_name}}
                                          </h5>
                                      @endif
                                    @else
                                      @if($profile->user_id == $bidonmyoffer->seller_id)
                                        <div class="avatar">
                                            <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                          </div>
                                          <div class="text text-l">
                                            <h5 class="title-chat font-weight-bold"> 
                                              {{$bidonmyoffer->bidtype}} by {{$profile->company_name}}
                                            </h5>
                                        
                                      @endif
                                    @endif
                                  @endforeach

                                  <p><span>Price: </span>{{$bidonmyoffer->new_currency}} {{$bidonmyoffer->new_price}} {{$bidonmyoffer->new_perunit}} &nbsp;&nbsp;<span>Quantity: </span>{{$bidonmyoffer->new_quantity}} {{$bidonmyoffer->new_unit}}</p>
                                  <p><span>Instructions: </span>{{$bidonmyoffer->instruction}}</p>
                              
                        
                        @if($bidonmyoffer->status == 'Ongoing')
                          @if($xyz1 == $bidonmyoffers->count() && $bidonmyoffer->bidtype=='bid')
                          <div class="" role="group" aria-label="Basic example">
                              <a class="btn btn-primary btn-round text-white" data-toggle="modal" data-target="#counterbid{{ $bidonmyoffer->id }}">Counter Bid</a>
                                <button type="button" class="btn btn-success btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidonmyoffer->id]) }}" class="text-white"><i class="material-icons">done</i>
                              </a></button>
                                <button type="button" class="btn btn-danger btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidonmyoffer->id]) }}" class="text-white"><i class="material-icons">close</i>
                              </a></button>
                          </div>
                          @endif
                          <?php $xyz1++; ?>
                        @endif
                        <!-- Modal -->
                              <div class="modal fade" id="counterbid{{ $bidonmyoffer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Start Bidding2</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ url('/start-counterbidding') }}">
                                        @csrf
                                        <div class="">
                                              <input type="text" class="myclass" name="new_currency" value="{{ $bidonmyoffer->new_currency }}" readonly="">
                                              <input type="text" class="myclass" name="new_price" value="{{ $bidonmyoffer->new_price }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_perunit" value="{{ $bidonmyoffer->new_perunit }}" readonly="">
                                              <input type="text" name="offer_id" value="{{ $bidonmyoffer->offer_id }}" class="d-none">
                                              <input type="text"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                                              <input type="text"  name="buyer_id"  value="{{ $bidonmyoffer->created_by }}" class="d-none">  
                                              <input type="number" class="myclass" name="new_quantity" value="{{ $bidonmyoffer->new_quantity }}" min="{{$seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}" required="required" placeholder="New Quantity">
                                              <input type="text" class="myclass" name="new_unit" value="{{ $bidonmyoffer->new_unit }}" readonly="">
                                              <input placeholder="Instruction" class=" myclass col-sm-12"  type="text" name="instruction">
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">
                                        </div>                                              
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div>
                              @if($bidonmyoffer->status == 'Ongoing')
                                  <p><small>Status: <span class="text-warning">{{$bidonmyoffer->status}}</span></small> &nbsp;&nbsp;<small>{{$bidonmyoffer->created_at}}</small></p>
                                  @elseif($bidonmyoffer->status == 'Approved')
                                  <p><small>Status: <span class="text-success">{{$bidonmyoffer->status}}</span></small> &nbsp;&nbsp;<small>{{$bidonmyoffer->created_at}}</small></p>
                                  @else
                                  <p><small>Status: <span class="text-danger">{{$bidonmyoffer->status}}</span></small> &nbsp;&nbsp;<small>{{$bidonmyoffer->created_at}}</small></p>
                                  @endif
                            </div>
                        </div>
                     </li>
                     @if($bidonmyoffer->status == 'Completed')
                    @if($bidonmyoffer->admin_confirmation == 'Pending')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      Bid Accepted Waiting For Admin Approval
                    </div>
                    @endif
                    @if($bidonmyoffer->admin_confirmation == 'Approved')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Bid Accepted Approved By Admin
                    </div>                     
                    @endif
                    @if($bidonmyoffer->admin_confirmation == 'Disapproved')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Bid Accepted Disapproved By Admin       
                    </div>                 
                    @endif
                  @endif         <!-- Modal End --> 
                    @endforeach
                  </ul>
                </div>
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