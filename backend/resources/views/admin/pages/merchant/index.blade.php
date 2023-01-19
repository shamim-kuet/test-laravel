@extends('admin.layouts.master')
@section('content')
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Merchant</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Merchant</li>
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
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12" style="padding:0">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm" href="javascript:void()"
                                                    onclick="permissions('merchants',0);"><i
                                                        data-feather='file-text'></i> Disapprove</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-success btn-sm" href="javascript:void()"
                                                    onclick="permissions('merchants',1);"><i
                                                        data-feather='file-text'></i> Approve</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'merchant']) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'merchant']) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    onclick="showModal(' for Merchants ','merchant')">
                                                    <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'merchant']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'merchant']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route('merchant.index') }}"><i data-feather='eye'></i>
                                                    View</a></li>
                                            @if ((session()->get('role_id') == 34) || \Utility::checkPermission('merchant.create'))
                                                <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                        href="{{ route('merchant.create') }}"><i data-feather='plus'></i>
                                                        Create</a></li>
                                                @endif
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('merchant.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    {{-- <div class="col-lg-3" style="margin-top: 20px;">
                                            <a href="javascript:void(0)" class="btn btn-primary"
                                            onclick="hubAssign('common/hubassign');">Assign hub and plan</a>
                                    </div> --}}
                                    <div class="col-lg-9">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-3">
                                                <label>Name/Email/Phone:</label>
                                                <input type="text" class="form-control" name="keyword" id="keyword" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Status:</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="formdate" id="fromdate" />
                                            </div>
                                            <div class="col-lg-3">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" name="todate" id="todate" />
                                            </div>
                                            <div class="col-lg-1" style="margin-top:22px;">
                                                <input type="submit" class="btn btn-success btn-sm" name="submit"
                                                    value="Search" />
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="col-sm-12">

                        <form id="form_check">
                            <table class="table table-striped table-responsive table-bordered common-datatables">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th><input name="checkbox" onclick='checkedAll();' type="checkbox"
                                                readonly="readonly" /></th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Business Name</th>
                                        <th>Code</th>
                                        <th>Owner name</th>
                                        <th>Owner Phone no</th>
                                        <th>contact person</th>
                                        <th>Contact person phone</th>
                                        <th>Email</th>
                                        <th>Hub</th>
                                        <th>Registration date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($getResponse != '')
                                        @foreach ($getResponse as $response)
                                            <tr id="tablerow{{ $response->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><input type="checkbox" name="summe_code[]" id="summe_code"
                                                        value="{{ $response->id }}" /></td>
                                                <td class="text-nowrap">
                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('merchant.show'))
                                                        <a href="{{ route('merchant.show', $response->id) }}" title="View Details"><i
                                                            class="fa fa-eye"></i></a>
                                                    @endif
                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('merchant.edit'))
                                                        <a href="{{ route('merchant.edit', $response->id) }}" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    @endif
                                                    {{-- @if ((session()->get('role_id') == 34) || \Utility::checkPermission('merchant.destroy'))
                                                        <a href="#"
                                                            onclick="singleDelete({{ $response->id }},'merchants');" title="Delete"><i
                                                               class="fa fa-trash"></i></a>
                                                    @endif --}}

                                                    @if ((session()->get('role_id') == 34) || \Utility::checkPermission('rider.destroy'))
                                                        <a href="javascript::void()" onclick="resetPasswordModal('merchants',{{ $response->id }})" title="Reset Password"><i class='fa fa-lock'></i></a>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($response->status == '1')
                                                        <button class="btn btn-success btn-sm">Active</button>
                                                    @elseif($response->status == '0')
                                                        <button class="btn btn-warning btn-sm">Inactive</button>
                                                    @endif
                                                </td>
                                                <td>{{ @$response->business->name }}</td>
                                                <td>{{ $response->code }}</td>
                                                <td><a href="#">{{ $response->name }}</a></td>
                                                <td>{{ $response->phone }}</td>
                                                <td>{{ @$response->contacts->name }}</td>
                                                <td>{{ @$response->contacts->phone }}</td>
                                                <td>{{ $response->email }}</td>
                                                <td>{{ @$response->hub->name }}</td>
                                                <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                            </table>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--/ Advanced Search -->


<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">

    </div>
</div>
@endsection
@section('page-script')
@endsection
