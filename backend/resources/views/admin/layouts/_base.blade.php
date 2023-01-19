<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/app-assets/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/animate-css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/chartist-js/chartist.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/chartist-js/chartist-plugin-tooltip.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/vertical-gradient-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/themes/vertical-gradient-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/dashboard-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/intro.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/form-select2.css')}}">
    <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('admin/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
    <!-- END PAGE VENDOR JS-->
    @stack('custom-css')
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    @include('admin.layouts.partials._header')
    @include('admin.layouts.partials._sidebar',['setting' => \App\Models\Setting::first()])






<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>@yield('prefixname')</span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item">@yield('prefixname')
                            </li>
                            <li class="breadcrumb-item">@yield('page_title')
                            </li>
                            <li class="breadcrumb-item active">@yield('title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper-before blue-grey lighten-5"></div>
        <div class="col s12">
            <div class="container">

                @yield('base.content')


{{--                @include('admin.layouts.partials._rightsidebar')--}}

            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->
    @include('admin.layouts.partials._footer',['setting' => \App\Models\Setting::first()])

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('admin/app-assets/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('admin/app-assets/vendors/chartjs/chart.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/chartist-js/chartist.min.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
<script src="{{ asset('admin/app-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('admin/app-assets/js/plugins.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/search.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/custom/custom-script.js')}}"></script>
<!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('admin/app-assets/js/scripts/ui-alerts.js')}}"></script>
    <!-- END PAGE LEVEL JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('admin/app-assets/js/scripts/dashboard-modern.js')}}"></script>
<script src="{{ asset('admin/app-assets/js/scripts/intro.js')}}"></script>
<!-- END PAGE LEVEL JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('admin/app-assets/vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/form-select2.js')}}"></script>
    <!-- END PAGE LEVEL JS-->
    @stack('custom-js')
</body>

</html>
