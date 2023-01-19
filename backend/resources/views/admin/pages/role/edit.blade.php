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
                        <h2 class="content-header-title float-left mb-0">Role</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include ('components.flash-messages')

        <div class="content-body">
            @include('ErrorMessage')
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex">
                                        <div class="left">
                                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                                    class="fas fa-arrow-circle-left"></i> Back</a>
                                        </div>
                                        <div class="right">
                                            <a class="btn btn-primary btn-learge" href="{{ route('role.index') }}"><i
                                                    data-feather='eye'></i> View {{ request()->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <form class="" action="{{ route('role.update', $role->id) }}" method="POST"
                                            enctype="multipart/form-data" files="true">
                                            @csrf
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label class="card-title" for="name">Role Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="{{ $role->name }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn btn-success right" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js">
    </script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"> </script>
    <script>
        $('#cancel').click(function(event) {

            $('name').value='';
            $('guard_name').value='';
        });
    </script>
@endsection
