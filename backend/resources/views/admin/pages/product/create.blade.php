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
                        <h2 class="content-header-title float-left mb-0">Product</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Product
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('product.index') }}"><i
                                            data-feather='eye'></i> View Product</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="name">Merchant ID</label>
                                                    <select name="merchant_id" class="form-control">
                                                        @foreach ($merchants as $merchant)
                                                            <option value="{{ $merchant->id }}">{{ $merchant->business->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="name">Store ID</label>
                                                    <select name="store_id" class="form-control">
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">{{ $store->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Product Name</label>
                                                <input type="text" id="modern-name" name="name" class="form-control"
                                                    value="{{ old('name') }}" required />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Sub Title</label>
                                                <input type="text" id="modern-name" name="subtitle" class="form-control"
                                                    value="{{ old('subtitle') }}" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="modern-username">SKU</label>
                                                <input type="text" id="modern-email" name="sku" class="form-control"
                                                    value="{{ old('sku') }}" required />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="modern-username">Price</label>
                                                <input type="number" id="modern-name" name="price" class="form-control"
                                                    value="{{ old('price') }}" required />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="modern-username">Sell Price</label>
                                                <input type="number" id="modern-name" name="sell_price"
                                                    class="form-control" value="{{ old('sell_price') }}" required />
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Description</label>
                                                <textarea id="modern-address" name="description" class="form-control">{{ old('description') }}</textarea>
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
