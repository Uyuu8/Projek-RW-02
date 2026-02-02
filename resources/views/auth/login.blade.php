<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>Login Page</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Assets/Backend/css/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-0" style="height: 100vh;">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center">
                                <img class="img-fluid" src="{{asset('images/Gedung-Sate.jpg')}}" alt="Login 1" style="width: 100%; height: 100%; object-fit: cover;" />
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

                            {{-- LOGO SECTION --}}
                            <div class="d-flex justify-content-center align-items-center mb-4 gap-3">
                                <img src="{{ asset('images/LOGO KOTA BANDUNG.png') }}" alt="Logo Kota" width="70">
                                <img src="{{ asset('images/JADI RW.png') }}" alt="Logo RW" width="70">
                            </div>

                            {{-- ALERT --}}
                            @if($message = Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-body">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>
                                </div>
                            @elseif($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <div class="alert-body">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                    </div>
                                </div>
                            @endif

                            {{-- TITLE --}}
                            <h2 class="card-title font-weight-bold mb-1 text-center">LOGIN</h2>
                            <p class="card-text mb-2 text-center">Silakan masuk ke akun Anda</p>

                            {{-- FORM --}}
                            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label" for="login-email">Email</label>
                                    <input
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="login-email"
                                        type="text"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Masukan Email"
                                        autofocus
                                    />
                                    @error('email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="login-password">Password</label>
                                        <a href="#"><small>Forgot Password?</small></a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="login-password"
                                            type="password"
                                            name="password"
                                            placeholder="••••••••"
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="remember-me" type="checkbox">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block">Masuk</button>
                            </form>

                        </div>
                    </div>

                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('Assets/Backend/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('Assets/Backend/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('Assets/Backend/js/core/app-menu.js')}}"></script>
    <script src="{{asset('Assets/Backend/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('Assets/Backend/js/scripts/pages/page-auth-login.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
