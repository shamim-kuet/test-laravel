@extends('admin.layouts.master')
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
                                <li class="breadcrumb-item active">Product Details
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('product.index') }}">Product List</a>
                                </div>
                            </div>
                            <div class="card-body">
                            	<div class="col-sm-8">
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="39%">Product Name</td>
                                          <td width="1%">:</td>
                                          <td width="60%">{{ $user->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Merchant Name</td>
                                            <td>:</td>
                                            <td>{{ @$user->merchant->business->name }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Store name</td>
                                            <td>:</td>
                                            <td>{{ @$user->store->name }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Subtitle</td>
                                            <td>:</td>
                                            <td>{{ $user->subtitle }}</td>
                                        </tr>
                                        <tr>
                                        	<td>SKU</td>
                                            <td>:</td>
                                            <td>{{ $user->sku }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Price</td>
                                            <td>:</td>
                                            <td>{{ $user->price }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Sell price</td>
                                            <td>:</td>
                                            <td>{{ $user->sell_price }}</td>
                                        </tr>
                                         <tr>
                                        	<td>Description</td>
                                            <td>:</td>
                                            <td>{{ $user->description }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Status</td>
                                            <td>:</td>
                                            <td>
                                                @if ($user->status == '1')
                                                    <button class="btn btn-success btn-sm">Active</button>
                                                @elseif($user->status == '0')
                                                    <button class="btn btn-warning btn-sm">Inactive</button>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
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
