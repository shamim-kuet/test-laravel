@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Edit: {{ $pickup->consignment_id }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pickup.index') }}">Pickup</a></li>
                                <li class="breadcrumb-item active">Edit Pickup</li>
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
                        <form action="{{ route('pickup.update', $pickup->id) }}" method="POST"
                            enctype="multipart/form-data" id="thisform">
                            @csrf
                            <input type="hidden" name="assign_pickup_id" value="{{ $pickup->id }}">
                            <input type="hidden" name="order_id" value="{{ $pickup->order_id }}">


                            <div class="card-header border-bottom">

                                <div class="col-sm-12 mt-1">
                                    <div class="row">

                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="20%">Consignment ID</td>
                                                <td width="20%">{{ $pickup->consignment_id }}</td>
                                                <td width="20%" align="right">Merchant Name</td>
                                                <td width="20%" align="left">{{ $pickup->merchant->name }}</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Pickup Date</td>
                                                <td width="20%">{{ $pickup->pickup_date }}</td>
                                                <td width="20%" align="right">Hub Name</td>
                                                <td width="20%" align="left">{{ $pickup->hub ? $pickup->hub->name : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Status</td>
                                                <td width="20%">{{ $pickup->status }}</td>
                                                <td width="20%" align="right">Assigned Rider</td>
                                                <td width="20%" align="left">{{ $pickup->rider->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="col-sm-12">
                                {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm" style="float: right; margin-top:20px;" onclick="partialPickup();">Change Status</a> --}}
                                <button type="submit" class="btn btn-success" style="float: right; margin-top:15px;">Change Status</button>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered common-datatables">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                {{-- <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" id="checkAll"/></th> --}}

                                                <th>Product Name</th>
                                                <th>Sub Title</th>
                                                <th>SKU</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($pickup != '')
                                                @foreach ($pickup->order->orderproduct as $response)
                                                    <tr>
                                                        <td>{{ $response->product->id }}
                                                            <input type="hidden" name="productid[]"
                                                                value="{{ $response->product->id }}" />
                                                        </td>
                                                        {{-- <td><input type="checkbox"  name="productid[]"
                                                    id="productid" value="{{ $response->product->id }}"/></td> --}}

                                                        <td><a href="#">{{ $response->product->name }}</a></td>
                                                        <td>{{ $response->product->subtitle }}</td>
                                                        <td>{{ $response->product->sku }}</td>
                                                        <td align="center" style="text-align: center"><input type="number"
                                                                name="quantity[]" class="form-control" style="width: 50%;"
                                                                value="{{ $response->quantity }}"></td>
                                                        <td>{{ \Utility::number($response->product->price) }}</td>
                                                        <td>
                                                            <select name="status[]" class="form-control"
                                                                onchange="getStatusCount(this.value)">
                                                                @if ($response->product->pickup_details)

                                                                <option value="{{ $response->product->pickup_details->status }}">
                                                                    {{ $response->product->pickup_details->status }}</option>
                                                                    @endif
                                                                <option value="Picked">Picked</option>
                                                                <option value="Unpicked">Unpicked</option>
                                                            </select>
                                                        </td>
                                                        <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                                        <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
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
        //  let getStatusCount = function(value){

        //     let totalpicked = $("#totalpicked");
        //     let totalunpicked = $("#totalunpicked");
        //     if(value=='Picked'){
        //         totalpicked.val(1);
        //     }
        //     else if(value=='Unicked'){
        //         totalunpicked.val(1);
        //     }
        //  }
    </script>
@endsection
