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
                        <h2 class="content-header-title float-left mb-0">Rider</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create Rider
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('rider.index') }}"><i data-feather='eye'></i> View Rider</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('rider.create') }}"><i data-feather='plus'></i> Create New</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('rider.update', $rider->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Rider Name</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ $rider->name }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Phone</label>
                                                    <input type="text" id="modern-name" name="phone" class="form-control" value="{{ $rider->phone }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Emargency Contact</label>
                                                    <input type="text" id="modern-name" name="emargency_contact" class="form-control" value="{{ $rider->emargency_contact }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Employee ID</label>
                                                    <input type="text" id="modern-name" name="employee_id" class="form-control" value="{{ $rider->employee_id }}" required />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Email</label>
                                                    <input type="email" id="modern-email" name="email" class="form-control" value="{{ $rider->email }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Joining date</label>
                                                    <input type="date" id="modern-name" name="joining_date" class="form-control" value="{{ $rider->joining_date }}"/>
                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Enroll Date</label>
                                                    <input type="date" id="modern-name" name="enroll_date" class="form-control" value="{{ $rider->enroll_date }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Address</label>
                                                    <input type="text" id="modern-address" name="address" class="form-control" value="{{ $rider->address }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Zone</label>
                                                    <input type="text" id="modern-name" name="zone" class="form-control" value="{{ $rider->zone }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Area</label>
                                                    <input type="text" id="modern-name" name="area" class="form-control" value="{{ $rider->area }}"/>
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Username</label>
                                                    <input type="text" id="modern-name" name="username" class="form-control" value="{{ $rider->username }}" required />
                                                </div>

                                            </div>
                                            <div class="row">
                                            	<div class="col-xl-4 col-md-6 col-12 mb-1">
                                                    <div class="form-group">
                                                        <label for="name">Hub</label>
                                                        <select name="hub_id" class="form-control">
                                                           @if ($rider->hub)
                                                           <option value="{{ $rider->hub->id }}">{{ $rider->hub->name }}</option>
                                                           @endif

                                                            @foreach($hubs as $hub)
                                                            <option value="{{ $hub->id }}">{{ $hub->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                               <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                    <div class="form-group">
                                                    <label class="form-label" for="modern-username">Can Login ?</label>
                                                    <select class="form-control" name="canlogin">
                                                        <option {{ $rider->canlogin==1? "selected": "" }} value="1">Yes</option>
                                                        <option {{ $rider->canlogin==0? "selected": "" }} value="0">No</option>
                                                    </select>
                                                </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                                    <div class="form-group">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option {{ $rider->status==1? "selected": "" }} value="1">Active</option>
                                                        <option {{ $rider->status==0? "selected": "" }} value="0">Inactive</option>
                                                    </select>
                                                </div>
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
