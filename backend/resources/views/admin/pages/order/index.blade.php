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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right" style="padding:0">

                                            @foreach ($status as $a)
                                                @if ($a->id == 11)
                                                    <li style="margin: 2px;">
                                                        <a class="btn btn-sm" style="background: {{$a->color}}; color: {{$a->font_color}}" href="javascript:void()"
                                                            onclick="permissions('orders','{{ $a->id }}');"><i
                                                                data-feather='file-text'></i> {{ $a->name }}</a>
                                                    </li>
                                                @endif
                                                @if ($a->id == 25)
                                                    <li style="margin: 2px;">
                                                        <a class="btn btn-sm" style="background: {{$a->color}}; color: {{$a->font_color}}" href="javascript:void()"
                                                            onclick="permissions('orders','{{ $a->id }}');"><i
                                                                data-feather='file-text'></i> {{ $a->name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'order','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'order','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    onclick="showModal(' for Order','order')">
                                                    <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'order-filter', 'method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'order-filter', 'method'=>'POST','requestdata'=> Request::except('_token','csrf-token','submit') ]) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>

                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                href="{{ route('order.index') }}"><i data-feather='eye'></i>
                                                View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                    href="{{ route('order.create') }}"><i data-feather='plus'></i>
                                                    Create</a></li>
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
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-3">
                                                <label>Number/Order ID/Amount/Charge:</label>
                                                <input type="text" class="form-control" name="keyword" id="keyword" />
                                            </div>


                                            {{-- <div class="col-lg-2">
                                                <label>Merchant:</label>
                                                <select class="form-control" name="merchant_id" id="merchant_id">
                                                    <option value="">Select</option>
                                                    @foreach ($merchants as $merchant)
                                                        <option value="{{ $merchant->id }}">
                                                            {{ @$merchant->business->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            {{-- <div class="col-lg-2">
                                                <label>Is Ready:</label>
                                                <select class="form-control" name="isready" id="isready">
                                                    <option value="">Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Status:</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div> --}}
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
                                            <th>Consignment ID</th>
                                            <th>Merchant Name</th>
                                            <th>Store Name</th>
                                            <th>Recipient Name</th>
                                            <th>Recipient Number</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Merchant Order ID</th>
                                            <th>Amount to be collect</th>
                                            <th>Delivery Charge</th>
                                            <th>Return Charge</th>
                                            <th>COD Charge</th>
                                            <th>Weight Charge</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($getResponse != '')
                                            @foreach ($getResponse as $response)
                                            <tr id="tablerow{{ $response->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if (@$response->status==25)
                                                        <input type="checkbox" name="summe_code[]" id="summe_code"
                                                        value="{{ $response->id }}" />
                                                        @endif

                                                    </td>
                                                    <td class="text-nowrap">
                                                    @if (@$response->status==25)
                                                        {{-- @if ((session()->get('role_id') == 34) || \Utility::checkPermission('order.show'))
                                                            <a href="{{ route('order.show', $response->id) }}"><i
                                                                    class="fa fa-eye"></i></a>
                                                        @endif --}}
                                                        @if ((session()->get('role_id') == 34) || \Utility::checkPermission('order.edit'))
                                                            <a href="{{ route('order.edit', $response->id) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        @endif
                                                        {{-- @if ((session()->get('role_id') == 34) || \Utility::checkPermission('order.destroy'))
                                                            <a href="#"
                                                                onclick="singleDelete({{ $response->id }},'orders');"><i
                                                                    class="fa fa-trash"></i></a>
                                                        @endif --}}
                                                        @endif
                                                    </td>
                                                    <td>{{$response->consignment_id}}</td>
                                                    <td><a href="#">{{@$response->merchant->business->name }}</a></td>
                                                    <td>{{ @$response->store->name }}</td>
                                                    <td><a href="#">{{ @$response->customer_name }}</a></td>
                                                    <td>{{ @$response->customer_mobile }}</td>
                                                    <td>{{ @$response->district->district_name }}</td>
                                                    <td>{{ @$response->upozila->upozila_name }}</td>
                                                    <td>{{ $response->merchant_order_id }}</td>
                                                    <td>{{ $response->collectable_amount }}</td>
                                                    <td>{{ $response->delivery_charge }}</td>
                                                    <td>{{ $response->total_return_cost }}</td>
                                                    {{-- <td>
                                                        {{ $codcharge ? $codcharge->percentage*$response->collectable_amount/100 : '' }}
                                                    </td> --}}
                                                    <td>{{ $response->cod_charge }}</td>
                                                    <td>{{ $response->weight_charge }}</td>
                                                    <td>
                                                        <button class="btn btn-xs" style="background: {{ @$response->deliver_status->color }}; color: {{ @$response->deliver_status->font_color }}">{{ @$response->deliver_status->name }}</button>
                                                    </td>
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


@endsection
@section('page-script')
@endsection
