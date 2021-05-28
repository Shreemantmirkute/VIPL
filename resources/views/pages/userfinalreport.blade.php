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
                            <h4 class="page-title">Customized Report</h4>
                            <div class="breadcrumb-list">
                                <ol class="breadcrumb">
                                    
                                    <li class="breadcrumb-item"><a href="{{ url('/user_dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Customized Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Breadcrumbbar -->
                <!-- Start Contentbar -->
                <div class="contentbar">
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-12 col-xl-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form>
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Select Product</label>
                                                <select name="subproduct" id="subproduct" class="form-control">
                                                    <option>Select Product</option>
                                                    @foreach($items as $item)
                                                    @if($item->created_by == Auth::user()->id)
                                                    <option>{{$item->product}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Select Buyer/Seller</label>
                                                <select name="buyerseller" id="buyerseller" class="form-control">
                                                    <option>Select Buyer/Seller</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>From Date</label>
                                                <input type="date" name="fromdate" value="<?php echo date('Y-m-01'); ?>" class="datepicker-here form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>To Date</label>
                                                <input type="date" name="todate" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d"); ?>" class="datepicker-here form-control">
                                            </div>
                                        </div>
                                        <div class="form-row" style="float: right">
                                            <input type="submit" name="Submit" value="Generate Report" class="btn btn-success" >
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-12" id="report-section">
                            <!-- Start row -->
                            <div class="card m-b-30">
                                <!-- <div class="card-header">
                                    <h5 class="card-title"></h5>
                                </div> -->
                                <div class="card-body">
                                    <div id="mytable">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table">
                                                <thead>
                                                    <th>Created At</th>
                                                    <th>Id</th>
                                                    <th>Sub-Product</th>
                                                    <th>Buyer</th>
													<th>Seller</th>
                                                    <th>Register As</th>
                                                    <th>Total Quantity</th>
                                                    <th>Total Price</th>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End row -->
                            </div>
                            <!-- End col -->
                        </div>
                    </div>
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
        <script src="admin_assets/js/popper.min.js"></script>
        <script src="admin_assets/js/bootstrap.min.js"></script>
        <script src="admin_assets/js/modernizr.min.js"></script>
        <script src="admin_assets/js/detect.js"></script>
        <script src="admin_assets/js/jquery.slimscroll.js"></script>
        <script src="admin_assets/js/vertical-menu.js"></script>
        <!-- Switchery js -->
        <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
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
        <!-- Sweet-Alert js -->
        <script src="admin_assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="admin_assets/js/custom/custom-sweet-alert.js"></script>
        
        <!-- Core js -->
        <script src="admin_assets/js/core.js"></script>
        <!-- End js -->
        @include('header_script')
        <script type="text/javascript">
        $(document).ready(function(){
        $("#subproduct").change(function()
        {
        var prod = $(this).val();
        $.get("ajax-get-item-user", {cid: prod}, function(data, status)
        {
        $('#buyerseller').empty();
        $('#buyerseller').append('<option value ="">Select Buyer or Seller</option>');
        $.each(data,function(index,subcatObj)
        {
        $('#buyerseller').append('<option value ="'+subcatObj.user_id+'">'+subcatObj.company_name+'</option>');
        });
        });
        });
        $('form').on('submit', function (e)
        {
        $("#report-section").show();
        var t = $('#datatable-buttons').DataTable();
        t.clear().draw();
        e.preventDefault();
        $.ajax({
        type: 'get',
        url: 'admin/finalreport',
        data: $('form').serialize(),
        success: function (mydata) {
        //$("mytable").append('jcjd'+index);
        $.each(mydata,function(index,subcatObj)
        {
        t.row.add( [
        subcatObj.created_at,
        subcatObj.id,
        subcatObj.product,
        subcatObj.buyer,
		subcatObj.seller,
        subcatObj.register_as,
        subcatObj.totalqty,
        subcatObj.totalprice
        ] ).draw( false );
        
        });
        //alert(mydata);
        }
        });
        });
        });
        </script>
    </body>
</html>