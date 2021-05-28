t
<!DOCTYPE html>
<html lang="en">
  @include('admin/new_head')
<body class="vertical-layout">    
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
        @include('admin/new_sidebar')
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            @include('admin/new_header')
            <!-- End Topbar -->
            
            <!-- Start Contentbar -->    
            <div class="contentbar m-t-30">  
                         
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-6">
                        <!-- Start row -->
                        <div class="row">
                            
                            <!-- Start col -->
                        <!--    <div class="col-lg-12">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <h5 class="card-title mb-0">Revenue Statistics</h5>
                                            </div>
                                            <div class="col-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetRevenue">
                                                        <a class="dropdown-item font-13" href="#">Refresh</a>
                                                        <a class="dropdown-item font-13" href="#">Export</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3">
                                                <div class="revenue-box border-bottom mb-2">
                                                    <h4>₹{{$totalrevenue}}</h4>
                                                    <p>Total Revenue</p>
                                                </div>
                                                <div class="revenue-box">
                                                    <h4>{{$totalquantity}}MT</h4>
                                                    <p>Total Quantity</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="apex-line-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- End col --> 
                            <!-- Start col -->
                            <div class="col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="media">
                                            <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                            <div class="media-body">
                                                <p class="mb-0">Total Products</p>
                                                <h5 class="mb-0">{{$totalproducts}}</h5>
                                                <a href="{{ url('/admin/subproduct') }}" class="stretched-link"></a>                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="col-lg-6 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="media">
                                            <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-gavel"></i></span>
                                            <div class="media-body">
                                                <p class="mb-0">Completed Bids</p>
                                                <h5 class="mb-0">{{$completedbid}}</h5>
                                                <a href="{{url('/admin/admin-bidaccepted-view')}}" class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                        </div>
                        <!-- End row -->                        
                    </div>
                    <!-- End col -->                    
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-6">
                        <div class="card m-b-30 dash-widget">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <h5 class="card-title mb-0">Index</h5>
                                    </div>
                                    <div class="col-7">
                                        <!-- <ul class="nav nav-pills float-right" id="pills-index-tab-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-sales-tab-justified" data-toggle="pill" href="#pills-sales-justified" role="tab" aria-selected="true">Offer</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-clients-tab-justified" data-toggle="pill" href="#pills-clients-justified" role="tab" aria-selected="false">Enquiry</a>
                                            </li>
                                        </ul> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0 pl-4 pr-4">
                                <!-- <div id="apex-bar-chart"></div> -->
                                {!! $chart->container() !!}
                                <script src="{{ $chart->cdn() }}"></script>
                                {!! $chart->script() !!}
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-9">
                        <!-- Start row -->
                        <div class="row">
                            <!-- Start col -->
                            
                             <!-- Start col -->
                            <div class="col-lg-12 col-xl-12">
                                <div class="m-b-30">
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card m-b-30 pt-4 pb-4">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                        <div class="media-body">
                                                            <p class="mb-0">Active Customers</p>
                                                            <h5 class="mb-0">3</h5>
                                                            <a href="#" class="stretched-link"></a>                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End col -->
                                        <!-- Start col -->
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card m-b-30 pt-4 pb-4">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                        <div class="media-body">
                                                            <p class="mb-0">Total Customers</p>
                                                            <h5 class="mb-0">{{$totalcustomers}}</h5>
                                                            <a href="{{url('/admin/users')}}" class="stretched-link"></a>                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-lg-4 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="media">
                                            <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-gavel"></i></span>
                                            <div class="media-body">
                                                <p class="mb-0">Ongoing Bids</p>
                                                <h5 class="mb-0">{{$totalongoingbids3}}</h5>
                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <!-- End col -->
                                        
                                         <!--Latest 5 bids-->
                             <!-- Start col -->
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0"> Ongoing Bids</h5>
                                            </div>
                                            <div class="col-3">
                                                <!--<div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-addresses">View More</a>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="default-datatable" class="table">
                                                <thead>

                                                    <tr>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Buyer</th>
                                                   <th>Seller</th>
                                                   <!-- <th>Turn</th>-->
                                                    <th>Status</th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <!--<a href="{{url('/new-ongoingbid')}}" class="stretched-link"></a>-->
                                              @foreach($bidonalldata as $allbids)               
                                                  <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                                                  $buyer_name = \App\Profile::where('user_id', $allbids->buyer_id)->pluck('company_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first();

                                                 ?>
                                                 
                                                  
                                                  <tr>
                                                    <td>{{$allbids->created_at}}</td>
                                                    <td>{{$product_name}}</td>
                                                    <td>{{$buyer_name}}</td>
                                                    <td>{{$seller_name}}</td>
                                                    <td>{{$allbids->status}}</td>
                                                   
                                                  </tr>
                                                  
                                             
                                              @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col --> 
                            <!--End of the code latest 5 bids-->
                            
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="col-lg-12 col-xl-12">
                                <div class="card m-b-30 pt-4 pb-4">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Products</h5>
                                            </div>
                                            <div class="col-3">
                                                <!--<div class="dropdown">-->
                                                <!--    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>-->
                                                <!--    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">-->
                                                <!--        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-addresses">View More</a>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>

                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Product Name</th>
                                                        <th>Buyer / Seller name</th>
                                                        <th>Total Revenue</th>
                                                        <th>Total Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($finalbids->unique('buyer_id')->take(5) as $buyer)
                                                                <tr>
                                                                    <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('name')->first();
                                                                    $total_revenue = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity');
                                                                    $total_qty_unit =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_unit')->first();
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$buyer_name}}-Buyer</td>
                                                                    <td>{{$total_revenue}}{{$total_qty_unit}}</td>
                                                                    <td>{{$total_qty}}{{$total_qty_unit}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @foreach($finalbids->unique('seller_id')->take(5) as $buyer)
                                                                <tr>
                                                                    <?php $seller_name = \App\Profile::where('user_id', $buyer->seller_id)->get()->pluck('name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_quantity');
                                                                    $total_qty_unit =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->pluck('new_unit')->first();
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->seller_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$seller_name}}-Seller</td>
                                                                    <td>{{number_format($total_revenue_seller)}}{{$total_qty_unit}}</td>
                                                                    <td>{{number_format($total_qty_seller)}}{{$total_qty_unit}}</td>
                                                                </tr>
                                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="col-lg-12 col-xl-6">
                                <div class="card m-b-30 pt-4 pb-4">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Buyers</h5>
                                            </div>
                                            <div class="col-3">
                                               <!-- <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-order">View More</a>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>

                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Buyer</th>
                                                        <th>Revenue</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($finalbids->unique('buyer_id')->take(5) as $buyer)
                                                        <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('name')->first();
                                                                    $total_revenue_currency = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_currency')->first();
                                                                    $total_revenue_perunit = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_perunit')->first();
                                                                    $total_revenue = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity');
                                                                    $total_qty_unit =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_unit')->first(); ?>
                                                                @if($total_qty != 0)
                                                                <tr>                                                                    
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$buyer_name}}</td>
                                                                    <td>{{$total_revenue_currency}}{{number_format($total_revenue)}}{{$total_revenue_perunit}}</td>
                                                                    <td>{{number_format($total_qty)}}{{$total_qty_unit}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="col-lg-12 col-xl-6">
                                <div class="card m-b-30 pt-4 pb-4">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Sellers</h5>
                                            </div>
                                            <div class="col-3">
                                               <!-- <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-addresses">View More</a>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>

                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Seller</th>
                                                        <th>Revenue</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($finalbids->unique('seller_id')->take(5) as $buyer)
                                                            <?php $seller_name = \App\Profile::where('user_id', $buyer->seller_id)->get()->pluck('name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_quantity');
                                                                    $total_revenue_currency = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->pluck('new_currency')->first();
                                                                    $total_revenue_perunit = \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->pluck('new_perunit')->first(); ?>
                                                                @if($total_qty_seller != 0)
                                                                <tr>                                                                    
                                                                    <th scope="row">{{$buyer->seller_id}}</th>
                                                                    <td>{{$seller_name}}</td>
                                                                    <td>{{$total_revenue_currency}}{{number_format($total_revenue_seller)}}{{$total_revenue_perunit}}</td>
                                                                    <td>{{number_format($total_qty_seller)}}{{$total_revenue_perunit}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="row">
                    <div class="col-lg-12 ">
                        <div class="card m-b-30 m-t-30">

                            <div class="card-body text-center">
                                <img src="{{ asset('/admin_theme_assets/img/ads-large.jpg') }}" class="img-fluid" alt="Responsive image">
                            </div>
                        </div>
                    </div>  
                </div> 
                            <!-- End col -->
                            
                           
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                 <!--   <div class="col-lg-12 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body text-center">
                                <span class="card-subtitle">Advertisement</span>
                                <img src="{{ asset('/admin_theme_assets/img/300x600.jpg') }}" style="width:100%"/>
                            </div>
                        </div>
                    </div>-->
                    <!-- End col -->
                </div>
                <!-- End row -->
               <!-- <div class="row">
                    news section
                </div>-->
            </div>            
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            @include('admin/new_footer')
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/detect.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin_assets/js/vertical-menu.js') }}"></script>
    <!-- Switchery js -->
    <script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
    <!-- Apex js -->
    <script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/apexcharts/irregular-data-series.js') }}"></script>    
    <!-- Slick js -->
    <script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>
    
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
    <script src="{{ asset('admin_assets/js/custom/custom-form-datepicker.js') }}"></script>
    
    <!-- Custom Dashboard js -->   
    <script src="{{ asset('admin_assets/js/custom/custom-dashboard.js') }}"></script>
    <!-- Core js -->
    <script src="{{ asset('admin_assets/js/core.js') }}"></script>
    <!-- End js -->
</body>
</html>