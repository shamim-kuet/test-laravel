@extends('admin.layouts.master')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/plugins/forms/form-validation.css">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css-rtl/plugins/forms/form-wizard.css">
    <style>
    	input[type='radio']{
			width:20px;
			height:20px;
			padding:5px;
			position:absolute;
			margin:0;
		}
		.radiolabel{
			margin-left:30px;
			position:relative;
		}
		.required{
			color:red;
		}

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">{{ request()->name }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Create {{ request()->name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @include ('components.flash-messages')
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
                                    <a class="btn btn-primary btn-learge" href="{{ route('user.index') }}"><i
                                            data-feather='eye'></i> View User</a>
                                    <a class="btn btn-dark btn-learge" href="{{ route('user.create') }}"><i
                                            data-feather='plus'></i> Create New</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modern Horizontal Wizard -->
                        <form action=" {{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data" files="true">
                         @csrf
                            <section class="modern-horizontal-wizard card bg-light">
                                <div class="bs-stepper wizard-modern modern-wizard-example">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#account-details-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="file-text" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Account Details</span>
                                                    <span class="bs-stepper-subtitle ml-2">Setup Account Details</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i data-feather="chevron-right" class="font-medium-2"></i>
                                        </div>
                                        <div class="step" data-target="#personal-info-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="user" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Personal Info</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Personal Info</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i data-feather="chevron-right" class="font-medium-2"></i>
                                        </div>
                                        <div class="step" data-target="#address-step-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="map-pin" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Address</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Address</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i data-feather="chevron-right" class="font-medium-2"></i>
                                        </div>
                                        <div class="step" data-target="#social-links-modern">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="link" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Social Links</span>
                                                    <span class="bs-stepper-subtitle ml-2">Add Social Links</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div id="account-details-modern" class="content" style="margin:0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Account Details</h5>
                                                <small class="text-muted">Enter Your Account Details.</small>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Username <span class="required">*</span></label>
                                                    <input type="text" id="username" class="form-control" name="username" value="{{ $user->username }}" required/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-email">Email<span class="required">*</span></label>
                                                    <input type="email" id="email" class="form-control"   value="{{ $user->email}}" name="email" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="roll">User Type<span class="required">*</span></label>
                                                    <select class="form-control" name="user_type" id="roll" required>
                                                        @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->user_type==$role->id?"selected":""}}>{{ $role->name }}

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-username">Status<span class="required">*</span></label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="1" {{ $user->status==1?"selected":""}}>Active</option>
                                                        <option value="0" {{ $user->status==0?"selected":""}}>Inactive</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-outline-secondary btn-prev" disabled type="button">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next" type="button">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="personal-info-modern" class="content" style="margin:0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Personal Info</h5>
                                                <small>Enter Your Personal Info.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Name<span class="required">*</span></label>
                                                    <input type="text" id="modern-first-name" class="form-control" name="name"  value="{{ $user->name}}" required/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="phone">Phone<span class="required">*</span></label>
                                                    <input type="text" id="phone" class="form-control" name="phone"  value="{{ $user->phone}}" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Emergency Contact<span class="required">*</span></label>
                                                    <input type="text" id="modern-first-name" class="form-control" name="emargency_contact"  value="{{ $user->emargency_contact}}" required/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="phone">Designation<span class="required">*</span></label>
                                                    <input type="text" id="emargency_contact" class="form-control"  name="designation"  value="{{ $user->designation}}" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Date of Birth</label>
                                                    <input type="date" id="modern-first-name" class="form-control" name="dob"  value="{{ $user->dob}}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="phone">Religion</label>
                                                    <input type="text" id="religion" class="form-control" name="religion" value="{{ $user->religion}}"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Marital Status: </label>
                                                    <input type="radio" name="marital_status" value="Married" id="married" @if($user->marital_status=='Married') checked @endif />
                                                    <label for="married" class="radiolabel">Married</label>
                                                    <input type="radio" name="marital_status" value="Unmarried" id="unmarried" @if($user->marital_status=='Unmarried') checked @endif/>
                                                    <label for="unmarried" class="radiolabel">Unmarried</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="phone">Gender: </label>
                                                    <input type="radio" name="gender" value="Male" id="male" @if($user->gender=='Male') checked @endif/>
                                                    <label for="male" class="radiolabel">Male</label>
                                                    <input type="radio" name="gender" value="Female" id="female" @if($user->gender=='Female') checked @endif/>
                                                    <label for="female" class="radiolabel">Female</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-first-name">Joining Date: </label>
                                                    <input type="date" id="joining_date" class="form-control" name="joining_date" value="{{ $user->joining_date}}"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="photo">Photo: </label>
                                                    <input type="file" id="photo" class="form-control" name="photo"/>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-primary btn-prev" type="button">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next" type="button">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="address-step-modern" class="content" style="margin:0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Address</h5>
                                                <small>Enter Your Address.</small>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="present_address">Present Address</label>

                                                    <textarea name="present_address" id="present_address" cols="30"  rows="10" class="form-control">{{ $user->present_address }}</textarea>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="permanent_address">Permanent Address</label>
                                                  <textarea name="permanent_address" id="permanent_address" cols="30" rows="10" class="form-control">{{ $user->permanent_address }}</textarea>
                                                </div>

                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-primary btn-prev" type="button">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next" type="button">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="social-links-modern" class="content" style="margin:0">
                                            <div class="content-header">
                                                <h5 class="mb-0">Social Links</h5>
                                                <small>Enter Your Social Links.</small>
                                            </div>
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-facebook">Facebook</label>
                                                    <input type="text" id="modern-facebook" class="form-control"
                                                        name="facebook"  value="{{ $user->facebook }}"/>
                                                </div>

                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-primary btn-prev">
                                                    <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
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
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/wizard/bs-stepper.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/select/select2.full.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js">
    </script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-validation.js"></script>
@endsection
@section('page-script')
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/forms/form-wizard.js"> </script>

    <script>
        $('#userAddForm').validate({
            rules: {
                name: "required",
                phone: "required",
                username: "required",
                roll: "required",
                status: "required",
                password: "required",
                c_password: "required",
                status: "required",
                : "required",
                emargency_contact: "required",
                email: {
                    required: true,
                     email: true
                }
            },
            messages: {
                name: "Please specify Name",
                phone: "Please specify Phone",
                username: "Please specify username",
                status: "Please Select Status",
                roll: "Please Select Role",
                password: "Please specify Password",
                c_password: "Confirm Password doesn't match",
                designation: "Please specify Designation",
                emargency_contact: "Please specify Emergency Contact",
                email: {
                    required: "Please Type Email",
                    email: "Your email address must be in the format of name@domain.com"
                }
            }
        });
    </script>
@endsection
