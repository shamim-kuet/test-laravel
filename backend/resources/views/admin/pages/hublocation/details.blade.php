@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Hub Location</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Hub Location Details
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('hublocation.index') }}">Hub Location List</a>
                                </div>
                            </div>
                            <div class="card-body">
                            	<div class="col-sm-8">
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="39%">Hub Location Name</td>
                                          <td width="1%">:</td>
                                          <td width="60%">{{ $user->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Merchant Name</td>
                                            <td>:</td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Email</td>
                                            <td>:</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Phone</td>
                                            <td>:</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Region</td>
                                            <td>:</td>
                                            <td>{{ $user->region }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Zone</td>
                                            <td>:</td>
                                            <td>{{ $user->zone }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Area</td>
                                            <td>:</td>
                                            <td>{{ $user->area }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Is Ready</td>
                                            <td>:</td>
                                            <td>{{ $user->isready }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Status</td>
                                            <td>:</td>
                                            <td>{{ $user->status }}</td>
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
