				
				@foreach($sellers as $seller)
				<?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                      ?>


				<?php $xyz1 = 1; ?>
                    <div class="bidding-trails-window">
                      <ul class="bidding-trails">
                        @foreach($bidonmyoffers as $bidonmyoffer)
                          <li>
                          @if($bidonmyoffer->bidtype=='bid')
                              <div class="card left-chat col-md-8 col-sm-10">
                          @else
                              <div class="card float-right col-md-8 col-sm-10">
                          @endif
                                <div class="card-body">
                                  @foreach($profiles as $profile)
                                    @if($bidonmyoffer->bidtype == 'bid')
                                      @if($profile->user_id == $bidonmyoffer->buyer_id)
                                        <div class="avatar">
                                          <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                        </div>
                                        <div class="text text-l">
                                          <h5 class="title-chat font-weight-bold"> 
                                          {{$bidonmyoffer->bidtype}} by {{$profile->company_name}}
                                          </h5>
                                      @endif
                                    @else
                                      @if($profile->user_id == $bidonmyoffer->seller_id)
                                        <div class="avatar">
                                            <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                          </div>
                                          <div class="text text-l">
                                            <h5 class="title-chat font-weight-bold"> 
                                              {{$bidonmyoffer->bidtype}} by {{$profile->company_name}}
                                            </h5>
                                        
                                      @endif
                                    @endif
                                  @endforeach

                                  <p><span>Price: </span>{{$bidonmyoffer->new_currency}} {{$bidonmyoffer->new_price}} {{$bidonmyoffer->new_perunit}} &nbsp;&nbsp;<span>Quantity: </span>{{$bidonmyoffer->new_quantity}} {{$bidonmyoffer->new_unit}}</p>
                                  <p><span>Instructions: </span>{{$bidonmyoffer->instruction}}</p>
                                  <p><span>Date: </span>{{$bidonmyoffer->created_at}}</p>
                           
                       				@if($bidonmyoffer->status == 'Ongoing')
			                          @if($xyz1 == $bidonmyoffers->count() && $bidonmyoffer->bidtype=='bid')
			                          <div class="" role="group" aria-label="Basic example">
			                              <a class="btn btn-primary btn-round text-white" data-toggle="modal" data-target="#counterbid{{ $bidonmyoffer->id }}">Counter Bid</a>
			                                <button type="button" class="btn btn-success btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidonmyoffer->id]) }}" class="text-white"><i class="material-icons">done</i>
			                              </a></button>
			                                <button type="button" class="btn btn-danger btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidonmyoffer->id]) }}" class="text-white"><i class="material-icons">close</i>
			                              </a></button>
			                          </div>
			                          @endif
			                          <?php $xyz1++; ?>
			                        @endif



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
				                    @if($bidonmyoffer->admin_confirmation == 'Disapproved')
				                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
				                      Bid Accepted Disapproved By Admin       
				                    </div>                 
				                    @endif
				                  @endif  




<!--modal start-->
			                    <div class="modal fade" id="counterbid{{ $bidonmyoffer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Start Bidding2</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ url('/start-counterbidding') }}">
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
                              </div>
<!--modal end-->


                    @endforeach
                  </ul>
                </div>



                @endforeach