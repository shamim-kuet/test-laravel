@extends('admin.layouts.master')
@section('content')



    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Assign Delivery</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Asssigned List</li>
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
                                    class="fas fa-arrow-circle-left"></i>  Back</a>
                            <div class="col-sm-11 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">

                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'delivery']) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'delivery']) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            {{-- <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    onclick="showModal(' for Order','delivery')">
                                                    <i data-feather='upload'></i> Import</a>
                                            </li> --}}
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'delivery']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'delivery']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                href="{{ route('delivery.index') }}"><i data-feather='eye'></i>
                                                View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                    href="{{ route('delivery.create') }}"><i data-feather='plus'></i>
                                                    Create</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                                <div class="row">
                                    <form class="dt_adv_search" method="POST" action="{{ route('delivery.filter') }}">
                                        @csrf
                                        <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                        <div class="col-12" s style="margin:0; padding:0">
                                            <div class="form-row mb-1">
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
                                                    <label>Status:</label>
                                                    <select name="statusfilter" id="statusfilter" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach ($status as $s)
                                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
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
                                    </form>



                                    <form class="dt_adv_search" method="POST" action="{{ route('order.filter') }}">
                                        @csrf
                                        <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Order Status</label>
                                                    <select name="status" id="changestatus" class="form-control">
                                                        @foreach ($status as $s)
                                                            @if ($s->type == 'delivery')
                                                                <option value="{{ $s->id }}">{{ $s->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>&nbsp;</label>
                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm"
                                                        onclick="statusChanges('common/changestatus');">Change Status</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                        </div>
                        <hr class="my-0" />
                        <form action="{{ route('delivery.reassign') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header border-bottom">

                                <div class="col-sm-12 mt-1">
                                    <div class="row">


                                        <div class="col-lg-2" style="margin:0; padding:0 3px">
                                            <label>Select Rider</label>
                                            <select class="form-control" name="rider_id" id="rider_id" required>
                                                <option value="">Select Rider</option>
                                                @foreach ($riders as $rider)
                                                    <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2" style="margin:0; padding:0 3px">
                                            <label>Assign date</label>
                                            <input type="date" class="form-control" name="assign_date"
                                                value="{{ date('Y-m-d') }}" />
                                        </div>
                                        <div class="col-lg-2" style="margin:0; padding:0 3px">
                                            <label>Delivery date</label>
                                            <input type="date" class="form-control" name="delivery_date"
                                                value="{{ date('Y-m-d', strtotime('+7 day')) }}" />
                                        </div>

                                        <div class="col-lg-2">
                                            <label>&nbsp;</label>
                                            <input type="submit" class="btn btn-success btn-sm" name="submit"
                                                value="Reassign Delivery" />
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-responsive table-bordered common-datatables">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" id="checkAll" /></th>
                                            <th>Consaignment ID</th>
                                            <th>Recipient Name</th>
                                            <th>Recipient Phone</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Merchant Name</th>
                                            <th>Rider Name</th>
                                            <th>Merchant ID</th>
                                            <th>Amount to be collect</th>
                                            <th>Received amount</th>
                                            <th>Delivery Charge</th>
                                            <th>Return Charge</th>
                                            <th>COD</th>
                                            <th>Weight Charge</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($getResponse != '')
                                            @foreach ($getResponse as $response)
                                            <tr id="tablerow{{ $response->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if(!$response->invoice)
                                                        <input type="checkbox" name="deliveryid[]" id="summe_code" value="{{ $response->id }}" />
                                                    @endif
                                                </td>

                                                <td>{{ @$response->order->consignment_id }}</td>
                                                <td>{{ @$response->order->customer_name }}</td>
                                                <td>{{ @$response->order->customer_mobile }}</td>
                                                <td>{{ @$response->order->district->district_name }}</td>
                                                <td>{{ @$response->order->upozila->upozila_name }}</td>
                                                <td>{{ @$response->merchant->business->name }}</td>
                                                <td>{{ @$response->rider->name }}</td>
                                                <td>{{ @$response->order->merchant_order_id }}</td>
                                                <td>{{ @$response->collectable_amount }}</td>
                                                <td>{{ $response->received_amount }}</td>
                                                <td>{{ @$response->delivery_charge }}</td>
                                                <td>{{ @$response->total_return_cost }}</td>
                                                <td>{{ @$response->cod_charge}}</td>
                                                <td>{{ @$response->weight_charge}}</td>
                                                <td>
                                                    <button class="btn btn-xs" style="background: {{ @$response->deliver_status->color }};  color: {{ @$response->deliver_status->font_color }}">
                                                    {{ @$response->deliver_status->name }}
                                                </button>
                                                </td>
                                                <td>
                                                    @if($response->invoice)
                                                        <span style="color:green">Invoice Created</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                                <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
                                                <td>{{ $response->note }}</td>
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
        </section>
    </section>
    <!--/ Advanced Search -->



    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">

        </div>
    </div>

@endsection
@section('page-script')
    <script>

        // function changeReturnCharge(status){
        //     if(status==17){
        //         var returnVal  = $("#returndata").val(status);
        //         alert(status);
        //         // $("#returnCharge" + orderId).val(0);
        //     }
        //     else{
        //        // document.getElementById("return_label" + orderId).innerHTML = 0;
        //         // $("#returnCharge" + orderId).val(10);
        //     }
        // }


        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>


@endsection
