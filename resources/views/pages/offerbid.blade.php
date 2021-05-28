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
              <h4 class="page-title">Enquiry / Offer</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('/enquiry-offer-view') }}">Enquiry / Offer</a></li>
                  <li class="breadcrumb-item active" aria-current="page">My Offer</li>
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
                          <!-- <td>{{ $seller->state }}</td> -->
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
                      $b2 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->pluck('new_unit')->first();  ?>
                      @if($b11 == $seller->quantity)
                      <div class="alert alert-danger show" role="alert">
                        SOLD OUT
                      </div>
                      @elseif($b11 != 0)
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item pr-3 border-right">
                          <h4 class="mb-0">{{$b1}} {{$b2}}</h4>
                          <p class="mb-0 text-danger">Sold</p>
                        </li>
                        <li class="list-inline-item">
                          <h4 class="mb-0">{{$seller->quantity-$b1}} {{$b2}}</h4>
                          <p class="mb-0 text-success">Left</p>
                        </li>
                      </ul>
                      @endif
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            @if($buyersforbid->count() != 0)
            <div class="col-lg-5 col-xl-4">
              <div class="chat-list">
                <div class="chat-search">
                  <form>
                    <div class="input-group">
                      <input type="search" class="form-control" id="search-input" placeholder="Search" aria-label="Search" aria-describedby="button-addon3" onkeyup="myFunction()">
                      <div class="input-group-append">
                        <button class="btn" type="submit" id="button-addon3" disabled><i class="feather icon-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="chat-user-list">
                  
                  <ul class="list-unstyled mb-0" id="user-ul">
                    @foreach($buyersforbid->unique('buyer_id') as $bfb)
                    <!-- <a title="View In Detail" href="{{ url('counterbidbyseller', [$bfb->offer_id, $bfb->seller_id, $bfb->buyer_id]) }}" id="mybutton"> -->
                    <a title="View In Detail" class="mybutton" data-xyz="{{$bfb->buyer_id}}" data-offer_id="{{$bfb->offer_id}}" data-seller_id="{{$bfb->seller_id}}" data-buyer_id="{{$bfb->buyer_id}}">
                      <li class="media">
                        <?php
                        $company_name = \App\Profile::where('user_id', $bfb->buyer_id)->pluck('company_name')->first();
                        $img = \App\Profile::where('user_id', $bfb->buyer_id)->pluck('company_logo')->first(); ?>
                        <img class="align-self-center rounded-circle" src="{{ asset('/imageupload/profile/'.$img) }}">
                        <div class="media-body">
                          <h5>
                          {{$company_name}}
                          @if($bfb->status == "Completed")
                          <span class="badge badge-success ml-2">{{$bfb->status}}</span>
                          @elseif($bfb->status == "Decline")
                          <span class="badge badge-danger ml-2">{{$bfb->status}}</span>
                          @else
                          <span class="badge badge-warning ml-2">{{$bfb->status}}</span>
                          @endif <span class="timing">{{$bfb->created_at}}</span>
                          </h5>
                          <p>Buyer</p>
                        </div>
                      </li>
                    </a>
                    @endforeach
                  </ul>
                  
                </div>
              </div>
            </div>
            @endif
            <!-- End col -->
            <!-- Start col -->
            <div class="col-lg-7 col-xl-8" id="mytab">
              {{--@include('counterbidbysellernew')--}}
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
    <script src="../admin_assets/js/jquery.min.js"></script>
    @include('header_script')
    <script src="../admin_assets/js/popper.min.js"></script>
    <script src="../admin_assets/js/bootstrap.min.js"></script>
    <script src="../admin_assets/js/modernizr.min.js"></script>
    <script src="../admin_assets/js/detect.js"></script>
    <script src="../admin_assets/js/jquery.slimscroll.js"></script>
    <script src="../admin_assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="../admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Datatable js -->
    <script src="../admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../admin_assets/plugins/datatables/jszip.min.js"></script>
    <script src="../admin_assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="../admin_assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="../admin_assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="../admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../admin_assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="../admin_assets/js/custom/custom-table-datatable.js"></script>
    <!-- Chat js -->
    <script src="../admin_assets/js/custom/custom-chat.js"></script>
    <script src="{{ asset('admin_assets/plugins/pnotify/js/pnotify.custom.min.js')}}"></script>
    <!-- Slick js -->
    <script src="{{ asset('admin_assets/plugins/slick/slick.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-ecommerce-single-product.js')}}"></script>
    <!-- Sweet-Alert js -->
    <script src="../admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="../admin_assets/js/custom/custom-sweet-alert.js"></script>
    
    <!-- Core js -->
    <script src="../admin_assets/js/core.js"></script>
    <!-- End js -->
    <script type="text/javascript">
    var count = 2;
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
    $( ".mybutton" ).click(function(){
    xyz = $(this).attr("data-xyz");
    offer_id = $(this).attr("data-offer_id");
    seller_id = $(this).attr("data-seller_id");
    buyer_id = $(this).attr("data-buyer_id");
    //var xyz = 2;
    $('#mytab').load('<?php echo url("/ajaxcounterbid/'+offer_id+'/'+seller_id+'/'+buyer_id+'"); ?>');
    });
    });
    </script>
    <script>
    function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('search-input');
    filter = input.value.toUpperCase();
    ul = document.getElementById("user-ul");
    li = ul.getElementsByTagName('li');
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
    h5 = li[i].getElementsByTagName("h5")[0];
    txtValue = h5.textContent || h5.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
    li[i].style.display = "";
    } else {
    li[i].style.display = "none";
    }
    }
    }
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
    }
    }, 1000);
    </script>
    
  </body>
</html>