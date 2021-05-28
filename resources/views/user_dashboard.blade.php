
<!DOCTYPE html>
<html lang="en">
  @include('new_head')
    <style type="text/css">
      .apexcharts-toolbar{
        display:none;
      }
  </style>
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

            <!-- <div id="my_header"></div> -->
            <!-- Start Contentbar -->    
            <div class="contentbar m-t-30">  
                           
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-6 m-t-30">
                        <!-- Start row -->
                        <div class="row">
                            
                            <!-- Start col -->
                            <!-- <div class="col-lg-12">
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
                                                    <h4>+ 4598</h4>
                                                    <p>Inward Amount</p>
                                                </div>
                                                <div class="revenue-box">
                                                    <h4>- 296</h4>
                                                    <p>Outward Amount</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="apex-line-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- End col --> 
                                                       
                        </div>
                        <!-- End row -->                        
                    </div>
                    <!-- End col -->                    
                    <!-- Start col -->
                    <!-- Currency Converter Script - EXCHANGERATEWIDGET.COM -->
<div style="width:478px;border:1px solid #55A516;"><div style="text-align:center;background-color:#55A516;height:18px;width:100%;font-size:13px;font-weight:bold;padding-top:2px;"><a rel="nofollow">Currency Converter</a></div><script type="text/javascript" src="//www.exchangeratewidget.com/converter.php?l=en&f=USD&t=INR&a=1&d=F0F0F0&n=FFFFFF&o=000000&v=2"></script></div>
<!-- End of Currency Converter Script -->
                    <div class="col-lg-12 col-xl-12">
                        <div class="card m-b-30 dash-widget">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <h5 class="card-title mb-0">Sales Purchases</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0 pl-0 pr-2">
                                {!! $chart->container() !!}
                                <script src="{{ $chart->cdn() }}"></script>
                                {!! $chart->script() !!}
                            </div>
                            <br><br>
                        </div>
                        

                    </div>
                    <!-- End col -->
                  <!--  <div class="col-lg-12">
	                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Contribution in terms of %</h5>
                            </div>
                            <div class="card-body">
                                <div id="c3-pie" style="height:320px;"></div>
                            </div>
                        </div>
                    	</div>-->
                </div>
                <!-- End row -->
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <!-- Start row -->
                        <div class="row">
                            <!-- Start col -->
                            <div class="col-lg-4 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="media">
                                            <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                            <div class="media-body">
                                                <p class="mb-0">Total Products</p>
                                                <h5 class="mb-0">{{$totalproducts}}</h5>
                                                <a href="{{ url('/add_product') }}" class="stretched-link"></a>                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                            <!-- Start col -->
                            <div class="col-lg-4 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="media">
                                            <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="fa fa-gavel"></i></span>
                                            <div class="media-body">
                                                <p class="mb-0">Ongoing Bids</p>
                                                <h5 class="mb-0">{{$totalcount}}</h5>
                                                <a href="{{url('/new-ongoingbid')}}" class="stretched-link"></a>
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
                                                <p class="mb-0">Users Online</p>
                                                <h5 class="mb-0">{{$online_users}}</h5>
                                                <a href="#" class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End col --> 
                            
                            <!-- Start col -->
                            <!--<div class="col-lg-12 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Buyers</h5>
                                            </div>
                                            <div class="col-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-order">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatabledb2" class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>Buyer</th>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($buyershares->take(5) as $top_buyer)
                                                    <tr>
                                                        <td><?= \App\Profile::where('user_id',$top_buyer->created_by)->get()->pluck('company_name')->first();?></td>
                                                        <td>{{$top_buyer->product_name}}</td>
                                                        <td>{{number_format($top_buyer->price)}}</td>
                                                        <td>{{number_format($top_buyer->quantity)}}</td>
                                                        <td>{{number_format($top_buyer->price * $top_buyer->quantity)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- End col -->
                            <!-- Start col -->
                            <!--<div class="col-lg-12 col-xl-6">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Sellers</h5>
                                            </div>
                                            <div class="col-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="http://vyapaarnetwork.com/beta/public/report#v-pills-addresses">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                         <div class="table-responsive">
                                            <table id="datatabledb1" class="table table-borderless">
                                                <thead>

                                                    <tr>
                                                        
                                                        <th>Seller</th>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                         <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($sellershares->take(5) as $top_seller)
                                                    <tr>
                                                        <td><?= \App\Profile::where('user_id',$top_seller->created_by)->get()->pluck('company_name')->first();?></td>
                                                         <td>{{$top_seller->product_name}}</td>
                                                        <td>{{number_format($top_seller->price)}}</td>
                                                        <td>{{number_format($top_seller->quantity)}}</td>
                                                        <td>{{number_format($top_seller->price * $top_seller->quantity)}}</td>
                                                    </tr>
                                                    @endforeach                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- End col -->
                            <!-- Start col -->
                           <!-- <div class="col-lg-12 col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Latest Order</h5>
                                            </div>
                                            <div class="col-3">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetPerformers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetPerformers">
                                                        <a class="dropdown-item font-13" href="#">View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="card-body">
                                                <div class="media">
                                                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                    <div class="media-body">
                                                        <p class="mb-0">Bid On My<br> Offer</p>
                                                        <h5 class="mb-0">{{$bidonmyoffers->where('status', 'Ongoing')->where('offer_id', '!=', '')->count()}}</h5>
                                                        @foreach($bidonmyoffers->unique('offer_id') as $allbids)
                                                          @if($allbids->offer_id != '')
                                                            <small>
                                                              <?php
                                                              $myoffer_to_date = \App\Seller::where('id', $allbids->offer_id)->pluck('to_date')->first();
                                                              $mostart = \Carbon\Carbon::now();
                                                              $moend = \Carbon\Carbon::parse($myoffer_to_date);
                                                              $modurationd = $moend->diffInDays($mostart);
                                                              $modurationh = $moend->diffInHours($mostart)-($modurationd*24);
                                                              $modurationm = $moend->diffInMinutes($mostart)-($moend->diffInHours($mostart)*60);
                                                              $modurations = $moend->diffInSeconds($mostart)-($moend->diffInMinutes($mostart)*60);
                                                              $mosecondleft = $moend->diffInSeconds($mostart);
                                                              $moturn = \App\Finalbid::where('buyer_id', $allbids->buyer_id)->where('offer_id', $allbids->offer_id)->orderBy('id', 'DESC')->pluck('bidtype')->first(); ?>
                                                              @if($moend < $mostart)
                                                                <td>
                                                                @elseif($mosecondleft < 300)<td class="text-white bg-danger"><span>{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S</span>
                                                                @else
                                                                <td><span class="text-success">{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S Left</span>
                                                                @endif</td>
                                                            </small>
                                                          @endif
                                                          @endforeach
                                                        <a href="{{ url('/new-ongoingbid') }}" class="stretched-link"></a>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="card-body">
                                                <div class="media">
                                                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                    <div class="media-body">
                                                        <p class="mb-0">Bid On My Enquiry</p>
                                                        <h5 class="mb-0">{{$bidonmyenquiries->where('status', 'Ongoing')->where('enquiry_id', '!=', '')->count()}}</h5>
                                                        @foreach($bidonmyenquiries->unique('seller_id') as $allbids)
                                                          @if($allbids->enquiry_id != '')
                                                            <small>
                                                              <?php
                                                              $myenquiry_to_date = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('to_date')->first();
                                                              $mestart = \Carbon\Carbon::now();
                                                              $meend = \Carbon\Carbon::parse($myenquiry_to_date);
                                                              $medurationd = $meend->diffInDays($mestart);
                                                              $medurationh = $meend->diffInHours($mestart)-($medurationd*24);
                                                              $medurationm = $meend->diffInMinutes($mestart)-($meend->diffInHours($mestart)*60);
                                                              $medurations = $meend->diffInSeconds($mestart)-($meend->diffInMinutes($mestart)*60);
                                                              $mesecondleft = $meend->diffInSeconds($mestart);
                                                              $meturn = \App\Finalbid::where('buyer_id', $allbids->buyer_id)->where('enquiry_id', $allbids->enquiry_id)->orderBy('id', 'DESC')->pluck('bidtype')->first();
                                                               ?>
                                                              @if($meend < $mestart)
                                                                
                                                                @elseif($mesecondleft < 300)<td class="text-white bg-danger"><span>{{$medurationd}}D {{$medurationh}}H {{$medurationm}}M {{$medurations}}S</span>
                                                                @else<td><span class="text-success">{{$medurationd}}D {{$medurationh}}H {{$medurationm}}M {{$medurations}}S Left</span>
                                                              @endif
                                                            </small>
                                                          @endif
                                                          @endforeach
                                                        <a href="{{ url('/new-ongoingbid') }}" class="stretched-link"></a>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="card-body">
                                                <div class="media">
                                                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                    <div class="media-body">
                                                        <p class="mb-0">Bid On Others Offer</p>
                                                        <h5 class="mb-0">{{$bidonoffers->where('status', 'Ongoing')->where('offer_id', '!=', '')->count()}}</h5>
                                                        @foreach($bidonoffers->unique('offer_id') as $allbids)
                                                          @if($allbids->offer_id != '')
                                                            <small>
                                                              <?php
                                                              $otheroffer_to_date = \App\Seller::where('id', $allbids->offer_id)->pluck('to_date')->first();
                                                              $oostart = \Carbon\Carbon::now();
                                                              $ooend = \Carbon\Carbon::parse($otheroffer_to_date);
                                                              $oodurationd = $ooend->diffInDays($oostart);
                                                              $oodurationh = $ooend->diffInHours($oostart)-($oodurationd*24);
                                                              $oodurationm = $ooend->diffInMinutes($oostart)-($ooend->diffInHours($oostart)*60);
                                                              $oodurations = $ooend->diffInSeconds($oostart)-($ooend->diffInMinutes($oostart)*60);
                                                              $oosecondleft = $ooend->diffInSeconds($oostart);
                                                              $ooturn = \App\Finalbid::where('seller_id', $allbids->seller_id)->where('offer_id', $allbids->offer_id)->orderBy('id', 'DESC')->pluck('bidtype')->first(); ?>
                                                              @if($ooend < $oostart) 
                                                                @elseif($oosecondleft < 300)<td class="text-white bg-danger"><span>{{$oodurationd}}D {{$oodurationh}}H {{$oodurationm}}M {{$oodurations}}S</span>
                                                                @else<td><span class="text-success">{{$oodurationd}}D {{$oodurationh}}H {{$oodurationm}}M {{$oodurations}}S
                                                                Left</span>
                                                              @endif</small>
                                                            </small>
                                                          @endif
                                                          @endforeach
                                                        <a href="{{ url('/new-ongoingbid') }}" class="stretched-link"></a>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="card-body">
                                                <div class="media">
                                                    <span class="align-self-center mr-3 action-icon badge badge-secondary-inverse"><i class="feather icon-box"></i></span>
                                                    <div class="media-body">
                                                        <p class="mb-0">Bid On Others Enquiry</p>
                                                        <h5 class="mb-0">{{$bidonenquiries->where('status', 'Ongoing')->where('enquiry_id', '!=', '')->count()}}</h5>
                                                        @foreach($bidonenquiries->unique('enquiry_id') as $allbids)
                                                      @if($allbids->enquiry_id != '')
                                                        <small>
                                                          <?php
                                                          $otherenquiry_to_date = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('to_date')->first();
                                                          $oestart = \Carbon\Carbon::now();
                                                          $oeend = \Carbon\Carbon::parse($otherenquiry_to_date);
                                                          $oedurationd = $oeend->diffInDays($oestart);
                                                          $oedurationh = $oeend->diffInHours($oestart)-($oedurationd*24);
                                                          $oedurationm = $oeend->diffInMinutes($oestart)-($oeend->diffInHours($oestart)*60);
                                                          $oedurations = $oeend->diffInSeconds($oestart)-($oeend->diffInMinutes($oestart)*60);
                                                          $oesecondleft = $oeend->diffInSeconds($oestart);
                                                          $oeturn = \App\Finalbid::where('seller_id', $allbids->seller_id)->where('enquiry_id', $allbids->enquiry_id)->orderBy('id', 'DESC')->pluck('bidtype')->first();
                                                          //$oesecondleft = $oeend-$oestart;
                                                           ?>
                                                          @if($oeend < $oestart)
                                                            @elseif($oesecondleft < 300)<td class="text-white bg-danger"><span>{{$oedurationd}}D {{$oedurationh}}H {{$oedurationm}}M {{$oedurations}}S</span>
                                                            @else
                                                            <td><span class="text-success">{{$oedurationd}}D {{$oedurationh}}H {{$oedurationm}}M {{$oedurations}}S</span>
                                                            @endif</td>
                                                          
                                                        </small>
                                                      @endif
                                                      @endforeach
                                                        <a href="{{ url('/new-ongoingbid') }}" class="stretched-link"></a>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>-->
                            <!-- End col -->    
                            <!--Latest 5 bids-->
                             <!-- Start col -->
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top 5 Ongoing Bids</h5>
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
                                            <table id="datatabledb" class="table table-borderless">
                                                <thead>

                                                    <tr>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Buyer/Seller</th>
                                                   
                                                    <th>Turn</th>
                                                    <th>Status</th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <a href="{{url('/new-ongoingbid')}}" class="stretched-link"></a>
                                              @foreach($bidonalldata->where('status', 'Ongoing') as $allbids)               
                                                  <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                                                  $buyer_name = \App\Profile::where('user_id', $allbids->buyer_id)->pluck('company_name')->first();
                                                  $myoffer_to_date = \App\Seller::where('id', $allbids->offer_id)->pluck('to_date')->first();
                                                  $mostart = \Carbon\Carbon::now();
                                                  $moend = \Carbon\Carbon::parse($myoffer_to_date);
                                                  $modurationd = $moend->diffInDays($mostart);
                                                  $modurationh = $moend->diffInHours($mostart)-($modurationd*24);
                                                  $modurationm = $moend->diffInMinutes($mostart)-($moend->diffInHours($mostart)*60);
                                                  $modurations = $moend->diffInSeconds($mostart)-($moend->diffInMinutes($mostart)*60);
                                                  $mosecondleft = $moend->diffInSeconds($mostart);
                                                  $moturn = \App\Finalbid::where('buyer_id', $allbids->buyer_id)->where('offer_id', $allbids->offer_id)->orderBy('id', 'DESC')->pluck('bidtype')->first(); ?>
                                                  @if($allbids->offer_id != '' && $mostart < $moend)
                                                  
                                                  <tr>
                                                    <td>{{$allbids->created_at}}</td>
                                                    <td>{{$product_name}}</td>
                                                    <td>{{$buyer_name}}</td>
                                                   <!-- @if($moend < $mostart)
                                                      <td><span class="text-danger">Expired</span>
                                                      @elseif($mosecondleft < 300)<td class="text-white bg-danger"><span>{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S</span>
                                                      @else
                                                      <td><span class="text-success">{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S</span>
                                                      @endif</td>-->
                                                      <td>@if($moturn == 'bid')<span>Your Turn</span>@else <span>Waiting..</span>@endif</td>
                                                    <td>{{$allbids->status}}</td>
                                                   
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
                            <!--End of the code latest 5 bids-->
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                            
                            <!-- End col -->
                    <!-- Start col -->
                    <!-- <div class="col-lg-12 col-xl-3">
                        <div class="card m-b-30">
                            <div class="card-body text-center">
                                <span class="card-subtitle">Advertisement</span>
                                <img src="{{ asset('/admin_theme_assets/img/300x600.jpg') }}" style="width:100%"/>
                            </div>
                        </div>
                    </div> -->
                    <!-- End col -->
                </div>
                <!-- End row -->
                <!-- Start Row -->

               <div class="row">
                    <div class="col-lg-12 col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-header">                                
                                        <div class="row align-items-center">
                                            <div class="col-9">                                                
                                                <h5 class="card-title mb-0">Top Products</h5>
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
                                            <table id="datatabledb" class="table table-borderless">
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
                                                            @foreach($buyerswise->unique('buyer_id') as $buyer)
                                                                <tr>
                                                                    <?php $buyer_name = \App\Profile::where('user_id', $buyer->buyer_id)->get()->pluck('company_name')->first();
                                                                    $total_revenue = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_price');
                                                                    $total_qty =  \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->sum('new_quantity');
                                                                    $total_revenue_currency = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_currency')->first();
                                                                    $total_revenue_perunit = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('buyer_id', $buyer->buyer_id)->get()->pluck('new_perunit')->first();
                                                                    if($buyer->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $buyer->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $buyer->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$buyer->buyer_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$buyer_name}}-Buyer</td>
                                                                    <td>{{$total_revenue_currency}}{{number_format($total_revenue*$total_qty)}}</td>
                                                                    <td>{{number_format($total_qty)}}{{$total_revenue_perunit}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @foreach($sellerswise->unique('seller_id') as $seller)
                                                                <tr>
                                                                    <?php $seller_name = \App\Profile::where('user_id', $seller->seller_id)->get()->pluck('company_name')->first();
                                                                    $total_revenue_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $seller->seller_id)->get()->sum('new_price');
                                                                    $total_qty_seller =  \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $seller->seller_id)->get()->sum('new_quantity');
                                                                    $total_unit_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $seller->seller_id)->get()->pluck('new_unit')->first();
                                                                    $total_currency_seller = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->where('seller_id', $seller->seller_id)->get()->pluck('new_currency')->first();
                                                                    if($seller->offer_id == ''){
                                                                        $name_of_product = \App\Buyer::where('id', $seller->enquiry_id)->get()->pluck('product_name')->first();
                                                                    }else {
                                                                        $name_of_product = \App\Seller::where('id', $seller->offer_id)->get()->pluck('product_name')->first();
                                                                    } ?>
                                                                    <th scope="row">{{$seller->seller_id}}</th>
                                                                    <td>{{$name_of_product}}</td>
                                                                    <td>{{$seller_name}}-Seller</td>
                                                                    <td>{{$total_currency_seller}}{{$total_revenue_seller*$total_qty_seller}}</td>
                                                                    <td>{{$total_qty_seller}}{{$total_unit_seller}}</td>
                                                                </tr>
                                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- End Row -->
                <div class="row">
                    @foreach($news as $newz)
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="card m-b-30">
                            <?php foreach (json_decode($newz->image)as $picture) { ?>                     
                            <img class="card-img-top" src="{{ asset('/imageupload/news/'.$picture) }}" alt="blog">
                            <?php } ?>
                            <div class="card-body">
                                <p class="text-center mb-3"><span class="badge badge-success text-uppercase">Tech</span></p>
                                <h5 class="card-title font-18">{{$newz->title}}</h5>
                                <p class="card-text mb-0">{{$newz->description}}</p>                                
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="blog-link">
                                            <a href="{{url('/more_news')}}" class="btn btn-primary-rgba">More<i class="feather icon-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="blog-meta">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">{{$newz->created_at}}</li>
                                                <li class="list-inline-item">|</li>
                                                <li class="list-inline-item">by <a href="#">Admin</a></li>
                                            </ul>
                                        </div>
                                    </div>    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    @endforeach                    
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

    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Apex js -->
    <script src="admin_assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="admin_assets/plugins/apexcharts/irregular-data-series.js"></script>    
    <!-- Slick js -->
    <script src="admin_assets/plugins/slick/slick.min.js"></script>
    <!-- Custom Dashboard js -->   
    <script src="admin_assets/js/custom/custom-dashboard.js"></script>

    <!-- C3 Chart js -->
    <script src="admin_assets/plugins/d3/d3.min.js"></script>
    <script src="admin_assets/plugins/c3/c3.min.js"></script>
    <script src="admin_assets/js/custom/custom-chart-c3.js"></script>
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->
    
     <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<!--<script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script> -->
<!--<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>-->
<!--<script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js">-->
<!--<script src ="/beta/public/firebase-messaging-sw.js"></script>-->
  <!--  <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
          navigator.serviceWorker.register('/beta/public/firebase-messaging-sw.js');
        });
      }
    </script> -->
<script>
  
     var firebaseConfig = {
         apiKey: "AIzaSyDqr9nF25xfxOSfCew_HdmqiNDdI4tcHp0",
         authDomain: "mymotifs-56d44.firebaseapp.com",
         databaseURL: "https://mymotifs-56d44.firebaseio.com",
         projectId: "mymotifs-56d44",
         storageBucket: "mymotifs-56d44.appspot.com",
         messagingSenderId: "1093645415864",
        appId: "1:1093645415864:web:cefb36d03f78a1f9a98b4d",
         measurementId: "G-968CH64QZ3"
     };
      //alert(1);
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  //alert(1);
 
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>

<script type="text/javascript">
                      $(document).ready(function() {
                        $('.apexcharts-toolbar').addClass('d-none');
                    });
                </script>



</body>
</html>