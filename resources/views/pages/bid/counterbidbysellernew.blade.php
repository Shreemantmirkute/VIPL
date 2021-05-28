<!-- <div class="chat-detail">
  <div class="chat-head">
      <ul class="list-unstyled mb-0">
          <li class="media">
              <img class="align-self-center mr-3 rounded-circle" src="assets/images/users/girl.svg">
              <div class="media-body">
                  <h5 class="font-18">Amy Adams</h5>
                  <p class="mb-0">typing...</p>
              </div>
          </li>
      </ul>
  </div>
  <div class="chat-body">
      <div class="chat-day text-center mb-3">
          <span class="badge badge-secondary">Today</span>
      </div>                                
      <div class="chat-message chat-message-right">
          <div class="chat-message-text">
              <span>Hello! please, let me know the status about project after school.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:18 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-left">
          <div class="chat-message-text">
              <span>I have completed 4 stages 5 stages remaining.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:20 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-right">
          <div class="chat-message-text">
              <span>I request you to schedule demo at 3 pm after 2 days for the better progress.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:25 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-left">
          <div class="chat-message-text">
              <span>Sure, I will prepare for the same.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:27 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-right">
          <div class="chat-message-text">
              <span>Great. Thanks</span>
          </div>
          <div class="chat-message-meta">
              <span>4:30 pm<i class="feather icon-clock ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-left">
          <div class="chat-message-text">
              <span>I have completed 4 stages 5 stages remaining.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:20 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-right">
          <div class="chat-message-text">
              <span>I request you to schedule demo at 3 pm after 2 days for the better progress.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:25 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-left">
          <div class="chat-message-text">
              <span>Sure, I will prepare for the same.</span>
          </div>
          <div class="chat-message-meta">
              <span>4:27 pm<i class="feather icon-check ml-2"></i></span>
          </div>
      </div>
      <div class="chat-message chat-message-right">
          <div class="chat-message-text">
              <span>Great. Thanks</span>
          </div>
          <div class="chat-message-meta">
              <span>4:30 pm<i class="feather icon-clock ml-2"></i></span>
          </div>
      </div>
  </div>
  <div class="chat-bottom">
      <div class="chat-messagebar">
          <form>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <button class="btn btn-secondary-rgba" type="button" id="button-addonmic"><i class="feather icon-mic"></i></button>
                  </div>  
                  <input type="text" class="form-control" placeholder="Type a message..." aria-label="Text">
                  <div class="input-group-append">
                      <button class="btn btn-secondary-rgba" type="submit" id="button-addonlink"><i class="feather icon-link"></i></button>
                      <button class="btn btn-primary-rgba" type="button" id="button-addonsend"><i class="feather icon-send"></i></button>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div> -->

@foreach($sellers as $seller)
                    <div class="col-md-4">
                      <?php foreach (json_decode($seller->product_image)as $picture) { ?>
                        <img src="{{ asset('/imageupload/offer/'.$picture) }}" style="height:150px; width:250px"/>
                      <?php } ?>
                      <?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                      ?>
                    </div>
                    <div class="col-md-8">
                      <table class="col-sm-12">
                        <thead>
                          <th>Name</th>
                          <th>Price</th>
                          <th>MOQ</th>
                          <th>Quantity</th>
                          <th>Created By</th>
                          <th>Origin</th>
                        </thead>
                        <tr>
                          <td>{{ $seller->product_name }}</td>
                          <td>{{ $seller->currency }} {{ $seller->price }} {{ $seller->perunit }}</td>
                          <td>{{ $seller->minimum_order_quantity }} {{$seller->minimum_order_unit}}</td>
                          <td>{{ $seller->quantity-$b1 }} {{ $seller->unit }}</td>
                          <?php
                          $sellercurrency = $seller->currency;
                          $sellerperunit = $seller->perunit;
                          $sellerunit = $seller->unit;
                          ?>
                          @foreach($profiles as $profile2)
                            @if($seller->created_by == $profile2->user_id)
                              <?php $user5 = $profile2->company_name; ?>
                            @endif
                          @endforeach
                          <td>{{ $user5 }}</td>
                          <td>{{ $seller->state }}</td>
                        </tr>
                      </table>
                      <div id="accordion" role="tablist">
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#collapseOnee" aria-expanded="false" aria-controls="collapseOnee" class="collapsed">
                                Tax Class
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOnee" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                              <?php $taxclass = \App\TaxClass::where('id', $seller->taxclass)->pluck('name')->first(); ?>
                              {{ $taxclass }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                Chemical Specification / Grade
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                              {{ $seller->chemical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Physical Specification / Size
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                              {{ $seller->physical_specification }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Payment Terms
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                             {{ $seller->tandc }}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingFour">
                            <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Other Terms and Conditions
                                <i class="material-icons">keyboard_arrow_down</i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                             {{ $seller->otandc }}
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity'); 
                          $b2 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->pluck('new_unit')->first(); 
                          ?>
                          @if($b1 == $seller->quantity)
                          <div class="alert alert-danger show" role="alert">
                            SOLD OUT
                          </div>
                          @elseif($b1 != 0)
                          <div class="alert alert-warning show" role="alert">
                            {{$seller->quantity-$b1}} {{$b2}} LEFT
                          </div>
                          @endif
                    </div>                   
                   @endforeach