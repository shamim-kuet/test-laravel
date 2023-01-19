@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Partner</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Partner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include ('components.flash-messages')
        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-10 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'partner']) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'partner']) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    onclick="showModal(' for Partner','partner')">
                                                    <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'partner']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'partner']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route('partner.index') }}"><i data-feather='eye'></i>
                                                    View</a></li>
                                            @if ((session()->get('role_id') == 34) || \Utility::checkPermission('partner.create'))
                                                <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                        href="{{ route('partner.create') }}"><i data-feather='plus'></i>
                                                        Create</a></li>
                                            @endif
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('partner.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-2">
                                                <label>Name/Email/Phone:</label>
                                                <input type="text" class="form-control" name="keyword" id="keyword" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Subscription Type:</label>
                                                <select class="form-control" name="subscription_type"
                                                    id="subscription_type">
                                                    <option value="">Select Type</option>
                                                    <option value="Gold">Gold</option>
                                                    <option value="Silver">Silver</option>
                                                    <option value="Bronze">Bronze</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Status:</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="formdate" id="fromdate" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" name="todate" id="todate" />
                                            </div>
                                            <div class="col-lg-2" style="margin-top:22px;">
                                                <input type="submit" class="btn btn-success btn-sm" name="submit"
                                                    value="Search" />
                                                <!--<input type="button"  class="btn btn-success btn-sm" name="submit" value="Search" onclick="getData()" />-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <table class="table table-striped table-responsive table-bordered common-datatables">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th><input name="checkbox" onclick='checkedAll();' type="checkbox"
                                                readonly="readonly" /></th>
                                        <th>Action</th>
                                        <th>Legal Name</th>
                                        <th>Address</th>
                                        <th>Company Name</th>
                                        <th>Company Mobile</th>
                                        <th>Company Email</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Mobile</th>
                                        <th>Contact Person Email</th>
                                        <th>Subscription Type</th>
                                        <th>Subscription Expiry Date</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($getResponse != '')
                                        @foreach ($getResponse as $response)
                                            <tr id="tablerow{{ $response->id }}">
                                                <td>{{$loop->iteration}}</td>
                                                <td><input type="checkbox" name="summe_code[]" id="summe_code"
                                                        value="{{ $response->id }}" /></td>
                                                <td class="text-nowrap">
                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('partner.show'))
                                                        <a href="{{ route('partner.show', $response->id) }}"><i
                                                                data-feather='eye'></i></a>
                                                    @endif
                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('partner.edit'))
                                                        <a href="{{ route('partner.edit', $response->id) }}"><i
                                                                data-feather='edit'></i></a>
                                                    @endif
                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('partner.destroy'))
                                                        <a href="#"
                                                            onclick="singleDelete({{ $response->id }},'partners');"><i
                                                                data-feather='trash-2'></i></a>
                                                    @endif
                                                </td>
                                                <td><a href="#">{{ $response->legal_name }}</a></td>
                                                <td>{{ $response->address }}</td>
                                                <td>{{ $response->company_name }}</td>
                                                <td>{{ $response->company_phone }}</td>
                                                <td>{{ $response->company_email }}</td>
                                                <td>{{ $response->contact_person_name }}</td>
                                                <td>{{ $response->contact_person_phone }}</td>
                                                <td>{{ $response->contact_person_email }}</td>
                                                <td>
                                                    <div class="row">
                                                        <button
                                                            class="btn btn-warning btn-sm">{{ $response->subscription_type }}</button>
                                                        <!--<div class="btn-group">
                                                            <a class="btn btn-sm dropdown-toggle hide-arrow text-primary m-0" data-toggle="dropdown"><i data-feather='more-vertical'></i></a>
                                                            <div class="dropdown-menu dropdown-menu-left m-0 p-0">
                                                                <a href="#" class="dropdown-item">Gold</a>
                                                                <a href="#" class="dropdown-item">Silver</a>
                                                                <a href="#" class="dropdown-item delete-record">Bronze</a>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </td>
                                                <td>{{ $response->subscription_expiry }}</td>
                                                <td>
                                                    @if ($response->status == '1')
                                                        <button class="btn btn-success btn-sm">Active</button>
                                                    @elseif($response->status == '0')
                                                        <button class="btn btn-warning btn-sm">Inactive</button>
                                                    @endif
                                                </td>
                                                <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                                <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

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
