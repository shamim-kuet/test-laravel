@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User Details
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('user.index') }}">User List</a>
                                </div>
                            </div>
                            <div class="card-body">
                            	<div class="col-sm-10">
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="39%">Name</td>
                                          <td width="1%">:</td>
                                          <td width="60%">{{ $user->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Username</td>
                                            <td>:</td>
                                            <td>{{ $user->username }}</td>
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
                                        	<td>Emergency Contact</td>
                                            <td>:</td>
                                            <td>{{ $user->emargency_contact }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Designation</td>
                                            <td>:</td>
                                            <td>{{ $user->designation }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Date of Birth</td>
                                            <td>:</td>
                                            <td>{{ $user->dob }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Religion</td>
                                            <td>:</td>
                                            <td>{{ $user->religion }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Marital Status</td>
                                            <td>:</td>
                                            <td>{{ $user->marital_status }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Gender</td>
                                            <td>:</td>
                                            <td>{{ $user->gender }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Joining Date</td>
                                            <td>:</td>
                                            <td>{{ $user->joining_date }}</td>
                                        </tr>

                                        <tr>
                                        	<td>Photo</td>
                                            <td>:</td>
                                            <td>{{ $user->photo }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Permanent Address</td>
                                            <td>:</td>
                                            <td>{{ $user->permanent_address }}</td>
                                        </tr>

                                        <tr>
                                        	<td>Permanent Address</td>
                                            <td>:</td>
                                            <td>{{ $user->permanent_address }}</td>
                                        </tr>

                                        <tr>
                                        	<td>Status</td>
                                            <td>:</td>
                                            <td>
                                                @if ($user->status == 1)
                                                <button class="btn btn-sm btn-success waves-effect waves-float waves-light">Active</button>
                                                @else
                                                <button class="btn btn-sm btn-warning waves-effect waves-float waves-light">Inactive</button>
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
