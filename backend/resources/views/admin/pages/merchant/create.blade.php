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
                        <h2 class="content-header-title float-left mb-0">Merchant</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Merchant
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
                                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                            class="fas fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('merchant.index') }}"><i
                                            data-feather='eye'></i> View Merchant</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('merchant.create') }}"><i
                                            data-feather='plus'></i> Create New Merchant</a>
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
                                                    <span class="bs-stepper-title">General Information</span>
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
                                                    <span class="bs-stepper-title">Business Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Contact Person Details</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="step" data-target="#payment-step-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="link" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Payment Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Payment Details</span>
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
                                                    <span class="bs-stepper-title">Document Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Subscription Details</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <form action="{{ route('merchant.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div id="account-details-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Account Details</h5>
                                                <small class="text-muted">Enter Your Account Details.</small>
                                            </div>
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="username">User Name  <span class="text-danger">*</span></label>
                                                    <input type="text" id="username" name="username"
                                                        class="form-control" value="{{ old('username') }}"
                                                        placeholder="Username should be opnly alphanumeric and (. - _ )" required
                                                        onkeydown="checkValidation('username','username','username_validation','Username','merchants');"
                                                        onblur="checkValidation('username','username','username_validation','Username','merchants')"
                                                        onkeyup="checkValidation('username','username','username_validation','Username','merchants')" />

                                                        <div id="username_validation" style="padding:5px;"></div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        {{-- <option value="1">Active</option> --}}
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group form-password-toggle col-md-6">
                                                    <label class="form-label" for="modern-password">Password  <span class="text-danger">*</span></label>
                                                    <input name="password" type="password" id="modern-password"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required/>
                                                </div>
                                                <div class="form-group form-password-toggle col-md-6">
                                                    <label class="form-label" for="modern-confirm-password">Confirm
                                                        Password  <span class="text-danger">*</span></label>
                                                    <input name="password_confirmation" type="password"
                                                        id="modern-confirm-password" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required/>
                                                </div>

                                                {{-- <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Hub</label>
                                                    <select class="form-control" name="hub_id">
                                                        @foreach ($hubinfo as $hub)
                                                            <option value="{{ $hub->id }}">{{ $hub->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Delivery Plan: </label>
                                                    <div class="col-sm-12" style="margin-top: 10px; ">
                                                        <div class="row">
                                                            @foreach ($deliveryplan as $dplan)
                                                                <div class="col-sm-4">
                                                                    <input type="checkbox" name="deliveryplan[]" value="{{ $dplan->id }}"
                                                                    style="width: 20px; height: 20px;position: absolute;">
                                                                    <label style=" margin-left: 25px;">{{ $dplan->name }}</label>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Return Plan: </label>
                                                    <div class="col-sm-12" style="margin-top: 10px; ">
                                                        <div class="row">
                                                            @foreach ($returnplan as $rplan)
                                                                <div class="col-sm-4">
                                                                    <input type="checkbox" name="returnplan[]" value="{{ $rplan->id }}"
                                                                    style="width: 20px; height: 20px;position: absolute;">
                                                                    <label style=" margin-left: 25px;">{{ $rplan->name }}</label>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                    </div>
                                                </div> --}}

                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary btn-prev"
                                                    disabled>
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

                                            <div class="row">

                                                <div class="col-sm-12">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-first-name">Owner
                                                                Name  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-first-name" name="name"
                                                                class="form-control" placeholder="Ex: ABC"
                                                                value="{{ old('name') }}" required/>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-last-name">Owner
                                                                Phone  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-last-name" name="phone"
                                                                class="form-control" placeholder="017XXXXXX"
                                                                value="{{ old('phone') }}" required/>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-first-name">Contact
                                                                Person Name  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-first-name" name="cname"
                                                                class="form-control" placeholder="Ex: ABC"
                                                                value="{{ old('name') }}" required/>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-last-name">Contact
                                                                Person Phone  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-last-name" name="cphone"
                                                                class="form-control" placeholder="017XXXXXX"
                                                                value="{{ old('phone') }}" required/>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label"
                                                                for="modern-username">District  <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="district_id"
                                                                onchange="getCommonData(this.value,'district_id','upozila','upazilalists');">
                                                                @foreach ($districts as $district)
                                                                    <option value="{{ $district->id }}">
                                                                        {{ $district->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label"
                                                                for="modern-username">Upazila  <span class="text-danger">*</span></label>
                                                            <div id="upazilalists">
                                                                <select class="form-control" name="area">
                                                                    @foreach ($upozilas as $upozila)
                                                                        <option value="{{ $upozila->id }}">
                                                                            {{ $upozila->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-last-name">Code  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-last-name" name="code"
                                                                class="form-control" placeholder="017XXXXXX"
                                                                value="{{ old('code') }}" required/>
                                                        </div>

                                                    </div>
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
                                                <h5 class="mb-0">Business Details</h5>
                                                <small>Enter Business Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="modern-first-name">Name of your
                                                                business  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-first-name" name="bname"
                                                                class="form-control" placeholder="Ex: ABC"
                                                                value="{{ old('bname') }}" required/>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="modern-last-name">Business
                                                                Email Id  <span class="text-danger">*</span></label>
                                                            <input type="email" name="bemail" id="bemail"
                                                                class="form-control"
                                                                placeholder="example@nextgenitltd.com"
                                                                value="{{ old('bemail') }}" required
                                                                onkeydown="checkValidation('bemail','email','email_validation','Email','merchants');"
                                                                onblur="checkValidation('bemail','email','email_validation','Email','merchants')"
                                                                onkeyup="checkValidation('bemail','email','email_validation','Email','merchants')"/>
                                                                <div id="email_validation" style="padding: 5px"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">

                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="modern-last-name">Business
                                                                Address</label>
                                                            <textarea name="baddress" class="form-control">{{ old('baddress') }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="modern-facebook">Facebook &
                                                                Web  <span class="text-danger">*</span></label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="facebook"
                                                                value="{{ old('facebook') }}" required/>
                                                        </div>

                                                    </div>
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

                                        <div id="payment-step-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Payment Details</h5>
                                                <small>Enter Payment Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">


                                                        <div class="form-group col-md-12">
                                                            <label class="form-label" for="modern-username">Payment
                                                                type</label>
                                                            <select class="form-control" name="payment_type"
                                                                id="payment_type">
                                                                <option value="Mobile Banking">Mobile Banking</option>
                                                                <option value="Banking">Banking</option>
                                                                <option value="COD">COD</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-12 m_banking">
                                                            <label class="form-label" for="modern-facebook">Moblie
                                                                Number</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="m_account_number"
                                                                value="{{ old('m_account_number') }}" />
                                                        </div>

                                                        <div class="form-group col-md-12 b_banking">
                                                            <label class="form-label" for="modern-facebook ">Banking
                                                                Name</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="bank_name"
                                                                value="{{ old('bank_name') }}" />
                                                        </div>
                                                        <div class="form-group col-md-12 b_banking">
                                                            <label class="form-label" for="modern-facebook">Account
                                                                Name</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="account_name"
                                                                value="{{ old('account_name') }}" />
                                                        </div>




                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-12 m_banking">
                                                            <label class="form-label" for="modern-username">Select Your
                                                                Mobile Banking</label>
                                                            <select class="form-control" name="mobile_banking_type">
                                                                <option value="Rocket">Rocket</option>
                                                                <option value="Nagad">Nagad</option>
                                                                <option value="bKash">bKash</option>
                                                                <option value="M-cash">M-cash</option>
                                                                <option value="Upay">Upay</option>
                                                                <option value="My Cash">My Cash</option>
                                                                <option value="Ok Mobile Banking">Ok Mobile Banking</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12 b_banking">
                                                            <label class="form-label" for="modern-facebook">Account
                                                                Number</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="account_number"
                                                                value="{{ old('account_number') }}" />
                                                        </div>
                                                        <div class="form-group col-md-12 b_banking">
                                                            <label class="form-label" for="modern-facebook">Branch
                                                                Name</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="branch_name"
                                                                value="{{ old('branch_name') }}" />
                                                        </div>

                                                        <div class="form-group col-md-12 b_banking">
                                                            <label class="form-label" for="modern-facebook">Routing
                                                                Number</label>
                                                            <input type="text" id="modern-facebook"
                                                                class="form-control" name="routing_number"
                                                                value="{{ old('routing_number') }}" />
                                                        </div>


                                                    </div>
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
                                                <h5 class="mb-0">Document Details</h5>
                                                <small>Enter Document Details.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Document Type</label>
                                                    <select class="form-control" name="documents_type">
                                                        @foreach ($documenttype as $dtype)
                                                            <option value="{{ $dtype->id }}">{{ $dtype->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Document Name</label>
                                                    <input type="text" name="headline" class="form-control"
                                                        value="{{ old('headline') }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="">Document File</label>
                                                    <input type="file" name="files" class="form-control"
                                                        value="{{ old('files') }}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-label" for="modern-first-name">Photo</label>
                                                    <input type="file" id="modern-first-name" name="cphoto"
                                                        class="form-control" />
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>



    <script>
        $(document).ready(function() {
                    $('.m_banking').hide();
                    $('.b_banking').hide();

                    $('#payment_type').change(function() {
                            if ($('#payment_type').val() == 'Mobile Banking') {

                                $('.m_banking').show();
                                $('.b_banking').hide();
                            }
                            if ($('#payment_type').val() == 'Banking') {
                                $('.m_banking').hide();
                                $('.b_banking').show();
                            }
                            if ($('#payment_type').val() == 'COD') {
                                $('.m_banking').hide();
                                $('.b_banking').hide();
                            }
                        });


                    });


    </script>
@endsection
