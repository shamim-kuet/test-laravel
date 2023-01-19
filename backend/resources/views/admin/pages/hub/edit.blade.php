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
                        <h2 class="content-header-title float-left mb-0">Hub</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
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
       <?php /*?> @if (isset($errors->phone))
      	  <div class="alert alert-danger">
                {{ $errors->phone[0] }}
            </div>
        @endif<?php */
		?>

        @if (isset($errors))
        	@foreach($errors as $error)
                <div class="alert alert-danger" style="padding:5px;">
                    {{ $error[0] }}
                </div>
            @endforeach
        @endif
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <div class="left">
                                    <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('hub.index') }}"><i data-feather='eye'></i> View</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('hub.create') }}"><i data-feather='plus'></i> Create</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('hub.update', $hub->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Hub Name</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ $hub->name }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Phone</label>
                                                    <input type="text" id="modern-name" name="phone" class="form-control" value="{{ $hub->phone }}"/>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Code</label>
                                                    <input type="text" id="modern-name" name="code" class="form-control" value="{{ $hub->code }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Email</label>
                                                    <input type="email" id="modern-email" name="email" class="form-control" value="{{ $hub->email }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Username</label>
                                                    <input type="text" id="modern-name" name="username" class="form-control" value="{{ $hub->username }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Emargency Contact</label>
                                                    <input type="text" id="modern-name" name="emargency_contact" class="form-control" value="{{ $hub->emargency_contact }}"/>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Hub Address</label>
                                                    <input type="text" id="modern-address" name="address" class="form-control" value="{{ $hub->address }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Hub Admin</label>

                                                    <select name="hub_admin_id" id="hub_admin_id" class="form-control">
                                                        @foreach ($admins as $admin)
                                                            <option value="{{ $admin->id }}" {{$admin->id==$hub->hub_admin_id? "selected": ""}}>{{ $admin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Can Login ?</label>
                                                    <select class="form-control" name="canlogin">
                                                        <option value="1" {{ $hub->canlogin == 1 ? "selected" : "" }}>Yes</option>
                                                        <option value="0" {{ $hub->canlogin == 0 ? "selected" : "" }}>No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" {{ $hub->status == 1 ? "selected" : "" }}>Active</option>
                                                        <option value="0" {{ $hub->status == 0 ? "selected" : "" }}>Inactive</option>
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
        </div>
    </div>
@endsection
