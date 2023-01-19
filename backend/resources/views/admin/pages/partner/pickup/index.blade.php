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
                                            <a class="btn btn-warning btn-sm" href="javascript:void()" onclick="permissions('assign_pickups','Unpicked');"><i data-feather='file-text'></i> Unpicked</a>
                                            </li>
                                             <li style="margin: 2px;">
                                            <a class="btn btn-success btn-sm" href="javascript:void()" onclick="permissions('assign_pickups','Picked');"><i data-feather='file-text'></i> Picked</a>
                                            </li>
                                            
                                            <li style="margin: 2px;">
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'pickup']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'pickup']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Order','pickup')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'pickup']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'pickup']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('pickup.index') }}"><i data-feather='eye'></i> View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('pickup.create') }}"><i data-feather='plus'></i> Create</a></li>
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
                                            <div class="col-lg-2">
                                                <label>Name/Email/Phone:</label>
                                                <input type="text"  class="form-control" name="keyword" id="keyword" />
                                            </div>
                                            <div class="col-lg-2">
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
                                            </div>
                                            <div class="col-lg-2">
                                                <label>From Date</label>
                                                <input type="date"  class="form-control" name="formdate" id="fromdate" />
                                            </div>
                                            <div class="col-lg-2">
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
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Merchant Name</th>
                                    <th>Rider Name</th>
                                    <th>Consaignment ID</th>
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
                                        <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="{{ $response->id }}"/></td>
                                        <td class="text-nowrap">
                                                <a href="{{ route('order.show',$response->id) }}"><i data-feather='eye'></i></a>
                                                <a href="{{ route('order.edit',$response->id) }}"><i data-feather='edit'></i></a>
                                                 <a href="#" onclick="singleDelete({{ $response->id }},'order');"><i data-feather='trash-2'></i></a>
                                        </td>
                                        <td>{{ $response->id }}</td>
                                        <td><a href="#">{{ $response->merchant->name }}</a></td>
                                        <td>{{ $response->rider->name }}</td>
                                        <td>{{ $response->consignment_id }}</td>
                                        <td>
                                        @php
                                            if($response->status!="" && $response->status=='Picked'){
                                            	$stsClass = 'success';
                                            }
                                            elseif($response->status!="" && $response->status=='Unpicked'){
                                            	$stsClass = 'danger';
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

