 <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f05af0867771f3813c0a364/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
  <!--End of Tawk.to Script-->
  <style type="text/css">
    #left {
    color: #fff;
    text-align: center;
    position: fixed;
    left: 0em;
    bottom: 1em;
    z-index: 9999999;
  }


/*.sidebar[data-color="gold"] li.active>a {
    background-color: #deb302;
    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(156, 39, 176, 0.4);
}*/


  </style>
  <a href="https://api.whatsapp.com/send?phone=+917503603844&amp;text=Hey" id="left"><img src="http://vyapaarnetwork.com/public/admin_theme_assets/img/wp.png" width="80%"></a>
  <!--whatsapp -->
    <div class="sidebar" data-color="gold" data-background-color="white">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{ url('/user_dashboard') }}" class="simple-text logo-normal">
          <img src="{{ asset('admin_theme_assets/img/logov2.png') }}" height="60px" />
       </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <? $img = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_logo')->first(); ?>
            <img src="{{ asset('/imageupload/profile/'.$img) }}" width="100%">
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php
                $company_name = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_name')->first();?>
                {{ $company_name }}
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/user_profile') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/change_password') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal"> Change Password </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal"> Logout </span>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <!-- <li class="nav-item dashboard2">
            <a class="nav-link" href="{{url('/add-enquiry-offer')}}">
              <i class="material-icons">description</i>
              <p>Add(Enquiry/Offer)</p>
            </a>
          </li> -->
          <li class="nav-item dashboard1">
            <a class="nav-link" href="{{ url('/user_dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <!-- <li class="nav-item droduct1">
            <a class="nav-link"  href="{{url('/demo')}}">
              <i class="material-icons">add_box</i>
              <p>Demo</p>
            </a>
          </li> -->
          @if(Auth::user()->status == 'Active')
          <li class="nav-item product1">
            <a class="nav-link" href="{{ url('/add_product') }}">
              <i class="material-icons">add_box</i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item enquiryoffer1">
            <a class="nav-link" href="{{url('/enquiry-offer-view')}}">
              <i class="material-icons">description</i>
              <p>Enquiry/Offer</p>
            </a>
          </li>
          <li class="nav-item acceptedbids">
            <a class="nav-link" href="{{url('/new-bidacceptance-view')}}">
              <span class="sidebar-mini"><i class="material-icons">gavel</i></span>
              <span class="sidebar-normal">Accepted Bids</span>
            </a>
          </li>
          <li class="nav-item newongoingbid">
            <a class="nav-link" href="{{url('/new-ongoingbid')}}">
              <span class="sidebar-mini"><i class="material-icons">gavel</i></span>
              <span class="sidebar-normal">Ongoing Bids</span>
            </a>
          </li>
         <!--  <li class="nav-item bproduct1">
            <a class="nav-link" href="{{ url('/bproduct_details') }}">
              <i class="material-icons">shopping_basket</i>
              <p>Buyers</p>
            </a>
          </li>
          <li class="nav-item sproduct1">
            <a class="nav-link" href="{{ url('/sproduct_details') }}">
              <i class="material-icons">storefrotn</i>
              <p>Sellers</p>
            </a>
          </li> -->
          
         <!--  <li class="nav-item offer">
            <a class="nav-link offer-link" data-toggle="collapse" href="#offer" aria-expanded="">
              <i class="material-icons">local_offer</i>
              <p> Offer
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse offer-collapse" id="offer" style="">
              <ul class="nav">
                <li class="nav-item add-offer">
                  <a class="nav-link" href="{{ url('/offer-view') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Add Offer</span>
                  </a>
                </li>
                <li class="nav-item offer-list">
                  <a class="nav-link" href="{{ url('/offer-list-view') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">List Offers</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> -->
          
         <!--  <li class="nav-item enquiry">
            <a class="nav-link enquiry-link" data-toggle="collapse" href="#enquiry" aria-expanded="">
              <i class="material-icons">description</i>
              <p> Enquiry
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse enquiry-collapse" id="enquiry" style="">
              <ul class="nav">
                <li class="nav-item add-enquiry">
                  <a class="nav-link" href="{{ url('/enquiry-view') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Add Enquiry</span>
                  </a>
                </li>
                <li class="nav-item enquiry-list">
                  <a class="nav-link" href="{{ url('/enquiry-list-view') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">List Enquiries</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> -->
        <!--   <li class="nav-item bids">
            <a class="nav-link bids-link" data-toggle="collapse" href="#bids" aria-expanded="">
              <i class="material-icons">gavel</i>
              <p> Bids
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse bids-collapse" id="bids" style="">
              <ul class="nav">
                <li class="nav-item accepted-bids">
                  <a class="nav-link" href="{{ url('/bidacceptance-view') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Accepted Bids</span>
                  </a>
                </li>
                <li class="nav-item ongoing-bids">
                  <a class="nav-link" href="{{ url('/ongoingbid') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Ongoing Bids</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> -->
          <li class="nav-item user1">
            <a class="nav-link" href="{{ url('/add_user') }}">
              <i class="material-icons">group_add</i>
              <p>Manage Users</p>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>


    <!-- Start Leftbar -->
        <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="index.html" class="logo logo-large"><img src="admin_assets/images/logo.svg" class="img-fluid" alt="logo"></a>
                    <a href="index.html" class="logo logo-small"><img src="admin_assets/images/small_logo.svg" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <ul class="vertical-menu">
                        <li>
                            <a href="javaScript:void();">
                              <img src="admin_assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>Dashboard</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="index.html">CRM</a></li>
                                <li><a href="dashboard-ecommerce.html">eCommerce</a></li>
                                <li><a href="dashboard-hospital.html">Hospital</a></li>
                                <li><a href="dashboard-crypto.html">Crypto</a></li>
                                <li><a href="dashboard-school.html">School</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/basic.svg" class="img-fluid" alt="basic"><span>Basic UI</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="basic-ui-kits-alerts.html">Alerts</a></li>
                                <li><a href="basic-ui-kits-badges.html">Badges</a></li>
                                <li><a href="basic-ui-kits-buttons.html">Buttons</a></li>
                                <li><a href="basic-ui-kits-cards.html">Cards</a></li>
                                <li><a href="basic-ui-kits-carousel.html">Carousel</a></li>
                                <li><a href="basic-ui-kits-collapse.html">Collapse</a></li>
                                <li><a href="basic-ui-kits-dropdowns.html">Dropdowns</a></li>
                                <li><a href="basic-ui-kits-embeds.html">Embeds</a></li>
                                <li><a href="basic-ui-kits-grids.html">Grids</a></li>
                                <li><a href="basic-ui-kits-images.html">Images</a></li>
                                <li><a href="basic-ui-kits-media.html">Media</a></li>
                                <li><a href="basic-ui-kits-modals.html">Modals</a></li>
                                <li><a href="basic-ui-kits-paginations.html">Paginations</a></li>
                                <li><a href="basic-ui-kits-popovers.html">Popovers</a></li>
                                <li><a href="basic-ui-kits-progressbars.html">Progress Bars</a></li>
                                <li><a href="basic-ui-kits-spinners.html">Spinners</a></li>
                                <li><a href="basic-ui-kits-tabs.html">Tabs</a></li>   
                                <li><a href="basic-ui-kits-toasts.html">Toasts</a></li>     
                                <li><a href="basic-ui-kits-tooltips.html">Tooltips</a></li>
                                <li><a href="basic-ui-kits-typography.html">Typography</a></li>
                            </ul>
                        </li>
                        <li>
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
                        </li>
                        <li>
                            <a href="javaScript:void();">
                              <img src="admin_assets/images/svg-icon/apps.svg" class="img-fluid" alt="apps"><span>Apps</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="apps-calender.html">Calender</a></li>
                                <li><a href="apps-chat.html">Chat</a></li> 
                                <li>
                                    <a href="javaScript:void();">Email<i class="feather icon-chevron-right pull-right"></i></a>
                                    <ul class="vertical-submenu">
                                        <li><a href="apps-email-inbox.html">Inbox</a></li>
                                        <li><a href="apps-email-open.html">Open</a></li>
                                        <li><a href="apps-email-compose.html">Compose</a></li>
                                    </ul>
                                </li>
                                <li><a href="apps-kanban-board.html">Kanban Board</a></li>
                                <li><a href="apps-onboarding-screens.html">Onboarding Screens</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/form_elements.svg" class="img-fluid" alt="form_elements"><span>Forms</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="form-inputs.html">Basic Elements</a></li>
                                <li><a href="form-groups.html">Groups</a></li>
                                <li><a href="form-layouts.html">Layouts</a></li>
                                <li><a href="form-colorpickers.html">Color Pickers</a></li>
                                <li><a href="form-datepickers.html">Date Pickers</a></li>
                                <li><a href="form-editors.html">Editors</a></li>
                                <li><a href="form-file-uploads.html">File Uploads</a></li>
                                <li><a href="form-input-mask.html">Input Mask</a></li>
                                <li><a href="form-maxlength.html">MaxLength</a></li>
                                <li><a href="form-selects.html">Selects</a></li>
                                <li><a href="form-touchspin.html">Touchspin</a></li>
                                <li><a href="form-validations.html">Validations</a></li>
                                <li><a href="form-wizards.html">Wizards</a></li>
                                <li><a href="form-xeditable.html">X-editable</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/chart.svg" class="img-fluid" alt="chart"><span>Charts</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="chart-apex.html">Apex</a></li>
                                <li><a href="chart-c3.html">C3</a></li>
                                <li><a href="chart-chartistjs.html">Chartist</a></li> 
                                <li><a href="chart-chartjs.html">Chartjs</a></li>
                                <li><a href="chart-flot.html">Flot</a></li>
                                <li><a href="chart-knob.html">Knob</a></li>
                                <li><a href="chart-morris.html">Morris</a></li>
                                <li><a href="chart-piety.html">Piety</a></li>
                                <li><a href="chart-sparkline.html">Sparkline</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/icons.svg" class="img-fluid" alt="icons"><span>Icons</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="icon-svg.html">SVG</a></li>
                                <li><a href="icon-dripicons.html">Dripicons</a></li>
                                <li><a href="icon-feather.html">Feather</a></li>
                                <li><a href="icon-flag.html">Flag</a></li>  
                                <li><a href="icon-font-awesome.html">Font Awesome</a></li>
                                <li><a href="icon-ionicons.html">Ion</a></li>
                                <li><a href="icon-line-awesome.html">Line Awesome</a></li>
                                <li><a href="icon-material-design.html">Material Design</a></li>
                                <li><a href="icon-simple-line.html">Simple Line</a></li>
                                <li><a href="icon-socicon.html">Socicon</a></li>
                                <li><a href="icon-themify.html">Themify</a></li>
                                <li><a href="icon-typicons.html">Typicons</a></li> 
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/tables.svg" class="img-fluid" alt="tables"><span>Tables</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="table-bootstrap.html">Bootstrap</a></li>
                                <li><a href="table-datatable.html">Datatable</a></li>
                                <li><a href="table-editable.html">Editable</a></li>
                                <li><a href="table-footable.html">Foo</a></li>
                                <li><a href="table-rwdtable.html">RWD</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/maps.svg" class="img-fluid" alt="maps"><span>Maps</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="map-google.html">Google</a></li>
                                <li><a href="map-vector.html">Vector</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets.html">
                                <img src="admin_assets/images/svg-icon/widgets.svg" class="img-fluid" alt="widgets"><span>Widgets</span><span class="badge badge-success pull-right">New</span>
                            </a>
                        </li>                        
                        <li>
                            <a href="javaScript:void();">
                              <img src="admin_assets/images/svg-icon/pages.svg" class="img-fluid" alt="pages"><span>Pages</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li>
                                    <a href="javaScript:void();">Basic<i class="feather icon-chevron-right pull-right"></i></a>
                                    <ul class="vertical-submenu">
                                        <li><a href="page-starter.html">Starter</a></li>
                                        <li><a href="page-blog.html">Blog</a></li>
                                        <li><a href="page-faq.html">FAQ</a></li>
                                        <li><a href="page-gallery.html">Gallery</a></li>
                                        <li><a href="page-invoice.html">Invoice</a></li>
                                        <li><a href="page-pricing.html">Pricing</a></li>
                                        <li><a href="page-timeline.html">Timeline</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javaScript:void();">Authentications<i class="feather icon-chevron-right pull-right"></i></a>
                                    <ul class="vertical-submenu">
                                        <li><a href="user-login.html">Login</a></li>
                                        <li><a href="user-register.html">Register</a></li>
                                        <li><a href="user-forgotpsw.html">Forgot Password</a></li>
                                        <li><a href="user-lock-screen.html">Lock Screen</a></li>
                                        <li><a href="error-comingsoon.html">Coming Soon</a></li>  
                                        <li><a href="error-maintenance.html">Maintenance</a></li>
                                        <li><a href="error-404.html">Error 404</a></li>
                                        <li><a href="error-500.html">Error 500</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javaScript:void();">
                                <img src="admin_assets/images/svg-icon/ecommerce.svg" class="img-fluid" alt="ecommerce"><span>eCommerce</span><i class="feather icon-chevron-right pull-right"></i>
                            </a>
                            <ul class="vertical-submenu">
                                <li><a href="ecommerce-product-list.html">Product List</a></li>
                                <li><a href="ecommerce-product-detail.html">Product Detail</a></li>
                                <li><a href="ecommerce-order-list.html">Order List</a></li>
                                <li><a href="ecommerce-order-detail.html">Order Detail</a></li> 
                                <li><a href="ecommerce-shop.html">Shop</a></li>
                                <li><a href="ecommerce-single-product.html">Single Product</a></li>
                                <li><a href="ecommerce-cart.html">Cart</a></li>
                                <li><a href="ecommerce-checkout.html">Checkout</a></li>
                                <li><a href="ecommerce-thankyou.html">Thank You</a></li>
                                <li><a href="ecommerce-myaccount.html">My Account</a></li>
                            </ul>
                        </li>                                           
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->