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
                        <h2 class="content-header-title float-left mb-0">weight details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('weight_details.index') }}"><i data-feather='eye'></i> View</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('weight_details.create') }}"><i data-feather='plus'></i> Create</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('weight_details.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">plan type</label>
                                                    <select class="form-control" name="plan_type">
                                                        <option value="Inside Dhaka">Inside Dhaka</option>
                                                        <option value="Outside Dhaka">Outside Dhaka</option>
                                                        <option value="Same Day Delivery">Same Day Delivery</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Increment Amount (TK)</label>
                                                    <input type="number" placeholder="EX-50.50,100,250" id="modern-name" name="increment_value" min="0" step="0.0001" class="form-control" value="{{ old('increment_value') }}" required/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Unit (KG)</label>
                                                    <input type="number" id="modern-name" placeholder="EX-1.5,5,10,50" name="unit" min="0" step="0.0001" class="form-control" value="{{ old('unit') }}" required/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">After Weight (KG)</label>
                                                    <input type="number" id="modern-name" name="after_weight" min="0" step="0.0001" placeholder="EX-1.5,5,10,50" class="form-control" value="{{ old('after_weight') }}" required/>
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
