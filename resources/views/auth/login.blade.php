<!DOCTYPE html>
<html lang="en">
    @include('new_head')
    <body class="vertical-layout">
        <!-- Start Containerbar -->
        <div id="containerbar" class="containerbar authenticate-bg">
            <!-- Start Container -->
            <div class="container">
                <div class="auth-box login-box">
                    <!-- Start row -->
                    <div class="row no-gutters align-items-center justify-content-center">
                        <!-- Start col -->
                        <div class="col-md-6 col-lg-5">
                            <!-- Start Auth Box -->
                            <div class="auth-box-right">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" id="login-btn" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-head">
                                                <a href="index.html" class="logo"><img src="{{ asset('admin_theme_assets/img/logoblack.png') }}" class="img-fluid" alt="logo"></a>
                                            </div>
                                            <h4 class="text-primary my-4">Log in !</h4>
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Registered Email here">
                                                @error('email')
                                                <span class="text-danger" role="">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"placeholder="Enter Password here">
                                                @error('password')
                                                <span class="text-danger" role="">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-checkbox text-left">
                                                        <input type="checkbox" class="custom-control-input" id="rememberme">
                                                        <label class="custom-control-label font-14" for="rememberme">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="forgot-psw">
                                                        <a id="forgot-psw" href="{{ url('password/reset') }}" class="font-14">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" onclick="initFirebaseMessagingRegistration()" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                                        </form>
                                        <!-- <div class="login-or">
                                            <h6 class="text-muted">OR</h6>
                                        </div>
                                        <div class="social-login text-center">
                                            <button type="submit" class="btn btn-primary-rgba font-18"><i class="mdi mdi-facebook mr-2"></i>Facebook</button>
                                            <button type="submit" class="btn btn-danger-rgba font-18"><i class="mdi mdi-google mr-2"></i>Google</button>
                                        </div> -->
                                        <p class="mb-0 mt-3">Don't have a account? <a href="{{ url('register') }}">Sign up</a></p>
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
        <!-- End Containerbar -->

        <!-- Start js -->
        <script src="admin_assets/js/jquery.min.js"></script>
        <script src="admin_assets/js/popper.min.js"></script>
        <script src="admin_assets/js/bootstrap.min.js"></script>
        <script src="admin_assets/js/modernizr.min.js"></script>
        <script src="admin_assets/js/detect.js"></script>
        <script src="admin_assets/js/jquery.slimscroll.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
        <!--<script src ="/beta/public/firebase-messaging-sw.js"></script>-->
    <script>
  
    var firebaseConfig = {
        apiKey: "AIzaSyDqr9nF25xfxOSfCew_HdmqiNDdI4tcHp0",
        authDomain: "mymotifs-56d44.firebaseapp.com",
        databaseURL: "https://mymotifs-56d44.firebaseio.com",
        projectId: "mymotifs-56d44",
        storageBucket: "mymotifs-56d44.appspot.com",
        messagingSenderId: "1093645415864",
        appId: "1:1093645415864:web:cefb36d03f78a1f9a98b4d",
        measurementId: "G-968CH64QZ3"
    };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
         email = $('#email').val();
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'GET',
                    data: {
                        email: email,
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        //alert('Token saved successfully.');
                          $('#login-btn').submit();
                    },
                   
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
           
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>
        <!-- End js -->
    </body>
</html>