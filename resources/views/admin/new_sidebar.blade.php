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
                        <li>
                            <a href="{{ url('admin') }}">
                              <i class="mdi mdi-view-dashboard-outline" style="color:#717c99"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/users') }}">
                                <i class="mdi mdi-account-group" style="color:#717c99"></i><span>Users</span> <span class="badge badge-pill badge-danger">{{ session('pendingusers') }}</span>
                            </a>
                        </li>
                        <li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-cart-plus" style="color:#717c99"></i><span>Catalog</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						        <li><a href="{{ url('admin/category') }}">Category</a></li>
						        <li><a href="{{ url('admin/product') }}">Product</a></li>
						        <li><a href="{{ url('admin/subproduct') }}">Sub Product</a></li>
						    </ul>
						</li>
                        <li>
                            <a href="{{ url('admin/admin-product') }}">
                                <i class="mdi mdi-cart" style="color:#717c99"></i><span>Sub-Products </span><span class="badge badge-pill badge-danger"><?php echo \App\Item::where('status', 'Pending')->count(); ?></span>
                            </a>
                        </li> 
                        <li>
                            <a href="{{ url('admin/admin-offer-view') }}">
                                <i class="mdi mdi-animation-outline" style="color:#717c99"></i><span>Offer/Enquiry</span><!--<span class="badge badge-pill badge-danger"><?php echo \App\Seller::where('status', 'Pending')->count(); ?></span>-->
                            </a>
                        </li> 
                      <!--  <li>
                            <a href="{{ url('admin/admin-enquiry-view') }}">
                                <i class="mdi mdi-animation-outline" style="color:#717c99"></i><span>Enquiry (Buy)</span><span class="badge badge-pill badge-danger"><?php echo \App\Buyer::where('status', 'Pending')->count(); ?></span>
                            </a>
                        </li> -->
                        
                         <li>
                            <a href="{{ url('admin/admin-ongoing-view') }}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Ongoing Bid</span><!--<span class="badge badge-pill badge-danger"><?php echo \App\Finalbid::where('admin_confirmation', 'Pending')->where('status', 'Completed')->count(); ?></span>-->
                            </a>
                        </li> 
                        
                          <li>
                            <a href="{{ url('admin/admin-bidcompleted-view') }}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Completed Bid</span><span class="badge badge-pill badge-danger"><?php echo \App\Finalbid::where('status', 'Completed')->where('admin_confirmation', 'Pending')->count(); ?></span>
                            </a>
                        </li> 
                        <li>
                            <a href="{{ url('admin/admin-bidaccepted-view') }}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Accepted Bid</span><span class="badge badge-pill badge-danger"><?php echo \App\Finalbid::where('admin_confirmation', 'Approved')->where('status', 'Completed')->count(); ?></span>
                            </a>
                        </li> 
                        
                       <!-- <li>
                            <a href="{{url('admin/admin-ongoingbid')}}">
                                <i class="mdi mdi-gavel" style="color:#717c99"></i><span>Ongoing Bids</span>
                               
                            </a>
                        </li>-->
                        
                        <li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-chart-bar-stacked" style="color:#717c99"></i><span>Reports</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						        <li><a href="{{ url('admin/top-buyers') }}">Top Buyers</a></li>
						        <li><a href="{{ url('admin/top-sellers') }}">Top Sellers</a></li>
						        <li><a href="{{ url('admin/daily-sales') }}">Daily Sales</a></li>
						        <li><a href="{{ url('admin/amount-wise-turnover') }}">Amount Wise Turnover</a></li>
                                <li><a href="{{ url('admin/admin-final-report') }}">Final Report</a></li>
						    </ul>
						</li>
                        <li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-web" style="color:#717c99"></i><span>Web Master</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						        <li><a href="{{ url('admin/add-news') }}">News</a></li>
						        <li><a href="{{ url('admin/add-event') }}">Event</a></li>
						        <li><a href="{{ url('admin/add-blog') }}">Blog</a></li>
						        <li><a href="{{ url('admin/informationpage') }}">Information Pages</a></li>
						    </ul>
						</li>
						<li>
						    <a href="javaScript:void();">
						        <i class="mdi mdi-settings" style="color:#717c99"></i><span>Masters</span><i class="feather icon-chevron-right pull-right"></i>
						    </a>
						    <ul class="vertical-submenu">
						        <li><a href="{{ url('admin/currency') }}">Currency</a></li>
						        <li><a href="{{ url('admin/country') }}">Country</a></li>
						        <li><a href="{{ url('admin/state') }}">State</a></li>
						        <li><a href="{{ url('admin/businesstype') }}">Business Type</a></li>
						        <li><a href="{{ url('admin/unit') }}">Unit</a></li>
						        <li><a href="{{ url('admin/taxclass') }}">Taxclass</a></li>
						        <li><a href="{{ url('admin/role') }}">Role</a></li>
						    </ul>
						</li>
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->