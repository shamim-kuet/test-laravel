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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Partner Edit
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            @include('ErrorMessage')
            <!-- Tooltip validations start -->
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <div class="left">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('user.index') }}">Partner List</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('partner.update', $partner->id) }}" method="post" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div id="account-details-modern" class="content m-0">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Legal Name</label>
                                                    <input type="text" id="modern-username" name="legal_name" class="form-control" placeholder="Alesha Mart Ltd."  value="{{ $partner->legal_name }}"/>
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

                                                <!--<div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Company Logo</label>
                                                    <input type="file" id="modern-first-name" name="logo" class="form-control"/>
                                                </div>-->
                                            </div>

                                            <div class="row">


                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Company Name</label>
                                                    <input type="text" id="modern-first-name" name="company_name" class="form-control" placeholder="John"  value="{{ $partner->company_name }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-last-name">Company Phone</label>
                                                    <input type="text" id="modern-phone" name="company_phone" class="form-control" placeholder="Doe" value="{{ $partner->company_phone }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-last-name">Company Email</label>
                                                    <input type="email" id="modern-email" name="company_email" class="form-control" placeholder="Doe" value="{{ $partner->company_email }}"/>
                                                </div>
                                                 <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Contact Person Name</label>
                                                    <input
                                                        name="contact_person_name"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ $partner->contact_person_name }}"
                                                    />
                                                </div>
                                                 <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Contact Person Mobile</label>
                                                    <input
                                                        name="contact_person_phone"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ $partner->contact_person_phone }}"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Contact Person Email</label>
                                                    <input
                                                        name="contact_person_email"
                                                        type="text"
                                                        id="modern-address"
                                                        class="form-control" value="{{ $partner->contact_person_email }}"
                                                    />
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Address</label>
                                                    <textarea name="address" id="modern-address" class="form-control">{{ $partner->address }}</textarea>
                                                </div>

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
                                                    <input type="date" id="" name="subscription_expiry" class="form-control" value="{{ $partner->subscription_expiry }}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>



                                    </div>
                                </form>
                            </div>
                        </div>
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
