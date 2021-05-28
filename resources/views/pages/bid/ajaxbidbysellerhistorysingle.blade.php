
      
      <div class="content">
        <div class="container-fluid">          
          <div class="row" id="add_user">            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Bidding Trails (Seller)</h4>
                  <p class="card-category">Below are the bidding trails with buyer.</p>
                </div>
                <div class="card-body">
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
                    @foreach($buyers as $buyer)

                    
                    @if(1 != 0)
                    <div class="row">
                      <div class="col-sm-12">
                          <?php
                          $xyz1 = 1;
                          $xyz2 = 1;
                          ?>
                          <div class="bidding-trails-window">
                          <ul class="bidding-trails">

                          @foreach($bidbysellers as $bidbyseller)
                          <li>

                          @if($bidbyseller->bidtype=='bid')
                          <div class="card float-right col-md-8 col-sm-10">
                          @else
                          <div class="card left-chat col-md-8 col-sm-10">
                          @endif

                           <div class="card-body">
                              @foreach($profiles as $profile)
                                @if($bidbyseller->bidtype == 'bid')
                                  @if($profile->user_id == $bidbyseller->seller_id)
                                    <div class="avatar">
                                      <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
                                    </div>
                                    <div class="text text-l">
                                      <h5 class="title-chat font-weight-bold"> 
                                        {{$bidbyseller->bidtype}} by {{$profile->company_name}}
                                      </h5>
                                  @endif
                                @else
                                  @if($profile->user_id == $bidbyseller->buyer_id)
                                    <div class="avatar">
                                      <img class="img-circle" style="width:100%;" src="{{ asset('/imageupload/profile/'.$profile->company_logo) }}">
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
                              @if($xyz1 == $bidbysellers->count() && $bidbyseller->bidtype == 'counterbid')
                              @if($bidbyseller->status == 'Ongoing')

                              <div class="" role="group" aria-label="Basic example">
                               	<a class="btn btn-primary btn-round text-white" data-toggle="modal" data-target="#bid{{ $bidbyseller->id }}">Bid</a>
                                <button type="button" class="btn btn-success btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('accept-by-seller', [$bidbyseller->id]) }}" class="text-white"><i class="material-icons">done</i></a>
                                </button>
                                <button type="button" class="btn btn-danger btn-round btn-fab"><a onclick="return confirm('Are you sure?')" href="{{ url('decline-by-seller', [$bidbyseller->id]) }}" class="text-white"><i class="material-icons">close</i></a>
                                </button>
                              </div>

                              @endif
                              
                              
                              <div class="modal fade" id="bid{{ $bidbyseller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Start Bidding</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ url('/start-bidding') }}">
                                        @csrf
                                        <div class="">
                                              <input type="text" class="myclass" name="new_currency" value="{{ $bidbyseller->new_currency }}" readonly="">
                                              <input type="text" class="myclass" name="new_price" value="{{ $bidbyseller->new_price }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_perunit" value="{{ $bidbyseller->new_perunit }}" readonly="">
                                              <input type="text" name="enquiry_id" value="{{ $buyer->id }}" class="d-none">
                                              <input type="text"  name="seller_id"  value="{{ Auth::user()->id }}" class="d-none">
                                              <input type="text"  name="buyer_id"  value="{{ $buyer->created_by }}" class="d-none">  
                                              <input type="text" class="myclass" name="new_quantity" value="{{ $bidbyseller->new_quantity }}" required="required" placeholder="New Price">
                                              <input type="text" class="myclass" name="new_unit" value="{{ $bidbyseller->new_unit }}" readonly="">
                                              <input required="required" placeholder="Instruction" class=" myclass col-sm-12"  type="text" name="instruction">
                                              <input class=" col-sm-3 btn btn-primary btn-sm float-right"  type="submit" name="submit">

                                        </div>                                              
                                      </form>

                                    </div>
                                  </div>
                                </div>
                              </div>
                                
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
                              @if($bidbyseller->status == 'Ongoing')
                                  <p><small>Status: <span class="text-warning">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @elseif($bidbyseller->status == 'Approved')
                                  <p><small>Status: <span class="text-success">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @else
                                  <p><small>Status: <span class="text-danger">{{$bidbyseller->status}}</span></small> &nbsp;&nbsp;<small>{{$bidbyseller->created_at}}</small></p>
                                  @endif
                            </div>
                          </div>
                        </li>
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
                        </ul>
                      </div>
                      </div>
                                           
                    </div>
                    @endif

                    
                    @endforeach
                    <div class="clearfix"></div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>