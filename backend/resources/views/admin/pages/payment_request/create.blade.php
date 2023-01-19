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
                        <h2 class="content-header-title float-left mb-0">Payment Request</h2>
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('paymentrequest.index') }}"><i
                                            data-feather='eye'></i> View</a>

                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('paymentrequest.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                                <div class="form-group">
                                                    <label for="name">Merchant ID</label>
                                                    <select name="merchant_id" class="form-control">
                                                        @foreach ($merchants as $merchant)
                                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Payment Method</label>
                                                <select class="form-control" id="payment_method" name="payment_method">
                                                    <option value="mobile_banking">Moblie banking</option>
                                                    <option value="bank">Bank</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Amount</label>
                                                <input type="text" id="modern-amount" name="amount" class="form-control"
                                                    value="{{ old('amount') }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-date">Payment Date</label>
                                                <input type="date" id="modern-date" name="payment_date"
                                                    class="form-control" value="{{ old('payment_date') }}" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 banking">
                                                <label class="form-label" for="modern-username">Amount Name</label>
                                                <input type="text" id="modern-amount" name="account_name"
                                                    class="form-control" value="{{ old('account_name') }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Account Number</label>
                                                <input type="text" id="account_number" name="account_number"
                                                    class="form-control" value="{{ old('account_number') }}" />
                                            </div>
                                            <div class="form-group col-md-6 banking">
                                                <label class="form-label" for="modern-username">Bank Name</label>
                                                <input type="text" id="modern-amount" name="bank_name"
                                                    class="form-control" value="{{ old('bank_name') }}" />
                                            </div>
                                            <div class="form-group col-md-6 banking">
                                                <label class="form-label" for="modern-username">Routing No</label>
                                                <input type="text" id="modern-amount" name="routing_no"
                                                    class="form-control" value="{{ old('routing_no') }}" />
                                            </div>
                                            <div class="form-group col-md-6 banking">
                                                <label class="form-label" for="modern-username">Branch No</label>
                                                <input type="text" id="modern-amount" name="branch_no"
                                                    class="form-control" value="{{ old('branch_no') }}" />
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Note</label>
                                                <textarea id="modern-address" name="remark"
                                                    class="form-control">{{ old('remark') }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="modern-username">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="High Priority">High Priority</option>
                                                    <option value="Low Priority">Low Priority</option>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {

                    var $typeSelector = $('#payment_method');
                    var $toggleArea = $('.banking');
                    $toggleArea.hide();
                    $typeSelector.change(function() {
                        if ($typeSelector.val() === 'bank') {
                            $toggleArea.show();
                        } else {
                            $toggleArea.hide();
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection
