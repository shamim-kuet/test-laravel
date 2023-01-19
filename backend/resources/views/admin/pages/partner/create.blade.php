@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet"
        href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Partner</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Partner
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('partner.index') }}"><i data-feather='eye'></i> View Partner</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('partner.create') }}"><i data-feather='plus'></i> Create New</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">
                                <div class="bs-stepper-header">
                                	<div class="col-sm-3">
                                        <div class="step" data-target="#account-details-modern">
                                            <button type="button" class="step-trigger">
                                                  <span class="bs-stepper-box">
                                                    <i data-feather="file-text" class="font-medium-3"></i>
                                                  </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Account Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Setup Account Details</span>
                                                  </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="step" data-target="#personal-info-modern">
                                            <button type="button" class="step-trigger">
                                                  <span class="bs-stepper-box">
                                                    <i data-feather="user" class="font-medium-3"></i>
                                                  </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Legal Information</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Legal Information</span>
                                                  </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="step" data-target="#address-step-modern">
                                            <button type="button" class="step-trigger">
                                                  <span class="bs-stepper-box">
                                                    <i data-feather="map-pin" class="font-medium-3"></i>
                                                  </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Contact Person Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Contact Person Details</span>
                                                  </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    	<div class="step" data-target="#social-links-modern">
                                        <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="link" class="font-medium-3"></i>
                                              </span>
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Subscription Details</span>
                                                <span class="bs-stepper-subtitle ml-2">Add Subscription Details</span>
                                              </span>
                                        </button>
                                    </div>
                                    </div>

                                </div>
                                <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div id="account-details-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Account Details</h5>
                                                <small class="text-muted">Enter Your Account Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">User Name</label>
                                                    <input type="text" id="modern-username" name="username" class="form-control" value="{{ old('username') }}"
                                                    placeholder="Username should be opnly alphanumeric and (. - _ )" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group form-password-toggle col-md-6">
                                                    <label class="form-label" for="modern-password">Password</label>
                                                    <input
                                                        name="password"
                                                        type="password"
                                                        id="modern-password"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    />
                                                </div>
                                                <div class="form-group form-password-toggle col-md-6">
                                                    <label class="form-label" for="modern-confirm-password">Confirm Password</label>
                                                    <input
                                                        name="password_confirmation"
                                                        type="password"
                                                        id="modern-confirm-password"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    />
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="personal-info-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Legal Information</h5>
                                                <small>Enter Legal Information.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-first-name">Legal Name</label>
                                                    <input type="text" id="modern-first-name" name="legal_name" class="form-control" placeholder="Nextgen IT LTD" value="{{ old('legal_name') }}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-first-name">Company Name</label>
                                                    <input type="text" id="modern-first-name" name="company_name" class="form-control" placeholder="Nextgen IT" value="{{ old('company_name') }}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-first-name">Company Logo</label>
                                                    <input type="file" id="modern-first-name" name="logo" class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-last-name">Company Phone</label>
                                                    <input type="text" id="modern-last-name" name="company_phone" class="form-control" placeholder="017XXXXXX" value="{{ old('company_phone') }}"/>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-last-name">Company Email</label>
                                                    <input type="email" id="modern-last-name" name="company_email" class="form-control" placeholder="example@nextgenitltd.com" value="{{ old('company_email') }}"  />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-last-name">Office Address</label>
                                                    <input type="text" id="modern-last-name" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}"/>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary btn-prev">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="address-step-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Contact Person Details</h5>
                                                <small>Enter Contact Person Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-address">Contact Person Name</label>
                                                    <input
                                                        name="contact_person_name"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ old('contact_person_name') }}"
                                                    />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-address">Contact Person Mobile</label>
                                                    <input
                                                        name="contact_person_phone"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ old('contact_person_phone') }}"
                                                    />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-address">Contact Person Email</label>
                                                    <input
                                                        name="contact_person_email"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ old('contact_person_email') }}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary btn-prev">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="social-links-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Subscription Details</h5>
                                                <small>Enter Subscription Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Subscription Type</label>
                                                    <select class="form-control" name="subscription_type">
                                                        <option value="Gold">Gold</option>
                                                        <option value="Silver">Silver</option>
                                                        <option value="Bronze">Bronze</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="">Subscription Expiry Date</label>
                                                    <input type="date" id="" name="subscription_expiry" class="form-control" value="{{ old('subscription_expiry') }}">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary btn-prev">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </section>
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
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js">
    </script>
    <script
        src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js">
    </script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"> </script>
@endsection
