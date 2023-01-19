@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Assign Pickup</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('pickup.index')}}">Pickup</a></li>
                                <li class="breadcrumb-item active">Assign Pickup</li>
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
                    	<form action="{{ route('pickup.store') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                            <div class="card-header border-bottom">
                                
                                <div class="col-sm-12 mt-1">
                                    <div class="row">
                                         <div class="col-lg-3">
                                         <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a></div>
                                         
                                         <div class="col-lg-3">
                                            <select class="form-control" name="rider_id" id="rider_id">
                                                <option value="">Select Rider</option>
                                                @foreach($riders as $rider)
                                                    <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="submit"  class="btn btn-success btn-sm" name="submit" value="Assign Pickup"/>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <a class="btn btn-primary btn-sm float-sm-right" href="{{ route('order.index') }}"><i data-feather='eye'></i> View Assigned List</a>                                        
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="col-sm-12">
                                <table class="table table-striped table-responsive table-bordered common-datatables">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" id="checkAll"/></th>
                                        <th>Action</th>
                                        <th>Merchant Name</th>
                                        <th>Store Name</th>
                                        <th>Merchant Order ID</th>
                                        <th>Amount to be collect</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($getResponse!="")
                                        @foreach($getResponse as $response)
                                            <tr>
                                            <td>1</td>
                                            <td><input type="checkbox"  name="orderid[]" id="summe_code" value="{{ $response->id }}"/></td>
                                            <td class="text-nowrap">
                                                    <a href="{{ route('order.show',$response->id) }}"><i data-feather='eye'></i></a>
                                                    <a href="{{ route('order.edit',$response->id) }}"><i data-feather='edit'></i></a>
                                                     <a href="#" onclick="singleDelete({{ $response->id }},'order');"><i data-feather='trash-2'></i></a>
                                            </td>
                                            <td><a href="#">{{ $response->merchant->name }}</a></td>
                                            <td>{{ $response->store->name }}</td>
                                            <td>{{ $response->merchant_order_id }}</td>
                                            <td>{{ \Utility::number($response->collectable_amount) }}</td> 
                                            <td>
                                                @php
                                                    if($response->status!="" && $response->status=='Accepted'){
                                                        $stsClass = 'success';
                                                    }
                                                    else{
                                                        $stsClass = 'warning';
                                                    }
                                                @endphp
                                            <button class="btn btn-xs btn-{{ $stsClass }}">{{ $response->status }}</button>
                                        	</td>
                                            <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                            <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
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
     $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
	
	
</script>
@endsection

