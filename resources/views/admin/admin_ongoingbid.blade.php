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
                        <h4 class="page-title"> All Ongoing Bids</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> All Ongoing Bids</li>
                            </ol>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">
              <!-- Start row -->
              <div class="row">
                <!-- Start col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="defaultTab" role="tablist">
                            	<?php $bidOnMyOfferCount = 0; ?> 
                            	@foreach($bidonmyoffers->where('status', 'Ongoing') as $bomoc)               
                                <?php
                                $myoffer_to_date1 = \App\Seller::where('id', $bomoc->offer_id)->pluck('to_date')->first();
                                $mostart1 = \Carbon\Carbon::now();
                                $moend1 = \Carbon\Carbon::parse($myoffer_to_date1); ?>
                                @if($bomoc->offer_id != '' && $mostart1 < $moend1)
                                <?php $bidOnMyOfferCount+=1; ?>
                                @endif
                                @endforeach
                              <li class="nav-item">
                                  <a class="nav-link active" id="my-offers-tab" data-toggle="tab" href="#my-offers" role="tab" aria-controls="my-offers" aria-selected="true">My Offers <span class="bg-danger badge text-white">{{$bidOnMyOfferCount}}</span></a>
                              </li>
                              	<?php $bidOnMyEnquiryCount = 0; ?>
                              	@foreach($bidonmyenquiries as $bomec)
                                <?php
                                $myenquiry_to_date2 = \App\Buyer::where('id', $bomec->enquiry_id)->pluck('to_date')->first();
                                $mestart2 = \Carbon\Carbon::now();
                                $meend2 = \Carbon\Carbon::parse($myenquiry_to_date2); ?>
                                @if($bomec->enquiry_id != '' && $meend2 > $mestart2 && $bomec->status == 'Ongoing')
                                <?php $bidOnMyEnquiryCount+=1; ?>
                                @endif
                                @endforeach
                              <li class="nav-item">
                                  <a class="nav-link" id="my-enquiries-tab" data-toggle="tab" href="#my-enquiries" role="tab" aria-controls="my-enquiries" aria-selected="false">My Enquiries <span class="bg-danger badge text-white">{{$bidOnMyEnquiryCount}}</span></a>
                              </li>
                              <?php $bidOnOtherOfferCount = 0; ?>
                              @foreach($bidonoffers as $allbids3)
                              	<?php 
                               $otheroffer_to_date3 = \App\Seller::where('id', $allbids3->offer_id)->pluck('to_date')->first();
                               $oostart3 = \Carbon\Carbon::now();
                               $ooend3 = \Carbon\Carbon::parse($otheroffer_to_date3); ?>
                               @if($allbids3->offer_id != '' && $allbids3->status == 'Ongoing' && $ooend3 > $oostart3)
                               <?php $bidOnOtherOfferCount+=1; ?>
                               @endif
                               @endforeach
                              <li class="nav-item">
                                  <a class="nav-link" id="other-offers-tab" data-toggle="tab" href="#other-offers" role="tab" aria-controls="other-offers" aria-selected="false">Other Offers <span class="bg-danger badge text-white">{{$bidOnOtherOfferCount}}</span></a>
                              </li>
                              <?php $bidOnOtherEnquiryCount = 0 ?>
                              	@foreach($bidonenquiries as $allbids4)
                               	<?php
                               	$otherenquiry_to_date4 = \App\Buyer::where('id', $allbids4->enquiry_id)->pluck('to_date')->first();
                               	$oestart4 = \Carbon\Carbon::now();
                               	$oeend4 = \Carbon\Carbon::parse($otherenquiry_to_date4); ?>
                                @if($allbids4->enquiry_id != '' && $allbids4->status == 'Ongoing' && $oeend4 > $oestart4)
                                <?php $bidOnOtherEnquiryCount+=1 ?>
                                @endif
                                @endforeach
                              <li class="nav-item">
                                  <a class="nav-link" id="other-enquiries-tab" data-toggle="tab" href="#other-enquiries" role="tab" aria-controls="other-offers" aria-selected="false">Other Enquiries <span class="bg-danger badge text-white">{{$bidOnOtherEnquiryCount}}</span></a>
                              </li>
                            </ul>
                              <div class="tab-content" id="defaultTabContent">
                                  <div class="tab-pane fade show active" id="my-offers" role="tabpanel" aria-labelledby="my-offers-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable" class="table">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Offer Product</th>
                                                <th>Buyer</th>
                                                <th>Time Left</th>
                                                <th>Turn</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonmyoffers->where('status', 'Ongoing') as $allbids)               
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
                                                    @if($moend < $mostart)
                                                      <td><span class="text-danger">Expired</span>
                                                      @elseif($mosecondleft < 300)<td class="text-white bg-danger"><span>{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S</span>
                                                      @else
                                                      <td><span class="text-success">{{$modurationd}}D {{$modurationh}}H {{$modurationm}}M {{$modurations}}S</span>
                                                      @endif</td>
                                                      <td>@if($moturn == 'bid')<span>Your Turn</span>@else <span>Waiting..</span>@endif</td>
                                                    <td>{{$allbids->status}}</td>
                                                    <td><a type="button" rel="tooltip"  class="btn btn-primary btn-round" data-toggle="tooltip" data-placement="top" title="Place Bid" href="{{ url('offerbid', [$allbids->offer_id]) }}"><i class="mdi mdi-gavel"></i></a></td>
                                                  </tr>
                                                  
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="my-enquiries" role="tabpanel" aria-labelledby="my-enquiries-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable2" class="table" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Enquiry Product</th>
                                                <th>Seller</th>
                                                <th>Time Left</th>
                                                <th>Turn</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonmyenquiries as $allbids)
                                              <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first();
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
                                              @if($allbids->enquiry_id != '' && $meend > $mestart && $allbids->status == 'Ongoing')
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>               
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  @if($meend < $mestart)
                                                    <td><span class="text-danger">Expired</span>
                                                    @elseif($mesecondleft < 300)<td class="text-white bg-danger"><span>{{$medurationd}}D {{$medurationh}}H {{$medurationm}}M {{$medurations}}S</span>
                                                    @else<td><span class="text-success">{{$medurationd}}D {{$medurationh}}H {{$medurationm}}M {{$medurations}}S</span>
                                                  @endif</td>
                                                  <td>@if($meturn == 'bid')<span>Your Turn</span>@else <span>Waiting..</span>@endif</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip"  class="btn btn-primary btn-round" data-toggle="tooltip" data-placement="top" title="Place Bid" href="{{ url('enquirybid', [$allbids->enquiry_id]) }}"><i class="mdi mdi-gavel"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="other-offers" role="tabpanel" aria-labelledby="other-offers-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable3" class="table table-bordered" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Date</th>
                                                <th>Offer Product</th>
                                                <th>Buyer</th>
                                                <th>Time Left</th>
                                                <th>Turn</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonoffers as $allbids)
                                              <?php $product_name = \App\Seller::where('id', $allbids->offer_id)->pluck('product_name')->first();
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first();
                                                  $otheroffer_to_date = \App\Seller::where('id', $allbids->offer_id)->pluck('to_date')->first();
                                                  $oostart = \Carbon\Carbon::now();
                                                  $ooend = \Carbon\Carbon::parse($otheroffer_to_date);
                                                  $oodurationd = $ooend->diffInDays($oostart);
                                                  $oodurationh = $ooend->diffInHours($oostart)-($oodurationd*24);
                                                  $oodurationm = $ooend->diffInMinutes($oostart)-($ooend->diffInHours($oostart)*60);
                                                  $oodurations = $ooend->diffInSeconds($oostart)-($ooend->diffInMinutes($oostart)*60);
                                                  $oosecondleft = $ooend->diffInSeconds($oostart);
                                                  $ooturn = \App\Finalbid::where('seller_id', $allbids->seller_id)->where('offer_id', $allbids->offer_id)->orderBy('id', 'DESC')->pluck('bidtype')->first(); ?>
                                                  @if($allbids->offer_id != '' && $allbids->status == 'Ongoing' && $ooend > $oostart)
                                                <tr>
                                                  <td>{{$allbids->created_at}}</td>                
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  @if($ooend < $oostart)
                                                  <td>
                                                    <span class="text-danger">Expired</span>
                                                    @elseif($oosecondleft < 300)<td class="text-white bg-danger"><span>{{$oodurationd}}D {{$oodurationh}}H {{$oodurationm}}M {{$oodurations}}S</span>
                                                    @else<td><span class="text-success">{{$oodurationd}}D {{$oodurationh}}H {{$oodurationm}}M {{$oodurations}}S
                                                    </span>
                                                  @endif</td>
                                                  <td>@if($ooturn == 'bid')<span>Waiting..</span>@else <span>Your Turn</span>@endif</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip"  class="btn btn-primary btn-round" data-toggle="tooltip" data-placement="top" title="Place Bid" href="{{ url('bidbybuyer', [$allbids->offer_id, $allbids->seller_id, $allbids->buyer_id]) }}"><i class="mdi mdi-gavel"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="other-enquiries" role="tabpanel" aria-labelledby="other-enquiries-tab">
                                      <div class="table-responsive">
                                        <table id="default-datatable4" class="table table-bordered" style="width: 100%">
                                            <thead>
                                              <tr>
                                                <th>Favourite</th>
                                                <th>Date</th>
                                                <th>Enquiry Product</th>
                                                <th>Seller</th>
                                                <th>Time Left</th>
                                                <th>Turn</th>
                                                <th>Status</th>
                                                <th data-orderable="false">Quick Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($bidonenquiries as $allbids)
                                                
                                                  <?php $product_name = \App\Buyer::where('id', $allbids->enquiry_id)->pluck('product_name')->first();                   
                                                  $seller_name = \App\Profile::where('user_id', $allbids->seller_id)->pluck('company_name')->first();
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
                                                   @if($allbids->enquiry_id != '' && $allbids->status == 'Ongoing' && $oeend > $oestart)
                                                  <tr>
                                                    <td></td>
                                                  <td>{{$allbids->created_at}}</td>
                                                  <td>{{$product_name}}</td>
                                                  <td>{{$seller_name}}</td>
                                                  @if($oeend < $oestart)
                                                    <td><span class="text-danger">Expired</span>
                                                    @elseif($oesecondleft < 300)<td class="text-white bg-danger"><span>{{$oedurationd}}D {{$oedurationh}}H {{$oedurationm}}M {{$oedurations}}S</span>
                                                    @else
                                                    <td><span class="text-success">{{$oedurationd}}D {{$oedurationh}}H {{$oedurationm}}M {{$oedurations}}S</span>
                                                    @endif</td>
                                                  <td>@if($oeturn == 'bid')<span>Waiting..</span>@else <span>Your Turn</span>@endif</td>
                                                  <td>{{$allbids->status}}</td>
                                                  <td><a type="button" rel="tooltip"  class="btn btn-primary btn-round" data-toggle="tooltip" data-placement="top" title="Place Bid" href="{{ url('bidbyseller', [$allbids->enquiry_id, $allbids->buyer_id, $allbids->seller_id]) }}"><i class="mdi mdi-gavel"></i></a></td>
                                                </tr>
                                              @endif
                                              @endforeach
                                            </tbody>
                                        </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
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