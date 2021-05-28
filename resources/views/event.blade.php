<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="home_theme_assets/img/favicon.png" rel="icon">
  <link href="home_theme_assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files {{ asset('admin_theme_assets/demo/demo.css') }} -->
  <link href="{{ asset('home_theme_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('home_theme_assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('home_theme_assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Selecao - v2.1.0
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><img src="img/logov2.png" alt="" class="img-fluid"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="active"><a href="{{ url('/about') }}">About Us</a></li>
          <!--<li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li><a href="#team">Team</a></li> -->
          <li><a href="#registration">Why Join Us</a></li>
          <!---<li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>-->
          <li><a href="{{ url('/#contact') }}">Contact Us</a></li>
          <li><a href="{{ route('register') }}">Login/Register</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animated fadeInDown">Event</span></h2>
          <p class="animated fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
        </div>
      </div>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-title" data-aos="zoom-out">
          <h2>Trending Now <span class="float-right"><?php echo date("Y-m-d"); ?></span></h2>
          <p>Event</p>
        </div>
        <!-- card deck start -->
        <div class="row">
          @foreach($events as $event)
          <div class="col-sm-3">
            <div class="card m-1 border-0">
              <?php foreach (json_decode($event->image)as $picture) { ?>
                <img class="card-img-top" src="{{ asset('/imageupload/event/'.$picture) }}" alt="Card image cap">
              <?php } ?>               
              <div class="card-body">
                <h5 class="card-title"><a href="{{ url('complete-event', [$event->id]) }}" >{{Illuminate\Support\Str::limit($event->title , 20)}}</a></h5>
                <p class="card-text">{{Illuminate\Support\Str::limit($event->description , 50)}}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <!--end -->
      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>ViPl</h3>
      <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
      <div class="social-links">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>ViPl</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/selecao-bootstrap-template/ -->
        Designed by <a href="https://bootstrapmade.com/">Webtactic</a>
      </div>
    </div>
  </footer><!-- End Footer -->

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

</body>

</html>