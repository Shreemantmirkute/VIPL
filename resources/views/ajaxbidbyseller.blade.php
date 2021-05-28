@foreach($buyers as $buyer)
                  @if(1 != 0)
                    <?php
                            $b1 = \App\Finalbid::where('offer_id', $buyer->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                    $company_name1 = \App\Profile::where('user_id', $buyer_user_id)->pluck('company_name')->first();
                          $img1 = \App\Profile::where('user_id', $buyer_user_id)->pluck('company_logo')->first();
                  ?>
                  <div class="chat-detail">
                            <div class="chat-head">
                                <ul class="list-unstyled mb-0">
                                    <li class="media">
                                        <img class="align-self-center mr-3 rounded-circle" src="{{ asset('/imageupload/profile/'.$img1) }}" alt="NA" width="50px" height="50px"> <!--need buyer company logo-->
                                        <div class="media-body">
                                            <h5 class="font-18">{{$company_name1}}</h5> <!--need buyer name here-->
                                            <p class="mb-0">Buyer</p> <!--need buyer or seller-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                              <div class="chat-body">
                                <?php
                                $xyz1 = 1;
                                $xyz2 = 1;
                                ?>
                                @if($bidbysellers->count() == 0)
                                  <p>No Trails. Please Start Bidding!</p>
                                @else
                                @foreach($bidbysellers as $bidbyseller)
                                  @if($bidbyseller->bidtype=='bid')
                                    <div class="chat-message chat-message-right">
                                  @else
                                    <div class="chat-message chat-message-left">
                                  @endif
                                      <div class="chat-message-text">
                                          <p><span>Price: </span><strong>{{$bidbyseller->new_currency}}{{$bidbyseller->new_price}}{{$bidbyseller->new_perunit}}</strong></p>
                                          <p><span>Quantity: </span><strong>{{$bidbyseller->new_quantity}}{{$bidbyseller->new_unit}}</strong></p>
                                        <p><span>Instructions: </span>{{$bidbyseller->instruction}}</p>
                                      </div>
                                      <div class="chat-message-meta">
                                          <span>{{$bidbyseller->created_at}} <i class="feather icon-check ml-2"></i></span>
                                      </div>
                                      <?php $hidden="hidden"; ?>  
                                      <?php
                                          $abcd = \App\Bidaccept::where('seller_id', $buyer->id)->where('buyer_user_id', Auth::user()->id)->count();
                                          ?>   
                                       @if($abcd == 0)
                                            @if($xyz1 == $bidbysellers->count() && $bidbyseller->bidtype=='counterbid')
                                              @if($bidbyseller->status == 'Ongoing')
                                                <div class="text-center" role="group" aria-label="Basic example">
                                                    <button class="btn btn-primary text-white" id="counterbid-bottom">Place Bid</button>
                                                    <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidbyseller->id]) }}">Accept
                                                    </a>
                                                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidbyseller->id]) }}">Reject
                                                    </a>
                                                </div>
                                              @endif
                                              @else                        
                                            @endif
                                            <?php
                                            $xyz1 = $xyz1+1;
                                            ?>
                                        @else
                                        @if($xyz2 == $bids->count())
                                        @endif
                                        <?php
                                        $xyz2 = $xyz2+1;
                                        ?>
                                      @endif
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
                                    @if($bidbyseller->admin_confirmation == 'Rejected')
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Bid Disapproved By Admin       
                                      </div>                 
                                    @endif
                                  @elseif($bidbyseller->status == 'Decline')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Bid Declined      
                                    </div> 
                                  @else
                                  @endif
                                  @endforeach

                              </div>  
                  
                              <div class="chat-bottom d-none" id="chat-bottom">
                                <div class="chat-messagebar">
                                    <form method="POST" id="mymodalform2346">
                                      <div class="form-row">
                                            <div class="input-group mb-3 col-md-6">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $bidbyseller->new_currency }}</span>
                                                </div>
                                                  <input type="text" class="form-control" name="new_price" value="{{ $bidbyseller->new_price }}" required="required" placeholder="New Price">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ $bidbyseller->new_perunit }}</span>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3 col-md-6">
                                                  <input type="number" class="form-control" name="new_quantity" value="{{ $bidbyseller->new_quantity }}" min="{{$buyer->minimum_order_quantity}}" max="{{$buyer->quantity-$b1}}" required="required" placeholder="New Quantity">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ $bidbyseller->new_unit }}</span>
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
                                            <input type="hidden" class="d-none" name="new_currency" value="{{ $bidbyseller->new_currency }}">
                                            <input type="hidden" class="d-none" name="new_perunit" value="{{ $bidbyseller->new_perunit }}" >
                                            <input type="hidden"  name="enquiry_id" value="{{ $buyer->id }}" class="d-none">
                                            <input type="hidden"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                                            <input type="hidden"  name="buyer_id"  value="{{ $buyer->created_by }}" class="d-none">  
                                            <input type="hidden" class="d-none" name="new_unit" value="{{ $bidbyseller->new_unit }}" >
                            
                            
                                      </div>
                                    </form>
                                </div>
                            </div>
 @endif
                          
                    @endif
                  @endforeach

                  <script src="{{ asset('admin_assets/js/custom/custom-chat.js')}}"></script>
                 
                 <script type="text/javascript">
                      $(document).ready(function() {
                        
                      $('#counterbid-bottom').click(function(){
                    $('#chat-bottom').removeClass("d-none");
                     $('#chat-bottom').focus();
                  });
                      seller_id = $('#mydatafromcontroller1').val();
                      seller_user_id = $('#mydatafromcontroller2').val();
                      buyer_user_id = $('#mydatafromcontroller3').val();

                      $.ajaxSetup({
                          headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

                      $("#mymodalform2346").on("submit", function (e) {
                        var dataString = $(this).serialize();
                        
                        $.ajax({
                          type: "POST",
                          //url: "/ajax_start_counterbidding",
                          url: '<?php echo url("/ajax_start_bidding"); ?>',
                          data: dataString,
                          success: function (data) {

                             new PNotify( {
                            title: 'Success notice', text: 'Bid Successfully Placed', type: 'success'
                            });

                            $('#mytab').load('<?php echo url("/ajaxbidbyseller/'+seller_id+'/'+buyer_user_id+'/'+seller_user_id+'"); ?>');
                          }
                        });  
                                 
                        e.preventDefault();
                    });
                    });
                </script>
