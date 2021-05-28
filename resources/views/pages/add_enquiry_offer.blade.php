<!DOCTYPE html>
<html lang="en">

@include('new_head')

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
                        <h4 class="page-title">Add New Enquiry / Offer</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/enquiry-offer-view') }}">Enquiry / Offer</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New Enquiry / Offer</li>
                            </ol>
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
                  <form class="form-validate" method="POST" action="{{ url('/save-enquiry-offer') }}" enctype="multipart/form-data">
                      @csrf                    
                    <!-- Start row -->
                    <div class="row">
                      
                        <!-- Start col -->
                        <div class="col-lg-12">
                          <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Basic Details</h5>
                            </div>
                            <div class="card-body">
                              <div class="form-row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="val-username">Select product for creating offer / enquiry</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <label class="input-group-text" for="exampleFormControlSelect2">Product</label>
                                      </div>
                                      <select class="form-control input-group" data-style="btn btn-link" id="thisUserProducts" name="product" onchange='CheckColors(this.value);'>
                                        <option value="" data-id="0">Choose</option>
                                        @foreach($thisuserproducts as $thisuserproduct)
                                        <option value="{{$thisuserproduct->id}}" data-id="{{ $thisuserproduct->register_as }}"  data-currency="{{ $thisuserproduct->currency }}" data-units="{{ $thisuserproduct->perunit }}"  data-prodname="{{$thisuserproduct->product}}">{{$thisuserproduct->product}}</option>
                                        @endforeach                           
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="val-username">Select whether to buy or sell</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <label class="input-group-text" for="exampleFormControlSelect2">Buyer/Seller</label>
                                      </div>
                                      <select class="form-control input-group" data-style="btn btn-link" id="thisProductBusinesType" name="register_as">
                                        <option value="">Choose</option>                                 
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="val-username">Your Origin State</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <label class="input-group-text" for="exampleFormControlSelect2">Origin</label>
                                      </div>
                                      <select class="form-control input-group border" data-style="btn btn-link" id="thisProductBusinesType2">
                                        <?php $originofuser = \App\Profile::where('user_id', Auth::user()->id)->get()->first();
                                        $originareyou = $originofuser->are_you;
                                        if( $originareyou == 'Manufacturer'){
                                          $originorigin = $originofuser->factory_state;
                                        }else{
                                          $originorigin = $originofuser->office_state;
                                        } ?>
                                        <option>{{$originorigin}}</option>                                 
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                <input type="text" name="created_by" style="display:none;" value="{{ Auth::user()->id }}" class="state">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="val-username">Enter quantity of product</label>
                                    <div class="input-group mb-3">
                                      <input type="number" name="quantity" placeholder="Quantity" class="form-control"  id="quantity" value="" min="">
                                      <div class="input-group-append">
                                        <select name="unit" class="form-control pl-1 pr-1">
                                          <option class="">Unit</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="val-username">Enter minimum order quantity of product</label>
                                    <div class="input-group">
                                          <input type="number" name="minimum_order_quantity" placeholder="Quantity" class="form-control" id="minimum_order_quantity">
                                          <div class="input-group-prepend">
                                            <select name="minimum_order_unit" class="form-control pl-1 pr-1">
                                              <option class="">Unit</option>
                                            </select>
                                          </div>
                                      </div> 
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="val-username">Enter cost of product per unit</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <select name="currency" class="form-control pl-2 pr-2">
                                          <option class="">Currency</option>
                                        </select>
                                      </div>
                                      <input type="number" name="price" placeholder="Price" class="form-control">
                                      <div class="input-group-append">
                                        <select name="unit" class="form-control pl-1 pr-1">
                                          <option class="">Unit</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="val-username">Select Tax Class</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <label class="input-group-text" for="exampleFormControlSelect2">Tax Class</label>
                                      </div>
                                      <select class="form-control input-group" id="" name="taxclass">
                                        <option value="">Choose</option> 
                                        @foreach($taxclass as $tc)                        
                                          <option value="{{$tc->id}}">{{$tc->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="val-username">Select the states where the product will be available to buyers / sellers</label>
                                    <!-- <select class="select2-multi-select form-control" name="state[]" multiple="multiple" id="state">
                                      <option value="">Select State</option>   
                                    </select> -->
                                      
                                      <select class="select2-multi-select form-control" name="state[]" id="state1" multiple="multiple" required>
                                      	<option value="all">All</option>
                                          @foreach ($allstate->unique() as $state)                            
                                            <option>{{ $state }}</option>
                                          @endforeach  
                                    	</select>
                                  </div>
                                </div>  
                              </div>
                              <br>
                              <div class="form-row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="val-username">Select start date and time for the offer/enquiry</label>
                                    <div class="input-group">
	                                    <input type="text" id="time-format" name="from_date" class="form-control" placeholder="dd/mm/yyyy - hh:ii aa" aria-describedby="basic-addon5" />
	                                    <div class="input-group-append">
	                                        <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
	                                    </div>
                                	</div>
                                  </div>
                                </div> 
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="val-username">Select end date and time for the offer/enquiry</label>
                                    <div class="input-group">
	                                    <input type="text" id="time-format-2" name="to_date" class="form-control" placeholder="dd/mm/yyyy - hh:ii aa" aria-describedby="basic-addon5" />
	                                    <div class="input-group-append">
	                                        <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
	                                    </div>
                                	</div>
                                  </div>
                                </div>  
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-12">
                          <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Add Product Image</h5>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-6 product_image" >
                                  <!-- <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                </form> -->
                                  <!--<div class="mt-3">                                           
                                    <input type="file" name="product_image[]" class="form-control">
                                  </div>-->
                                  <div class="input-group increment">
                                    <div class="custom-file">
                                    	<input type="file" name="product_image[]" id="image_upload" class="form-control" multiple>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button" id="btn1">Add</button>
                                    </div>
                                </div>
                                <br>
                                <span>Only 10 images can be uploaded. Images must in png / jpeg / jpg format only.</span>
                                  <!-- <div class="clone d-none">
                                    <div class="control-group input-group" style="margin-top:10px">
                                    	<div class="custom-file">
                                      <input type="file" name="product_image[]" class="form-control">
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" id="btn1">Remove</button>
                                    </div>
                                    </div>
                                  </div>  --> 
                                </div> 
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Other Details</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="row">
                            <div class="col-lg-12 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="nav flex-column nav-pills" id="v-pills-product-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link mb-2 active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true"><i class="fa fa-flask mr-2"></i>Chemical Specification / Grade</a>
                                            <a class="nav-link mb-2" id="v-pills-stock-tab" data-toggle="pill" href="#v-pills-stock" role="tab" aria-controls="v-pills-stock" aria-selected="false"><i class="fa fa-dropbox mr-2"></i>Physical Specification / Size</a>
                                            <a class="nav-link mb-2" id="v-pills-shipping-tab" data-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="false"><i class="fa fa-money mr-2"></i>Payment Terms</a>
                                            <a class="nav-link mb-2" id="v-pills-advanced-tab" data-toggle="pill" href="#v-pills-advanced" role="tab" aria-controls="v-pills-advanced" aria-selected="false"><i class="fa fa-info-circle mr-2"></i>Other terms and condition</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-8">
                              <div class="card m-b-30">
                                <div class="card-body">
                                  <div class="tab-content" id="v-pills-product-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                      <div class="form-group">
                                      <label for="chemical_specification">Enter Product Chemical Specification / Grade</label>
                                        <div>
                                            <textarea rows="5" name="chemical_specification" placeholder="Chemical Specification / Grade" class="form-control"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-stock" role="tabpanel" aria-labelledby="v-pills-stock-tab">
                                      <div class="form-group">
                                        <label for="chemical_specification">Enter Product Physical Specification / Size</label>
                                        <div>
                                          <textarea rows="5" name="physical_specification" placeholder="Physical Specification / Size" class="form-control"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                      <div class="form-group">
                                        <label for="chemical_specification">Enter Payment Terms</label>
                                        <div>
                                          <textarea rows="5" name="tandc" placeholder="Payment Terms" class="form-control"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-advanced" role="tabpanel" aria-labelledby="v-pills-advanced-tab">
                                      <div class="form-group">
                                        <label for="chemical_specification">Enter Other Terms and Conditions</label>
                                        <div>
                                          <textarea rows="5" name="otandc" placeholder="Other terms and condition" class="form-control"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                          <button type="submit" name="Submit" class="btn btn-primary">Publish</button>
                      
                                    
                    </div>
                  </form>
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
    <!-- Switchery js -->
    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>

    <!-- Select2 js -->
    <script src="admin_assets/plugins/select2/select2.min.js"></script>    
    <!-- Tagsinput js -->
    <script src="admin_assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="admin_assets/plugins/bootstrap-tagsinput/typeahead.bundle.js"></script>
    <script src="admin_assets/js/custom/custom-form-select.js"></script>

    <!-- Datepicker JS -->
    <script src="admin_assets/plugins/datepicker/datepicker.min.js"></script>
    <script src="admin_assets/plugins/datepicker/i18n/datepicker.en.js"></script>
    <script src="admin_assets/js/custom/custom-form-datepicker.js"></script>

    
    <!-- Parsley js -->
    <script src="admin_assets/plugins/validatejs/validate.min.js"></script>

    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <script>
        var dateToday = new Date();    
         $(function () {
             $("#time-format").datepicker({ 
                 minDate: dateToday 
             });
         });
    </script>
      <script>
        var dateToday = new Date();    
         $(function () {
             $("#time-format-2").datepicker({ 
                 minDate: dateToday 
             });
         });
    </script>
    <!-- End js -->
    <script type="text/javascript">
    var count = 9;
      $(document).ready(function() {      
        $btn = $('button[type="submit"]');
        $(".btn-success").click(function(){ 
            var html = $(".clone").html();
            count--;         
            if ( count == 0 )
            {
              $('#btn1').prop('disabled', true);
            }
            $(".increment").after(html);
        });
        $("body").on("click",".btn-danger",function(){ 
          count++;
          if ( count != 0 )
            {
              $('#btn1').prop('disabled', false);
            }
          $(this).parents(".control-group").remove();
        });
      });
  </script>
  <script>
  $(document).ready(function(){
      $("#prod").change(function()
      {
        var prod = $(this).val();
        $.get("ajax-atri", {cid: prod}, function(data, status)
        {
          //alert("Data: " + data + "\nStatus: " + status);
          $('#atri').empty();
          $.each(data,function(index,subcatObj)
          {
          $('#atri').append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
          });
        });
      });


      $("#exampleFormControlSelect3").change(function()
      {
        var businesstype = $(this).val();
        $.get("productsBusinessTypeWise", {businesstype: businesstype}, function(data, status)
        {
          // console.log("Response yaha ayega")
          console.log(data)
          data = $.parseJSON(data)
          console.log(data)
          // console.log(status)
          //alert("Data: " + data + "\nStatus: " + status);
          $('#exampleFormControlSelect1').empty();
          $.each(data,function(index,obj)
          {
          $('#exampleFormControlSelect1').append('<option value ="'+obj.product+'">'+obj.product+'</option>');
          });
        });
      });
      $("#image_upload").on("change", function() {
		    if ($("#image_upload")[0].files.length > 10) {
		        alert("<p>You can select only 10 images</p>");
		    }
		});
      $("#thisUserProducts").change(function()
      {
        register_as = $(this).find("option:selected").attr("data-id")
        data_currency = $(this).find("option:selected").attr("data-currency")
        data_units = $(this).find("option:selected").attr("data-units")
        data_prodname = $(this).find("option:selected").attr("data-prodname")
        var buyerstate = JSON.parse('<?php echo json_encode($buyerstate); ?>');
        var sellerstate = JSON.parse('<?php echo json_encode($sellerstate); ?>');

        /*if (register_as == "0") {
          $('#thisProductBusinesType').hide();
        }
        else {

          $('#thisProductBusinesType').show();
        }*/
        $('#thisProductBusinesType').empty();
        $('#state').empty();
        $("select[name='currency']").empty();
        $("select[name='perunit'], select[name='unit'], select[name='minimum_order_unit']").empty();

        $("#thisProductBusinesType").append("<option value='"+register_as+"' selected>"+register_as+"</option>")
        if(register_as == 'Buyer')
        {
          var allstatelist = [];
        	$.each(buyerstate, function(index, value)
        	{
            $.each(value,function(i){
              allstatelist.push(value[i]);
            });
    			});
          var uniquestate = allstatelist.filter((item, i, ar) => ar.indexOf(item) === i);
          $.each(uniquestate,function(i){
            $("#state").append("<option value='"+uniquestate[i]+"'>"+uniquestate[i]+"</option>");
          });	
        }
        if(register_as == 'Seller')
        {
          var allstatelist = [];
        	$.each(sellerstate, function(index, value)
        	{
    			$.each(value,function(i){
              allstatelist.push(value[i]);
            });
    			});	
          var uniquestate = allstatelist.filter((item, i, ar) => ar.indexOf(item) === i);
          $.each(uniquestate,function(i){
            $("#state").append("<option value='"+uniquestate[i]+"'>"+uniquestate[i]+"</option>");
          }); 
        }
		
        $("select[name='currency']").append("<option value='"+data_currency+"' selected>"+data_currency+"</option>")

        $("select[name='perunit'], select[name='unit'], select[name='minimum_order_unit']").append("<option value='"+data_units+"' selected>"+data_units+"</option>")



      });

  });



  </script>
  <script type="text/javascript">
  	/*
--------------------------------
    : Custom - Validate js :
--------------------------------
*/
"use strict";
$(document).ready(function() {
    $(".form-validate").validate({
        ignore: [],
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group > div").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
        rules: {
            "val-email": {
                required: !0,
                email: !0
            },
            "register_as": {
                required: !0
            },
            "val-confirm-password": {
                required: !0,
                equalTo: "#val-password"
            },
            "product": {
                required: !0
            },
            "state[]": {
                required: !0
			},
            "price": {
                required: !0,
            },
            "taxclass": {
                required: !0
            },
            "from_date": {
                required: !0
            },
            "to_date": {
                required: !0
            },
            "quantity": {
                required: !0
            },
            "minimum_order_quantity": {
                required: !0
            },
            "val-range": {
                required: !0,
                range: [1, 5]
            },
            "val-terms": {
                required: !0
            }
        },
        messages: {
            "register_as": "Please select a value!",
            "product": "Please select a value!",
            "state[]": "Please select at least one state",
            "price": "Please enter a price",
            "taxclass": "Please select a tax class",
            "from_date": "Please enter start date",
            "to_date": "Please enter end date",
            "quantity": "Please enter a quantity!",
            "minimum_order_quantity": "Please enter a quantity!",
            "val-range": "Please enter a number between 1 and 5!",\
            "val-terms": "You must agree to the service terms!"
        }
    })   
});
  </script>
</body>

</html>