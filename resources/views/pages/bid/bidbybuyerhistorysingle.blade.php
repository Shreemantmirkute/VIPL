<!DOCTYPE html>
<html lang="en">
  @include('new_head')
  <body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar">
      <!-- Start Leftbar -->
      @include('admin/new_sidebar')
      <div class="rightbar">
        <!-- Start Topbar Mobile -->
        @include('admin/new_header')
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
              <h4 class="page-title">Bidding Trails (Buyer)</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('/admin/admin-bidaccepted-view') }}" onclick="history.go(-1)">Accepted Bids</a></li>
                  <li class="breadcrumb-item"><a href="" onclick="history.go(-1)">Accepted Bids Single View</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Bidding Trails</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
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
              <div class="col-md-12">
                <div class="card m-b-30">
                  <div class="card-header card-header-primary">
                    <h5 class="card-title">Bidding Trails (Buyer)</h5>
                    <p class="card-category">Below are the bidding trails with seller.</p>
                  </div>
                  <div class="card-body">
                    @foreach($sellers as $buyer)
                    @if(1 != 0)
                    <div class="chat-detail">
                      <div class="chat-body">
                        <?php
                        $xyz1 = 1;
                        $xyz2 = 1;
                        ?>
                        
                        @foreach($bidbysellers as $bidbyseller)
                        @if($bidbyseller->bidtype=='bid')
                          <div class="chat-message chat-message-right">
                        @else
                          <div class="chat-message chat-message-left">
                            @endif
                            <div class="chat-message-text">
                              @foreach($profiles as $profile)
                                @if($bidbyseller->bidtype == 'bid')
                                  @if($profile->user_id == $bidbyseller->seller_id)
                                    <div class="avatar">
                                      <img class="align-self-center mr-3 rounded-circle" style="width:50px;height:50px" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                    </div>
                                    <div class="text text-l">
                                      <h5 class="title-chat font-weight-bold">
                                      {{$bidbyseller->bidtype}} by {{$profile->company_name}}
                                      </h5>
                                  @endif
                                @else
                                  @if($profile->user_id == $bidbyseller->buyer_id)
                                    <div class="avatar">
                                      <img class="align-self-center mr-3 rounded-circle" style="width:50px;height:50px" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                    </div>
                                    <div class="text text-l">
                                      <h5 class="title-chat font-weight-bold">
                                      {{$bidbyseller->bidtype}} by {{$profile->company_name}}
                                      </h5>
                                  @endif
                                @endif
                              @endforeach
                                      <p><span>Price: </span>{{$bidbyseller->new_currency}} {{$bidbyseller->new_price}} {{$bidbyseller->new_perunit}} &nbsp;&nbsp;<span>Quantity: </span>{{$bidbyseller->new_quantity}} {{$bidbyseller->new_unit}}</p>
                                      <p><span>Instructions: </span>{{$bidbyseller->instruction}}</p>
                                      <?php
                                      $abcd = \App\Bidaccept::where('seller_id', $buyer->id)->where('buyer_user_id', Auth::user()->id)->count();
                                      ?>
                                      @if($abcd == 0)
                                        <?php
                                        $xyz1 = $xyz1+1;
                                        ?>
                                      @else
                                        <?php
                                        $xyz2 = $xyz2+1;
                                        ?>
                                      @endif
                                      @if($bidbyseller->status == 'Ongoing')
                                        <p><small>{{$bidbyseller->created_at}}</small></p>
                                      @elseif($bidbyseller->status == 'Approved')
                                        <p><small>{{$bidbyseller->created_at}}</small></p>
                                      @else
                                        <p><small>{{$bidbyseller->created_at}}</small></p>
                                      @endif
                                </div>
                              </div>
                            </div>
                              @if($bidbyseller->status == 'Completed')
                                @if($bidbyseller->admin_confirmation == 'Pending')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                  Bid Accepted Waiting For Admin Approval
                                </div>
                                @endif
                                @if($bidbyseller->admin_confirmation == 'Approved')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  Bid Accepted Approved By Admin
                                </div>
                                @endif
                                @if($bidbyseller->admin_confirmation == 'Disapproved')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  Bid Accepted Disapproved By Admin
                                </div>
                                @endif
                              @endif
                              @endforeach
                              
                            </div>
                            
                          </div>
                          @endif
                          </div>
                        </div>
                          @endforeach
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                @include('admin/new_footer')
        </div>
      </div>
            <!-- Start js -->
            <script src="{{ asset('admin_assets/js/jquery.min.js')}}"></script>
            <script src="{{ asset('admin_assets/js/popper.min.js')}}"></script>
            <script src="{{ asset('admin_assets/js/bootstrap.min.js')}}"></script>
            <script src="{{ asset('admin_assets/js/modernizr.min.js')}}"></script>
            <script src="{{ asset('admin_assets/js/detect.js')}}"></script>
            <script src="{{ asset('admin_assets/js/jquery.slimscroll.js')}}"></script>
            <script src="{{ asset('admin_assets/js/vertical-menu.js')}}"></script>
            
            <!-- Chat js -->
            <script src="{{ asset('admin_assets/js/custom/custom-chat.js')}}"></script>
            <script src="{{ asset('admin_assets/plugins/pnotify/js/pnotify.custom.min.js')}}"></script>
            <!-- Slick js -->
            <script src="{{ asset('admin_assets/plugins/slick/slick.min.js')}}"></script>
            <!-- Sweet-Alert js -->
            <script src="{{ asset('admin_assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
            <script src="{{ asset('admin_assets/js/custom/custom-sweet-alert.js')}}"></script>
            
            <!-- Core js -->
            <script src="{{ asset('admin_assets/js/core.js')}}"></script>
          </body>
        </html>