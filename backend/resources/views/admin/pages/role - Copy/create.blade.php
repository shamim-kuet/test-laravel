@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/base/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/base/plugins/forms/form-wizard.css">
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Home</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Role</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
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
                                <a class="btn btn-primary btn-learge" href="{{ route('role.index') }}"><i data-feather='eye'></i> View {{ request()->name }}</a>
                                <a class="btn btn-dark btn-learge" href="{{ route('role.create') }}"><i data-feather='plus'></i> Create New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" files="true">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="card-title" for="name">Role Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Permissions</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="demo-inline-spacing" style="display: flex; flex-direction: column; align-items: baseline;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">All</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-4">
                                        <div class="card-header">
                                            <h4 class="card-title">Admin</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="demo-inline-spacing" style="display: flex; flex-direction: column; align-items: baseline;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">All</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">Create</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Update</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Edit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Approval</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card-header">
                                            <h4 class="card-title">Banner</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="demo-inline-spacing" style="display: flex; flex-direction: column; align-items: baseline;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">All</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">Create</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Update</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Edit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Approval</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="card-header">
                                            <h4 class="card-title">Driver</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="demo-inline-spacing" style="display: flex; flex-direction: column; align-items: baseline;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">All</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                                    <label class="form-check-label" for="inlineCheckbox1">Create</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Update</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Edit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                                    <label class="form-check-label" for="inlineCheckbox2">Approval</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn btn-danger right" type="">Cancel</button>
                                        <button class="btn btn-success right" type="submit">Submit</button>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
