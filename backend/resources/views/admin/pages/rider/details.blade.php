@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Rider</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Rider Details
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('rider.index') }}">Rider List</a>
                                </div>
                            </div>
                            <div class="card-body">
                            	<div class="col-sm-8">
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="39%">Rider Name</td>
                                            <td width="1%">:</td>
                                            <td width="60%">{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Hub Name</td>
                                            <td>:</td>
                                            <td>{{ @$user->hub->name }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Employee ID</td>
                                            <td>:</td>
                                            <td>{{ $user->employee_id }}</td>
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
                                        {{-- <tr>
                                        	<td>Rider Code</td>
                                            <td>:</td>
                                            <td>{{ $user->code }}</td>
                                        </tr> --}}
                                        <tr>
                                        	<td>Username</td>
                                            <td>:</td>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Emargency Contact</td>
                                            <td>:</td>
                                            <td>{{ $user->emargency_contact }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Address</td>
                                            <td>:</td>
                                            <td>{{ $user->address }}</td>
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
                                        	<td>Joining Date</td>
                                            <td>:</td>
                                            <td>{{ date('d-M-Y', strtotime($user->joining_date)) }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Enroll Date</td>
                                            <td>:</td>
                                            <td>{{ date('d-M-Y', strtotime($user->enroll_date)) }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Photo</td>
                                            <td>:</td>
                                            <td><img src="{{ asset('uploads/rider/'.$user->photo) }}" style="width: 150px; height: auto;"></td>
                                        </tr>
                                        <tr>
                                        	<td>Can Login</td>
                                            <td>:</td>
                                            <td>
                                                {{ $user->canlogin == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>Status</td>
                                            <td>:</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <button class="btn btn-sm btn-success">Active</button>
                                                @else
                                                    <button class="btn btn-sm btn-warning">Inactive</button>
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
