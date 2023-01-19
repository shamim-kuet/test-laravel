@extends('admin.layouts.master')
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
                                <li class="breadcrumb-item active">Order Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            @include('ErrorMessage')
            <!-- Tooltip validations start -->
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <div class="left">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('order.index') }}">Order List</a>
                                </div>
                            </div>
                            <div class="card-body">
                            	<div class="col-sm-8">
                                	<fieldset style="border:1px solid #ccc; padding:10px;  border-radius:10px;">
                                    	<legend style="width:auto">Delivery Information</legend>
                                        <table class="table table-bordered" width="100%">

                                        <tr>
                                        	<td>Merchant Name</td>
                                            <td>:</td>
                                            <td>{{ $user->merchant ? $user->merchant->name : '' }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Store name</td>
                                            <td>:</td>
                                            <td>{{ $user->store ? $user->store->name : '' }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Subtitle</td>
                                            <td>:</td>
                                            <td>{{ $user->merchant_order_id }}</td>
                                        </tr>

                                        <tr>
                                        	<td>Amount to be collect</td>
                                            <td>:</td>
                                            <td>{{ $user->collectable_amount }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Package Description</td>
                                            <td>:</td>
                                            <td>{{ $user->package_description }}</td>
                                        </tr>
                                         <tr>
                                        	<td>Special Instruction</td>
                                            <td>:</td>
                                            <td>{{ $user->instruction }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Delivery Note</td>
                                            <td>:</td>
                                            <td>{{ $user->delivery_note }}</td>
                                        </tr>
                                    </table>
                                    </fieldset>

                                    <fieldset style="border:1px solid #ccc; padding:10px;  border-radius:10px; margin-top:30px;">
                                    	<legend style="width:auto">Customer Information</legend>
                                        <table class="table table-bordered" width="100%">


                                        <tr>
                                        	<td>Customer Name</td>
                                            <td>:</td>
                                            <td>{{ $user->customer_name }}</td>
                                        </tr>

                                        <tr>
                                        	<td>Customer Mobile</td>
                                            <td>:</td>
                                            <td>{{ $user->customer_mobile }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Customer Email</td>
                                            <td>:</td>
                                            <td>{{ $user->customer_email }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Customer Delivery Address</td>
                                            <td>:</td>
                                            <td>{{ $user->customer_address }}</td>
                                        </tr>
                                       <tr>
                                        	<td>Delivery Zone</td>
                                            <td>:</td>
                                            <td>{{ $user->customer_zone }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Latitude Coordinate </td>
                                            <td>:</td>
                                            <td>{{ $user->customer_latitude }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Longtitude Coordinate </td>
                                            <td>:</td>
                                            <td>{{ $user->customer_longtitude }}</td>
                                        </tr>
                                    </table>
                                    </fieldset>

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
