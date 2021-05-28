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
                    <h4 class="page-title">Productwise Top Buyers & Sellers</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            
                            <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Productwise Top Buyers & Sellers</li>
                        </ol>
                    </div>
                </div>
            </div>          
        </div>
        <!-- End Breadcrumbbar -->
        <!-- Start Contentbar -->    
        <div class="contentbar">
          <div class="row">
                    <!-- Start col -->
                   
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-7 col-xl-9">
                        <div class="tab-content" id="v-pills-tabContent">

                                <!-- Start row -->
                                <div class="row">
                                    <!-- Start col -->
                                    <!-- <div class="col-lg-12 col-xl-4">
                                        <div class="card m-b-20">
                                            <div class="card-body">
                                                <div class="ecom-dashboard-widget">
                                                    <div class="media">
                                                        <i class="feather icon-package"></i>
                                                        <div class="media-body">
                                                            <h5>My Orders</h5>
                                                            <p>Pending (3)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End col -->
                                    <!-- Start col -->
                                    <!-- <div class="col-lg-12 col-xl-4">
                                        <div class="card m-b-20">
                                            <div class="card-body">
                                                <div class="ecom-dashboard-widget">
                                                    <div class="media">
                                                        <i class="feather icon-heart"></i>
                                                        <div class="media-body">
                                                            <h5>My Wishlist</h5>
                                                            <p>Items (7)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End col -->
                                    <!-- Start col -->
                                    <!-- <div class="col-lg-12 col-xl-4">
                                        <div class="card m-b-20">
                                            <div class="card-body">
                                                <div class="ecom-dashboard-widget">
                                                    <div class="media">
                                                        <i class="feather icon-credit-card"></i>
                                                        <div class="media-body">
                                                            <h5>My Wallet</h5>
                                                            <p>Balance ($25)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- End col -->
                                </div>  
                                <!-- End row -->
                            <!-- Dashboard Start -->
                            <div class="tab-pane fade" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Dashboard</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="profilebox py-4 text-center">
                                            <? $img2 = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_logo')->first(); ?>
                                            <img src="{{ asset('/imageupload/profile/'.$img2) }}" class="img-fluid mb-3" alt="profile" width="150px">
                                            <div class="profilename">
                                                <h5><?php
                                                            $company_name = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_name')->first();?>
                                                            {{ $company_name }}</h5>
                                                <p class="text-muted my-3"><a href="my-account.html"><i class="feather icon-edit-2 mr-2"></i>Edit Profile</a></p>
                                            </div>
                                            <div class="button-list">
                                                <a href="#" class="btn btn-primary-rgba font-18"><i class="feather icon-facebook"></i></a>
                                                <a href="#" class="btn btn-info-rgba font-18"><i class="feather icon-twitter"></i></a>
                                                <a href="#" class="btn btn-danger-rgba font-18"><i class="feather icon-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard End -->
                            <!-- My Orders Start -->
                            <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Buyer Wise</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
         
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="datatable-buttons" class="table table-borderless" style="width: 100%">

                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>    
                                                                    <th scope="col">Buyer Name</th>
                                                                    <th scope="col">Total Revenue</th>
                                                                    <th scope="col">Total Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyerswise->unique('buyer_id') as $buyer)
                                                                <tr>
                                                                    <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('name')->first();
                                                                    $total_revenue = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity'); ?>
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$buyer_name}}</td>
                                                                    <td>{{number_format($total_revenue)}}</td>
                                                                    <td >{{number_format($total_qty)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <tfoot><div id="datatable-buttons"></div></tfoot>
                                                        

                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Orders End -->
                            <!-- My Addresses Start -->
                            <div class="tab-pane fade" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Seller Wise</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="datatable-buttons1" class="table table-borderless" style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>    
                                                                    <th scope="col">Seller Name</th>
                                                                    <th scope="col">Total Revenue</th>
                                                                    <th scope="col" >Total Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyerswise->unique('seller_id') as $buyer)
                                                                <tr>
                                                                    <?php $seller_name = \App\Profile::where('user_id', $buyer->seller_id)->get()->pluck('name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_quantity'); ?>
                                                                    <th scope="row">{{$buyer->seller_id}}</th>
                                                                    <td>{{$seller_name}}</td>
                                                                    <td>{{$total_revenue_seller}}</td>
                                                                    <td >{{$total_qty_seller}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                            
                                                        </table>
                                                        <tfoot><div id="datatable-buttons1"></div></tfoot>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Addresses End -->
                            <!-- My Wishlist Start -->
                            <div class="tab-pane fade active show" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Product Wise</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="datatable-buttons2" class="table table-borderless" style="width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Product Name</th>    
                                                                    <th scope="col">Buyer/Seller Name</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col" >Total Qty</th>
                                                                     <th scope="col" >Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyerswise->unique('buyer_id') as $buyer)
                                                                <tr>
                                                                    <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('name')->first();
                                                                    $total_revenue = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity');
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$buyer_name}}-Buyer</td>
                                                                    <td>{{number_format($total_revenue)}}</td>
                                                                    <td>{{number_format($total_qty)}}</td>
                                                                     <td>{{number_format($total_revenue * $total_qty)}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @foreach($buyerswise->unique('seller_id') as $buyer)
                                                                <tr>
                                                                    <?php $seller_name = \App\Profile::where('user_id', $buyer->seller_id)->get()->pluck('name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_quantity');
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->seller_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$seller_name}}-Seller</td>
                                                                    <td>{{$total_revenue_seller}}</td>
                                                                    <td >{{$total_qty_seller}}</td>
                                                                    <td >{{$total_revenue_seller * $total_qty_seller}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                           
                                                        </table>
                                                         <tfoot><div id="datatable-buttons2"></div></tfoot>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Wishlist End -->
                            <!-- My Wallet Start -->
                            <div class="tab-pane fade" id="v-pills-wallet" role="tabpanel" aria-labelledby="v-pills-wallet-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Latest Deal</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-header">
                                                    <!-- <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>ID : #26598</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0">Total : <strong>$500</strong></h6>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Product Name</th>    
                                                                    <th scope="col">Buyer/Seller Name</th>
                                                                    <th scope="col">Total Revenue</th>
                                                                    <th scope="col" >Total Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyerswise->unique('buyer_id') as $buyer)
                                                                <tr>
                                                                    <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('name')->first();
                                                                    $total_revenue = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity');
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$buyer->created_at}}</td>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$buyer_name}}-Buyer</td>
                                                                    <td>{{number_format($total_revenue)}}</td>
                                                                    <td >{{number_format($total_qty)}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @foreach($buyerswise->unique('seller_id') as $buyer)
                                                                <tr>
                                                                    <?php $seller_name = \App\Profile::where('user_id', $buyer->seller_id)->get()->pluck('name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $buyer->seller_id)->get()->sum('new_quantity');
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->seller_id}}</th>
                                                                    <td>{{$buyer->created_at}}</td>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$seller_name}}-Seller</td>
                                                                    <td>{{$total_revenue_seller}}</td>
                                                                    <td >{{$total_qty_seller}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Wallet End -->
                            <!-- My Chat Start -->
                            <div class="tab-pane fade" id="v-pills-chat" role="tabpanel" aria-labelledby="v-pills-chat-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Top Sellers</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>ID : #26598</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0">Total : <strong>$500</strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>    
                                                                    <th scope="col">Photo</th>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col" >Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyers as $buyer)
                                                                <tr>
                                                                    <th scope="row">{{$buyer->id}}</th>
                                                                    <?php foreach (json_decode($buyer->product_image) as $picture) { ?>
                                                                        <td><img src="{{ asset('/imageupload/enquiry/'.$picture) }}" class="img-fluid" width="35" alt="product"/></td>
                                                                      <?php } ?>
                                                                    <td>{{$buyer->product_name}}</td>
                                                                    <td>1</td>
                                                                    <td>${{number_format($buyer->price)}}</td>
                                                                    <td >${{number_format($buyer->price)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Chat End -->
                            <!-- My Notifications Start -->
                            <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Top Buyers</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>ID : #26598</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0">Total : <strong>$500</strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>    
                                                                    <th scope="col">Photo</th>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col" >Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyers as $buyer)
                                                                <tr>
                                                                    <th scope="row">{{$buyer->id}}</th>
                                                                    <?php foreach (json_decode($buyer->product_image) as $picture) { ?>
                                                                        <td><img src="{{ asset('/imageupload/enquiry/'.$picture) }}" class="img-fluid" width="35" alt="product"/></td>
                                                                      <?php } ?>
                                                                    <td>{{$buyer->product_name}}</td>
                                                                    <td>1</td>
                                                                    <td>${{number_format($buyer->price)}}</td>
                                                                    <td >${{number_format($buyer->price)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Notifications End -->
                            <!-- My Profile Start -->
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Top Products</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="order-box">
                                            <div class="card border m-b-30">
                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>ID : #26598</h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0">Total : <strong>$500</strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>    
                                                                    <th scope="col">Photo</th>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col" >Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($buyers as $buyer)
                                                                <tr>
                                                                    <th scope="row">{{$buyer->id}}</th>
                                                                    <?php foreach (json_decode($buyer->product_image) as $picture) { ?>
                                                                        <td><img src="{{ asset('/imageupload/enquiry/'.$picture) }}" class="img-fluid" width="35" alt="product"/></td>
                                                                      <?php } ?>
                                                                    <td>{{$buyer->product_name}}</td>
                                                                    <td>1</td>
                                                                    <td>${{number_format($buyer->price)}}</td>
                                                                    <td >${{number_format($buyer->price)}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm-6">
                                                            <h5>Status : <span class="badge badge-info-inverse font-14">Shipped</span></h5>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="mb-0"><button class="btn btn-success-rgba font-16"><i class="feather icon-file mr-2"></i>Invoice</button></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Profile End -->
                            <!-- My Logout Start -->
                            <div class="tab-pane fade" id="v-pills-logout" role="tabpanel" aria-labelledby="v-pills-logout-tab">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <h5 class="card-title mb-0">Logout</h5>                                       
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 col-xl-4">
                                                <div class="logout-content text-center my-5">
                                                    <img src="assets/images/ecommerce/logout.svg" class="img-fluid mb-5" alt="logout">
                                                    <h2 class="text-success">Logout ?</h2>
                                                    <p class="my-4">Are you sure to want to Log out? You will miss your instant checkout deal.</p>
                                                    <div class="button-list">
                                                        <button type="button" class="btn btn-danger font-16"><i class="feather icon-check mr-2"></i>Yes, I'm sure</button>
                                                        <button type="button" class="btn btn-success-rgba font-16"><i class="feather icon-x mr-2"></i>Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- My Logout End -->                            
                        </div>                        
                    </div>
                    <!-- End col -->
                </div>
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
    <script src="admin_assets/js/jquery.min.js"></script>
    @include('header_script')
    <script src="admin_assets/js/popper.min.js"></script>
    <script src="admin_assets/js/bootstrap.min.js"></script>
    <script src="admin_assets/js/modernizr.min.js"></script>
    <script src="admin_assets/js/detect.js"></script>
    <script src="admin_assets/js/jquery.slimscroll.js"></script>
    <script src="admin_assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Datatable js -->
    <script src="admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/jszip.min.js"></script>
    <script src="admin_assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="admin_assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="admin_assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="admin_assets/js/custom/custom-table-datatable.js"></script>

    <!-- Sweet-Alert js -->
    <script src="admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="admin_assets/js/custom/custom-sweet-alert.js"></script>
    
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->   
</body>
</html>