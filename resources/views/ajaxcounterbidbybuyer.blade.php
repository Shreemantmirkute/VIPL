@foreach($buyers as $buyer)
@if ($loop->last)
      <?php
          $b1 = \App\Finalbid::where('enquiry_id', $buyer->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
          $b2 = \App\Finalbid::where('enquiry_id', $buyer->id)->where('status', 'Completed')->pluck('new_unit')->first(); 
          $company_name12 = \App\Profile::where('user_id', $seller_user_id)->pluck('company_name')->first();
          $img1 = \App\Profile::where('user_id', $seller_user_id)->pluck('company_logo')->first(); ?>
          
      
<?php $xyz1 = 1; ?>
      <div class="chat-detail">
                            <div class="chat-head">
                                <ul class="list-unstyled mb-0">
                                    <li class="media">
                                        <img class="align-self-center mr-3 rounded-circle" src="{{ asset('/imageupload/profile/'.$img1) }}" alt="NA" width="50px" height="50px"> <!--need buyer company logo-->
                                        <div class="media-body">
                                            <h5 class="font-18">{{$company_name12}}</h5> <!--need buyer name here-->
                                            <p class="mb-0">Seller</p> <!--need buyer or seller-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
              <div class="chat-body">

                      @foreach($bidonmyenquiries as $bidonmyenquiry)
                        @if($bidonmyenquiry->bidtype=='bid')
                          <div class="chat-message chat-message-left">
                        @else
                          <div class="chat-message chat-message-right">
                        @endif
                            <div class="chat-message-text">
                                <p><span>Price: </span><strong>{{$bidonmyenquiry->new_currency}}{{$bidonmyenquiry->new_price}}{{$bidonmyenquiry->new_perunit}}</strong></p>
                                <p><span>Quantity: </span><strong>{{$bidonmyenquiry->new_quantity}}{{$bidonmyenquiry->new_unit}}</strong></p>
                              <p><span>Instructions: </span>{{$bidonmyenquiry->instruction}}</p>
                            </div>
                            <div class="chat-message-meta">
                                <span>{{$bidonmyenquiry->created_at}} <i class="feather icon-check ml-2"></i></span>
                            </div>
                            {{$xyz1}} {{$bidonmyenquiries->count()}}
                            <?php $hidden="hidden"; ?>     
                         @if($bidonmyenquiry->status == 'Ongoing')
                              @if($xyz1 == $bidonmyenquiries->count() && $bidonmyenquiry->bidtype=='bid')
                              <?php $hidden="hidden"; ?>
                              <div class="text-center" role="group" aria-label="Basic example">
                                  <button class="btn btn-primary text-white" id="counterbid-bottom">Counter Bid</button>
                                  <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidonmyenquiry->id]) }}">Accept
                                  </a>
                                  <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidonmyenquiry->id]) }}">Reject
                                  </a>
                              </div>
                              @endif
                            @endif
                            <?php $xyz1++; ?>
                        </div>
                        @if($bidonmyenquiry->status == 'Completed')
                          @if($bidonmyenquiry->admin_confirmation == 'Pending')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Bid Accepted Waiting For Admin Approval
                            </div>
                          @endif
                          @if($bidonmyenquiry->admin_confirmation == 'Approved')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              Bid Accepted Approved By Admin
                            </div>                     
                          @endif
                          @if($bidonmyenquiry->admin_confirmation == 'Disapproved')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Bid Accepted Disapproved By Admin       
                            </div>                 
                          @endif
                        @elseif($bidonmyenquiry->status == 'Decline')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Bid Declined       
                            </div>
                        @endif
                      @endforeach
                
                </div>  

                <div class="chat-bottom d-none" id="chat-bottom">
                    <div class="chat-messagebar">
                        <form method="POST" id="mymodalform234">
                          
                          <div class="form-row">
                              <div class="input-group mb-3 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $bidonmyenquiry->new_currency }}</span>
                                </div>
                                <input type="text" class="form-control" name="new_price" value="{{ $bidonmyenquiry->new_price }}" required="required" placeholder="Bid">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ $bidonmyenquiry->new_perunit }}</span>
                                </div>
                                </div>
                                <div class="input-group mb-3 col-md-6">
                                      <input type="number" class="form-control" name="new_quantity" value="{{ $bidonmyenquiry->new_quantity }}" min="{{$buyer->minimum_order_quantity}}" max="{{$buyer->quantity-$b1}}" required="required" placeholder="Quantity">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ $bidonmyenquiry->new_unit }}</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-row">
                              <div class="input-group mb-3 col-md-12">
                                <input placeholder="Please type any instruction" class="form-control"  type="text" name="instruction">
                                    <div class="input-group-append">
                                        <input class="btn btn-success"  type="submit" name="submit" style="border-radius:unset !important">
                                    </div>
                                </div>
                                <input type="hidden" class="d-none" name="new_currency" value="{{ $bidonmyenquiry->new_currency }}">
                                <input type="hidden" class="d-none" name="new_perunit" value="{{ $bidonmyenquiry->new_perunit }}" >
                                <input type="hidden"  name="enquiry_id" value="{{ $bidonmyenquiry->enquiry_id }}" class="d-none">
                                <input type="hidden"  name="bid_tracker" value="{{ $bidonmyenquiry->bid_tracker }}" class="d-none">
                                <input type="hidden"  name="seller_id"  value="{{ $bidonmyenquiry->created_by }}" class="d-none">
                                <input type="hidden"  name="buyer_id"  value="{{ Auth::user()->id }}" class="d-none">  
                                <input type="hidden" class="d-none" name="new_unit" value="{{ $bidonmyenquiry->new_unit }}" >
                
                
                           </div>
                        </form>
                    </div>
                </div>
            </div>
@endif
@endforeach
        <!-- Chat js -->
    <script src="../admin_assets/js/custom/custom-chat.js"></script>
    <script src="../admin_assets/plugins/pnotify/js/pnotify.custom.min.js"></script>

        <script type="text/javascript">
          $(document).ready(function() {
          $('#counterbid-bottom').click(function(){
        $('#chat-bottom').removeClass("d-none");
      });
          $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          
          $("#mymodalform234").on("submit", function (e) {
              var dataString = $(this).serialize();
               
              $.ajax({
                type: "POST",
                //url: "/ajax_start_counterbidding",
                url: '<?php echo url("/ajax_start_counterbidding"); ?>',
                data: dataString,
                success: function (data) {
                  enquiry_id = data['enquiry_id'];
                  seller_id = data['seller_id'];
                  buyer_id = data['buyer_id'];
                  new PNotify( {
                  title: 'Success notice', text: 'Counter-Bid Successfully Placed', type: 'success'
                  });
                 $('#mytab').load('<?php echo url("/ajaxcounterbidbybuyer/'+enquiry_id+'/'+buyer_id+'/'+seller_id+'"); ?>');
                }
              });  
                       
              e.preventDefault();
          });
          });
  </script>