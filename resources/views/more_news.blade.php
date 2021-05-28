
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

            <!-- <div id="my_header"></div> -->
            <!-- Start Contentbar -->    
            <div class="contentbar m-t-30">  
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="card m-b-30 m-t-30">

                            <div class="card-body text-center">
                                <img src="{{ asset('/admin_theme_assets/img/ads-large.jpg') }}" class="img-fluid" alt="Responsive image">
                            </div>
                        </div>
                    </div>  
                </div>            
               
                <div class="row">
                    @foreach($news as $newz)
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="card m-b-30">
                            <?php foreach (json_decode($newz->image)as $picture) { ?>                     
                            <img class="card-img-top" src="{{ asset('/imageupload/news/'.$picture) }}" alt="blog">
                            <?php } ?>
                            <div class="card-body">
                                <p class="text-center mb-3"><span class="badge badge-success text-uppercase">Tech</span></p>
                                <h5 class="card-title font-18">{{$newz->title}}</h5>
                                <p class="card-text mb-0">{{$newz->description}}</p>                                
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                  
                                   <!-- <div class="col-md-8">
                                        <div class="blog-meta">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">{{$newz->created_at}}</li>
                                                <li class="list-inline-item">|</li>
                                                <li class="list-inline-item">by <a href="#">Admin</a></li>
                                            </ul>
                                        </div>
                                    </div> -->   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    @endforeach                    
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
    @include('header_script')
    <script src="admin_assets/js/popper.min.js"></script>
    <script src="admin_assets/js/bootstrap.min.js"></script>
    <script src="admin_assets/js/modernizr.min.js"></script>
    <script src="admin_assets/js/detect.js"></script>
    <script src="admin_assets/js/jquery.slimscroll.js"></script>
    <script src="admin_assets/js/vertical-menu.js"></script>
    <!-- Switchery js -->

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

    <script src="admin_assets/plugins/switchery/switchery.min.js"></script>
    <!-- Apex js -->
    <script src="admin_assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="admin_assets/plugins/apexcharts/irregular-data-series.js"></script>    
    <!-- Slick js -->
    <script src="admin_assets/plugins/slick/slick.min.js"></script>
    <!-- Custom Dashboard js -->   
    <script src="admin_assets/js/custom/custom-dashboard.js"></script>
    <!-- Core js -->
    <script src="admin_assets/js/core.js"></script>
    <!-- End js -->
</body>
</html>