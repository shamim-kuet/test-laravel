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
                                <li class="breadcrumb-item active">Edit Order
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
                                    <div class="col-sm-3" id="productinformation" @if($order->partialdelivery!=1) style="display:none" @endif>
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
                                                        <label for="name">Delivery Plan</label>
                                                        <select name="delivery_plan_id" class="form-control">
                                                            @foreach($deliveryPlan as $dplan)
                                                            <option value="{{ $dplan->id }}">{{ $dplan->name.' - '.$dplan->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="return_plan_id">Return Plan</label>
                                                        <select name="return_plan_id" class="form-control">
                                                            @foreach($returnPlan as $rplan)
                                                            <option value="{{ $rplan->id }}">{{ $rplan->name.' - '.$rplan->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Merchant Order ID</label>
                                                        <input type="text" name="merchant_order_id" class="form-control" required value="{{ $order->merchant_order_id }}" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Partially delivery available</label>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                            <input type="radio" name="partialdelivery" @if($order->partialdelivery==1) checked @endif onclick="checkPartialDelivery(1)"  value="1"
                                                            style="width:20px; height:20px; position:absolute;" />
                                                            <label style="position:relative; left:30px">Yes</label></div>

                                                            <div class="col-sm-3">
                                                            <input type="radio" name="partialdelivery" @if($order->partialdelivery==0) checked @endif onclick="checkPartialDelivery(0)"  value="0"
                                                            style="width:20px; height:20px; position:absolute;" />
                                                            <label style="position:relative; left:30px">No</label> </div>
                                                            </div>
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

                                                <div class="form-group col-md-3">
                                                    <label class="form-label" for="modern-username">Amount to be collect</label>
                                                    <input type="text" name="collectable_amount" class="form-control" value="{{ $order->collectable_amount }}">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="Accepted" {{ $order->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    </select>
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
                                        <div id="productdetails"  @if($order->partialdelivery!=1) style="display:none" @endif>
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
                                                                <!--<th>Price</th>-->
                                                                <th>Quantity</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	<tr class="em_pho cloned-row" id="phone_content">
                                                            	<td>
                                                                	<select name="product_id[]" class="form-control">
                                                                        @foreach($products as $product)
                                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <!--<td><span id="price">00.0</span></td>-->
                                                                <td><input type="number" class="form-control" placeholder="Quantity" name="quantity[]" style="width:40%" /></td>
                                                                <td>
                                                                <a class="btn btn-success  phn_btn_more" id="buttonvalue" title="Add new" style="padding:3px 8px; font-size:15px; margin-right:5px">+</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="d-flex justify-content-between mt-1">
                                                    <button type="button" class="btn btn-primary btn-prev">
                                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-next">
                                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                    </button>
                                                </div>
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
    <script>
    	let checkPartialDelivery = function(thisvalue){
			if(thisvalue==1){
				document.getElementById('productinformation').style.display = 'inline';
				document.getElementById('productdetails').style.display = 'inline';
			}
			else{
				document.getElementById('productinformation').style.display = 'none';
				document.getElementById('productdetails').style.display = 'none';
			}
		}


		var count=0;



	    $(document).on("click", ".phn_btn_more", function () {
	        var $clone = $('.cloned-row:eq(0)').clone();
	        //alert("Clone number" + clone);
	         $clone.find('[id]').each(function(){this.id});
	         $clone.find('.phn_btn_more').after('<a class="btn btn-danger btn_less1" id="buttonless" title="Remove this" style="padding:3px 8px; font-size:15px;">-</a>');
	         $clone.attr('id', "added"+(++count));

			//alert(count);
	        $(this).parents('.em_pho').after($clone);
	    });

		$(document).on('click', ".btn_less1", function (){
		    var len = $('.cloned-row').length;
		    if(len>1){
		        $(this).parents('.em_pho').remove();
		    }
		});

    </script>
@endsection
