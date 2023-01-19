@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Settings</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @include('ErrorMessage')
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <div class="left">
                                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="right">
{{--                                    <a class="btn btn-primary btn-learge" href="{{ route('setting.index') }}"><i data-feather='eye'></i> View {{ request()->name }}</a>--}}
{{--                                    <a class="btn btn-dark btn-learge" href="{{ route('setting.create') }}"><i data-feather='plus'></i> Create New</a>--}}
                                </div>
                            </div>


                        </div>
                        <!-- Modern Horizontal Wizard -->
                         <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#account-details-modern">
                                        <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="user" class="font-medium-3"></i>
                                              </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">General Setting</span>
                                                <span class="bs-stepper-subtitle ml-2">Setup General Setting</span>
                                              </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#personal-info-modern">
                                        <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="mail" class="font-medium-3"></i>
                                              </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">SMTP</span>
                                                <span class="bs-stepper-subtitle ml-2">SMTP Setting</span>
                                              </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#address-step-modern">
                                        <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="tablet" class="font-medium-3"></i>
                                              </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">App Setting</span>
                                                <span class="bs-stepper-subtitle ml-2">Add App Setting</span>
                                              </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#social-links-modern">
                                        <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="link" class="font-medium-3"></i>
                                              </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Social Links</span>
                                                <span class="bs-stepper-subtitle ml-2">Add Social Links</span>
                                              </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="account-details-modern" class="content m-0">
                                        <div class="content-header">
                                            <h5 class="mb-0">General Setting</h5>
                                            <small class="text-muted">Enter General Setting</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Site Name</label>
                                                <input type="text" class="form-control" placeholder="Courier App" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Copyright Message</label>
                                                <input type="text" class="form-control" placeholder="© 2021 All rights reserved" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Design & Developed By</label>
                                                <input type="text" class="form-control" placeholder="Nextgen IT Ltd" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Design & Developed By URL</label>
                                                <input type="text" class="form-control" placeholder="nextgenitltd.com" />
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="customFile">Logo</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="logo" />
                                                    <label class="custom-file-label" for="customFile">Choose logo</label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="row">
                                            <div class="form-group form-password-toggle col-md-6">
                                                <label class="form-label" for="modern-password">Password</label>
                                                <input
                                                    type="password"
                                                    id="modern-password"
                                                    class="form-control"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                />
                                            </div>
                                            <div class="form-group form-password-toggle col-md-6">
                                                <label class="form-label" for="modern-confirm-password">Confirm Password</label>
                                                <input
                                                    type="password"
                                                    id="modern-confirm-password"
                                                    class="form-control"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                />
                                            </div>
                                        </div>--}}
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-outline-secondary btn-prev" disabled type="button">
                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-next" type="button">
                                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="personal-info-modern" class="content m-0">
                                        <div class="content-header">
                                            <h5 class="mb-0">SMTP</h5>
                                            <small>Enter Your SMTP Setting</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-first-name">Mail Driver</label>
                                                <input type="text" id="modern-first-name" class="form-control" placeholder="SMTP" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-last-name">Mail Host</label>
                                                <input type="text" id="modern-last-name" class="form-control" placeholder="smtp.mailtrap.io" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-first-name">Mail Port</label>
                                                <input type="text" id="modern-first-name" class="form-control" placeholder="123" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-first-name">Mail User Name</label>
                                                <input type="text" id="modern-first-name" class="form-control" placeholder="user name" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-first-name">Mail Password</label>
                                                <input type="text" id="modern-first-name" class="form-control" placeholder="password" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-last-name">Mail Encryption</label>
                                                <input type="text" id="modern-last-name" class="form-control" placeholder="mail encryption" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-last-name">Mail From Name</label>
                                                <input type="text" id="modern-last-name" class="form-control" placeholder="app name" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-last-name">Mail From Address</label>
                                                <input type="text" id="modern-last-name" class="form-control" placeholder="mail from address" />
                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary btn-prev" type="button">
                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-next" type="button">
                                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="address-step-modern" class="content m-0">
                                        <div class="content-header">
                                            <h5 class="mb-0">App Setting</h5>
                                            <small>Enter App Setting</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-address">Android App</label>
                                                <input
                                                    type="text"
                                                    id="modern-address"
                                                    class="form-control"
                                                    placeholder="Version"
                                                />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-address">IOS App</label>
                                                <input
                                                    type="text"
                                                    id="modern-address"
                                                    class="form-control"
                                                    placeholder="Version"
                                                />
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary btn-prev" type="button">
                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-next" type="button">
                                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="social-links-modern" class="content m-0">
                                        <div class="content-header">
                                            <h5 class="mb-0">Social Links</h5>
                                            <small>Enter Your Social Links.</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-twitter">Twitter</label>
                                                <input type="text" id="modern-twitter" class="form-control" placeholder="https://twitter.com/abc" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-facebook">Facebook</label>
                                                <input type="text" id="modern-facebook" class="form-control" placeholder="https://facebook.com/abc" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-google">Google+</label>
                                                <input type="text" id="modern-google" class="form-control" placeholder="https://plus.google.com/abc" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-linkedin">Linkedin</label>
                                                <input type="text" id="modern-linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary btn-prev" type="button">
                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        </form>
                        <!-- /Modern Horizontal Wizard -->
                    </div>
                </div>
            </section>
            <!-- Tooltip validations end -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
