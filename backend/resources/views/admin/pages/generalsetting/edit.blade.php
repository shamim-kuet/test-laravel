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
                                <li class="breadcrumb-item active">Edit General Setting
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
                                            data-feather='eye'></i> View</a>
                                    {{-- <a class="btn btn-dark btn-learge" href="{{ route('generalsetting.create') }}"><i
                                            data-feather='plus'></i> Create</a> --}}
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('generalsetting.update', $generalsetting->id) }}" method="post"
                                    enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="bs-stepper-content">

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_name">Site Name</label>
                                                <input type="text" id="site_name" name="site_name" class="form-control" placeholder="Enter Site Name" value="{{ $generalsetting->site_name }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="site_title">Site Title</label>
                                                <input type="text" id="site_title" name="site_title" class="form-control" placeholder="Enter Site Title" value="{{ $generalsetting->site_title }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_message">Copyright Message</label>
                                                <input type="text" id="copyright_message" name="copyright_message" class="form-control" placeholder="Enter Copyright Message" value="{{ $generalsetting->copyright_message }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_name">Copyright Name</label>
                                                <input type="text" id="copyright_name" name="copyright_name" class="form-control" placeholder="Enter Copyright Name" value="{{ $generalsetting->copyright_name }}"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="copyright_url">Copyright url</label>
                                                <input type="text" id="copyright_url" name="copyright_url" class="form-control" placeholder="Enter Copyright Url" value="{{ $generalsetting->copyright_url }}"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_text">Design Develop By Text</label>
                                                <input type="text" id="design_develop_by_text" name="design_develop_by_text" class="form-control" placeholder="Enter Design Develop By Text" value="{{ $generalsetting->design_develop_by_text }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_name">Design Develop By Name</label>
                                                <input type="text" id="design_develop_by_name" name="design_develop_by_name" class="form-control" placeholder="Enter Design Develop By Name" value="{{ $generalsetting->design_develop_by_name }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="design_develop_by_url">Design Develop By Url</label>
                                                <input type="text" id="design_develop_by_url" name="design_develop_by_url" class="form-control" placeholder="Enter Design Develop By Url" value="{{ $generalsetting->design_develop_by_url }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone" value="{{ $generalsetting->phone }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $generalsetting->email }}" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="website_link">Website Link</label>
                                                <input type="text" id="website_link" name="website_link" class="form-control" placeholder="Enter Website Link" value="{{ $generalsetting->website_link }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="default_url">Default Url</label>
                                                <input type="text" id="default_url" name="default_url" class="form-control" placeholder="Enter Default Url" value="{{ $generalsetting->default_url }}" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="api_url">Api Url</label>
                                                <input type="text" id="api_url" name="api_url" class="form-control" placeholder="Enter Api Url" value="{{ $generalsetting->api_url }}" required/>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-success">Update</button>
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
