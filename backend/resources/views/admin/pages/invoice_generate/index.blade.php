@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Cash Handovered List</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Cash Handovered Order List</li>
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
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                                <a class="btn btn-success btn-sm" href="javascript:void(0)"
                                                    onclick="invoiceGenerate()">Generate Invoice</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'invoicegenerated', 'requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'invoicegenerated', 'requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            {{-- <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Order','invoicegenerate')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li> --}}
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'invoicegenerate-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'invoicegenerate-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route('invoicegenerate.list') }}"><i data-feather='eye'></i>
                                                    Generated Invoice</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-success btn-sm"
                                                    href="{{ route('invoicegenerate.index') }}"><i data-feather='eye'></i>
                                                    View</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('invoicegenerate.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12" s style="margin:0; padding:0">
                                        <div class="form-row mb-1">

                                            {{-- <div class="col-lg-2">
                                                <label>Merchant Code:</label>
                                                <input type="text"  class="form-control" name="keyword" id="keyword" />
                                            </div> --}}

                                            <div class="col-lg-2">
                                                <label>Merchant:</label>
                                                <select class="form-control" name="merchant_id" id="merchant_id">
                                                    <option value="">Select</option>
                                                    @foreach ($merchants as $merchant)
                                                        <option value="{{ $merchant->id }}">
                                                            {{ @$merchant->business->name }}</option>
                                                    @endforeach
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
                                            <div class="col-lg-2" style="margin-top:22px;">
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered common-datatables">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th><input name="checkbox" onclick='checkedAll();' type="checkbox"
                                                        readonly="readonly" /></th>
                                                <th>Action</th>
                                                <th>Merchant Name</th>
                                                <th>Merchant Code</th>
                                                <th>Total Order</th>
                                                <th>Total Collection</th>
                                                <th>Delivery Charge</th>
                                                <th>Return Charge</th>
                                                <th>COD Charge</th>
                                                <th>Weight Charge</th>
                                                <th>Total Charge</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $total_received_amount = 0;
                                            $total_delivery_charge = 0;
                                            $total_total_return_cost = 0;
                                            $total_cod_charge = 0;
                                            $total_weight_charge = 0;
                                            $total_charge = 0;
                                        @endphp

                                        <tbody>
                                            @if ($getResponse != '')
                                                @php $i=0; @endphp
                                                @foreach ($getResponse as $response)
                                                    @php
                                                        $i++;
                                                        $totalRetCharge = $response->total_returncharge;
                                                        $totalDelCharge = $response->total_deliverycharge;
                                                    @endphp

                                                    @php
                                                        $total_received_amount = $total_received_amount + $response->total_received;
                                                        $total_delivery_charge = $total_delivery_charge + $totalDelCharge;
                                                        $total_total_return_cost = $total_total_return_cost + $totalRetCharge;
                                                        $total_cod_charge = $total_cod_charge + $response->total_codcharge;
                                                        $total_weight_charge = $total_weight_charge + $response->total_weight_charge;
                                                        $total_charge = $total_charge + $response->total_charge;
                                                    @endphp

                                                    <tr id="tablerow{{ $response->merchant_id }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><input type="checkbox" name="summe_code[]" id="summe_code"
                                                                value="{{ $response->merchant_id }}" /></td>

                                                        <td class="text-nowrap">
                                                            <a href="{{ route('invoicegenerate.edit', $response->merchant_id) }}"
                                                                target="_blank"><i class="fa fa-edit"></i></a>
                                                        </td>
                                                        <td>{{ @$response->merchant->business->name }}</td>
                                                        <td>{{ @$response->merchant ? $response->merchant->code : '' }}
                                                        </td>
                                                        <td>{{ $response->total_order }}
                                                            <input type="hidden"
                                                                id="total_order{{ $response->merchant_id }}"
                                                                value="{{ $response->total_order }}">
                                                        </td>
                                                        <td>{{ $response->total_received }}
                                                            <input type="hidden"
                                                                id="total_received{{ $response->merchant_id }}"
                                                                value="{{ $response->total_received }}">
                                                        </td>
                                                        <td>{{ $totalDelCharge }}
                                                            <input type="hidden"
                                                                id="total_deliverycharge{{ $response->merchant_id }}"
                                                                value="{{ $totalDelCharge }}">
                                                        </td>
                                                        <td>{{ $totalRetCharge }}
                                                            <input type="hidden"
                                                                id="total_returncharge{{ $response->merchant_id }}"
                                                                value="{{ $totalRetCharge }}">
                                                        </td>
                                                        <td>{{ $response->total_codcharge }}
                                                            <input type="hidden"
                                                                id="total_codcharge{{ $response->merchant_id }}"
                                                                value="{{ $response->total_codcharge }}">
                                                        </td>
                                                        <td>{{ $response->total_weight_charge }}
                                                            <input type="hidden"
                                                                id="total_weight_charge{{ $response->merchant_id }}"
                                                                value="{{ $response->total_weight_charge }}">
                                                        </td>
                                                        <td>{{ $response->total_charge }}
                                                            <input type="hidden"
                                                                id="total_charge{{ $response->merchant_id }}"
                                                                value="{{ $response->total_charge }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>

                                        <tr style="background: #c7c7c7; font-weight: bold">
                                            <td align="right" colspan="6">Total</td>
                                            <td align="center">{{ \Utility::number($total_received_amount) }}</td>
                                            <td align="center">{{ \Utility::number($total_delivery_charge) }}</td>
                                            <td align="center">{{ \Utility::number($total_total_return_cost) }}</td>
                                            <td align="center">{{ \Utility::number($total_cod_charge) }}</td>
                                            <td align="center">{{ \Utility::number($total_weight_charge) }}</td>
                                            <td align="center">{{ \Utility::number($total_charge) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('page-script')
@endsection
