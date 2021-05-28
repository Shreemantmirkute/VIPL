            <!-- Start Topbar Mobile -->
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="index.html" class="mobile-logo"><img src="{{ asset('admin_theme_assets/img/logoblack.png')}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="{{ asset('admin_assets/images/svg-icon/horizontal.svg') }}" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="{{ asset('admin_assets/images/svg-icon/verticle.svg') }}" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="{{ asset('admin_assets/images/svg-icon/collapse.svg') }}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="{{ asset('admin_assets/images/svg-icon/close.svg') }}" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            
            <div class="topbar">
                <!-- Start row -->
                <div class="row align-items-center">
                    <!-- Start col -->
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                           <img src="{{ asset('admin_assets/images/svg-icon/collapse.svg') }}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                           <img src="{{ asset('admin_assets/images/svg-icon/close.svg') }}" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>
                                <!-- <li class="list-inline-item">
                                    <div class="searchbar">
                                        <form>
                                            <div class="input-group">
                                              <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon2"><img src="admin_assets/images/svg-icon/search.svg" class="img-fluid" alt="search"></button>
                                              </div>
                                            </div>
                                        </form>
                                    </div>
                                </li -->
                            </ul>
                        </div>
                        <div class="infobar">
                            <ul class="list-inline mb-0">
                                <!-- <li class="list-inline-item">
                                    <div class="settingbar">
                                        <a href="javascript:void(0)" id="infobar-settings-open" class="infobar-icon">
                                            <img src="admin_assets/images/svg-icon/settings.svg" class="img-fluid" alt="settings">
                                        </a>
                                    </div>
                                </li> -->
                                <li class="list-inline-item">
                                    <div class="notifybar">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle infobar-icon" href="#" role="button" id="notoficationlink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('admin_assets/images/svg-icon/notifications.svg') }}" class="img-fluid" alt="notifications">
                                            <span class="live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="notoficationlink">
                                                <div class="notification-dropdown-title">
                                                    <h4>Notifications</h4>                            
                                                </div>
                                                <!-- <span class="text-center">No Notification</span> -->
                                                <ul class="list-unstyled"> 
                                                    <?php
                                                    $user = App\User::find(Auth::user()->id); ?>
                                                    @foreach($user->notifications as $notifi)                                       
                                                    <li class="media dropdown-item">
                                                        <span class="action-icon badge badge-primary-inverse"><i class="feather icon-dollar-sign"></i></span>
                                                        <div class="media-body">
                                                            <h5 class="action-title">{{$notifi->data['data']}}</h5>
                                                            <p><span class="timing">Today, 10:45 AM</span></p>                            
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <div class="notification-dropdown-title">
                                                    <a href="{{url('/clear_notification')}}" id="clear_notification">Clear All</a>                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>                                
                                <li class="list-inline-item">
                                    <div class="profilebar">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <? $img = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_logo')->first(); ?>
                                            <img src="{{ asset('/imageupload/profile/'.$img) }}" class="img-fluid" width="100%">
                                            <span class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink" style="min-width: 12rem !important;">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                      <h5><?php
                                                            $company_name = \App\Profile::where('user_id', Auth::user()->id)->pluck('company_name')->first();?>
                                                            {{ $company_name }}
                                                    </h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <!-- <li class="media dropdown-item">
                                                            <a href="{{ url('/user_profile') }}" class="profile-icon"><img src="admin_assets/images/svg-icon/user.svg" class="img-fluid" alt="user">My Profile</a>
                                                        </li> -->
                                                        <li class="media dropdown-item">
                                                            <a href="{{ url('/change_password') }}" class="profile-icon"><img src="{{ asset('admin_assets/images/svg-icon/email.svg')}}" class="img-fluid" alt="email">Change Password</a>
                                                        </li>                                                        
                                                        <li class="media dropdown-item">
                                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="profile-icon"><img src="{{ asset('admin_assets/images/svg-icon/logout.svg') }}" class="img-fluid" alt="logout">Logout</a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                            </form>
                                                        </li>
                  
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End col -->
                </div> 
                <!-- End row -->
            </div>
