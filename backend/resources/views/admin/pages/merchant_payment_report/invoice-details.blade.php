@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Merchant Payment</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">Report All Details</li>
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
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                    	 <ol class="breadcrumb float-sm-right">

                                         <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'merchantpayment_report_allDetails', 'requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'merchantpayment_report_allDetails','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'merchantpaymentreportdetails-filter', 'method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'merchantpaymentreportdetails-filter', 'method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>

                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('merchantpaymentreportdetails.filter') }}">
                                @csrf
                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12" s style="margin:0; padding:0">
                                        <div class="form-row mb-1">
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

                                            <div class="col-lg-2">
                                                <label>Hub:</label>
                                                <select class="form-control" name="hub_id" id="hub_id">
                                                    <option value="">Select</option>
                                                    @foreach ($hubs as $hub)
                                                        <option value="{{ $hub->id }}">
                                                            {{ @$hub->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="formdate" id="formdate" />
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
                                            <th>Consignment Id</th>
                                            <th>Hub Name</th>
                                            <th>Merchant Name</th>
                                            <th>Merchant Code</th>
                                            <th>Collectable Amount</th>
                                            <th>Delivery Charge</th>
                                            <th>COD Charge</th>
                                            <th>Weight Charge</th>
                                            <th>Return Charge</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                        </tr>
                                        </thead>

                                        @php
                                            $totalCollectableAmount = 0;
                                            $totalDeliveryCharge = 0;
                                            $totalCodCharge = 0;
                                            $totalWeightCharge = 0;
                                            $totalReturnCost = 0;
                                        @endphp

                                        <tbody>
                                        @if($getResponse!="")
                                            @foreach($getResponse as $response)

                                            @php
                                                $totalCollectableAmount = $totalCollectableAmount + $response->order->collectable_amount;
                                                $totalDeliveryCharge = $totalDeliveryCharge + $response->order->delivery_charge;
                                                $totalCodCharge = $totalCodCharge + $response->order->cod_charge;
                                                $totalWeightCharge = $totalWeightCharge + $response->order->weight_charge;
                                                $totalReturnCost = $totalReturnCost + $response->order->total_return_cost;
                                            @endphp

                                            <tr id="tablerow{{ $response->id }}">
                                                <td>{{ $loop->iteration  }}</td>
                                                <td>{{@$response->order->consignment_id}}</td>
                                                <td>{{ @$response->merchant->hub->name }}</td>
                                                <td>{{ @$response->merchant->business->name }}</td>
                                                <td>{{ @$response->merchant->code }}</td>
                                                <td>{{@$response->order->collectable_amount}}</td>
                                                <td>{{@$response->order->delivery_charge}}</td>
                                                <td>{{@$response->order->cod_charge}}</td>
                                                <td>{{@$response->order->weight_charge}}</td>
                                                <td>{{@$response->order->total_return_cost}}</td>

                                                <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                                <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tr style="background: #c7c7c7; font-weight: bold">
                                            <td align="right" colspan="5">Total</td>
                                            <td align="center">{{ \Utility::number($totalCollectableAmount) }}</td>
                                            <td align="center">{{ \Utility::number($totalDeliveryCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalCodCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalWeightCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalReturnCost) }}</td>
                                            <td align="right" colspan="2"></td>
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
    <!--/ Advanced Search -->

<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">

    </div>
</div>

@endsection
@section('page-script')
@endsection

