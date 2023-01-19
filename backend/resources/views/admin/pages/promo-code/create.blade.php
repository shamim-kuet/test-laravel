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
                            <li class="breadcrumb-item"><a href="">Promo Code</a>
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
                                <a class="btn btn-primary btn-learge" href="{{ route('promo-code.index') }}"><i data-feather='eye'></i> View Promo Code</a>
                                <a class="btn btn-dark btn-learge" href="{{ route('promo-code.create') }}"><i data-feather='plus'></i> Create New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" files="true">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Code</label>
                                            <input type="text" class="form-control" placeholder="code" id="code" name="code">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <input type="text" class="form-control" placeholder="Description" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Total Limit</label>
                                            <input type="number" class="form-control" placeholder="Total limit" id="name" name="total_limit">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Per user limit</label>
                                            <input type="text" class="form-control" placeholder="Per user limit" id="name" name="per_user_limit">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="role">Rules</label>
                                            <select name="status" class="form-control">
                                            <option value="">---Select rule---</option>
                                                {{-- @foreach($enumStatuses as $key => $status) --}}
                                                    {{-- <option value="{{$status}}">{{ ucwords($status) }}</option> --}}
                                                    <option value="">New User</option>
                                                    <option value="">Anyone</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="role">Discount Type</label>
                                            <select name="status" class="form-control">
                                            <option value="">---Select type---</option>
                                                {{-- @foreach($enumStatuses as $key => $status) --}}
                                                    {{-- <option value="{{$status}}">{{ ucwords($status) }}</option> --}}
                                                    <option value="">Percentage</option>
                                                    <option value="">Fixed Discount</option>
                                                    <option value="">Flat fares</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Discount Amount</label>
                                            <input type="text" class="form-control" placeholder="Discount Amount" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Ride Require</label>
                                            <input type="text" class="form-control" placeholder="Ride Require" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Start Date</label>
                                            <input type="date" class="form-control" placeholder="Start Date" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Expirede Date</label>
                                            <input type="date" class="form-control" placeholder="Expirede Date" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Start at</label>
                                            <input type="time" class="form-control" placeholder="Start at" id="name" name="descriptions">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Expirede at</label>
                                            <input type="time" class="form-control" placeholder="Expirede at" id="name" name="descriptions">
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="role">Status</label>
                                            <select name="status" class="form-control">
                                            <option value="">---Select rule---</option>
                                                {{-- @foreach($enumStatuses as $key => $status) --}}
                                                    {{-- <option value="{{$status}}">{{ ucwords($status) }}</option> --}}
                                                    <option value="">Active</option>
                                                    <option value="">Inactive</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn btn-danger right" type="submit">Cancel</button>
                                        <button class="btn btn-info right" type="submit">Save as draft</button>
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
