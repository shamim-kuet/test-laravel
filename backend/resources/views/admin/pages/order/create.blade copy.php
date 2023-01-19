@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    {{-- <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css"> --}}
@endsection

@section('page-style')
    <!-- Page css files -->
    {{-- <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css"> --}}
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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
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
                                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                            class="fas fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('order.index') }}"><i
                                            data-feather='eye'></i> View Order</a>
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
                                    <div class="col-sm-3" id="productinformation" style="display:none">
                                        <div class="step" data-target="#product-details-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="file-text" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title"> Product Details</span>
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
                                <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="bs-stepper-content">
                                                <div id="account-details-modern" class="content m-0">
                                                    <div class="content-header">
                                                        <h5 class="mb-0">Delivery Details</h5>
                                                        <small class="text-muted">Enter Delivery Details.</small>
                                                    </div>

                                                    <div class="row">
                                                        <div class=" col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Merchant ID</label>
                                                                <select name="merchant_id" id="merchant_id"
                                                                    class="form-control"
                                                                    onchange="getCommonData(this.value,'merchant_id','stores','storedata');getPlanPrice();">
                                                                    @foreach ($merchants as $merchant)
                                                                        <option value="{{ $merchant->id }}"
                                                                            title="{{ $merchant->cod }}">
                                                                            {{ $merchant->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Store ID</label>
                                                                <div id="storedata">
                                                                    <select name="store_id" class="form-control select2"
                                                                        id="store_id" onchange="getPlanPrice();">
                                                                        @foreach ($stores as $store)
                                                                            <option value="{{ $store->id }}"
                                                                                title="{{ $store->region . '~' . $store->area }}">
                                                                                {{ $store->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Delivery Plan</label>
                                                                <select name="delivery_plan_id" class="form-control">
                                                                    @foreach ($deliveryPlan as $dplan)
                                                                        <option value="{{ $dplan->id }}">
                                                                            {{ $dplan->name . ' - ' . $dplan->code }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> --}}

                                                        <div class="col-sm-6" style="margin-bottom:10px;">
                                                            <div class="form-group mb-0">
                                                                <label for="fullname" class="col_sm_12">District<span
                                                                        class="required">*</span></label>
                                                                <div id="districtlists">
                                                                    <select name="district" id="districtid"
                                                                        class="form-control select2"
                                                                        onchange="getCommonData(this.value,'district_id','upozila','upazilalists');
                                                                        getPlanPrice();">

                                                                        @foreach ($district as $distr)
                                                                            <option value="{{ $distr->district_id }}"
                                                                                @if ($distr->code == 26) selected @endif>
                                                                                {{ ucfirst(strtolower($distr->district_name)) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($errors->has('district'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color:#FF0000; font-size:12px;">{{ $errors->first('district') }}</strong>
                                                                    </span>
                                                                @endif
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6" style="margin-bottom:10px;">
                                                            <div class="form-group mb-0">
                                                                <label for="fullname"
                                                                    class="col_sm_12">Thana/Upazilla<span
                                                                        class="required">*</span></label>
                                                                <div id="upazilalists">
                                                                    <select name="area" id="area" onchange="getPlanPrice()"
                                                                        class="form-control select2">
                                                                        @foreach ($upozila as $upaz)
                                                                            <option value="{{ $upaz->upozila_id }}">
                                                                                {{ ucfirst(strtolower($upaz->upozila_name)) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($errors->has('area'))
                                                                    <span class="help-block">
                                                                        <strong
                                                                            style="color:#FF0000; font-size:12px;">{{ $errors->first('area') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">


                                                        {{-- <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="return_plan_id">Return Plan</label>
                                                                <select name="return_plan_id" class="form-control">
                                                                    @foreach ($returnPlan as $rplan)
                                                                        <option value="{{ $rplan->id }}">
                                                                            {{ $rplan->name . ' - ' . $rplan->code }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="payment_status">Payment Status</label>
                                                                <select name="payment_status" class="form-control">
                                                                    <option value="Paid">Paid</option>
                                                                    <option value="Unpaid">Unpaid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Merchant Order ID</label>
                                                                <input type="text" name="merchant_order_id"
                                                                    class="form-control" required />

                                                                    <input type="hidden" name="delivery_plan_id" id="delivery_plan_id" class="form-control" required />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Delivery Date</label>
                                                                <input type="date" name="delivery_date"
                                                                    class="form-control" required />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12 mb-1">
                                                            <div class="form-group">
                                                                <label for="name">Partially delivery available</label>
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <input type="radio" name="partialdelivery"
                                                                            onclick="checkPartialDelivery(1)"
                                                                            value="1"
                                                                            style="width:20px; height:20px; position:absolute;" />
                                                                        <label
                                                                            style="position:relative; left:30px">Yes</label>
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <input type="radio" name="partialdelivery" checked
                                                                            onclick="checkPartialDelivery(0)"
                                                                            value="0"
                                                                            style="width:20px; height:20px; position:absolute;" />
                                                                        <label
                                                                            style="position:relative; left:30px">No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                        {{-- <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Package
                                                                Description</label>
                                                            <textarea id="modern-address" name="package_description" class="form-control">{{ old('package_description') }}</textarea>
                                                        </div> --}}

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Special
                                                                Instruction</label>
                                                            <textarea id="modern-address" name="instruction" class="form-control">{{ old('instruction') }}</textarea>
                                                        </div>

                                                        {{-- <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Delivery
                                                                Note</label>
                                                            <textarea id="modern-address" name="delivery_note" class="form-control">{{ old('delivery_note') }}</textarea>
                                                        </div> --}}

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Amount to be
                                                                collect</label>
                                                            <input type="number" id="collectable_amount" name="collectable_amount" class="form-control"
                                                                value="{{ old('collectable_amount') }}" placeholder="0"
                                                                onchange="getPlanPrice();" onblur="getPlanPrice()" onkeyup="getPlanPrice()">
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-outline-secondary btn-prev"
                                                            disabled>
                                                            <i data-feather="arrow-left"
                                                                class="align-middle mr-sm-25 mr-0"></i>
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-next">
                                                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                            <i data-feather="arrow-right"
                                                                class="align-middle ml-sm-25 ml-0"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                                <div id="personal-info-modern" class="content m-0">
                                                    <div class="content-header">
                                                        <h5 class="mb-0">Customer / Recipient Details</h5>
                                                        <small class="text-muted">Enter Customer Details for
                                                            delivery.</small>
                                                    </div>

                                                    <div class="row">

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Customer
                                                                Name</label>
                                                            <input id="customer_name" name="customer_name"
                                                                class="form-control"
                                                                value="{{ old('customer_name') }}" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Customer
                                                                Mobile</label>
                                                            <input id="customer_mobile" name="customer_mobile"
                                                                class="form-control"
                                                                value="{{ old('customer_mobile') }}" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Customer
                                                                Email</label>
                                                            <input id="customer_email" name="customer_email"
                                                                class="form-control"
                                                                value="{{ old('customer_email') }}" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Delivery
                                                                Address</label>
                                                            <input id="customer_address" name="customer_address"
                                                                class="form-control"
                                                                value="{{ old('customer_address') }}" />
                                                        </div>

                                                        {{-- <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Delivery
                                                                Zone</label>
                                                            <input id="customer_zone" name="customer_zone"
                                                                class="form-control"
                                                                value="{{ old('customer_zone') }}" />
                                                        </div> --}}

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Latitude
                                                                Coordinate </label>
                                                            <input type="number" id="customer_latitude"
                                                                name="customer_latitude" class="form-control"
                                                                value="{{ old('customer_latitude') }}" />
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="form-label" for="modern-username">Longtitude
                                                                Coordinate </label>
                                                            <input type="number" id="customer_longtitude"
                                                                name="customer_longtitude" class="form-control"
                                                                value="{{ old('customer_longtitude') }}" />
                                                        </div>
                                                    </div>


                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-primary btn-prev">
                                                            <i data-feather="arrow-left"
                                                                class="align-middle mr-sm-25 mr-0"></i>
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>

                                                <div id="productdetails" style="display:none">
                                                    <div id="product-details-modern" class="content m-0">
                                                        <div class="content-header">
                                                            <h5 class="mb-0">Delivery Details</h5>
                                                            <small class="text-muted">Enter Delivery Details.</small>
                                                        </div>
                                                        <div class="row">
                                                            <table width="100%" class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:50%;">Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="em_pho cloned-row" id="phone_content">
                                                                        <td>
                                                                            <select name="product_id[]"
                                                                                class="form-control">
                                                                                @foreach ($products as $product)
                                                                                    <option value="{{ $product->id }}">
                                                                                        {{ $product->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>

                                                                        <td><input type="number" class="form-control"
                                                                                placeholder="Quantity" name="quantity[]"
                                                                                style="width:40%" /></td>
                                                                        <td>
                                                                            <a class="btn btn-success  phn_btn_more"
                                                                                id="buttonvalue" title="Add new"
                                                                                style="padding:3px 8px; font-size:15px; margin-right:5px">+</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-prev" disabled>
                                                                <i data-feather="arrow-left"
                                                                    class="align-middle mr-sm-25 mr-0"></i>

                                                                <span
                                                                    class="align-middle d-sm-inline-block d-none">Previous</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-next">
                                                                <span
                                                                    class="align-middle d-sm-inline-block d-none">Next</span>
                                                                <i data-feather="arrow-right"
                                                                    class="align-middle ml-sm-25 ml-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table width="100%" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">
                                                                    <h2>Cost of Delivery</h2>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Delivery Fee</td>
                                                                <td>৳ <span id="deliveryfee">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>COD Fee</td>
                                                                <td>৳ <span id="codfee">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Discount</td>
                                                                <td>৳ <span>0</span></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Total Cost</th>
                                                                <th>৳<b id="total_amount"></b></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                    <input type="hidden" id="total_cost">
                                                    <div class="flex flex-col">

                                                        <div class="w-full mt-8" style="margin-top: 50px;">
                                                            Cost might vary depending upon the delivery situations and other
                                                            circumstances.
                                                        </div>
                                                        <div class="w-full mt-4">
                                                            For details:
                                                            <a href="{{ route('plan.index') }}"
                                                                style="text-decoration: underline">
                                                                Check the Pricing Plan
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>
    <script>
        let checkPartialDelivery = function(thisvalue) {
            if (thisvalue == 1) {
                document.getElementById('productinformation').style.display = 'inline';
                document.getElementById('productdetails').style.display = 'inline';
            } else {
                document.getElementById('productinformation').style.display = 'none';
                document.getElementById('productdetails').style.display = 'none';
            }
        }


        var count = 0;



        $(document).on("click", ".phn_btn_more", function() {
            var $clone = $('.cloned-row:eq(0)').clone();
            //alert("Clone number" + clone);
            $clone.find('[id]').each(function() {
                this.id
            });
            $clone.find('.phn_btn_more').after(
                '<a class="btn btn-danger btn_less1" id="buttonless" title="Remove this" style="padding:3px 8px; font-size:15px;">-</a>'
            );
            $clone.attr('id', "added" + (++count));

            //alert(count);
            $(this).parents('.em_pho').after($clone);
        });

        $(document).on('click', ".btn_less1", function() {
            var len = $('.cloned-row').length;
            if (len > 1) {
                $(this).parents('.em_pho').remove();
            }
        });



        // cost calculation


        $(document).ready(function() {
            getPlanPrice();
            //     $("#collectable_amount").change(function() {
            //         var amount = $("#collectable_amount").val()
            //         $("#total_amount").text(amount)

            //     });
        });




        function getPlanPrice() {
            let storedata = $("#store_id option:selected").attr('title');
            let districtid = $("#districtid option:selected").val();
            let area = $("#area option:selected").val();
            let merchant = $("#merchant_id option:selected").val();

            let codPercentage = $("#merchant_id option:selected").attr('title');
            let collectableAmount = $("#collectable_amount").val();
            let codVal = collectableAmount * codPercentage / 100;

            $("#codfee").text(codVal);

            if (districtid == '') {
                return false;
            } else {
                var surl = '/getPlanPrice';
                $.ajax({
                    type: "GET",
                    url: surl,
                    data: {
                        'storedata': storedata,
                        'districtid': districtid,
                        'area': area,
                        'merchant_id': merchant
                    },
                    cache: false,
                    success: function(response) {
                        console.dir(response);
                        if (response != '') {

                            $("#delivery_plan_id").val(response.plan_id)

                            let totalVal = parseFloat(response.plan.charge) + parseFloat(codVal);
                            $("#total_amount").text(totalVal)
                            $("#total_cost").val(totalVal)
                            $("#deliveryfee").text(response.plan.charge)
                        } else {
                            $("#total_amount").text(0)
                            $("#deliveryfee").text(0)
                        }
                    },
                    error: function(xhr, status) {
                        alert('Unknown error ' + status);
                    }
                });
            }
        }
    </script>
@endsection
