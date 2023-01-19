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
                        <h2 class="content-header-title float-left mb-0">Permission</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
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
                                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                            class="fas fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('permission.index') }}"><i
                                            data-feather='eye'></i> View</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('permission.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div class="row">
                                            <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="name">Select Group</label>
                                                        <select name="group_id" class="form-control">
                                                            <option value="">Select Group
                                                            </option>
                                                            @foreach ($groups as $group)
                                                                <option value="{{ $group->id }}">{{ $group->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>


                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="modern-username">Name</label>
                                                    <input type="text" id="modern-username" name="name" class="form-control"
                                                        value="{{ old('name') }}"
                                                        placeholder="Enter permission name" />
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="modern-username">Route Name</label>
                                                    <input type="text" id="modern-username" name="guard_name" class="form-control"
                                                        value="{{ old('guard_name') }}" placeholder="Enter route name"/>
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js">
    </script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"> </script>
@endsection
