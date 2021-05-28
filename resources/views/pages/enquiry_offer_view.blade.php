<!DOCTYPE html>
<html lang="en">
@include('new_head')
<style type="text/css">
  tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<body class="vertical-layout">    
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
      @include('new_sidebar')
      <!-- End Leftbar -->
      <!-- Start Rightbar -->
      <div class="rightbar">
        <!-- Start Topbar Mobile -->
        @include('new_header')
        <!-- End Topbar -->
        <!-- Start Breadcrumbbar -->                    
        <div class="breadcrumbbar">
            <div class="row align-items-center">
                <div class="col-md-8 col-lg-8">
                    <h4 class="page-title">Enquiry / Offer</h4>
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enquiry / Offer</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="widgetbar">
                    	<a href="{{url('/add-enquiry-offer')}}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add New Offer / Enquiry</a>
                    </div>                        
                </div>
            </div>          
        </div>
        <!-- End Breadcrumbbar -->
        <!-- Start Contentbar -->    
        <div class="contentbar">
        	@if (\Session::has('success'))                          
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {!! \Session::get('success') !!}
                </div>
            @endif

              @if (\Session::has('warning'))                          
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  {!! \Session::get('warning') !!}
                </div>
            @endif


            @if (\Session::has('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                   {!! \Session::get('fail') !!}
                </div>
            @endif
            @if (\Session::has('successdeleted'))                          
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! \Session::get('successdeleted') !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="defaultTab" role="tablist">
                          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Offer / Offers raised by Me.">
                              <a class="nav-link active" id="my-offers-tab" data-toggle="tab" href="#my-offers" role="tab" aria-controls="my-offers" aria-selected="true">My Offers <span class="bg-danger badge text-white">{{$sellers->count()}}</span> </a>
                          </li>
                          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Enquiry / Enquiries raised by Me.">
                              <a class="nav-link" id="my-enquiries-tab" data-toggle="tab" href="#my-enquiries" role="tab" aria-controls="my-enquiries" aria-selected="false">My Enquiries <span class="bg-danger badge text-white">{{$buyers->count()}}</span></a>
                          </li>
                          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Offer / Offers raised by others.">
                            <?php $other_offer_count = 0; ?>
                                      @foreach($availableproducts_one as $item)
                                      <?php
                                          $no_of_offer_transactiona = \App\Seller::where('product', $item->id)->count();
                                          $tilldatea = Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i:s');
                                          $pasta   = new DateTime($tilldatea);
                                          $nowa    = new DateTime();
                                          if ($pasta<$nowa)
                                            { $isexpireda = 1;}
                                          else
                                            { $isexpireda = 0;}
                                          ?>
                                    
                                      
                                       @if($isexpireda == 0 || ($isexpireda == 1 && $no_of_offer_transactiona > 0))
                                      <?php $other_offer_count += 1; 
                                      //dd($other_offer_count);
                                      ?>
                                      @endif
                                      @endforeach
                              <a class="nav-link" id="other-offers-tab" data-toggle="tab" href="#other-offers" role="tab" aria-controls="other-offers" aria-selected="false">Other Offers <span class="bg-danger badge text-white">{{$other_offer_count}}</span></a>
                          </li>
                          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Enquiry / Enquiries raised by others.">
                            <?php $other_enquiry_count = 0; ?>
                                      @foreach ($availableproducts_two as $item)
                                      <?php                                          
                                          $no_of_enquiry_transactionb = \App\Finalbid::where('enquiry_id', $item->id)->count(); 
                                          $tilldateb = Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i:s');
                                          $pastb   = new DateTime($tilldateb);
                                          $nowb    = new DateTime();
                                          if ($pastb<$nowb)
                                            { $isexpiredb = 1;}
                                          else
                                            { $isexpiredb = 0;}
                                          ?>
                                      @if($isexpiredb == 0 || ($isexpiredb == 1 && $no_of_enquiry_transactionb > 0))
                                      <?php $other_enquiry_count += 1; 
                                      // dd($other_enquiry_count);
                                       ?>
                                      @endif
                                      @endforeach
                              <a class="nav-link" id="other-enquiries-tab" data-toggle="tab" href="#other-enquiries" role="tab" aria-controls="other-offers" aria-selected="false">Other Enquiries <span class="bg-danger badge text-white">{{$other_enquiry_count}}</span></a>
                          </li>
                        </ul>
                          <div class="tab-content" id="defaultTabContent">
                              <div class="tab-pane fade show active" id="my-offers" role="tabpanel" aria-labelledby="my-offers-tab">
                                  <div class="table-responsive">
                                    <table id="default-datatable" class="table">
                                        <thead>
                                          <tr>
                                            <th>#</th>
  	                                        <th>Product</th>
  	                                        <th>Price</th>
  	                                        <th>MOQ</th>
  	                                        <th>Quantity</th>
  	                                        <th>Origin</th>
  	                                        <th>Added On</th>
                                            <th>Valid Till</th>
  	                                        <th data-orderable="false" >Quick Actions</th>
                                            <th data-orderable="false" >Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                     <!--   <tfoot>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>MOQ</th>
                                            <th>Quantity</th>
                                             <th>Origin</th>
                                            <th>Added On</th>
                                            <th>Valid Till</th>

                                        </tfoot>-->
                                          @foreach ($sellers as $seller)                                      
                                      <tr class="">
                                        <td><strong>{{ $seller->id }}</strong></td>
                                        @foreach($items as $item)
                                        @if($seller->product == $item->id)
                                        <?php $availableproducts = $item->product ?>
                                        @endif
                                        @endforeach
                                        <td>{{ $availableproducts }}</td>
                                        <td>{{ $seller->currency }} {{ number_format($seller->price) }} {{ $seller->perunit }}</td>
                                        <td>{{$seller->minimum_order_quantity}} {{ $seller->unit }}</td>
                                        <td>{{ $seller->quantity }} {{ $seller->unit }}</td>
                                        <td>{{ $seller->factory_state}}</td>
                                        <td>{{ Carbon\Carbon::parse($seller->created_at)->format('d-m-Y') }}</td>
                                        <td><span class="to_date" data-id="{{ $seller->id }}">{{ Carbon\Carbon::parse($seller->to_date)->format('d-m-Y H:i') }}</span></td>
                                        
                                        <td>                                           
                                          <a type="button" data-toggle="tooltip" data-placement="top" title="View Offer" class="btn btn-round btn-primary" href="{{ url('/offerbid', [$seller->id]) }}"><i class="fa fa-eye"></i></a>
                                          <!-- <button type="button" rel="tooltip" title="View Product" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#viewOffer{{ $seller->id }}"><i class="material-icons">visibility</i> -->
                                          </button>
                                          <!-- Modal -->
                                            <div class="modal fade" id="viewOffer{{ $seller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <table class="table table-sm table-bordered">
                                                      <tr>
                                                        <th>Item Id</th>
                                                        <td>{{ $seller->id }}</td>
                                                        <th>Product</th>
                                                        <td>{{ $seller->product }}</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Price</th>
                                                        <td>{{ $seller->currency }} {{ $seller->price }} {{ $seller->perunit }}</td>
                                                        <th>Quantity</th>
                                                        <td>{{ $seller->quantity }} {{ $seller->unit }}</td>
                                                      </tr>
                                                      <tr>
                                                        <th>Origin</th>
                                                        <td>{{ $seller->origin }}</td>
                                                        <th>Chemical Specification</th>
                                                        <td>{{ $seller->chemical_specification }}</td>
                                                      </tr>
                                                      <tr>                                  
                                                        <th>Physical Specifications</th>
                                                        <td>{{ $seller->physical_specification }}</td>
                                                        <th>Status</th>
                                                        <td>{{ $seller->status }}</td>
                                                      </tr>
                                                       <tr>
                                                          <?php foreach (json_decode($seller->product_image)as $picture) { ?>
                                                            <td><img src="{{ asset('/imageupload/offer/'.$picture) }}" style="height:60px; width:100px"/></td>
                                                          <?php } ?>
                                                          <td>
                                                            <a type="button" class="btn btn-info btn-sm" href="{{ url('/offerbid', [$seller->id]) }}">View More</a>
                                                          </td>
                                                           
                                                      </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          @if($seller->status == 'Active')
                                          <button type="button" rel="tooltip" class="btn btn-round btn-primary disabled" data-toggle="modal" data-target="#" data-placement="top" title="Edit Offer"><i class="fa fa-edit"></i>
                                          </button>
                                          @else
                                          <button type="button" rel="tooltip" title="Edit Offer" class="btn btn-round btn-primary" data-target="#editOffer{{ $seller->id }}" data-toggle="modal" data-placement="top" title="Edit Offer"><i class="fa fa-edit"></i>
                                          </button>
                                          @endif
                                          <!-- Modal -->
                                              <div class="modal fade" id="editOffer{{ $seller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <form method="POST" action="{{ url('/update-seller') }}">
                                                        @csrf
                                                        <div class="row">                                  
                                                          <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="id" required autocomplete="id" autofocus readonly="readonly" value="{{ $seller->id }}">
                                                          </div>
                                                          <div class="col-sm-5">
                                                            <div class="input-group mb-4">
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  <select name="currency" class="form-control pl-2 pr-2">
                                                                    <option>{{$seller->currency}}</option>
                                                                    @if($seller->currency != '€')
                                                                    <option>€</option>
                                                                    @endif
                                                                    @if($seller->currency != '¥')
                                                                    <option>¥</option>
                                                                    @endif
                                                                    @if($seller->currency != '₹')
                                                                    <option>₹</option>
                                                                    @endif
                                                                    @if($seller->currency != '$')
                                                                    <option>$</option>
                                                                    @endif
                                                                  </select>
                                                                </span>
                                                              </div>
                                                              <input type="number" class="form-control" name="price" required autocomplete="price" autofocus placeholder="Price" value="{{ $seller->price }}"> 
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  <select name="perunit" class="form-control pl-1 pr-1">
                                                                    <option>{{$seller->perunit}}</option>
                                                                    @if($seller->perunit != '/Kg')
                                                                    <option>/Kg</option>
                                                                    @endif
                                                                    @if($seller->perunit != '/MT')
                                                                    <option>/MT</option>
                                                                    @endif
                                                                    @if($seller->perunit != '/Peice')
                                                                    <option>/Peice</option>
                                                                    @endif
                                                                    @if($seller->perunit != '/Meter')
                                                                    <option>/Meter</option>
                                                                    @endif
                                                                  </select>
                                                                </span>
                                                              </div>
                                                            </div>                                                            
                                                          </div>
                                                          <div class="col-sm-4">
                                                            <div class="input-group mb-3">
                                                              <input type="number" class="form-control" name="quantity" required autocomplete="quantity" autofocus placeholder="Quantity" value="{{ $seller->quantity }}" data-style="btn btn-link">
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  <select name="unit" class="form-control pl-1 pr-1">
                                                                    <option>{{$seller->unit}}</option>
                                                                    @if($seller->unit != 'Kg')
                                                                    <option>Kg</option>
                                                                    @endif
                                                                    @if($seller->unit != 'MT')
                                                                    <option>MT</option>
                                                                    @endif
                                                                    @if($seller->unit != 'Peice')
                                                                    <option>Peice</option>
                                                                    @endif
                                                                    @if($seller->unit != 'Meter')
                                                                    <option>Meter</option>
                                                                    @endif
                                                                  </select>
                                                                </span>
                                                              </div>
                                                            </div>        
                                                          </div>
                                                          
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-sm-3">
                                                             <input type="text" class="form-control" name="origin" required autocomplete="origin" autofocus placeholder="Origin" value="{{ $seller->state }}">                
                                                          </div>
                                                          <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="tandc" required autocomplete="tandc" autofocus placeholder="Terma and Condition" value="{{ $seller->tandc }}">
                                                          </div>
                                                          <div class="col-sm-5">
                                                            <input type="text" class="form-control" name="otandc" required autocomplete="otandc" autofocus placeholder="Other T&C" value="{{ $seller->otandc }}">
                                                          </div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="chemical_specification" required autocomplete="chemical_specification" autofocus placeholder="Chemical Specification" value="{{ $seller->chemical_specification }}">
                                                          </div>
                                                          <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="physical_specification" required autocomplete="physical_specification" autofocus placeholder="Physical Specification" value="{{ $seller->physical_specification }}">
                                                          </div>
                                                          <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>                 
                                                          </div>
                                                        </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          @if($seller->status == 'Active')
                                          <a type="button" rel="tooltip" class="btn btn-round btn-danger disabled" onclick="return confirm('Are you sure?')" href="#"><i class="fa fa-trash"></i></a></a>
                                          @else
                                          <a type="button" rel="tooltip" title="Remove" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/delete-seller', [$seller->id]) }}"><i class="fa fa-trash"></i></a></a>
                                          @endif
                                          <!-- <a type="button" rel="tooltip" title="Activate" class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('activate-offer', [$seller->id]) }}"><i class="fa fa-check"></i></a>
                                          <a type="button" rel="tooltip" title="Deactivate" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-offer', [$seller->id]) }}"><i class="fa fa-times"></i></a> -->
                                        </td>
                                        <td>
                                        @if($seller->status == 'Active')
                                          <div class="switchery-list"><input data-value="{{$seller->id}}" type="checkbox" class="js-switch-success-small" checked /></div>
                                        @else
                                          <div class="switchery-list"><input data-value="{{$seller->id}}" type="checkbox" class="js-switch-success-small" /></div>
                                        @endif
                                        </td>
                                      </tr>
                                      @endforeach
                                        </tbody>
                                       
                                    </table>
                                  </div>
                              </div>
                              <div class="tab-pane fade" id="my-enquiries" role="tabpanel" aria-labelledby="my-enquiries-tab">
                                  <div class="table-responsive">
                                    <table id="default-datatable2" class="table" style="width: 100%">
                                        <thead>
                                          <tr>
	                                          <th>#</th>
		                                      <th>Product</th>
		                                      <th>Price</th>
		                                      <th>MOQ</th>
		                                      <th>Quantity</th>
		                                       <th>Origin</th>
		                                      <th>Added On</th>
		                                      <th>Valid Till</th>
		                                      <th data-orderable="false">Quick Action</th>
                                          <th data-orderable="false">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($buyers as $buyer)
                                    
                                    <tr class="">
                                      <td><strong>{{ $buyer->id }}</strong></td>
                                      @foreach($items as $item)
                                      @if($buyer->product == $item->id)
                                      <?php $product_name = $item->product ?>
                                      @endif
                                      @endforeach
                                      <td>{{ $product_name }}</td>
                                      <td>{{ $buyer->currency }} {{ number_format($buyer->price) }} {{ $buyer->perunit }}</td>
                                      <td>{{$buyer->minimum_order_quantity}} {{$buyer->minimum_order_unit}}</td>
                                      <td>{{ $buyer->quantity }} {{ $buyer->unit }}</td>
                                       <td>{{ $buyer->factory_state}}</td>
                                      <td>{{ Carbon\Carbon::parse($buyer->created_at)->format('d-m-Y') }}</td>
                                      <td>{{ Carbon\Carbon::parse($buyer->to_date)->format('d-m-Y H:i') }}</td>
                                       <td><span class="to_date" data-id="{{ $seller->id }}">{{ Carbon\Carbon::parse($seller->to_date)->format('d-m-Y H:i') }}</span></td>
                                      <td>
                                        <!-- <button type="button" rel="tooltip" title="View Product" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#viewEnquiry{{ $buyer->id }}"><i class="material-icons">visibility</i>
                                        </button> -->
                                        <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Enquiry" class="btn btn-round btn-primary" href="{{ url('/enquirybid', [$buyer->id]) }}"><i class="fa fa-eye"></i></a>
                                        <!-- Modal -->
                                          <div class="modal fade" id="viewEnquiry{{ $buyer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">View Product</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-sm table-bordered">
                                                    <tr>
                                                      <th>Item Id</th>
                                                      <td>{{ $buyer->id }}</td>
                                                      <th>Product</th>
                                                      <td>{{ $buyer->product_name }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Price</th>
                                                      <td>{{ $buyer->currency }} {{ $buyer->price }} {{ $buyer->perunit }}</td>
                                                      <th>Quantity</th>
                                                      <td>{{ $buyer->quantity }} {{ $buyer->unit }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Origin</th>
                                                      <td>{{ $buyer->origin }}</td>
                                                      <th>Chemical Specification</th>
                                                      <td>{{ $buyer->chemical_specification }}</td>
                                                    </tr>
                                                    <tr>                                  
                                                      <th>Physical Specifications</th>
                                                      <td>{{ $buyer->physical_specification }}</td>
                                                      <th>Status</th>
                                                      <td>{{ $buyer->status }}</td>
                                                    </tr>
                                                     <tr>
                                                        <?php foreach (json_decode($buyer->product_image)as $picture) { ?>
                                                          <td><img src="{{ asset('/imageupload/enquiry/'.$picture) }}" style="height:60px; width:100px"/></td>
                                                        <?php } ?>  
                                                        <td><a href="{{ url('/bidacceptance-view', [$buyer->product]) }}" class="btn btn-info">View All</a></td>                                         
                                                    </tr>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @if( $buyer->status == 'Active')
                                        <button type="button" class="btn btn-round btn-primary disabled" data-toggle="modal" data-target="#"><i class="fa fa-edit"></i>
                                        </button>
                                        @else
                                        <button type="button" rel="tooltip" title="Edit Enquiry" class="btn btn-round btn-primary" data-toggle="modal" data-target="#editOffer{{ $buyer->id }}"><i class="fa fa-edit"></i>
                                        </button>
                                        @endif
                                        <!-- Modal -->
                                            <div class="modal fade" id="editOffer{{ $buyer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form method="POST" action="{{ url('/update-buyer') }}">
                                                      @csrf
                                                      <div class="row">                                  
                                                        <div class="col-sm-2">
                                                          <input type="text" class="form-control" name="id" required autocomplete="id" autofocus readonly="readonly" value="{{ $buyer->id }}">
                                                        </div>
                                                        <div class="col-sm-6">
                                                          <div class="input-group border">
                                                            <div class="input-group-prepend">
                                                              <span class="input-group-text" id="basic-addon1">
                                                                <select name="currency" class="form-control">
                                                                  <option>{{$buyer->currency}}</option>
                                                                  @if($buyer->currency != '€')
                                                                  <option>€</option>
                                                                  @endif
                                                                  @if($buyer->currency != '¥')
                                                                  <option>¥</option>
                                                                  @endif
                                                                  @if($buyer->currency != '₹')
                                                                  <option>₹</option>
                                                                  @endif
                                                                  @if($buyer->currency != '$')
                                                                  <option>$</option>
                                                                  @endif
                                                                </select>
                                                              </span>
                                                            </div>
                                                           <input type="number" class="form-control" name="price" required autocomplete="price" autofocus placeholder="Price" value="{{ $buyer->price }}">
                                                           <div class="input-group-prepend">
                                                              <span class="input-group-text" id="basic-addon1">
                                                                <select name="perunit" class="form-control">
                                                                  <option>{{$buyer->perunit}}</option>
                                                                  @if($buyer->perunit != '/Kg')
                                                                  <option>/Kg</option>
                                                                  @endif
                                                                  @if($buyer->perunit != '/MT')
                                                                  <option>/MT</option>
                                                                  @endif
                                                                  @if($buyer->perunit != '/Peice')
                                                                  <option>/Peice</option>
                                                                  @endif
                                                                  @if($buyer->perunit != '/Meter')
                                                                  <option>/Meter</option>
                                                                  @endif
                                                                </select>
                                                              </span>
                                                            </div>
                                                            </div>                
                                                        </div>
                                                        <div class="col-sm-4">
                                                          <div class="input-group border">
                                                           <input type="number" class="form-control" name="quantity" required autocomplete="quantity" autofocus placeholder="Quantity" value="{{ $buyer->quantity }}">
                                                           <div class="input-group-prepend">
                                                              <span class="input-group-text" id="basic-addon1">
                                                                <select name="unit" class="form-control">
                                                                  <option>{{$buyer->unit}}</option>
                                                                  @if($buyer->unit != 'Kg')
                                                                  <option>Kg</option>
                                                                  @endif
                                                                  @if($buyer->unit != 'MT')
                                                                  <option>MT</option>
                                                                  @endif
                                                                  @if($buyer->unit != 'Peice')
                                                                  <option>Peice</option>
                                                                  @endif
                                                                  @if($buyer->unit != 'Meter')
                                                                  <option>Meter</option>
                                                                  @endif
                                                                </select>
                                                              </span>
                                                            </div>
                                                          </div>               
                                                        </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                           <input type="text" class="form-control" name="origin" required autocomplete="name" autofocus placeholder="Origin" value="{{ $buyer->origin }}">                
                                                        </div>
                                                        <div class="col-sm-4">
                                                          <input type="text" class="form-control" name="tandc" required autocomplete="tandc" autofocus placeholder="Terms and Condition" value="{{ $buyer->tandc }}">
                                                        </div>
                                                        <div class="col-sm-5">
                                                          <input type="text" class="form-control" name="otandc" required autocomplete="otandc" autofocus placeholder="Other T&C" value="{{ $buyer->otandc }}">
                                                        </div>
                                                      </div>
                                                      <div class="row">
                                                        <div class="col-sm-4">
                                                          <input type="text" class="form-control" name="chemical_specification" required autocomplete="chemical_specification" autofocus placeholder="Chemical Specification" value="{{ $buyer->chemical_specification }}">
                                                        </div>
                                                        <div class="col-sm-4">
                                                          <input type="text" class="form-control" name="physical_specification" required autocomplete="physical_specification" autofocus placeholder="Physical Specification" value="{{ $buyer->physical_specification }}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                          <button type="submit" class="btn btn-primary btn-sm">Update</button>                 
                                                        </div>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        @if( $buyer->status == 'Active')
                                        <a type="button" class="btn btn-round btn-danger disabled" onclick="return confirm('Are you sure?')" href="#"><i class="fa fa-trash"></i></a>
                                        @else
                                        <a type="button" rel="tooltip" title="Remove" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/delete-buyer', [$buyer->id]) }}"><i class="fa fa-trash"></i></a>
                                        @endif
                                        <!-- <a type="button" rel="tooltip" title="Activate" class="btn btn-round btn-success" onclick="return confirm('Are you sure?')" href="{{ url('activate-enquiry', [$buyer->id]) }}"><i class="fa fa-check"></i></a>
                                        <a type="button" rel="tooltip" title="Deactivate" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-enquiry', [$buyer->id]) }}"><i class="fa fa-times"></i></a> -->
                                      </td>
                                      <td>
                                        @if($buyer->status == 'Active')
                                          <div class="switchery-list"><input data-value="{{$buyer->id}}" type="checkbox" class="js-switch-success-small-1" checked /></div>
                                        @else
                                          <div class="switchery-list"><input data-value="{{$buyer->id}}" type="checkbox" class="js-switch-success-small-1" /></div>
                                        @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                              </div>
                              <div class="tab-pane fade" id="other-offers" role="tabpanel" aria-labelledby="other-offers-tab">
                                  <div class="table-responsive">
                                    <table id="default-datatable3" class="table" style="width: 100%">
                                        <thead>
                                        <tr>
		                                    <th>Product</th>
		                                    <th>Price</th>
		                                    <th>MOQ</th>
		                                    <th>Quantity</th>
		                                      <th>Origin</th>
		                                    <th>Added On</th>
                                        	<th>Valid Till</th>
		                                    <th>Created By</th>
		                                    <th data-orderable="false">Quick Actions</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($availableproducts_one as $item)
			                              
                                             <?php
                                          $no_of_offer_transaction = \App\Seller::where('product', $item->id)->count();
                                          $tilldate = Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i:s');
                                          $past   = new DateTime($tilldate);
                                          $now    = new DateTime();
                                          if ($past<$now)
                                            { $isexpired = 1;}
                                          else
                                            { $isexpired = 0;}
                                          ?>
                                      
			                          
			                             
			                              @if($isexpired == 0 || ($isexpired == 1 && $no_of_offer_transaction > 0))
			                                <tr>
			                                  
			                                  <td>
			                                    {{ $item->product_name }}
			                                  </td>
			                                  <td>
			                                    {{ $item->currency }}{{ number_format($item->price) }}{{ $item->perunit }}
			                                  </td>
			                                  <td>
			                                    {{ $item->minimum_order_quantity }} {{$item->minimum_order_unit}}
			                                  </td>
			                                  <td>
			                                    {{ $item->quantity }}{{ $item->unit }}
			                                  </td>
			                                  <td>
			                                      {{ $item->factory_state }}
			                                  </td>
			                                  <td>
			                                   {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
			                                  </td>
                                        <td>{{ Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i') }}</td>
			                                  <td>
			                                    @foreach($alprofiles as $aprofile)
			                                    <?php if($aprofile->user_id == $item->created_by){ $pcompany = $aprofile->company_name;} ?>
			                                    @endforeach
			                                    {{ $pcompany }}
			                                  </td>
			                                  <td>
			                                      <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Place Your Bid" class="btn btn-primary btn-round" href="{{ url('bidbybuyer', [$item->id, $item->created_by, Auth::user()->id]) }}"><i class="mdi mdi-gavel"></i>
			                                      </a>
                                        </td>
			                                </tr>
			                                @endif
			                                @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                              <div class="tab-pane fade" id="other-enquiries" role="tabpanel" aria-labelledby="other-enquiries-tab">
                                  <div class="table-responsive">
                                    <table id="default-datatable4" class="table" style="width: 100%">
                                        <thead>
                                          <tr>
		                                    <th>Product</th>
		                                    <th>Price</th>
		                                    <th>MOQ</th>
		                                    <th>Quantity</th>
		                                    <th>Origin</th>
		                                    <th>Added On</th>
                                        	<th>Valid Till</th>
		                                    <th>Created By</th>
		                                    <th data-orderable="false">Quick Actions</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($availableproducts_two as $item)
			                            
                                     
                                      <?php                                          
                                          $no_of_enquiry_transaction = \App\Finalbid::where('enquiry_id', $item->id)->count(); 
                                          $tilldate = Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i:s');
                                          $past   = new DateTime($tilldate);
                                          $now    = new DateTime();
                                          if ($past<$now)
                                            { $isexpired = 1;}
                                          else
                                            { $isexpired = 0;}
                                          ?>
                                      @if($isexpired == 0 || ($isexpired == 1 && $no_of_enquiry_transactionb > 0))
                                      
			                                <tr>
			                                  
			                                  <td>
			                                    {{ $item->product_name }}
			                                  </td>
			                                  <td>
			                                    {{ $item->currency }}{{ number_format($item->price) }}{{ $item->perunit }}
			                                  </td>
			                                  <td>{{ $item->minimum_order_quantity }} {{$item->minimum_order_unit}}</td>
			                                  <td>
			                                    {{ $item->quantity }}{{ $item->unit }}
			                                  </td>
			                                  <td> {{ $item->factory_state }}</td>
			                                  <td>
			                                    {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
			                                  </td>
		                                        <td>
		                                          {{ Carbon\Carbon::parse($item->to_date)->format('d-m-Y H:i:s') }}
		                                        </td>
			                                  <td>
			                                  @foreach($alprofiles as $aprofile)
			                                    <?php if($aprofile->user_id == $item->created_by){ $pcompany = $aprofile->company_name;} ?>
			                                    @endforeach
			                                    {{ $pcompany }}
			                                  </td>
			                                  <td>
			                                      <a type="button" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Place Your Bid" class="btn btn-primary btn-round" href="{{ url('bidbyseller', [$item->id, $item->created_by, Auth::user()->id]) }}"><i class="mdi mdi-gavel"></i></a>
			                                   </td>
			                                </tr>
			                                @endif
			                                @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
            <!-- End col -->
          </div>   
          <!-- End row -->
        </div>
        <!-- End Contentbar -->
        <!-- Start Footerbar -->
        @include('new_footer')
        <!-- End Footerbar -->
      </div>
      <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="admin_assets/js/jquery.min.js"></script>
    @include('header_script')
    <script src="admin_assets/js/popper.min.js"></script>
    <script src="admin_assets/js/bootstrap.min.js"></script>
    <script src="admin_assets/js/modernizr.min.js"></script>
    <script src="admin_assets/js/detect.js"></script>
    <script src="admin_assets/js/jquery.slimscroll.js"></script>
    <script src="admin_assets/js/vertical-menu.js"></script>
    
    <!-- Datatable js -->
    <script src="admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="admin_assets/plugins/datatables/jszip.min.js"></script>
    <script src="admin_assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="admin_assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="admin_assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="admin_assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="admin_assets/js/custom/custom-table-datatable.js"></script>
    <script src="admin_assets/js/custom/custom-form-datepicker.js"></script>

    <!-- Sweet-Alert js -->
    <script src="admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="admin_assets/js/custom/custom-sweet-alert.js"></script>

    <!-- Pnotify js -->
    <script src="admin_assets/plugins/pnotify/js/pnotify.custom.min.js"></script>
    <script src="admin_assets/js/custom/custom-pnotify.js"></script>

    <!-- Datepicker JS -->
    <script src="admin_assets/plugins/datepicker/datepicker.min.js"></script>
    <script src="admin_assets/plugins/datepicker/i18n/datepicker.en.js"></script>

    <!-- Switchery js -->
    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>

    <script src="admin_assets/plugins/pnotify/js/pnotify.custom.min.js"></script>
<!--    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>-->
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->   
    <script type="">
      var switchery = {};
      $.fn.initComponents = function () {
          //Init CheckBox Style
          var searchBy = ".js-switch-success-small";
          $(this).find(searchBy).each(function (i, html) {
              debugger;
              if (!$(html).next().hasClass("switchery")) {
                  switchery[html.getAttribute('id')] = new Switchery(html, $(html).data());
              }
          });
          var searchBy = ".js-switch-success-small-1";
          $(this).find(searchBy).each(function (i, html) {
              debugger;
              if (!$(html).next().hasClass("switchery")) {
                  switchery[html.getAttribute('id')] = new Switchery(html, $(html).data());
              }
          });
      };

      /*Offer Switch*/
      $(document).ready(function(){ 
        $("body").initComponents();
        $(".js-switch-success-small").on("change" , function() {
            if($(this).is(":checked"))
            {
              var status = $(this).attr("data-value");
              $.get("statuson", {status: status}, function(data, status)
              {
                if(data == 1){
                  new PNotify( {
                  title: 'Success notice', text: 'Offer Activated Successfully!', type: 'success'
                  });
                }          
              });
            }
            else
            {
              var status = $(this).attr("data-value");
              $.get("statusoff", {status: status}, function(data, status)
              {
                if(data == 1){
                  new PNotify( {
                  title: 'Success notice', text: 'Offer Deactivated Successfully!', type: 'danger'
                  });
                }  
              });
            }
        });

$('[data-toggle="tooltip"]').tooltip();   
    setInterval(function () {
         $('[data-toggle="tooltip"]').tooltip('hide'); 
    }, 3000);

        $('.nav-link').click(function(){
          var tt = $(this);
          
            setTimeout(function(){
              tt.tooltip( 'hide' );
            }, 2000);   
        });

        /*Enquiry Switch*/
        $(".js-switch-success-small-1").on("change" , function() {
            if($(this).is(":checked"))
            {
              var status = $(this).attr("data-value");
              $.get("statusonenquiry", {status: status}, function(data, status)
              {
                if(data == 1){
                  new PNotify( {
                  title: 'Success notice', text: 'Enquiry Activated Successfully!', type: 'success'
                  });
                }          
              });
            }
            else
            {
              var status = $(this).attr("data-value");
              $.get("statusoffenquiry", {status: status}, function(data, status)
              {
                if(data == 1){
                  new PNotify( {
                  title: 'Success notice', text: 'Enquiry Deactivated Successfully!', type: 'danger'
                  });
                }  
              });
            }
        });

        $(".to_date").on("click", function(){
          var data_date = $(this).html();
          var td = $(this);
          var data_id = $(this).data("id");
          $(this).closest("td").append('<div class="input-group" id="in-format'+data_id+'"><input type="text" id="time-format'+data_id+'" class="form-control" placeholder="dd/mm/yyyy - hh:ii aa" aria-describedby="basic-addon5" value="'+data_date+'"><div class="input-group-append"><a class="input-group-text" style="background:#18d26b !important;color:#ffffff !important;" id="click'+data_id+'"  data-toggle="tooltip" data-placement="top" title="Update"><i class="feather icon-check"></i></a></div></div>');
                    $(this).hide();
                    $('#time-format'+data_id).datepicker({
                      dateFormat: 'yyyy-mm-dd',
                      timeFormat: 'hh:ii:00',
                      timepicker: true,
                      dateTimeSeparator: ' ',
                      language: 'en'
                    });

                    $("#click"+data_id).on("click", function(){
                    var selected_date =  $('#time-format'+data_id).val();
                     
                     alert( $('#time-format'+data_id).val());
                     $("#in-format"+data_id).remove();
                     //td.append('<span class="to_date" data-id="'+data_id+'">'+selected_date+'</span>');
                     $.get("ajax-updatedate", {pid: data_id,dt:selected_date}, function(data, status)
                      {
                        if(status=="success")
                        {
                          new PNotify( {
                          title: 'Success notice', text: 'Validity Updated Successfully', type: 'success'
                          });
                        }
                      });
                     td.html(selected_date);
                     $(".to_date").show();
                    });
                     

        });
      });
      
    </script>

<script type="text/javascript">
    	/* Custom filtering function which will search data in column four between two values */
	//	$(document).ready(function() {
		    // Setup - add a text input to each footer cell
	//	    $('#default-datatable tfoot th').each( function () {
	//	        var title = $('#default-datatable tfoot th').eq( $(this).index() ).text();
	//	        $(this).html( '<input class="form-control form-control-sm" type="text" placeholder="Search '+title+'" />' );
	//	    } );
		 
		    // DataTable
	//	    var table = $('#default-datatable').DataTable();
		 
		    // Apply the search
	//	    table.columns().every( function () {
	//	        var that = this;
		 
	//	        $( 'input', this.footer() ).on( 'keyup change', function () {
	//	            console.log(this.value);
		            that
	//	                .search( this.value )
	//	                .draw();
	//	        } );
	//	    } );
		    
		    /*this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );*/
	//	} );
    </script>
</body>
</html>