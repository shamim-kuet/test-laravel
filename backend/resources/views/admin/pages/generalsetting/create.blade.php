@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">General Setting</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create General Setting
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('generalsetting.index') }}"><i
                                            data-feather='eye'></i> View General Setting</a>
                                    {{-- <a class="btn btn-dark btn-learge" href="{{ route('generalsetting.create') }}"><i
                                            data-feather='plus'></i> Create New</a> --}}
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">
                                <form action="{{ route('generalsetting.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_name">Site Name</label>
                                                <input type="text" id="site_name" name="site_name" class="form-control"
                                                    value="{{ old('site_name') }}" placeholder="Enter Site Name" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_title">Site Title</label>
                                                <input type="text" id="site_title" name="site_title" class="form-control"
                                                    value="{{ old('site_title') }}" placeholder="Enter Site Title" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_message">Copyright Message</label>
                                                <input type="text" id="copyright_message" name="copyright_message" class="form-control"
                                                    value="{{ old('copyright_message') }}" placeholder="Enter Copyright Message" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_name">Copyright Name</label>
                                                <input type="text" id="copyright_name" name="copyright_name" class="form-control"
                                                    value="{{ old('copyright_name') }}" placeholder="Enter Copyright Name" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_url">Copyright url</label>
                                                <input type="text" id="copyright_url" name="copyright_url" class="form-control"
                                                    value="{{ old('copyright_url') }}" placeholder="Enter Copyright Url" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_text">Design Develop By Text</label>
                                                <input type="text" id="design_develop_by_text" name="design_develop_by_text" class="form-control"
                                                    value="{{ old('design_develop_by_text') }}" placeholder="Enter Design Develop By Text" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_name">Design Develop By Name</label>
                                                <input type="text" id="design_develop_by_name" name="design_develop_by_name" class="form-control"
                                                    value="{{ old('design_develop_by_name') }}" placeholder="Enter Design Develop By Name" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_url">Design Develop By Url</label>
                                                <input type="text" id="design_develop_by_url" name="design_develop_by_url" class="form-control"
                                                    value="{{ old('design_develop_by_url') }}" placeholder="Enter Design Develop By Url" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                    value="{{ old('phone') }}" placeholder="Enter Phone" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email') }}" placeholder="Enter Email" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="website_link">Website Link</label>
                                                <input type="text" id="website_link" name="website_link" class="form-control"
                                                    value="{{ old('website_link') }}" placeholder="Enter Website Link" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="default_url">Default Url</label>
                                                <input type="text" id="default_url" name="default_url" class="form-control"
                                                    value="{{ old('default_url') }}" placeholder="Enter Default Url" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="api_url">Api Url</label>
                                                <input type="text" id="api_url" name="api_url" class="form-control"
                                                    value="{{ old('api_url') }}" placeholder="Enter Api Url" required/>
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
