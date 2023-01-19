<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $setting->site_name ?? 'Website' }}</title>
    <link rel="apple-touch-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/vendors.min.css">
    <!--<link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/charts/apexcharts.css">-->
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/components.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/pages/app-invoice-list.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}assets/css/style.css">
    <!--<link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/custom.css">-->
    <link rel="stylesheet" type="text/css" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/custom.css">
    <link rel="stylesheet" type="text/css"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <!-- END: Custom CSS-->

    @yield('page-style')
    @yield('vendor-style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bulk Import </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Download excel format</label>
                            <a href="#" class="btn btn-warning"
                                onClick="sampleDownload(document.getElementById('filetypes').value)">Download</a>
                        </div>
                        <div class="col-sm-8">
                            <label>Choose your excel file</label>
                            <form method="post" action="{{ route('common.import') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="file" name="importfile" class="form-control" />
                                        <input type="hidden" name="filetypes" id="filetypes" />
                                    </div>
                                    <div class="col-sm-4"><button type="submit" class="btn btn-info">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="resetPassword" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reset Password </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('common.changepassword') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" name="newpassword" placeholder="Enter New Password"
                                            class="form-control" />
                                        <input type="hidden" name="table_name" id="table_name" />
                                        <input type="hidden" name="table_id" id="table_id" />
                                    </div>
                                    <div class="col-sm-4"><button type="submit" class="btn btn-info">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- BEGIN: Header-->
    @include('admin.includes.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('home') }}"
                        style="width:100%; height:auto; margin:0 !important">
                        <div style="width:100%;">
                            @if ($setting->logo != '')
                                <img alt="{{ $setting->site_name }}"
                                    src="{{ asset('uploads/company/logo/' . $setting->logo) }}"
                                    style="width:150px; height:auto">
                            @else
                                <img alt="{{ $setting->site_name }}"
                                    src="{{ asset('app-assets/images/logo/logo.png') }}"
                                    style="width:100px; height:auto">
                            @endif
                        </div>
                        {{-- @if ($setting->logo)
                        <img src="{{ asset('/').$setting->logo }}" alt="">
                        @endif
                        </span>
                        @php
                        $setting = \App\Models\Setting::first()
                        @endphp
                        @if ($setting->site_name)
                        <h2 class="brand-text">{{ $setting->site_name }}</h2>
                        @else
                        @endif --}}
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                            class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                            data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            @if (session()->get('role_id') == 34)
                @include('admin.includes.sidebar_super_admin')
            @else
                @include('admin.includes.sidebar')
            @endif
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('content')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        @include('admin.layouts.partials._footer')
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!--<script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/charts/apexcharts.min.js"></script>-->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/datatables.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/datatables.buttons.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js">
    </script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/core/app-menu.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    <!--<script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/pages/dashboard-analytics.js"></script>-->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/pages/app-invoice-list.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/pages/app-superadmin-list.js"></script>
    <script type="text/javascript"
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script type="text/javascript"
        src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/extensions/ext-component-sweet-alerts.js">
    </script>
    <script type="text/javascript" src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/custom.js">
    </script>

    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $(document).ready(function() {
            $('.common-datatables').DataTable({
                //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]];
                "pageLength": 50
            });
        });
    </script>

    <!-- vendor css files -->
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css">

    @stack('custom-js')
    @yield('vendor-script')
    @yield('page-script')
</body>
<!-- END: Body-->

</html>
