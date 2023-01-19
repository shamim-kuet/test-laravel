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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                    	 <ol class="breadcrumb float-sm-right">

                                            <li style="margin: 2px;">
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'delivery']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'delivery']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>

                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'delivery']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'delivery']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('invoicegenerate.list') }}"><i data-feather='eye'></i> Generated Invoice</a></li>

                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <form id="form_check" method="POST" action="{{ route('invoicegenerate.save') }}">
                                @csrf
                                <input type="submit" class="btn btn-success btn-sm" value="Generate Invoice">

                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered common-datatables">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly"/></th>

                                            <th>Merchant Name</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Merchant Order Id</th>
                                            <th>Consignment Id</th>
                                            <th>Received Amount</th>
                                            <th>Delivery Charge</th>
                                            <th>Return Charge</th>
                                            <th>COD Charge</th>
                                            <th>Weight Charge</th>
                                            <th>Status</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($getResponse!="")
                                        @php $i=0; @endphp
                                            @foreach($getResponse as $response)

                                            <tr id="tablerow{{ $response->merchant_id  }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="{{ $response->id }}"/></td>


                                                <td>{{ @$response->merchant->business->name }}</td>
                                                <td>{{ @$response->order->customer_name }}</td>
                                                <td>{{ @$response->order->customer_mobile }}</td>
                                                <td>{{ @$response->order->merchant_order_id }}</td>
                                                <td>{{ @$response->order->consignment_id }}</td>

                                                <td>{{ $response->received_amount }}</td>
                                                <td>{{ $response->delivery_charge }}</td>
                                                <td>{{ $response->total_return_cost }}</td>
                                                <td>{{ $response->cod_charge }}</td>
                                                <td>{{ $response->weight_charge }}</td>
                                                <td>
                                                    <button class="btn btn-xs" style="background: {{ @$response->deliver_status->color }};">{{ @$response->deliver_status->name }}</button>
                                                </td>



                                            </tr>
                                            @endforeach
                                        @endif

                                        </tbody>

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

