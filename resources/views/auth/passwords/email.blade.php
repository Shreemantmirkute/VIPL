<!DOCTYPE html>
<html lang="en">

<head>
  @include('new_head')
</head>

<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box forgot-password-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                        <div class="form-head">
                                            <a href="index.html" class="logo"><img src="{{ asset('admin_theme_assets/img/logoblack.png') }}" class="img-fluid" alt="logo"></a>
                                        </div> 
                                        <h4 class="text-primary my-4">Forgot Password ?</h4>
                                        <p class="mb-4">Enter the email address below to receive reset password instructions.</p>
                                        <div class="form-group">
                                            <input type="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                      <button type="submit" class="btn btn-success btn-lg btn-block font-18">Send Email</button>
                                    </form>
                                    <p class="mb-0 mt-3">Remember Password? <a href="{{ url('login') }}">Log in</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>

  <!-- Start js -->        
    <script src="admin_assets/js/jquery.min.js"></script>
    <script src="admin_assets/js/popper.min.js"></script>
    <script src="admin_assets/js/bootstrap.min.js"></script>
    <script src="admin_assets/js/modernizr.min.js"></script>
    <script src="admin_assets/js/detect.js"></script>
    <script src="admin_assets/js/jquery.slimscroll.js"></script>
    <!-- End js -->
</body>

</html>