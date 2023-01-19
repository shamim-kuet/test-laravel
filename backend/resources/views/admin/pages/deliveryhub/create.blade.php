@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Assign Delivery Hub</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('delivery.index') }}">Delivery</a></li>
                                <li class="breadcrumb-item active">Assign Delivery Hub</li>
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
                        <form action="{{ route('deliveryhub.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header border-bottom">

                                <div class="col-sm-12 mt-1">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                                    class="fas fa-arrow-circle-left"></i> Back</a>
                                        </div>

                                        <div class="col-lg-2" style="margin:0; padding:0 3px">
                                            <label>Select Hub</label>
                                            <select class="form-control" name="rider_id" id="rider_id">
                                                <option value="">Select Hub</option>
                                                @foreach ($riders as $rider)
                                                    <option value="{{ $rider->hub_admin_id }}">{{ $rider->name }}</option>
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
                                                value="Assign Delivery hub" />
                                        </div>

                                        {{-- <div class="col-sm-2" style="margin:0; padding:0">
                                            <a class="btn btn-primary btn-sm float-sm-right" href="{{ route('deliveryhub.index') }}"><i data-feather='eye'></i> Assigned List</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="col-sm-12">
                                <table class="table table-striped table-responsive table-bordered common-datatables">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th><input name="checkbox" onclick='checkedAll();' type="checkbox"
                                                    readonly="readonly" id="checkAll" /></th>
                                            {{-- <th>Action</th> --}}
                                            <th>Consignment ID</th>
                                            <th>Merchant Name</th>
                                            <th>Recipient Name</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Merchant Order ID</th>
                                            <th>Amount to be collect</th>
                                            <th>Delivery charge</th>
                                            <th>Return Charge</th>
                                            <th>COD Charge</th>
                                            <th>Weight Charge</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($getResponse != '')
                                            @foreach ($getResponse as $response)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><input type="checkbox" name="orderid[]" id="summe_code"
                                                            value="{{ $response->order_id }}" /></td>
                                                    {{-- <td class="text-nowrap"> --}}
                                                        {{-- <a href="{{ route('order.show',$response->id) }}"><i data-feather='eye'></i></a>
                                                        <a href="{{ route('order.edit',$response->id) }}"><i data-feather='edit'></i></a> --}}
                                                        {{-- <a href="#"
                                                            onclick="singleDelete({{ $response->id }},'order');"><i
                                                                data-feather='trash-2'></i></a>

                                                        @if (session()->get('role_id') == 34 || \Utility::checkPermission('pickup.edit'))
                                                            <a href="{{ route('pickup.print', $response->id) }}"
                                                                target="_blank" title="Print Invoice">
                                                                <i data-feather='printer'></i></a>
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $response->consignment_id }}</td>
                                                    <td>{{@$response->merchant->business->name }}</td>
                                                    <td>{{ @$response->order->customer_name }}</td>
                                                    <td>{{ @$response->order->district->district_name }}</td>
                                                    <td>{{ @$response->order->upozila->upozila_name }}</td>
                                                    <td>{{ @$response->order->merchant_order_id }}</td>
                                                    <td>{{ \Utility::number(@$response->order->collectable_amount) }}</td>
                                                    <td>{{ @$response->order->delivery_charge }}</td>
                                                    <td>{{ @$response->order->total_return_cost }}</td>
                                                    <td>{{ @$response->order->cod_charge }}</td>
                                                    <td>{{ @$response->order->weight_charge }}</td>
                                                    <td>
                                                        <button class="btn btn-xs"
                                                            style="background: {{ @$response->deliver_status->color }}; color: {{ @$response->deliver_status->font_color }}">{{ @$response->deliver_status->name }}</button>
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


@endsection
@section('page-script')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
