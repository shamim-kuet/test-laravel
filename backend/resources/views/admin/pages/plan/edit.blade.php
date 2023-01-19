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
                        <h2 class="content-header-title float-left mb-0">Plan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('plan.index') }}"><i data-feather='eye'></i> View</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('plan.create') }}"><i data-feather='plus'></i> Create</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                 <form action="{{ route('plan.update', $plan->id) }}" method="post" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Plan</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ $plan->name }}" placeholder="Ex: Banani, Mirpur"/>
                                                </div>
                                               <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Code</label>
                                                    <input type="text" id="modern-name" name="code" class="form-control" value="{{ $plan->code }}"/>
                                                </div>

                                            </div>

                                            <div class="row">
                                            	{{-- <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Plan Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="delivery" {{$plan->type=="delivery" ?"selected":""}}>Delivery Plan</option>
                                                        <option value="return" {{$plan->type=="return" ?"selected":""}}>Return Plan</option>
                                                    </select>
                                                </div> --}}


                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Parcel Type</label>
                                                    <select class="form-control" name="percel_type">
                                                        <option value="Document" {{$plan->percel_type=="Document" ?"selected":""}}>Document</option>
                                                        <option value="Fragile" {{$plan->percel_type=="Fragile" ?"selected":""}}>Fragile</option>
                                                        <option value="Parcel" {{$plan->percel_type=="Parcel" ?"selected":""}}>Parcel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Location</label>
                                                    <select class="form-control" name="location">
                                                        <option value="Inside Dhaka" {{$plan->location=="Inside Dhaka" ?"selected":""}}>Inside Dhaka</option>
                                                        <option value="Outside Dhaka" {{$plan->location=="Outside Dhaka" ?"selected":""}}>Outside Dhaka</option>
                                                        <option value="Inside Dhaka to Suburbs" {{$plan->location=="Inside Dhaka to Suburbs" ?"selected":""}}>Inside Dhaka to Suburbs</option>
                                                        <option value="Suburbs to Inside Dhaka" {{$plan->location=="Suburbs to Inside Dhaka" ?"selected":""}}>Suburbs to Inside Dhaka</option>
                                                        <option value="Suburbs to Suburbs" {{$plan->location=="Suburbs to Suburbs" ?"selected":""}}>Suburbs to Suburbs</option>
                                                        <option value="Outside Dhaka Same City" {{$plan->location=="Outside Dhaka Same City" ?"selected":""}}>Outside Dhaka Same City</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Time</label>
                                                    <select class="form-control" name="time">
                                                        <option value="Standard Delivery" {{$plan->time=="Standard Delivery" ?"selected":""}}>Standard Delivery</option>
                                                        <option value="Same Day Delivery" {{$plan->time=="Same Day Delivery" ?"selected":""}}>Same Day Delivery</option>
                                                        <option value="Express Delivery" {{$plan->time=="Express Delivery" ?"selected":""}}>Express Delivery</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Weight Kg</label>
                                                    <input type="number" id="modern-name" name="weight" min="0" step="0.0001" class="form-control" value="{{ $plan->weight }}" required/>
                                                </div>



                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Charge amount</label>
                                                    <input type="number" id="modern-name" name="charge" class="form-control" value="{{ $plan->charge }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" {{$plan->status==1?"selected":""}}>Active</option>
                                                        <option value="0" {{$plan->status==0?"selected":""}}>Inactive</option>
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
