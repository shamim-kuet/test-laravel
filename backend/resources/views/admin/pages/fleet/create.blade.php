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
                    <h2 class="content-header-title float-left mb-0">Fleet</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Create New Fleet
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
                                <a class="btn btn-primary" href="{{ route('fleet.index') }}"><i data-feather='eye'></i> View Fleet</a>
                                <a class="btn btn-dark" href="{{ route('fleet.create') }}"><i data-feather='plus'></i> Create New</a>
                            </div>
                        </div>
                    </div>
                    <!-- Modern Horizontal Wizard -->
                    <section class="modern-horizontal-wizard card bg-light">
                        <div class="bs-stepper wizard-modern modern-wizard-example">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#account-details-modern">
                                    <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="file-text" class="font-medium-3"></i>
                                              </span>
                                        <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Basic Information</span>
                                                <span class="bs-stepper-subtitle ml-2">Setup Basic Details</span>
                                              </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i data-feather="chevron-right" class="font-medium-2"></i>
                                </div>
                                <div class="step" data-target="#personal-info-modern">
                                    <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="user" class="font-medium-3"></i>
                                              </span>
                                        <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Vehicle Information</span>
                                                <span class="bs-stepper-subtitle ml-2">Add Vehicle Info</span>
                                              </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i data-feather="chevron-right" class="font-medium-2"></i>
                                </div>
                                <div class="step" data-target="#address-step-modern">
                                    <button type="button" class="step-trigger">
                                              <span class="bs-stepper-box">
                                                <i data-feather="map-pin" class="font-medium-3"></i>
                                              </span>
                                        <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">Documents</span>
                                                <span class="bs-stepper-subtitle ml-2">Vehicle documents</span>
                                              </span>
                                    </button>
                                </div>

                            </div>
                            <div class="bs-stepper-content">
                                <div id="account-details-modern" class="content" style="margin:0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="modern-username">Vehicle Type</label>
                                             <select class="form-control" name="type">
                                            	<option value="">Select Status</option>
                                                <option value="Private Car">Private Car</option>
                                                <option value="Micro Bus">Micro Bus</option>
                                                <option value="Mini Bus">Mini Bus</option>
                                                <option value="Pickup Van">Pickup Van</option>
                                                <option value="Truck">Truck</option>
                                                <option value="Motor Cycle">Motor Cycle</option>
                                                <option value="Cycle">Cycle</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="modern-username">Vehicle name</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="modern-username">Vehicle Owner Name</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="modern-username">Vehicle Owner Contact</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary btn-prev" disabled>
                                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="personal-info-modern" class="content" style="margin:0">

                                    <div class="row">
                                         <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Registratoin No.</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Model</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Capacity</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Chassis No</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Engine No</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Manufactured by</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Registration Expiry Date</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Vehicle Cost</label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Mileage </label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="modern-username">Distance </label>
                                            <input type="text" id="modern-username" class="form-control" placeholder="johndoe" />
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                                            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="address-step-modern" class="content" style="margin:0">

                                    <div class="row">

                                    </div>
                                    <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-address">License</label>
                                                <input
                                                    type="file"
                                                    id=""
                                                    class="form-control"
                                                />
                                            </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-success btn-submit">Submit</button>
                                    </div>
                                </div>

                            </div>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
