@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Rider Report</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">All Rider Report</li>
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
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'rider_report','requestdata'=> Request::except('_token','csrf-token','submit')]) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'rider_report','requestdata'=> Request::except('_token','csrf-token','submit')]) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            {{-- <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Order','delivery')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li> --}}
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'riderReport-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'riderReport-filter','method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit')]) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="{{ route('rider_report') }}">
                                                <i data-feather='eye'></i> View</a>
                                            </li>

                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('rider_report.filter') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12" s style="margin:0; padding:0">
                                        <div class="form-row mb-1">

                                            {{-- <div class="col-lg-3">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="formdate" id="formdate" />
                                            </div>
                                            <div class="col-lg-3">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" name="todate" id="todate" />
                                            </div> --}}

                                            <div class="col-lg-2" style="margin:0; padding:0 3px">
                                                <label>Select Rider</label>
                                                <select class="form-control" name="rider_id" id="rider_id">
                                                    <option value="">Select Rider</option>
                                                    @foreach ($riders as $rider)
                                                        <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                <th>Rider Name</th>
                                                <th>Received Amount</th>
                                                <th>Delivery Charge</th>
                                                <th>Return Charge</th>
                                                <th>COD Charge</th>
                                                <th>Weight Charge</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $totalReceived = 0;
                                            $totalDeliveryCharge = 0;
                                            $totalReturnCharge = 0;
                                            $totalCodCharge = 0;
                                            $totalWeightCharge = 0;
                                        @endphp

                                        <tbody>
                                        @if($getResponse!="")
                                            @foreach($getResponse as $response)

                                            @php
                                                $totalReceived = $totalReceived + $response->total_received;
                                                $totalDeliveryCharge = $totalDeliveryCharge + $response->total_deliverycharge;
                                                $totalReturnCharge = $totalReturnCharge + $response->total_returncharge;
                                                $totalCodCharge = $totalCodCharge + $response->total_codcharge;
                                                $totalWeightCharge = $totalWeightCharge + $response->total_weight_charge;
                                            @endphp

                                            <tr id="tablerow{{ $response->rider_id }}">
                                                <td>{{ $loop->iteration  }}</td>
                                                <td>{{ @$response->rider->name }}</td>
                                                <td>{{ @$response->total_received}}</td>
                                                <td>{{ @$response->total_deliverycharge}}</td>
                                                <td>{{ @$response->total_returncharge}}</td>
                                                <td>{{ @$response->total_codcharge}}</td>
                                                <td>{{ @$response->total_weight_charge}}</td>
                                            </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                        <tr style="background: #c7c7c7; font-weight: bold">
                                            <td align="right" colspan="2">Total</td>
                                            <td align="center">{{ \Utility::number($totalReceived) }}</td>
                                            <td align="center">{{ \Utility::number($totalDeliveryCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalReturnCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalCodCharge) }}</td>
                                            <td align="center">{{ \Utility::number($totalWeightCharge) }}</td>
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

