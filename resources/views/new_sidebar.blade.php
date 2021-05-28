<!-- Start Leftbar -->
        <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="{{ url('/user_dashboard') }}" class="logo logo-large"><img src="{{ asset('admin_theme_assets/img/logoblack.png') }}" class="img-fluid" alt="logo"></a>
                    <a href="{{ url('/user_dashboard') }}" class="logo logo-small"><img src="{{ asset('admin_theme_assets/img/logoblack.png') }}" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <ul class="vertical-menu">
                        
                        <?php $role = Auth::user()->status;
                        //dd($role);
                       // exit();
                        ?>
                        @if($role == 'Pending')
                        <li>
                            <a href="{{ url('/user_dashboard') }}">
                              <i class="mdi mdi-view-dashboard-outline" style="color:#717c99"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/add_product') }}">
                                <i class="mdi mdi-cart-plus" style="color:#717c99"></i><span>Product</span>
                            </a>
                        </li>
                          <li>
                            <a href="{{url('/add_user')}}">
                                <i class="mdi mdi-account-group" style="color:#717c99"></i><span>Manage Users</span>
                            </a>
                        </li>
                         @else
                           <li>
                            <a href="{{ url('/user_dashboard') }}">
                              <i class="mdi mdi-view-dashboard-outline" style="color:#717c99"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/add_product') }}">
                                <i class="mdi mdi-cart-plus" style="color:#717c99"></i><span>Product</span>
                            </a>
                        </li>
                          <li>
                            <a href="{{url('/add_user')}}">
                                <i class="mdi mdi-account-group" style="color:#717c99"></i><span>Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/enquiry-offer-view')}}">
                                <i class="mdi mdi-animation-outline" style="color:#717c99"></i><span>Enquiry/Offer
                                 <!--<span class="badge badge-pill badge-danger">-->
                                <?php
                                /* $productname1 =\App\Item::where('created_by', Auth::user()->id)->where('register_as', 'Buyer')->get()->pluck('product')->toArray();
     

                                 $productname2 = \App\Item::where('register_as', 'Seller')->where('created_by', Auth::user()->id)->get()->pluck('product')->toArray();
                                
                                
                                 $availableproducts_one = \App\Seller::join('profiles','profiles.user_id','=','sellers.created_by')->select('profiles.factory_state','sellers.*')->whereIn('product_name', $productname1)->get();
                                $availableproducts_two = \App\Buyer::join('profiles','profiles.user_id','=','buyers.created_by')->select('profiles.factory_state','buyers.*')->whereIn('product_name', $productname2)->get();
                                
                                 $h = count($availableproducts_one) + count($availableproducts_two);
                                    echo $h;*/
                                
                                ?>
                                
                               <!-- </span>-->
                                </span>
                            </a>
                        </li>
                          <li>
                            <a href="{{ url('/order-book-seller') }}">
                              <i class="mdi mdi-view-dashboard-outline" style="color:#717c99"></i><span>Order Book(Seller)</span>
                            </a>
                        </li>
                          <li>
                            <a href="{{ url('/order-book-buyer') }}">
                              <i class="mdi mdi-view-dashboard-outline" style="color:#717c99"></i><span>Order Book(Buyer)</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/new-ongoingbid')}}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Ongoing Bids
                              <span class="badge badge-pill badge-danger">
                                <?php
                                
                                // $bidonoffers = \App\Finalbid::where('buyer_id', Auth::user()->id)->get();
                                // $bidonenquiries = \App\Finalbid::where('seller_id', Auth::user()->id)->get();
                                 $myoffers = \App\Seller::where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
                                 $myenquiries = \App\Buyer::where('created_by', Auth::user()->id)->get()->pluck('id')->toArray();
                                 $bidonoffers = \App\Finalbid::where('buyer_id', Auth::user()->id)->orderBy('id', 'desc')->get()->unique('bid_tracker');
                                $bidonenquiries =\App\Finalbid::where('seller_id', Auth::user()->id)->orderBy('id', 'desc')->get()->unique('bid_tracker');
                                $bidonmyoffers =\App\Finalbid::whereIn('offer_id', $myoffers)->orderBy('id', 'desc')->get()->unique('bid_tracker');
                                $bidonmyenquiries = \App\Finalbid::whereIn('enquiry_id', $myenquiries)->orderBy('id', 'desc')->get()->unique('bid_tracker');
                                                        
                                 $bidOnMyOfferCount = 0; 
                            	foreach($bidonmyoffers->where('status', 'Ongoing') as $bomoc) {             
                               
                                $myoffer_to_date1 = \App\Seller::where('id', $bomoc->offer_id)->pluck('to_date')->first();
                                $mostart1 = \Carbon\Carbon::now();
                                $moend1 = \Carbon\Carbon::parse($myoffer_to_date1); 
                                if($bomoc->offer_id != '' && $mostart1 < $moend1){
                                 $bidOnMyOfferCount+=1; }
                            	}
                            	
                            	 $bidOnMyEnquiryCount = 0; 
                              	foreach($bidonmyenquiries as $bomec){
                                
                                $myenquiry_to_date2 = \App\Buyer::where('id', $bomec->enquiry_id)->pluck('to_date')->first();
                                $mestart2 = \Carbon\Carbon::now();
                                $meend2 = \Carbon\Carbon::parse($myenquiry_to_date2); 
                                if($bomec->enquiry_id != '' && $meend2 > $mestart2 && $bomec->status == 'Ongoing'){
                                 $bidOnMyEnquiryCount+=1; }
                              	}
                              	
                              $bidOnOtherOfferCount = 0; 
                              foreach($bidonoffers as $allbids3){
                              
                               $otheroffer_to_date3 = \App\Seller::where('id', $allbids3->offer_id)->pluck('to_date')->first();
                               $oostart3 = \Carbon\Carbon::now();
                               $ooend3 = \Carbon\Carbon::parse($otheroffer_to_date3); 
                               if($allbids3->offer_id != '' && $allbids3->status == 'Ongoing' && $ooend3 > $oostart3){
                               $bidOnOtherOfferCount+=1; }
                              }
                              
                               $bidOnOtherEnquiryCount = 0; 
                              	foreach($bidonenquiries as $allbids4){
                               
                               	$otherenquiry_to_date4 = \App\Buyer::where('id', $allbids4->enquiry_id)->pluck('to_date')->first();
                               	$oestart4 = \Carbon\Carbon::now();
                               	$oeend4 = \Carbon\Carbon::parse($otherenquiry_to_date4);
                                if($allbids4->enquiry_id != '' && $allbids4->status == 'Ongoing' && $oeend4 > $oestart4){
                                $bidOnOtherEnquiryCount+=1; }
                              	}
                              	
                              	$totalcount = $bidOnMyOfferCount + $bidOnMyEnquiryCount + $bidOnOtherOfferCount + $bidOnOtherEnquiryCount;
                                 
                                 
                                 
                                // $g = count($bidonoffers) + count($bidonenquiries);
                                    echo $totalcount;
                                ?>
                                </span>
                                </span>
                                <!-- <div class="spinner-grow text-success" role="status" style="width: 0.5rem;height: 0.5rem;vertical-align:text-top;,margin-left: 5px;">
                                    <span class="sr-only">Loading...</span>
                                </div> -->
                            </a>
                        </li>
                       <!-- <li>
                            <a href="{{url('/new-acceptedbid')}}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Order Book</span>
                            </a>
                        </li>-->
                       <!-- <li>
                            <a href="{{url('/admin-bids-approved')}}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Bids Admin Approved</span>
                            </a>
                        </li>-->
                       <!--  <li>
                            <a href="{{url('/product-wise-buyer-seller')}}">
                                <i class="mdi mdi-account-group" style="color:#717c99"></i><span>Productwise</span>
                            </a>
                        </li>-->
                        <!--<li>
                            <a href="{{url('/new-rejectedbid')}}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Rejected Bids</span>
                            </a>
                        </li>-->
                      
                        
                        
                        <!-- <li>
                            <a href="{{url('/report')}}">
                                <i class="mdi mdi-graphql" style="color:#717c99"></i><span>Top Buyers </span>
                            </a>
                        </li> -->
                        
                        
                        <li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-chart-bar-stacked" style="color:#717c99"></i><span>Information</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						        <?php
						        $infopages = Session::get('informationpages')
						        ?>
						         @foreach($infopages as $informationpage)
                                    <li><a href="{{url('/user-information')}}">{{$informationpage->title}}</a></li>

                                @endforeach   
						       
						    </ul>
						</li>
                        
                        
                          <li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-chart-bar-stacked" style="color:#717c99"></i><span>Reports</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						       <!-- <li><a href="{{ url('admin/top-buyers') }}">Top Buyers</a></li>
						        <li><a href="{{ url('admin/top-sellers') }}">Top Sellers</a></li>
						        <li><a href="{{ url('admin/daily-sales') }}">Daily Sales</a></li>
						        <li><a href="{{ url('admin/amount-wise-turnover') }}">Amount Wise Turnover</a></li>-->
                                <li><a href="{{ url('/userfinalreport') }}">Customized Reports</a></li>
                                <li><a href="{{ url('/report') }}">Top Buyers & Sellers</a></li>
                                <li><a href="{{ url('/product-wise-buyer-seller') }}">Productwise</a></li>
                                <li><a href="{{ url('/new-acceptedbid') }}">Completed Bids 
                                <span class="badge badge-pill badge-danger">
                                    <?php
                                    
                                     $bidonoffers = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->get();
                                    $bidonenquiries = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->get();
                                    
                                    $d = count($bidonoffers) + count($bidonenquiries);
                                    echo $d;
                                    
                                    ?>
                                    </span>
                                    </a>
                                    </li>
                                 <li><a href="{{ url('/new-rejectedbid') }}">Rejected Bids <span class="badge badge-pill badge-danger"> <?php
                                     
                                     $bidonoffers = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Decline')->get();
                                    $bidonenquiries = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Decline')->get();
                                    
                                    $f = count($bidonoffers) + count($bidonenquiries);
                                    echo $f;
                                    
                                    ?>

                                    </span></a></li>
                                <!-- <li><a href="{{ url('/new-acceptedbid-approved') }}">Accepted Bids</a></li>-->
                                 <li><a href="{{ url('/admin-bids-approved') }}">Accepted Bids <span class="badge badge-pill badge-danger"> <?php
                                     
                                     $bidonoffers = \App\Finalbid::where('buyer_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
                                    $bidonenquiries = \App\Finalbid::where('seller_id', Auth::user()->id)->where('status', 'Completed')->where('admin_confirmation', 'Approved')->get();
                                    
                                    $e = count($bidonoffers) + count($bidonenquiries);
                                    echo $e;
                                    
                                    ?></span></a></li>
                                 @endif 
						    </ul>
						</li>
                        <li style="background:#BBFFD8">
                          <a href="https://api.whatsapp.com/send?phone=+917503603844&amp;text=Hey" target="_blank">
                            <i class="mdi mdi-whatsapp" style="color:#717c99"></i><span>Chat with Support</span>
                        </a>
                      </li>
                      <!--  <li>
                            <a href="{{url('/userfinalreport')}}">
                                <i class="mdi mdi-chart-bar-stacked" style="color:#717c99"></i><span>Customized Reports</span>
                            </a>
                        </li>-->
                        <!-- <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/advanced.svg" class="img-fluid" alt="advanced"><span>Advanced UI</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">                                
                                <li><a href="advanced-ui-kits-image-crop.html">Image Crop</a></li>  
                                <li><a href="advanced-ui-kits-jquery-confirm.html">jQuery Confirm</a></li>
                                <li><a href="advanced-ui-kits-nestable.html">Nestable</a></li>
                                <li><a href="advanced-ui-kits-pnotify.html">Pnotify</a></li>
                                <li><a href="advanced-ui-kits-range-slider.html">Range Slider</a></li>
                                <li><a href="advanced-ui-kits-ratings.html">Ratings</a></li>
                                <li><a href="advanced-ui-kits-session-timeout.html">Session Timeout</a></li>
                                <li><a href="advanced-ui-kits-sweet-alerts.html">Sweet Alerts</a></li>
                                <li><a href="advanced-ui-kits-switchery.html">Switchery</a></li>
                                <li><a href="advanced-ui-kits-toolbar.html">Toolbar</a></li>
                                <li><a href="advanced-ui-kits-tour.html">Tour</a></li>
                                <li><a href="advanced-ui-kits-treeview.html">Tree View</a></li>
                            </ul>
                        </li> -->                                   
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->