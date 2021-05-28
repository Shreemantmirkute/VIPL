<!DOCTYPE html>
<html lang="en">

@include('new_head')

<body class="vertical-layout">
  <!-- Start Infobar Setting Sidebar -->
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="../assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close"></a>
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
                    <h4 class="page-title">Enquiry / Offer</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/enquiry-offer-view') }}">Enquiry / Offer</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Other Offer</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary-rgba" id="hide-btn"><i class="feather icon-plus mr-2"></i>View Offer Details</button>
                </div>                        
            </div>
            </div>          
        </div>
        <!-- End Breadcrumbbar -->
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
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! \Session::get('fail') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          @endif
          <div class="row" id="add_user">
            <div class="col-md-12 col-lg-12 col-xl-12 add_new_product">
              <div class="card m-b-30">
                <div class="card-header card-header-primary">
                   <h4 class="card-title">Offer Product Details</h4>
                   <input class="d-none" type="text" id="mydatafromcontroller1" value="{{$seller_id}}">
                   <input class="d-none" type="text" id="mydatafromcontroller2" value="{{$seller_user_id}}">
                   <input class="d-none" type="text" id="mydatafromcontroller3" value="{{$buyer_user_id}}">
                </div>
                <div class="card-body">
                  <div class="row">
                    @foreach ($sellers as $seller)
                    <div class="col-md-4">
                      
                      <div class="product-slider-box product-box-for">
                        <?php foreach (json_decode($seller->product_image) as $picture) { 
                        if($picture==""){
                          $picture="noimage.png";
                        }
                        ?>
                        <div class="product-preview">
                          <img src="{{ asset('/imageupload/offer/'.$picture) }}" class="img-fluid" />
                        </div>
                        <?php } ?>
                      </div>
                      <div class="product-slider-box product-box-nav">
                        <?php foreach (json_decode($seller->product_image) as $picture) { 
                        if($picture==""){
                          $picture="noimage.png";
                        }?>
                        <div class="product-preview">
                          <img src="{{ asset('/imageupload/offer/'.$picture) }}" class="img-fluid" style="width: 150px;" />
                        </div>
                        <?php } ?>
                      </div>
                      <?php
                      $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                      $seller_to_date = $seller->to_date;
                      ?>
                    </div>
                    <div class="col-md-8">
                      <h2 class="font-22">{{ $seller->product_name }} <span class="badge badge-default" id="validtill"></span></h2>
                      @foreach($profiles as $profile2)
                      @if($seller->created_by == $profile2->user_id)
                        <?php $user5 = $profile2->company_name; ?>
                        <?php $origin = $profile2->office_state; ?>
                      @endif
                      @endforeach
                      <strong><span>Seller:</span> {{ $user5 }}</strong> || <strong><span>Origin:</span> {{ $origin }}</strong>
                      <hr>
                      <table class="col-md-12">
                        <thead>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>MOQ</th>
                          <th>Tax Class</th>
                        </thead>
                        <tr>
                          <td>{{ $seller->currency }}{{ $seller->price }}{{ $seller->unit }}</td>
                          <td>{{ $seller->quantity-$b1 }}{{ $seller->unit }}</td>
                          <td>{{ $seller->minimum_order_quantity }}{{$seller->minimum_order_unit}}</td>
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
                          <td><?php $taxclass = \App\TaxClass::where('id', $seller->taxclass)->pluck('name')->first(); ?>
                              {{ $taxclass }}</td>
                        </tr>                        
                      </table>
                      <br>
                      <div class="accordion accordion-light" id="accordionwithlight">
                        <div class="card">
                          <div class="card-header" id="headingFourlight">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFivelight" aria-expanded="false" aria-controls="collapseFivelight"><i class="fa fa-plus mr-2"></i>Available States</button>
                            </h2>
                          </div>
                          <div id="collapseFivelight" class="collapse" aria-labelledby="headingFivelight" data-parent="#accordionwithlight">
                            <div class="card-body">
                              <?php foreach (json_decode($seller->state) as $key => $value) {
                                echo $value."<br>";
                              }?>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingOnelight">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOnelight" aria-expanded="false" aria-controls="collapseOnelight"><i class="fa fa-plus mr-2"></i>Chemical Specification / Grade</button>
                            </h2>
                          </div>
                          <div id="collapseOnelight" class="collapse" aria-labelledby="headingOnelight" data-parent="#accordionwithlight" style="">
                            <div class="card-body">
                              {{ $seller->chemical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwolight">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwolight" aria-expanded="false" aria-controls="collapseTwolight"><i class="fa fa-plus mr-2"></i>Physical Specification / Grade</button>
                            </h2>
                          </div>
                          <div id="collapseTwolight" class="collapse" aria-labelledby="headingTwolight" data-parent="#accordionwithlight" style="">
                            <div class="card-body">
                              {{ $seller->physical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThreelight">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThreelight" aria-expanded="false" aria-controls="collapseThreelight"><i class="fa fa-plus mr-2"></i>Payment Terms / Size</button>
                            </h2>
                          </div>
                          <div id="collapseThreelight" class="collapse" aria-labelledby="headingThreelight" data-parent="#accordionwithlight">
                            <div class="card-body">
                              {{ $seller->physical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingFourlight">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFourlight" aria-expanded="false" aria-controls="collapseFourlight"><i class="fa fa-plus mr-2"></i>Other Terms and Conditions</button>
                            </h2>
                          </div>
                          <div id="collapseFourlight" class="collapse" aria-labelledby="headingFourlight" data-parent="#accordionwithlight">
                            <div class="card-body">
                              {{ $seller->otandc }}
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                          $b11 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                          $a1 = \App\Finalbid::where('offer_id', $seller->id)->where('admin_confirmation', '!=', 'Rejected')->where('seller_id', $seller->created_by)->where('buyer_id', Auth::user()->id)->get()->sum('new_quantity');
                          $b2 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->pluck('new_unit')->first(); 
                          $current_status =  \App\Finalbid::where('offer_id', $seller->id)->where('buyer_id', Auth::user()->id)->where('seller_id', $seller->created_by)->get()->pluck('admin_confirmation')->last();
                    ?>
                          @if($seller->status == 'Active' && ($a1 == 0 || $b11 != 0) && $b11 != $seller->quantity)
                            <a type="button" rel="tooltip" title="Bid" class="btn btn-primary text-white" data-toggle="modal" data-target="#bid{{ $seller->id }}" id="place_bid_button">Place Bid
                            </a>
                            <a class="btn btn-success" href="" onclick="event.preventDefault(); document.getElementById('accepted_bid_form').submit();" id="accept_bid_button">Accept</a> 
                            <a class="btn btn-danger" href="" onclick="event.preventDefault(); document.getElementById('reject_bid_form').submit();" id="reject_bid_button">Reject</a>
                          @endif
                          <form method="POST" action="{{ url('/start-bidding') }}" style="display:none;" id="accepted_bid_form">
                                          @csrf
                                          <div class="">
                                            <div class="form-row">
                                              <div class="input-group mb-3 col-md-6">                                              
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $seller->currency }}</span>
                                                </div>
                                                <input type="text" class="form-control" name="new_price" value="{{ $seller->price }}" required="required" placeholder="Place Bid">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ $seller->perunit }}</span>
                                                </div>
                                                </div>
                                                <div class="input-group mb-3 col-md-6">
                                                      <input type="number" class="form-control" name="new_quantity" id="quantity" value="{{ $seller->quantity-$b1 }}" required="required" placeholder="Quantity" min="{{ $seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ $seller->unit }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                              <input placeholder="Type any instruction" class="form-control col-sm-12"  type="text" name="instruction" value="Acceted With All Your Conditions">
                                            </div>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <select class="btn btn-sm d-none" name="new_currency">
                                                  <option selected>{{ $seller->currency }}</option>
                                                </select>
                                              </div>
                                              <div class="input-group-append">
                                                <select class="btn btn-sm d-none" name="new_perunit">
                                                  <option selected>{{ $seller->unit }}</option>
                                                </select>
                                              </div>
                                            </div>
                                                <input type="text" name="offer_id" value="{{ $seller->id }}" class="d-none">

                                                <input type="text"  name="buyer_id"  value="{{ Auth::user()->id }}" class="d-none">

                                                <input type="text"  name="seller_id"  value="{{ $seller->created_by }}" class="d-none">
                                                <input type="text" name="status" value="Completed">


                                                <div class="input-group">                                              

                                                <div class="input-group-append">
                                                  <select class="btn btn-sm d-none" name="new_unit">
                                                    <option selected>{{ $seller->unit }}</option>
                                                  </select>
                                                </div>
                                                </div>
                                                <span class="text-danger" id="quantity_error1"></span>
                                                <br>

                                          </div>                                              
                            </form> 
                          <form method="POST" action="{{ url('/start_bidding_reject') }}" style="display:none;" id="reject_bid_form">
                                          @csrf
                                          <div class="">
                                            <div class="form-row">
                                              <div class="input-group mb-3 col-md-6">                                              
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $seller->currency }}</span>
                                                </div>
                                                <input type="text" class="form-control" name="new_price" value="{{ $seller->price }}" required="required" placeholder="Place Bid">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ $seller->perunit }}</span>
                                                </div>
                                                </div>
                                                <div class="input-group mb-3 col-md-6">
                                                      <input type="number" class="form-control" name="new_quantity" id="quantity" value="{{ $seller->quantity-$b1 }}" required="required" placeholder="Quantity" min="{{ $seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ $seller->unit }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                              <input placeholder="Type any instruction" class="form-control col-sm-12"  type="text" name="instruction" value="Bid Declined">
                                            </div>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <select class="btn btn-sm d-none" name="new_currency">
                                                  <option selected>{{ $seller->currency }}</option>
                                                </select>
                                              </div>
                                              <div class="input-group-append">
                                                <select class="btn btn-sm d-none" name="new_perunit">
                                                  <option selected>{{ $seller->unit }}</option>
                                                </select>
                                              </div>
                                            </div>
                                                <input type="text" name="offer_id" value="{{ $seller->id }}" class="d-none">

                                                <input type="text"  name="buyer_id"  value="{{ Auth::user()->id }}" class="d-none">

                                                <input type="text"  name="seller_id"  value="{{ $seller->created_by }}" class="d-none">
                                                <input type="text" name="status" value="Decline">


                                                <div class="input-group">                                              

                                                <div class="input-group-append">
                                                  <select class="btn btn-sm d-none" name="new_unit">
                                                    <option selected>{{ $seller->unit }}</option>
                                                  </select>
                                                </div>
                                                </div>
                                                <span class="text-danger" id="quantity_error1"></span>
                                                <br>

                                          </div>                                              
                            </form>
                       
                         

                           @if($b11 == $seller->quantity)
                          <div class="alert alert-danger show" role="alert">
                            SOLD OUT
                          </div>
                          @elseif($b11 != 0)
                          <div class="alert alert-warning show" role="alert">
                            {{$seller->quantity-$b1}} {{$b2}} LEFT
                          </div>
                         
                          @endif
                          
                          <!-- Modal -->
                            <div class="modal fade" id="bid{{ $seller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <label>Enter Bid and Quantity Required</label>
                                          <div class="form-row">

                                            <div class="input-group mb-3 col-md-6">
                                              
                                              <div class="input-group-prepend">
                                                  <span class="input-group-text">{{ $seller->currency }}</span>
                                              </div>
                                              <input type="text" class="d-none" name="bid_tracker" value="{{now()->timestamp}}">
                                              <input type="text" class="form-control" name="new_price" value="{{ $seller->price }}" required="required" placeholder="Place Bid">
                                              <div class="input-group-append">
                                                  <span class="input-group-text">{{ $seller->perunit }}</span>
                                              </div>
                                              </div>
                                              <div class="input-group mb-3 col-md-6">
                                                    <input type="number" class="form-control" name="new_quantity" id="quantity" value="{{ $seller->quantity-$b1 }}" required="required" placeholder="Quantity" min="{{ $seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}">
                                                  <div class="input-group-append">
                                                      <span class="input-group-text">{{ $seller->unit }}</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-row">
                                            <input placeholder="Type any instruction" class="form-control col-sm-12"  type="text" name="instruction">
                                          </div>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <select class="btn btn-sm d-none" name="new_currency">
                                                <option selected>{{ $seller->currency }}</option>
                                              </select>
                                            </div>
                                            <div class="input-group-append">
                                              <select class="btn btn-sm d-none" name="new_perunit">
                                                <option selected>{{ $seller->unit }}</option>
                                              </select>
                                            </div>
                                          </div>
                                              <input type="text" name="offer_id" value="{{ $seller->id }}" class="d-none">

                                              <input type="text"  name="buyer_id"  value="{{ Auth::user()->id }}" class="d-none">

                                              <input type="text"  name="seller_id"  value="{{ $seller->created_by }}" class="d-none">


                                              <div class="input-group">
                                              <!-- <input type="hidden" class="form-control hide" name="new_quantity" id="minimum_order_quantity" value="{{ $seller->minimum_order_quantity }}" placeholder="MOQ"> -->

                                              

                                              <div class="input-group-append">
                                                <select class="btn btn-sm d-none" name="new_unit">
                                                  <option selected>{{ $seller->unit }}</option>
                                                </select>
                                              </div>
                                              </div>
                                              <span class="text-danger" id="quantity_error1"></span>
                                              <br>
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">

                                        </div>                                              
                                      </form>                                      
                                    </div>
                                  </div>
                                </div>
                            </div>
                          <!-- Modal End -->
                    </div>

                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Start row -->
          <div class="row">
              <!-- End col -->
              <!-- Start col -->                       
              <div class="col-md-12" id="mytab">       
                
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
    <script src="{{ asset('admin_assets/js/jquery.min.js')}}"></script>
    @include('header_script')
    <script src="{{ asset('admin_assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/modernizr.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/detect.js')}}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('admin_assets/js/vertical-menu.js')}}"></script>
    <!-- Switchery js -->
    <script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js')}}"></script>
    <!-- Datatable js -->
    <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-table-datatable.js')}}"></script>

    <!-- Chat js -->
    <script src="{{ asset('admin_assets/js/custom/custom-chat.js')}}"></script>

    <script src="{{ asset('admin_assets/plugins/pnotify/js/pnotify.custom.min.js')}}"></script>

    <!-- Sweet-Alert js -->
    <script src="{{ asset('admin_assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-sweet-alert.js')}}"></script>
    
    <!-- Core js -->
    <script src="{{ asset('admin_assets/js/core.js')}}"></script>
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
            $(this).parents(".control-group").remove();
        });
      });
  </script>
  <script>
  $(document).ready(function(){
      $(".offer1").addClass("active");
  });
  </script>
  <script>
    $(document).ready(function() {
      $('#datatables1').DataTable({
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
          searchPlaceholder: "Search buyers",
        }
      });
    });
  </script>
  <script type="text/javascript">
          $(document).ready(function() {  

          $(".add_new_product").hide();
      $("#hide-btn").click(function(){
        if($(".add_new_product").is(":visible"))
        {
          $(".add_new_product").hide("slow");
          $("#hide-btn").html("<i class='feather icon-plus mr-2'></i> View Offer Details");
        }
        else
        { 
           $('.product-box-for').trigger('resize');
          $('.product-box-nav').trigger('resize');

          $(".add_new_product").show("slow");
          $("#hide-btn").html("<i class='feather icon-minus mr-2'></i> Close");
        }
      });          
          $('#counterbid-bottom').click(function(){
        $('#chat-bottom').removeClass("d-none");
      });
        seller_id = $('#mydatafromcontroller1').val()
        seller_user_id = $('#mydatafromcontroller2').val()
        buyer_user_id = $('#mydatafromcontroller3').val()
        //var xyz = 2;
        $('#mytab').load('<?php echo url("/ajaxbidbybuyer/'+seller_id+'/'+seller_user_id+'/'+buyer_user_id+'"); ?>');
        
          $("#mymodalform234").on("submit", function (e) {
              var dataString = $(this).serialize();
               
              $.ajax({
                type: "POST",
                //url: "/ajax_start_counterbidding",
                url: '<?php echo url("/ajax_start_bidding"); ?>',
                data: dataString,
                success: function (data) {
                  oid = data['offer_id'];
                  sid = data['seller_id'];
                  bid = data['buyer_id'];
                 
                  /*$('.modal-backdrop').hide();
                  $('.mymodal1').modal('hide');
                  $('body').removeClass('modal-open');
                  $('body').css('padding-right', '0px');
                  $('.modal-backdrop').remove();*/
                }
              });  
               $('#mytab').load('<?php echo url("/ajaxbidbybuyer/'+seller_id+'/'+seller_user_id+'/'+buyer_user_id+'"); ?>');         
              e.preventDefault();
          });
          });
  </script>

  <script>
// Set the date we're counting down to
var currenttime = '<?php echo $seller_to_date; ?>';
var countDownDate = new Date(currenttime).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("validtill").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("validtill").innerHTML = "EXPIRED";
    $("#place_bid_button").addClass('d-none');
    $("#accept_bid_button").addClass('d-none');
    $("#reject_bid_button").addClass('d-none');
  }
  else
  {
    $("#place_bid_button").removeClass('d-none');
    $("#accept_bid_button").removeClass('d-none');
    $("#reject_bid_button").removeClass('d-none');
  }
}, 1000);
</script>

<script>
    $("#reject_bid_button").click(function(evt){
    evt.preventDefault();
    var result = confirm("Are you sure?");
   // alert("You clicked " + result);
});

$("#accept_bid_button").click(function(evt){
    evt.preventDefault();
    var result = confirm("Are you sure?");
   // alert("You clicked " + result);
});
</script>


</body>



</html>