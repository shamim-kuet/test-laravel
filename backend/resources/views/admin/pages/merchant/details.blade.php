@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Merchant</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Merchant Details
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('merchant.index') }}">Merchant List</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- @dd($user) --}}
                            	<div class="col-sm-12">
                                	<h2>Account Details</h2>
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="34%">Merchant Name</td>
                                          <td width="1%">:</td>
                                          <td width="65%">{{ $user->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Merchant Code</td>
                                            <td>:</td>
                                            <td>{{ $user->code }}</td>
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
                                        	<td>Username</td>
                                            <td>:</td>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Emergency Contact</td>
                                            <td>:</td>
                                            <td>{{ $user->emargency_contact }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Registration Date</td>
                                            <td>:</td>
                                            <td>{{ $user->enroll_date }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Member Type</td>
                                            <td>:</td>
                                            <td>{{ $user->member_type }}</td>
                                        </tr>
                                    </table>
                                    <h2 style="margin-top:20px;">Contact Person Details</h2>
                            		<table class="table table-bordered" width="100%">
                                        <tr>
                                        	<td width="34%">Contact Person Name</td>
                                            <td width="1%">:</td>
                                            <td width="65%">{{ $user->contacts->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Contact Person Email</td>
                                            <td>:</td>
                                            <td>{{ $user->contacts->email }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Contact Person Phone</td>
                                            <td>:</td>
                                            <td>{{ $user->contacts->phone }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Emergency Contact</td>
                                            <td>:</td>
                                            <td>{{ $user->contacts->emargency_contact }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Contact Person Address</td>
                                            <td>:</td>
                                            <td>{{ $user->contacts->address }}</td>
                                        </tr>
                                    </table>
                                    <h2 style="margin-top:20px;">Business Details</h2>
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="33%">Business Name</td>
                                            <td width="2%">:</td>
                                            <td width="65%">{{ $user->business->name }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Hotline No</td>
                                            <td>:</td>
                                            <td>{{ $user->business->hotline }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Business Email</td>
                                            <td>:</td>
                                            <td>{{ $user->business->email }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Business Phone</td>
                                            <td>:</td>
                                            <td>{{ $user->business->phone }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Emergency Contact</td>
                                            <td>:</td>
                                            <td>{{ $user->business->emargency_contact }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Business Address</td>
                                            <td>:</td>
                                            <td>{{ $user->business->address }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Business Type</td>
                                            <td>:</td>
                                            <td>{{ $user->business->company_type }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Facedbook</td>
                                            <td>:</td>
                                            <td>{{ $user->business->facebook }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Twitter</td>
                                            <td>:</td>
                                            <td>{{ $user->business->twitter }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Youtube</td>
                                            <td>:</td>
                                            <td>{{ $user->business->youtube }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Linkedin</td>
                                            <td>:</td>
                                            <td>{{ $user->business->linkedin }}</td>
                                        </tr>
                                        <tr>
                                        	<td>Instagram</td>
                                            <td>:</td>
                                            <td>{{ $user->business->instagram }}</td>
                                        </tr>
                                    </table>
                                    <h2 style="margin-top:20px;">Documents</h2>
                            		<table class="table table-bordered" width="100%">
                                    	<tr>
                                        	<td width="33%">Document Type</td>
                                          <td width="2%">:</td>
                                          <td width="65%">{{ $user->documents ? $user->documents->documents_type : null }}</td>
                                      </tr>
                                        <tr>
                                        	<td>Document Name</td>
                                            <td>:</td>
                                            <td>{{ $user->documents ? $user->documents->headline : null }}</td>
                                        </tr>
                                        <tr>
                                        	<td height="22">{{ $user->documents ? $user->documents->headline : null }}</td>
                                            <td>:</td>
                                            <td><a href="{{ route('common.commondownload', ['path'=>base64_encode('uploads/merchant/documents/'), 'filename'=>base64_encode($user->documents->files)]) }}">
                                                click here to download </a> </td>
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
