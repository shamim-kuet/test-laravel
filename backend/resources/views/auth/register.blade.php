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
    <title>{{ $setting ? $setting->site_title : '' }} | Login</title>
    <link rel="apple-touch-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
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
                       <img class="img-fluid" src="{{ $setting ? $setting->default_url : '' }}app-assets/images/provati_banner/13.jpg" alt="Login V2" style="width:100%; height:100%;" />
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 auth-bg-dark px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <div class="align-items-center p-lg-5">
                                @if($setting!="")
                                    @if($setting->logo!="")
                                        <img alt="{{ $setting ? $setting->site_name : '' }}" src="{{ asset('uploads/company/logo/'.$setting->logo) }}" style="width:80%; height:auto">
                                    @else
                                        <img alt="{{ $setting ? $setting->site_name : '' }}" src="{{ asset('app-assets/images/logo/bmplogo.png') }}" style="width:80%; height:auto">
                                    @endif
                                @endif
                            </div>

                            <h2 class="card-title font-weight-bold mb-1 text-white">{{ $setting ? $setting->site_title : '' }}</h2>
                            <p class="card-text mb-2 text-white">Please enter valid information to register</p>

                            <form class="auth-register-form mt-2" action="{{ route('user.store') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="register-name">Name</label>
                                        <input class="form-control" id="register-name" type="text" name="name" placeholder="XYZ" aria-describedby="name" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="register-phone">Phone</label>
                                        <input class="form-control" id="register-phone" type="text" name="contact" placeholder="017XXXXXXXX" aria-describedby="phone" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="register-username">Username</label>
                                        <input class="form-control" id="register-username" type="text" name="username" placeholder="xyz1234" aria-describedby="register-username" autofocus="" tabindex="1" />
                                        <input class="form-control" type="hidden" name="partner_id" value="0"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="register-email">Email</label>
                                        <input class="form-control" id="register-email" type="text" name="email" placeholder="example@example.com" aria-describedby="register-email" tabindex="2" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="register-password">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="register-password" tabindex="3" />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
                                            <label class="custom-control-label" for="register-privacy-policy">I agree to<a href="javascript:void(0);">&nbsp;privacy policy & terms</a></label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
                                </form>
                            <?php /*?><p class="text-center mt-2 text-white"><span>New on our platform?</span><a href="{{ route('register') }}" class="text-white"><span>&nbsp;Create an account</span></a></p><?php */?>
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
