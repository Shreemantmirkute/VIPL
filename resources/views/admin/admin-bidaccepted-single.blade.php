<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin/new_head')
  </head>
  <body class="vertical-layout">
    <div id="containerbar">
      @include('admin/new_sidebar')
      <div class="rightbar">
        @include('admin/new_header')
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
              <h4 class="page-title">Accepted Bids - Single View</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('/admin/admin-bidaccepted-view') }}">Accepted Bids</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Accepted Bid Single View</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="contentbar">
          <div class="row" id="add_user">
            <div class="col-md-12">
              <div class="card m-b-30">
                @foreach($acceptedbids as $acceptedbid)
                <div class="card-header card-header-primary">
                  <h5 class="card-title">Accepted Bids - Single View - Bid Id - {{ $acceptedbid->id }}</h5>
                  <p class="card-category">Showing details of single view.</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ url('/subuser-store') }}">
                    @csrf
                    <div class="row">
                      <div class="col-md-4">
                        <div class="product-slider-box product-box-for">
                          <?php
                          if($acceptedbid->offer_id != '')
                          {
                          $imgs = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('product_image')->first();
                          }
                          else
                          {
                          $imgs = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('product_image')->first();
                          }
                          ?>
                          <?php foreach (json_decode($imgs) as $picture) { ?>
                          <div class="product-preview">
                            <img src="{{ asset('/imageupload/offer/'.$picture) }}" class="img-fluid" />
                          </div>
                          <?php } ?>
                        </div>
                        <div class="product-slider-box product-box-nav">
                          <?php foreach (json_decode($imgs) as $picture) { ?>
                          
                          <div class="product-preview">
                            <img src="{{ asset('/imageupload/offer/'.$picture) }}" class="img-fluid" style="width: 150px;" />
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <table class="table table-sm">
                          
                          <tr>
                            <th>Id</th>
                            <th>Seller</th>
                            <th>Buyer</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created On</th>
                          </tr>
                          <tr>
                            <?php
                            $buyer1 = \App\Profile::where('user_id', $acceptedbid->buyer_id)->get()->pluck('company_name')->first();
                            $seller1 = \App\Profile::where('user_id', $acceptedbid->seller_id)->get()->pluck('company_name')->first();
                            $sellername1 = $seller1;
                            if($acceptedbid->offer_id != '')
                            {
                            $productname1 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('product_name')->first();
                            }
                            else
                            {
                            $productname1 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('product_name')->first();
                            }
                            ?>
                            <td>{{ $acceptedbid->id }}</td>
                            <td>{{$seller1}}</td>
                            <td>{{$buyer1}}</td>
                            <td>{{$productname1}}</td>
                            @if($acceptedbid->admin_confirmation == 'Pending')
                            
                            <td class="text-info font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                            @elseif($acceptedbid->admin_confirmation == 'Approved')
                            <td class="text-success font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                            @else
                            <td class="text-danger font-weight-bold">{{$acceptedbid->admin_confirmation}}</td>
                            @endif
                            <!-- <td>{{$acceptedbid->admin_confirmation}}</td> -->
                            <?php
                            if($acceptedbid->offer_id != '')
                            {
                            $origin2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('state')->first();
                            $price20 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('currency')->first();
                            $price21 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('price')->first();
                            $price22 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('perunit')->first();
                            $quantity20 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('quantity')->first();
                            $quantity21 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('unit')->first();
                            $origin = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('state')->first();
                            
                            $temp = preg_replace("/[^a-zA-Z 0-9]+/", "", $origin );
                          //  unset($origin);
                           // dd($temp);
                            $tandc2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('tandc')->first();
                            $otandc2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('otandc')->first();
                            $chemical_specification2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('chemical_specification')->first();
                            $physical_specification2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('physical_specification')->first();
                            $taxclass2 = \App\Seller::where('id', $acceptedbid->offer_id)->get()->pluck('taxclass')->first();
                            }
                            else
                            {
                            $origin2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('state')->first();
                             $temp = preg_replace("/[^a-zA-Z 0-9]+/", "", $origin2 );
                            //dd($origin2);
                            $price20 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('currency')->first();
                            $price21 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('price')->first();
                            $price22 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('perunit')->first();
                            $quantity20 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('quantity')->first();
                            $quantity21 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('unit')->first();
                            $origin = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('state')->first();
                            $tandc2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('tandc')->first();
                            $otandc2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('otandc')->first();
                            $chemical_specification2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('chemical_specification')->first();
                            $physical_specification2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('physical_specification')->first();
                            $taxclass2 = \App\Buyer::where('id', $acceptedbid->enquiry_id)->get()->pluck('taxclass')->first();
                            }
                            ?>
                            <!-- <td>{{$price20}} {{$price21}} {{$price22}}</td>
                            <td>{{$quantity20}} {{$quantity21}}</td> -->
                            <td>{{ $acceptedbid->new_currency }} {{ $acceptedbid->new_price }} {{ $acceptedbid->new_perunit }}</td>
                            <td>{{ $acceptedbid->new_quantity }} {{ $acceptedbid->new_unit }}</td>
                            <td>{{ $acceptedbid->created_at }}</td>
                            
                          </tr>
                          <!-- <tr>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Origin</th>
                            <th>Created On</th>
                          </tr>
                          <tr>
                            
                            
                          </tr> -->
                          <!-- <tr>
                            
                            <th>Created On</th>
                            <th>Offer</th>
                            <th>Enquiry</th>
                            <th>New Price</th>
                            <th>New Quantity</th>
                          </tr> -->
                          <!-- <tr>
                            
                            <td>{{ $acceptedbid->new_currency }} {{ $acceptedbid->new_price }} {{ $acceptedbid->new_perunit }}</td>
                            <td>{{ $acceptedbid->new_quantity }} {{ $acceptedbid->new_unit }}</td>
                            
                            
                            
                            <td>{{ $acceptedbid->offer_id }}</td>
                            <td>{{ $acceptedbid->enquiry_id }}</td>
                            
                          </tr> -->
                          <!-- <tr> -->
                          <!-- <td></td>
                          @if($enquiry_id3 != '')
                          {
                          <?php $offer_id31 = 'NA'; ?>
                          <?php $enquiry_id31 = $enquiry_id3; ?>
                          }
                          @else
                          {
                          <?php $enquiry_id31 = 'NA'; ?>
                          <?php $offer_id31 = $offer_id3; ?>
                          }
                          @endif
                          
                          <td></td> -->
                          <!--  </tr> -->
                          <?php $taxclass32 = \App\TaxClass::where('id', $taxclass2)->pluck('name')->first(); ?>
                        </table>
                        <div class="accordion accordion-light" id="accordionwithlight">
                          <div class="card">
                            <div class="card-header" id="headingSixlight">
                              <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSixlight" aria-expanded="false" aria-controls="collapseSixlight"><i class="fa fa-plus mr-2"></i>Available States</button>
                              </h2>
                            </div>
                            <div id="collapseSixlight" class="collapse" aria-labelledby="headingSixlight" data-parent="#accordionwithlight">
                              <div class="card-body">
                                <?php foreach (json_decode($origin) as $key => $value) {
                                echo $value."<br>";
                                }?>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingFourlight">
                              <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFivelight" aria-expanded="false" aria-controls="collapseFivelight"><i class="fa fa-plus mr-2"></i>Tax Class</button>
                              </h2>
                            </div>
                            <div id="collapseFivelight" class="collapse" aria-labelledby="headingFivelight" data-parent="#accordionwithlight">
                              <div class="card-body">
                                {{$taxclass32}}
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
                                {{$chemical_specification2}}
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
                                {{$physical_specification2}}
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
                                {{$tandc2}}
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
                                {{$otandc2}}
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="col-md-12 m-t-30">
                        <h5>Summary</h5>
                        @if($acceptedbid->enquiry_id != 0)
                        <p>This <strong>Enquiry ({{$acceptedbid->enquiry_id}})</strong> for Product <strong>{{$productname1}}</strong> is created by <strong>{{$buyer1}} (Buyer)</strong> on {{ $acceptedbid->created_at }} from state {{$temp}}.</p>
                        <p>{{$buyer1}} (Buyer) accepted the bid of {{$seller1}} (Seller) for <strong>{{ $acceptedbid->new_quantity }}{{ $acceptedbid->new_unit }}</strong> of <strong>{{$productname1}}</strong> at Price <strong>{{ $acceptedbid->new_currency }} {{ $acceptedbid->new_price }} {{ $acceptedbid->new_perunit }}</strong></p>
                        @endif
                        @if($acceptedbid->offer_id != 0)
                        <p>This <strong>Offer ({{$acceptedbid->offer_id}})</strong> for Product <strong>{{$productname1}}</strong> is created by <strong>{{$seller1}} (Seller)</strong> on {{ $acceptedbid->created_at }} from state {{$temp}}.</p>
                        <p>{{$seller1}} (Seller) accepted the bid of {{$buyer1}} (Buyer) for <strong>{{ $acceptedbid->new_quantity }}{{ $acceptedbid->new_unit }}</strong> of <strong>{{$productname1}}</strong> at Price <strong>{{ $acceptedbid->new_currency }} {{ $acceptedbid->new_price }} {{ $acceptedbid->new_perunit }}</strong></p>
                        @endif
                        <br>
                        <a type="button" rel="tooltip" title="View Trail" class="btn btn-primary btn-link btn-sm vt" href="{{ url('admin/singletrail', [$enquiry_id31, $offer_id31, $buyer_id3, $seller_id3, $acceptedbid->id]) }}" data-enquiry_id31="{{$enquiry_id31}}" data-buyer_id3="{{$buyer_id3}}" data-offer_id31="{{$offer_id31}}" data-seller_id3="{{$seller_id3}}" data-accetedbid_id="{{$acceptedbid->id}}"><i class="fa fa-gavel"></i> View Trails</a>
                        <!--  <a id="vt"  title="View Trail" class="btn btn-primary btn-link btn-sm" data-enquiry_id31="{{$enquiry_id31}}" data-buyer_id3="{{$buyer_id3}}" data-offer_id31="{{$offer_id31}}" data-seller_id3="{{$seller_id3}}" data-accetedbid_id="{{$acceptedbid->id}}"><i class="fa fa-gavel"></i> View Trails</a> -->
                        
                        
                        <a type="button" rel="tooltip" title="Approve" class="btn btn-success btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('approve-acceptedbid', [$acceptedbid->id]) }}"><i class="fa fa-check"></i> Approve</a>
                        
                        <a type="button" rel="tooltip" title="Dispprove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('disapprove-acceptedbid', [$acceptedbid->id]) }}"><i class="fa fa-close"></i> Disapprove</a>
                      </div>
                      
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
              <div class="card m-b-30" id="view_trails"></div>
            </div>
          </div>
        </div>
        @include('admin/new_footer')
      </div>
    </div>
    <!-- Start js -->
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/detect.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin_assets/js/vertical-menu.js') }}"></script>
    <!-- Datatable js -->
    <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-table-datatable.js') }}"></script>

    <script src="{{ asset('admin_assets/js/custom/custom-chat.js')}}"></script>
    <script src="{{ asset('admin_assets/plugins/pnotify/js/pnotify.custom.min.js')}}"></script>

    <!-- Slick js -->
    <script src="{{ asset('admin_assets/plugins/slick/slick.min.js')}}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-ecommerce-single-product.js')}}"></script>

    <!-- Core js -->
    <script src="{{ asset('admin_assets/js/core.js') }}"></script>
    <!-- End js -->
    <script>
    $(document).ready(function(){
    
    $(".add_new_product").hide();
    $("#hide-btn").click(function(){
    $(".add_new_product").show("slow");
    });
    $( "#vt" ).click(function(){
    enquiry_id31 = $(this).attr("data-enquiry_id31");
    buyer_id3 = $(this).attr("data-buyer_id3");
    offer_id31 = $(this).attr("data-offer_id31");
    seller_id3 = $(this).attr("data-seller_id3");
    accetedbid_id = $(this).attr("data-accetedbid_id");
    $("#view_trails").load('<?php echo url("/admin/ajaxsingletrail/'+enquiry_id31+'/'+offer_id31+'/'+buyer_id3+'/'+seller_id3+'/'+accetedbid_id"); ?>');
    alert('clicked');
    });
    });
    </script>
  </body>
</html>