
<!DOCTYPE html>
<html lang="en">
  @include('admin/new_head')
<body class="vertical-layout">    
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
        @include('admin/new_sidebar')
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            @include('admin/new_header')
            <!-- End Topbar -->
             <div class="breadcrumbbar">
              <div class="row align-items-center">
                  <div class="col-md-8 col-lg-8">
                      <h4 class="page-title">Offer(Sale) Enquiry (Buy)</h4>
                      <div class="breadcrumb-list">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Offer(Sale) Enquiry (Buy)</li>
                          </ol>
                      </div>
                  </div>
              </div>          
            </div>
            <!-- Start Contentbar -->    
            <div class="contentbar "> 
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
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <!-- Start row -->
                        
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Offer(Sale) Enquiry (Buy)</h5>
                </div>
                <ul class="nav nav-tabs mb-3" id="defaultTab" role="tablist">
                          <li class="nav-item" data-toggle="tooltip" data-placement="top"  >
                              <a class="nav-link active" id="my-offers-tab" data-toggle="tab" href="#my-offers" role="tab" aria-controls="my-offers" aria-selected="true">Offer(Sale) </a>
                          </li>
                          <li class="nav-item" data-toggle="tooltip" data-placement="top" >
                              <a class="nav-link" id="my-enquiries-tab" data-toggle="tab" href="#my-enquiries" role="tab" aria-controls="my-enquiries" aria-selected="false">Enquiry(Buy)</a>
                          </li>
                </ul>

                 <div class="tab-content" id="defaultTabContent">
                    <div class="tab-pane fade show active" id="my-offers" role="tabpanel" aria-labelledby="my-offers-tab">
                    <div class="table-responsive">
                   <table id="default-datatable" class="table">
                      <thead>
                        <th>Id</th>
                        <th>Added On</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th data-orderable="false">Quick Actions</th>
                      </thead>
                      @foreach ($sellers as $seller)
                      <?php
                          $b1 = \App\Finalbid::where('offer_id', $seller->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity');
                          $profile_name = \App\Profile::where('user_id', $seller->created_by)->get()->pluck('company_name')->first();?>
                      <tr>
                        <td>{{ $seller->id }}</td>
                        <td>{{ $seller->created_at }}</td>
                        <td>{{ $seller->product_name }}</td>
                        <td>{{ $seller->currency }}{{ number_format($seller->price) }}{{ $seller->perunit }}</td>
                        <td>{{ $seller->quantity-$b1 }}{{ $seller->unit }}</td>
                        <td>
                          <button type="button" rel="tooltip" title="View User" class="btn btn-link text-left" data-toggle="modal" data-target="#createdby{{ $seller->id }}">
                            @foreach($thisusers->where('id',$seller->created_by) as $thisuser)
                            {{$profile_name}}
                            @endforeach
                          <!-- {{ $seller->created_by }}-->
                           </button>
                          <!-- Modal -->
                            <div class="modal fade" id="createdby{{ $seller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Created By</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <table class="table table-sm table-bordered">
                                      @foreach($thisusers->where('id',$seller->created_by) as $thisuser)
                                      <tr>
                                        <th>Name</th>                                        
                                        <th>Email</th>
                                        <th>Phone</th>
                                      </tr>
                                      <tr>
                                        <td>{{$thisuser->name}}</td>
                                        <td>{{$thisuser->email}}</td>
                                        <td>{{$thisuser->phone}}</td>
                                      </tr>
                                      <tr>                                        
                                        <th>Status</th>
                                        <th>Joined On</th>
                                        <th>Subusers</th>
                                      </tr>
                                      <tr>
                                        <td>{{$thisuser->status}}</td>
                                        <td>{{$thisuser->created_at}}</td>
                                        <td>{{$thisuser->subusercount}}</td>
                                      </tr>
                                      @endforeach
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal End -->
                        </td>
                        <td>{{ $seller->status }}</td>
                        <td class="td-actions text-left">
                          <button type="button" rel="tooltip" title="View Offer" class="btn btn-primary btn-round" data-toggle="modal" data-target="#viewOffer{{ $seller->id }}"><i class="fa fa-eye"></i>
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
                                        <td>{{ $seller->product_name }}</td>
                                      </tr>
                                      <tr>
                                        <th>Price</th>
                                        <td>{{ $seller->currency }}{{ $seller->price }}{{ $seller->perunit }}</td>
                                        <th>Quantity</th>
                                        <td>{{ $seller->quantity-$b1 }}{{ $seller->unit }}</td>
                                      </tr>
                                      <tr>
                                        <th>Origin</th>
                                        <td>{{ $seller->state }}</td>
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
                                        <th>Physical Specifications</th>
                                        <td>{{ $seller->physical_specification }}</td>
                                        <th>Status</th>
                                        <td>{{ $seller->status }}</td>
                                      </tr>
                                       <tr>
                                          <?php foreach (json_decode($seller->product_image)as $picture) { ?>
                                            <td><img src="{{ asset('/imageupload/offer/'.$picture) }}" style="height:60px; width:100px"/></td>
                                          <?php } ?>
                                           
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal End -->
                          @if($seller->status == 'Active')
                          <button type="button" rel="tooltip" class="btn btn-primary btn-round disabled" data-toggle="modal" data-target="#"><i class="fa fa-edit"></i>
                          </button>
                          @else
                          <button type="button" rel="tooltip" title="Edit Offer" class="btn btn-primary btn-round" data-toggle="modal" data-target="#editOffer{{ $seller->id }}"><i class="fa fa-edit"></i>
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
                                          <div class="col-sm-3">
                                            <input type="text" class="form-control" name="id" required autocomplete="id" autofocus readonly="readonly" value="{{ $seller->id }}">
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="number" class="form-control" name="price" required autocomplete="price" autofocus placeholder="Price" value="{{ $seller->price }}">                
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="number" class="form-control" name="quantity" required autocomplete="quantity" autofocus placeholder="Quantity" value="{{ $seller->quantity }}">                
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="text" class="form-control" name="origin" required autocomplete="origin" autofocus placeholder="Origin" value="{{ $seller->origin }}">                
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <input type="text" class="form-control" name="tandc" required autocomplete="tandc" autofocus placeholder="Terma and Condition" value="{{ $seller->tandc }}">
                                          </div>
                                          <div class="col-sm-6">
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
                          <a type="button" rel="tooltip"data-toggle="tooltip" data-placement="top"  class="btn btn-danger btn-round disabled" onclick="return confirm('Are you sure?')" href="#"><i class="fa fa-trash"></i></a>
                          @else
                          <a type="button" rel="tooltip" title="Remove Offer" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('/delete-seller', [$seller->id]) }}"><i class="fa fa-trash"></i></a>
                          @endif
                          <a type="button" rel="tooltip" title="Activate Offer" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('activate-offer', [$seller->id]) }}"><i class="fa fa-check"></i></a>
                          <a type="button" rel="tooltip" title="Deactivate Offer"  data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-offer', [$seller->id]) }}"><i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  </div>

                <!--Enquiry add by shreemant-->
                     <div class="tab-pane fade" id="my-enquiries" role="tabpanel" aria-labelledby="my-enquiries-tab">
                    <div class="table-responsive">
                <table id="default-datatable" class="table">
                      <thead>
                        <th>Id</th>
                        <th>Added On</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th data-orderable="false">Quick Actions</th>
                      </thead>
                      @foreach ($buyers as $buyer)
                      <?php
                          $b1 = \App\Finalbid::where('enquiry_id', $buyer->id)->where('status', 'Completed')->where('admin_confirmation', '!=', 'Rejected')->get()->sum('new_quantity'); 
                          $profile_name = \App\Profile::where('user_id', $buyer->created_by)->get()->pluck('company_name')->first();?>
                      <tr>
                        <td>{{ $buyer->id }}</td>
                        <td>{{ $buyer->created_at }}</td>
                        <td>{{ $buyer->product_name }}</td>
                        <td>{{ $buyer->currency }}{{ number_format($buyer->price) }}{{ $buyer->perunit }}</td>
                        <td>{{ $buyer->quantity-$b1 }}{{ $buyer->unit }}</td>
                        <td>
                          <button type="button" rel="tooltip" title="View User" class="btn btn-link text-left" data-toggle="modal" data-target="#createdby{{ $buyer->id }}">
                            @foreach($thisusers->where('id',$buyer->created_by) as $thisuser)
                              {{$profile_name}}
                            @endforeach
                            <!-- {{ $buyer->created_by }} -->
                          </button>
                          <!-- Modal -->
                            <div class="modal fade" id="createdby{{ $buyer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Created By</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <table class="table table-sm table-bordered">
                                      @foreach($thisusers->where('id',$buyer->created_by) as $thisuser)
                                      <tr>
                                        <th>Name</th>                                        
                                        <th>Email</th>
                                        <th>Phone</th>
                                      </tr>
                                      <tr>
                                        <td>{{$thisuser->name}}</td>
                                        <td>{{$thisuser->email}}</td>
                                        <td>{{$thisuser->phone}}</td>
                                      </tr>
                                      <tr>                                        
                                        <th>Status</th>
                                        <th>Joined On</th>
                                        <th>Subusers</th>
                                      </tr>
                                      <tr>
                                        <td>{{$thisuser->status}}</td>
                                        <td>{{$thisuser->created_at}}</td>
                                        <td>{{$thisuser->subusercount}}</td>
                                      </tr>
                                      @endforeach
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal End -->
                        </td>
                        <td>{{ $buyer->status }}</td>
                        <td class="td-actions text-left">
                          <button type="button" rel="tooltip" title="View Enquiry" class="btn btn-primary btn-round" data-toggle="modal" data-target="#viewEnquiry{{ $buyer->id }}"><i class="fa fa-eye"></i>
                          </button>
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
                                        <td>{{ $buyer->currency }}{{ $buyer->price }}{{ $buyer->perunit }}</td>
                                        <th>Quantity</th>
                                        <td>{{ $buyer->quantity-$b1 }}{{ $buyer->unit }}</td>
                                      </tr>
                                      <tr>
                                        <th>Origin</th>
                                        <td>{{ $buyer->state }}</td>
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
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!--  @if( $buyer->status == 'Active')
                          <button type="button" class="btn btn-primary btn-round disabled" data-toggle="modal" data-target="#"><i class="fa fa-edit"></i>
                          </button>
                          @else
                          <button type="button" rel="tooltip" title="Edit Enquiry" class="btn btn-primary btn-round" data-toggle="modal" data-target="#editOffer{{ $buyer->id }}"><i class="fa fa-edit"></i>
                          </button>
                          @endif-->
                          <!-- Modal -->
                             <!-- <div class="modal fade" id="editOffer{{ $buyer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <div class="col-sm-3">
                                            <input type="text" class="form-control" name="id" required autocomplete="id" autofocus readonly="readonly" value="{{ $buyer->id }}">
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="number" class="form-control" name="price" required autocomplete="price" autofocus placeholder="Price" value="{{ $buyer->price }}">                
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="number" class="form-control" name="quantity" required autocomplete="quantity" autofocus placeholder="Quantity" value="{{ $buyer->quantity }}">                
                                          </div>
                                          <div class="col-sm-3">
                                             <input type="text" class="form-control" name="origin" required autocomplete="name" autofocus placeholder="Origin" value="{{ $buyer->origin }}">                
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <input type="text" class="form-control" name="tandc" required autocomplete="tandc" autofocus placeholder="Terms and Condition" value="{{ $buyer->tandc }}">
                                          </div>
                                          <div class="col-sm-6">
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
                              </div>-->
                       <!--   @if( $buyer->status == 'Active')
                          <a type="button" class="btn btn-danger   btn-round disabled" href="#"><i class="fa fa-trash"></i></a>
                          @else
                          <a type="button" rel="tooltip" title="Remove enquiry" data-toggle="tooltip" data-placement="top"  class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('/delete-buyer', [$buyer->id]) }}"><i class="fa fa-trash"></i></a>
                          @endif-->
                         <!-- <a type="button" rel="tooltip" title="Activate Enquiry" data-toggle="tooltip" data-placement="top"  class="btn btn-success btn-round" onclick="return confirm('Are you sure?')" href="{{ url('activate-enquiry', [$buyer->id]) }}"><i class="fa fa-check"></i></a>-->
                          <a type="button" rel="tooltip" title="Deactivate Enquiry" data-toggle="tooltip" data-placement="top"  class="btn btn-danger btn-round" onclick="return confirm('Are you sure?')" href="{{ url('deactivate-enquiry', [$buyer->id]) }}"><i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                  </div>

                <!--End of the code shreemant-->
                </div>
              </div>
            
                        <!-- End row -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            @include('admin/new_footer')
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/detect.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin_assets/js/vertical-menu.js') }}"></script>
    <!-- Switchery js -->
    <script src="{{ asset('admin_assets/plugins/switchery/switchery.min.js') }}"></script>
    <!-- Apex js -->
    <script src="{{ asset('admin_assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/apexcharts/irregular-data-series.js') }}"></script>    
    <!-- Slick js -->
    <script src="{{ asset('admin_assets/plugins/slick/slick.min.js') }}"></script>
    <!-- Datatable js -->
    <script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-table-datatable.js') }}"></script>
    <script src="{{ asset('admin_assets/js/custom/custom-form-datepicker.js') }}"></script>

    <!-- Custom Dashboard js -->   
    <script src="{{ asset('admin_assets/js/custom/custom-dashboard.js') }}"></script>
    <!-- Core js -->
    <script src="{{ asset('admin_assets/js/core.js') }}"></script>
    <!-- End js -->
</body>
</html>