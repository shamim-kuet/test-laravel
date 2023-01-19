@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Order</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">Order</li>
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
                                                <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="invoiceGenerate()">Generate Invoice</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'delivery']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'delivery']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Order','delivery')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'delivery']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'delivery']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('invoicegenerate.index') }}"><i data-feather='eye'></i> Generated Invoice</a></li>

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
                                <div class="row">
                                    <div class="col-12" s style="margin:0; padding:0">
                                        <div class="form-row mb-1">

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
                                                <input type="date"  class="form-control" name="formdate" id="fromdate" />
                                            </div>
                                            <div class="col-lg-3">
                                                <label>To Date</label>
                                                <input type="date"  class="form-control" name="todate" id="todate" />
                                            </div>
                                            <div class="col-lg-2" style="margin-top:22px;">
                                                <input type="submit"  class="btn btn-success btn-sm" name="submit" value="Search"/>
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
                                    <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly"/></th>
                                    <th>Consaignment ID</th>
                                    <th>Merchant Order ID</th>
                                    <th>Rider</th>
                                    <th>Delivery Date</th>
                                    <th>Payable amount</th>
                                    <th>Collected amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($getResponse!="")
                                    @foreach($getResponse as $response)
                                    <tr id="tablerow{{ $response->id }}">
                                        <td>1</td>
                                        <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="{{ $response->id }}"/></td>

                                        <td>{{ $response->order->consignment_id }}</td>
                                        <td>{{ $response->order->merchant_order_id }}</td>
                                        <td>{{ $response->rider->name }}</td>
                                        <td>{{ $response->delivery_date }}</td>
                                        <td>{{ $response->payable_amount }}</td>
                                        <td>{{ $response->collected_amount }}</td>
                                        <td>
                                        @php
                                            if($response->status!="" && $response->status=='Paid'){
                                            	$stsClass = 'success';
                                            }
                                            elseif($response->status!="" && $response->status=='Unpaid'){
                                            	$stsClass = 'danger';
                                            }
                                            else{
                                            	$stsClass = 'warning';
                                            }
                                        @endphp
                                        <button class="btn btn-xs btn-{{ $stsClass }}">{{ $response->status }}</button>
                                        </td>
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
@endsection
@section('page-script')
@endsection

