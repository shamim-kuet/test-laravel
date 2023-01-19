@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Store</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Store
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('store.index') }}"><i data-feather='eye'></i> View Store</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('store.create') }}"><i data-feather='plus'></i> Create New</a>
                                </div>
                            </div>

                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <section class="modern-horizontal-wizard card bg-light">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <form action="{{ route('store.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="bs-stepper-content">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Merchant Name</label>
                                                    <select name="merchant_id" class="form-control">
                                                        @foreach ($merchants as $merchant)
                                                            <option value="{{ $merchant->id }}" {{ ($store->merchant_id==$merchant->id)? "selected":"" }}>
                                                                {{ $merchant->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Store Name</label>
                                                    <input type="text" id="modern-name" name="name" class="form-control" value="{{ $store->name }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Phone</label>
                                                    <input type="text" id="modern-name" name="phone" class="form-control" value="{{ $store->phone }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Email</label>
                                                    <input type="email" id="modern-email" name="email" class="form-control" value="{{ $store->email }}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Store Address</label>
                                                    <input type="text" id="modern-address" name="address" class="form-control" value="{{ $store->address }}"/>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">District<span class="required">*</span></label>
                                                    <select name="region" class="form-control select2" required  onchange="getCommonData(this.value,'district_id','upozila','upazilalists')">
                                                        @foreach($district as $distr)
                                                            <option value="{{ $distr->district_id }}" @if ($distr->district_id == $store->region) selected @endif>{{ ucfirst(strtolower($distr->district_name)) }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Thana/Upazila<span class="required">*</span></label>
                                                        <div id="upazilalists">
                                                            <select name="area" class="form-control select2" required>
                                                            @foreach($upozila as $upaz)
                                                                <option value="{{ $upaz->upozila_id }}" @if ($upaz->upozila_id == $store->area) selected @endif >{{ ucfirst(strtolower($upaz->upozila_name)) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" {{ $store->status==1? "selected": ""}}>Active</option>
                                                        <option value="0" {{ $store->status==0? "selected": ""}}>Inactive</option>
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
@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
@endsection

@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
