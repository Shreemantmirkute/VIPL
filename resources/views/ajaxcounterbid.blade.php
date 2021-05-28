				
				@foreach($sellers as $seller)
        @if ($loop->last)
				<?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                          $company_name1 = \App\Profile::where('user_id', $buyer_user_id)->pluck('company_name')->first();
                          $img1 = \App\Profile::where('user_id', $buyer_user_id)->pluck('company_logo')->first(); ?>


				<?php $xyz1 = 1; ?>
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
                      @foreach($bidonmyoffers as $bidonmyoffer)
	                      @if($bidonmyoffer->bidtype=='bid')
	                        <div class="chat-message chat-message-left">
	                      @else
	                        <div class="chat-message chat-message-right">
	                      @endif
		                        <div class="chat-message-text">
		                            <p><span>Price: </span><strong>{{$bidonmyoffer->new_currency}}{{$bidonmyoffer->new_price}}{{$bidonmyoffer->new_perunit}}</strong></p>
		                            <p><span>Quantity: </span><strong>{{$bidonmyoffer->new_quantity}}{{$bidonmyoffer->new_unit}}</strong></p>
		                      		<p><span>Instructions: </span>{{$bidonmyoffer->instruction}}</p>
		                        </div>
		                        <div class="chat-message-meta">
		                            <span>{{$bidonmyoffer->created_at}} <i class="feather icon-check ml-2"></i></span>
		                        </div>
		                        <?php $hidden="hidden"; ?>     
		           				   @if($bidonmyoffer->status == 'Ongoing')
		                          @if($xyz1 == $bidonmyoffers->count() && $bidonmyoffer->bidtype=='bid')
		                          <?php $hidden="hidden"; ?>

		                          <div class="text-center" role="group" aria-label="Basic example">
		                              <button class="btn btn-primary text-white" id="counterbid-bottom">Counter Bid</button>
		                              <a class="btn btn-success" onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidonmyoffer->id]) }}">Accept
		                              </a>
		                              <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidonmyoffer->id]) }}">Reject
		                              </a>
		                          </div>
		                          @endif
		                          
		                        @endif
                            <?php $xyz1++; ?>
		                    </div>
		                    @if($bidonmyoffer->status == 'Completed')
			                    @if($bidonmyoffer->admin_confirmation == 'Pending')
				                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
				                      Bid Accepted Waiting For Admin Approval
				                    </div>
			                    @endif
			                    @if($bidonmyoffer->admin_confirmation == 'Approved')
				                    <div class="alert alert-success alert-dismissible fade show" role="alert">
				                      Bid Accepted Approved By Admin
				                    </div>                     
			                    @endif
			                    @if($bidonmyoffer->admin_confirmation == 'Rejected')
				                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
				                      Bid Accepted Disapproved By Admin       
				                    </div>                 
			                    @endif
				                @endif
                        @if($bidonmyoffer->status == 'Decline')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Bid Disapproved       
                          </div>
                        @endif
				        @endforeach
                
           			</div>  



			                        




<!--modal start-->
			                    <!-- div class="modal fade mymodal1" id="counterbid{{ $bidonmyoffer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Start Bidding2</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" id="mymodalform2364">
                                        @csrf
                                        <div class="">
                                              <input type="text" class="myclass" name="new_currency" value="{{ $bidonmyoffer->new_currency }}" readonly="">
                                              <input type="text" class="myclass" name="new_price" value="{{ $bidonmyoffer->new_price }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_perunit" value="{{ $bidonmyoffer->new_perunit }}" readonly="">
                                              <input type="text" name="offer_id" value="{{ $bidonmyoffer->offer_id }}" class="d-none">
                                              <input type="text"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                                              <input type="text"  name="buyer_id"  value="{{ $bidonmyoffer->created_by }}" class="d-none">  
                                              <input type="number" class="myclass" name="new_quantity" value="{{ $bidonmyoffer->new_quantity }}" min="{{$seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}" required="required" placeholder="New Quantity">
                                              <input type="text" class="myclass" name="new_unit" value="{{ $bidonmyoffer->new_unit }}" readonly="">
                                              <input placeholder="Instruction" class=" myclass col-sm-12"  type="text" name="instruction">
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">
                                        </div>                                              
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div> -->
<!--modal end-->


                <div class="chat-bottom d-none" id="chat-bottom">
                    <div class="chat-messagebar">
                        <form method="POST" id="mymodalform234">
                        	
                        	<div class="form-row">
                              <div class="input-group mb-3 col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $bidonmyoffer->new_currency }}</span>
                                </div>
                                <input type="text" class="form-control" name="new_price" value="{{ $bidonmyoffer->new_price }}" required="required" placeholder="Bid">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ $bidonmyoffer->new_perunit }}</span>
                                </div>
                                </div>
                                <div class="input-group mb-3 col-md-6">
                                    	<input type="number" class="form-control" name="new_quantity" value="{{ $bidonmyoffer->new_quantity }}" min="{{$seller->minimum_order_quantity}}" max="{{$seller->quantity-$b1}}" required="required" placeholder="Quantity">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ $bidonmyoffer->new_unit }}</span>
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
                               	<input type="hidden" class="d-none" name="new_currency" value="{{ $bidonmyoffer->new_currency }}">
                								<input type="hidden" class="d-none" name="new_perunit" value="{{ $bidonmyoffer->new_perunit }}" >
                								<input type="hidden"  name="offer_id" value="{{ $bidonmyoffer->offer_id }}" class="d-none">
                                <input type="hidden"  name="bid_tracker" value="{{ $bidonmyoffer->bid_tracker }}" class="d-none">
                								<input type="hidden"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                								<input type="hidden"  name="buyer_id"  value="{{ $bidonmyoffer->created_by }}" class="d-none">  
                								<input type="hidden" class="d-none" name="new_unit" value="{{ $bidonmyoffer->new_unit }}" >
								
								
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
                  oid = data['offer_id'];
                  sid = data['seller_id'];
                  bid = data['buyer_id'];
                  new PNotify( {
                  title: 'Success notice', text: 'Counter-Bid Successfully Placed', type: 'success'
                  });
                 $('#mytab').load('<?php echo url("/ajaxcounterbid/'+oid+'/'+sid+'/'+bid+'"); ?>');
                }
              });  
                       
              e.preventDefault();
          });
          });
  </script>