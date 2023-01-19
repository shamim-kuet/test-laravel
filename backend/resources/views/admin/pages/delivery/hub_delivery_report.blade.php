@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Report</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Hub Delivery Report</li>
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
                            <a href="{{ route("rider.delivery.report") }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'hubDeliveryReport','requestdata'=> Request::except('_token','csrf-token','submit')]) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'hubDeliveryReport','requestdata'=> Request::except('_token','csrf-token','submit')]) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>

                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'hubDeliveryReport-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'hubDeliveryReport-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route("rider.delivery.report") }}"><i data-feather='eye'></i>
                                                    View</a></li>

                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('hub_delivery_report.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-2">
                                                <label>Consignment ID:</label>
                                                <input type="text" class="form-control" name="consignment_id"
                                                    id="keyword" />
                                            </div>

                                            <div class="col-lg-2">
                                                <label>Rider:</label>
                                                <select class="form-control" name="rider_id" id="rider_id">
                                                    <option value="">Select</option>
                                                    @foreach ($riders as $rider)
                                                        <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Select status:</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($status as $a)
                                                    @if ($a->type=="delivery"&&($a->id==17||$a->id==32))
                                                    <option value="{{ $a->id }}">{{ $a->name }}
                                                    </option>
                                                    @endif

                                                    @endforeach
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered common-datatables">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Consaignment ID</th>
                                            <th>Merchant Name</th>
                                            <th>Rider Name</th>
                                            <th>Recipient</th>
                                            <th>Merchant Order ID</th>
                                            <th>Collected</th>
                                            <th>Delivery Charge</th>
                                            <th>Return Charge</th>
                                            <th>COD Charge</th>
                                            <th>Weight Charge</th>
                                            <th>Total Charge</th>
                                            <th>Status</th>
                                            <th>Assigned Date</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $totalReceivedAmount = 0;
                                        $totalDeliveryCharge = 0;
                                        $totalReturnCost = 0;
                                        $totalCodCharge = 0;
                                        $totalWeightCharge = 0;
                                        $totalCharge = 0;
                                    @endphp

                                    <tbody>
                                        @if ($getResponse != '')
                                            @foreach ($getResponse as $response)
                                                @php
                                                    $totalReceivedAmount = $totalReceivedAmount + $response->received_amount;
                                                    $totalDeliveryCharge = $totalDeliveryCharge + $response->delivery_charge;
                                                    $totalReturnCost = $totalReturnCost + $response->total_return_cost;
                                                    $totalCodCharge = $totalCodCharge + $response->cod_charge;
                                                    $totalWeightCharge = $totalWeightCharge + $response->weight_charge;
                                                    $totalCharge = $totalCharge + $response->total_charge;
                                                @endphp


                                                <tr id="tablerow{{ $response->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $response->order->consignment_id }}</td>
                                                    <td>
                                                        <a href="#">{{ @$response->merchant->business->name }}</a>
                                                    </td>
                                                    <td>{{ @$response->rider->name }}</td>
                                                    <td>{!! @$response->order->customer_name.'</br>'.@$response->order->customer_mobile !!}</td>
                                                    <td>{{ @$response->order->merchant_order_id }}</td>
                                                    <td>{{ @$response->received_amount }}</td>
                                                    <td>{{ @$response->delivery_charge }}</td>
                                                    <td>{{ @$response->total_return_cost }}</td>
                                                    <td>{{ @$response->cod_charge }}</td>
                                                    <td>{{ @$response->weight_charge }}</td>
                                                    <td>{{ @$response->total_charge }}</td>
                                                    <td>
                                                        <button class="btn btn-xs"
                                                            style="background: {{ @$response->deliver_status->color }}; color: {{ @$response->deliver_status->font_color }}">{{ @$response->deliver_status->name }}</button>
                                                    </td>
                                                    <td>{{ \Utility::commonDateFormate($response->assign_date) }}</td>
                                                    <td>{{ \Utility::commonDateFormate($response->delivery_date) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                    <tr style="background: #c7c7c7; font-weight: bold">
                                        <td align="right" colspan="6">Total</td>
                                        <td align="center">{{ \Utility::number($totalReceivedAmount) }}</td>
                                        <td align="center">{{ \Utility::number($totalDeliveryCharge) }}</td>
                                        <td align="center">{{ \Utility::number($totalReturnCost) }}</td>
                                        <td align="center">{{ \Utility::number($totalCodCharge) }}</td>
                                        <td align="center">{{ \Utility::number($totalWeightCharge) }}</td>
                                        <td align="center">{{ \Utility::number($totalCharge) }}</td>
                                        <td align="right" colspan="3"></td>
                                    </tr>
                                </table>
                            </div>
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
