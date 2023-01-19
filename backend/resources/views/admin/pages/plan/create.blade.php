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
                        <h2 class="content-header-title float-left mb-0">Plan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Plan
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('plan.index') }}"><i data-feather='eye'></i> View Plan</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('plan.create') }}"><i data-feather='plus'></i> Create New</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Plan</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ex: Banani, Mirpur" required/>
                                                </div>
                                               <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Code</label>
                                                    <input type="text" id="modern-name" name="code" class="form-control" value="{{ old('code') }}"/>
                                                </div>

                                            </div>

                                            <div class="row">
                                            	<div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Plan Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="delivery">Delivery Plan</option>
                                                        <option value="return">Return Plan</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Parcel Type</label>
                                                    <select class="form-control" name="percel_type">
                                                        <option value="Parcel">Parcel</option>
                                                        <option value="Fragile">Fragile</option>
                                                        <option value="Document">Document</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Location</label>
                                                    <select class="form-control" name="location">
                                                        <option value="Inside Dhaka">Inside Dhaka</option>
                                                        <option value="Outside Dhaka">Outside Dhaka</option>
                                                        <option value="Inside Dhaka to Suburbs">Inside Dhaka to Suburbs</option>
                                                        <option value="Suburbs to Inside Dhaka">Suburbs to Inside Dhaka</option>
                                                        <option value="Suburbs to Suburbs">Suburbs to Suburbs</option>
                                                        <option value="Outside Dhaka Same City">Outside Dhaka Same City</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Time</label>
                                                    <select class="form-control" name="time">
                                                        <option value="Standard Delivery">Standard Delivery</option>
                                                        <option value="Same Day Delivery">Same Day Delivery</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Weight in Kg</label>
                                                    <input type="number" id="modern-name" name="weight" min="0" step="0.0001" class="form-control" value="1" required/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Charge amount</label>
                                                    <input type="number" id="modern-name" name="charge" min="0" step="0.0001" class="form-control" value="{{ old('charge') }}" required/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success">Submit</button>
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
