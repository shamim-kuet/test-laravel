@extends('admin.layouts.master')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/base/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}app-assets/css/base/plugins/forms/pickers/form-flat-pickr.css">
@endsection
@section('content')
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Promo Code</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">View Promo Code</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
        <div class="col-12">
            <div class="card invoice-list-wrapper">
                <div class="card-header border-bottom">
                   <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div class="col-sm-10 mt-1">
                        <div class="row">
                            <div class="col-sm-12">
                                <ol class="breadcrumb float-sm-right">
                                    <li style="margin: 2px;"><button class="btn btn-info btn-sm"><i data-feather='file-text'></i> CSV</button></li>
                                    <li style="margin: 2px;"><button class="btn btn-success btn-sm"><i data-feather='download'></i> Excel</button></li>
                                    <li style="margin: 2px;"><button class="btn btn-danger btn-sm"><i data-feather='file'></i> PDF</button></li>
                                    <li style="margin: 2px;"><button class="btn btn-warning btn-sm"><i data-feather='printer'></i> Print</button></li>
                                    <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('promo-code.index') }}"><i data-feather='eye'></i> View</a></li>
                                    <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('promo-code.create') }}"><i data-feather='plus'></i> Create</a></li>
                                    <li style="margin: 2px;"><div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Column</button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0);">ID</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Image</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Name</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Banner Type</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Status</a>
                                            </div>
                                        </div></li>
                                </ol>
                            </div>
                           {{-- <div class="col-md-6 text-right">
                                <button class="btn btn-info btn-sm"><i data-feather='file-text'></i> CSV</button>
                                <button class="btn btn-success btn-sm"><i data-feather='download'></i> Excel</button>
                                <button class="btn btn-danger btn-sm"><i data-feather='file'></i> PDF</button>
                            </div>--}}
                            {{--<div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('driver.create') }}"><i data-feather='eye'></i> View</a>
                                <a class="btn btn-dark btn-sm" href="{{ route('driver.create') }}"><i data-feather='plus'></i> Create</a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Column</button>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);">ID</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Image</a>
                                        <a class="dropdown-item" href="javascript:void(0);">License</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Vehicle</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Full Name</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mobile</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Emergency Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Email</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Address</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Status</a>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <form class="dt_adv_search" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-row mb-1">
                                    <div class="col-lg-3">
                                        <label>Name:</label>
                                        <input type="text"  class="form-control" />
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Banner Type:</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Type</option>
                                            <option value="Processing">Main Banner</option>
                                            <option value="Picked">Below</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Status:</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option value="Processing">Active</option>
                                            <option value="Picked">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2" style="margin-top:22px;">
                                        <input type="submit"  class="btn btn-success btn-sm" name="submit" value="Search"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="card-datatable mb-2">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-responsive table-striped common-datatables" style="width:100%; padding: 10px">
                            <thead>
                            <tr>
                                <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                <th>Action</th>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Discount Type</th>
                                <th>Discount Amount</th>
                                <th>Uses</th>
                                <th>Total Limit</th>
                                <th>Rule</th>
                                <th>Time Period</th>
                                <th>Rule</th>
                                <th>Updated_at</th>
                                <th>Created_at</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @php $i=1; @endphp
                            <tbody>
                            <tr>
                                <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                <td class="text-nowrap">
                                    <a href="#" title="view"><i data-feather='eye'></i></a>
                                    <a href="#" title="edit"><i data-feather='edit'></i></a>
                                    <a href="#" title="delete"><i data-feather='trash-2'></i></a>
                                    <a href="#" title="info"><i data-feather='more-vertical'></i></a>
                                </td>
                                <td>{{$i++}}</td>
                                <td>New user promo</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Banner one</td>
                                <td>Main Banner</td>
                                <td><button class="btn btn-sm btn-success">Active</button></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection


@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
@endsection

@section('page-script')
   {{-- <script>
        checked = false;
        function checkedAll() {
            if (checked == false){checked = true}else{checked = false}
            for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
                document.getElementById('form_check').elements[i].checked = checked;
            }
        }
    </script>--}}
    {{-- Page js files --}}
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/pages/app-user-list.js"></script>

    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/js/scripts/tables/table-datatables-advanced.js"></script>
    <script src="{{ $setting ? $setting->default_url : '' }}app-assets/data/table-datatable.json"></script>
@endsection

