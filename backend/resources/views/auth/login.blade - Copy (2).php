<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ $setting->site_title }} | Login</title>
    <link rel="apple-touch-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/pages/page-auth.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
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
                    <!-- Brand logo-->

                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="col-lg-8" style="background:#f05542; padding:0; margin:0">
                       <img class="img-fluid" src="{{ $setting ? $setting->default_url : '' }}app-assets/images/provati_banner/13.jpg" alt="Login V2" style="width:100%; height:auto;" />
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 auth-bg-dark px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <div class="align-items-center p-lg-5">
                                @if($setting->logo!="")
                                    <img alt="{{ $setting->site_name }}" src="{{ asset('uploads/company/logo/'.$setting->logo) }}" style="width:80%; height:auto">
                                @else
                                    <img alt="{{ $setting->site_name }}" src="{{ asset('app-assets/images/logo/logowhite.png') }}" style="width:80%; height:auto">
                                @endif
                            </div>

                            <h2 class="card-title font-weight-bold mb-1 text-white">{{ $setting->site_title }}</h2>
                            <p class="card-text mb-2 text-white">Please sign-in to your account</p>

                            <form class="mt-2" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label text-white" for="login-email">Email</label>
                                    <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="login-password" class="text-white">Password</label><a href="#"><small>Forgot Password?</small></a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer btn-orange"><i data-feather="eye"></i></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                                        <label class="custom-control-label text-white" for="remember-me"> Remember Me</label>
                                    </div>
                                </div>
                                <button class="btn btn-orange btn-block" tabindex="4">Sign in</button>
                            </form>
                            <p class="text-center mt-2 text-white"><span>New on our platform?</span><a href="{{ route('register') }}" class="text-white"><span>&nbsp;Create an account</span></a></p>
                            <div class="divider my-2">
                                <div class="divider-text">or</div>
                            </div>
                            <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a></div>
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
<script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/core/app-menu.js"></script>
<script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/pages/page-auth-login.js"></script>
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
