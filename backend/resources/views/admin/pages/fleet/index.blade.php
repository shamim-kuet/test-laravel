@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Fleet</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">View Fleet</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-10 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;"><button class="btn btn-info btn-sm"><i data-feather='file-text'></i> CSV</button></li>
                                            <li style="margin: 2px;"><button class="btn btn-secondary btn-sm"><i data-feather='download'></i> Excel</button></li>
                                            <li style="margin: 2px;"><button class="btn btn-danger btn-sm"><i data-feather='file'></i> PDF</button></li>
                                            <li style="margin: 2px;"><button class="btn btn-warning btn-sm"><i data-feather='printer'></i> Print</button></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('fleet.index') }}"><i data-feather='eye'></i> View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('fleet.create') }}"><i data-feather='plus'></i> Create</a></li>
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
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Vehicle Type</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Vehicle Name</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Registration No</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Chassis No</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Engine No</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Manufactured by</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Capacity</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Registration Expiry Date</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Vehicle Owner Name</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><input name="checkbox" type="checkbox" readonly="readonly"/> Vehicle Owner Contact</a>
                                                        <div class="col-md-12 p-1">
                                                            <button class="btn btn-sm btn-primary btn-block">Apply</button>
                                                        </div>
                                                    </div>
                                                </div></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-2">
                                                <label>Vehicle Name:</label>
                                                <input type="text"  class="form-control" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Vehicle Type:</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Select Type</option>
                                                    <option value="Processing">Car</option>
                                                    <option value="Picked">Cycle</option>
                                                    <option value="Shipped">Bike</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Vehicle Status:</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="In Progress">Active</option>
                                                    <option value="Pending">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>From Date</label>
                                                <input type="text"  class="form-control" name="from" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>To Date</label>
                                                <input type="text"  class="form-control" name="to" />
                                            </div>
                                            <div class="col-lg-2" style="margin-top:22px;">
                                                <input type="submit"  class="btn btn-success btn-sm" name="submit" value="Search" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-responsive common-datatables" style="width:100%; padding: 10px">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                    <th>Action</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Name</th>
                                    <th>License</th>
                                    <th>Registration No</th>
                                    <th>Model</th>
                                    <th>Chassis No</th>
                                    <th>Engine No</th>
                                    <th>Manufactured by</th>
                                    <th>Capacity</th>
                                    <th>Vehicle Cost</th>
                                    <th>Mileage</th>
                                    <th>Distance</th>
                                    <th>Registration Expiry Date</th>
                                    <th>Vehicle Owner Name</th>
                                    <th>Vehicle Owner Contact</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="" /></td>
                                    <td class="text-nowrap">
                                        <a href="#"><i data-feather='eye'></i></a>
                                        <a href="#"><i data-feather='edit'></i></a>
                                        <a href="#"><i data-feather='trash-2'></i></a>
                                        <a href="#"><i data-feather='more-vertical'></i></a>
                                    </td>
                                    <td>Car</td>
                                    <td>Car</td>
                                    <td><img height="auto" width="80px" src="{{asset('images/license/1.jpg')}}" alt="license"></td>
                                    <td>12345678</td>
                                    <td>MK-093</td>
                                    <td>DF456</td>
                                    <td>QF-45644</td>
                                    <td>Borak</td>
                                    <td>4</td>
                                    <td>5000</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>2021-10-31</td>
                                    <td>Shakil</td>
                                    <td>01972839454</td>
                                    <td><button class="btn btn-sm btn-danger">Inactive</button></td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--/ Advanced Search -->


@endsection
@section('page-script')
@endsection

