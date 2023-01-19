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
                        <h2 class="content-header-title float-left mb-0">Delivery Status</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Delivery Status
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('deliverystatus.index') }}"><i data-feather='eye'></i> View Delivery Status</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('deliverystatus.create') }}"><i data-feather='plus'></i> Create New</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('deliverystatus.update', $deliverystatus->id) }}" method="post" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="modern-username">Status in Admin Panel</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ $deliverystatus->name }}" placeholder="Ex: delivered" required/>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="modern-username">Status in Merchant</label>
                                                    <input type="text" id="modern-name" name="merchant_status" class="form-control" value="{{ $deliverystatus->merchant_status }}" placeholder="Ex: delivered"/>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="modern-username">Button Color</label>
                                                    <input type="color" id="modern-name" name="color" class="form-control" value="{{ $deliverystatus->color }}"/>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="modern-username">Status Color</label>
                                                    <input type="color" id="modern-name" name="font_color" class="form-control" value="{{ old('color') }}"/>
                                                </div>



                                                <div class="form-group col-md-4">
                                                    <label class="form-label" for="modern-username">Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="pickup" {{ $deliverystatus->type=='pickup'? "selected":'' }}>Pickup</option>
                                                        <option value="delivery" {{ $deliverystatus->type=='delivery'? "selected":'' }}>Delivery</option>
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
