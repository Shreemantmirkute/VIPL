<footer id="footer">
    <div class="container">
      <!-- <h3>VyapaarNetwork</h3>
      <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p> -->
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="footer-links" id="footer-links">
        
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>VyapaarNetwork</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/selecao-bootstrap-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">Webtactic</a> -->
      </div>
    </div>
  </footer>
  <style type="text/css">
    .footer-links a
    {
      display: inline-block;
      padding: 5px;
    }
  </style>
  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files {{ asset('admin_theme_assets/demo/demo.css') }}  -->
  <script src="{{ asset('home_theme_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('home_theme_assets/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('home_theme_assets/js/main.js') }}"></script>

  <script>
  $(document).ready(function(){
      
    $.get("ajax-informationpage", function(data, status)
    {
      $.each(data,function(index,subcatObj)
      {       
        $("#footer-links").append(' <a href="'+subcatObj.link+'">'+subcatObj.title+'</a>'); 
      });
    });
    $(".notification_seen").change(function()
      {
        var prod = $(this).val();
        $.get("notification_seen", {cid: prod}, function(data, status)
        {
          
        });
      });
  });
</script>