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
                        <h2 class="content-header-title float-left mb-0">Order</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Order
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('order.index') }}"><i data-feather='eye'></i> View Order</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('order.create') }}"><i data-feather='plus'></i> Create New</a>
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
                                                    <span class="bs-stepper-title"> Delivery Details</span>
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
                                                    <span class="bs-stepper-title"> Customer / Recipient Information</span>
                                                  </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <form action="{{ route('order.update', $order->id) }}" method="post" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div id="account-details-modern" class="content m-0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Delivery Details</h5>
                                                <small class="text-muted">Enter Delivery Details.</small>
                                            </div>

                                                <div class="row">
                                                <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Merchant ID</label>
                                                        <select name="merchant_id" class="form-control">
                                                            @foreach($merchants as $merchant)
                                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Store ID</label>
                                                        <select name="store_id" class="form-control">
                                                            @foreach($stores as $store)
                                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Product ID</label>
                                                        <select name="product_id" class="form-control">
                                                            @foreach($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="name">Delivery Plan</label>
                                                            <select name="delivery_plan_id" class="form-control">
                                                                @foreach($merchants as $merchant)
                                                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="return_plan_id">Return Plan</label>
                                                            <select name="return_plan_id" class="form-control">
                                                                @foreach($stores as $store)
                                                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="name">Merchant Order ID</label>
                                                           <input type="text" name="merchant_order_id" class="form-control" required />
                                                        </div>
                                                    </div>
                                            </div>
                                                <div class="row">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Package Description</label>
                                                            <textarea  name="package_description" class="form-control">{{ $order->package_description }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Special Instruction</label>
                                                            <textarea  name="instruction" class="form-control">{{ $order->instruction }}</textarea>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Delivery Note</label>
                                                            <textarea  name="delivery_note" class="form-control">{{ $order->delivery_note }}</textarea>
                                                        </div>

                                                         <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Amount to be collect</label>
                                                            <input type="text" name="collectable_amount" class="form-control" value="{{ $order->collectable_amount }}">
                                                        </div>
                                                    </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
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
                                            <div class="content-header">
                                                <h5 class="mb-0">Customer / Recipient Details</h5>
                                                <small class="text-muted">Enter Customer Details for delivery.</small>
                                            </div>

                                             <div class="row">

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Customer Name</label>
                                                        <input id="customer_name" name="customer_name" class="form-control" value="{{ $order->customer_name }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Customer Mobile</label>
                                                        <input id="customer_mobile" name="customer_mobile" class="form-control" value="{{ $order->customer_mobile }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Customer Email</label>
                                                        <input id="customer_email" name="customer_email" class="form-control" value="{{ $order->customer_email }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Delivery Address</label>
                                                        <input id="customer_address" name="customer_address" class="form-control" value="{{ $order->customer_address }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Delivery Zone</label>
                                                        <input id="customer_zone" name="customer_zone" class="form-control" value="{{ $order->customer_zone }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Latitude Coordinate </label>
                                                        <input id="customer_latitude" name="customer_latitude" class="form-control" value="{{ $order->customer_latitude }}"/>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="form-label" for="modern-username">Longtitude Coordinate </label>
                                                        <input id="customer_longtitude" name="customer_longtitude" class="form-control" value="{{ $order->customer_longtitude }}"/>
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
