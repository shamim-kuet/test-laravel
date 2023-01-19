@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Payment Request</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Payment Request List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('components.flash-messages')
        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">

                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'paymentrequest']) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'paymentrequest']) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'paymentrequest']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'paymentrequest']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                    href="{{ route('paymentrequest.create') }}"><i
                                                        data-feather='plus'></i> Create</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('order.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">

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
                                            <th>Merchant Name</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Account Name</th>
                                            <th>Account Number</th>
                                            <th>Routing No</th>
                                            <th>Branch No</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Payment Date</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($result != '')
                                            {{-- {{ dd($result) }} --}}
                                            @foreach ($result as $response)
                                            <tr id="tablerow{{ $response->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><input type="checkbox" name="summe_code[]" id="summe_code"
                                                            value="{{ $response->id }}" /></td>
                                                    <td class="text-nowrap">
                                                        <a href="#" onclick="singleDelete({{ $response->id }},'merchant_payment_requests');">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ @$response->merchant->business->name }}</td>
                                                    <td>{{ $response->payment_method }}</td>
                                                    <td>{{ $response->amount }}</td>
                                                    <td>{{ $response->account_name }}</td>
                                                    <td>{{ $response->account_number }}</td>
                                                    <td>{{ $response->routing_no }}</td>
                                                    <td>{{ $response->branch_no }}</td>
                                                    <td>{{ $response->remark }}</td>
                                                    <td>{{ $response->status }}</td>
                                                    <td>{{ \Utility::commonDateFormate($response->payment_date) }}</td>
                                                    <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                                    <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
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
