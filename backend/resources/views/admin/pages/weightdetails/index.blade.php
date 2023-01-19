@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Weight Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">WeightDetails</li>
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
                            <div class="col-sm-10 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                    	 <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'plan']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'plan']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            {{-- <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Plan','plan')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li> --}}
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'plan']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'plan']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('weight_details.index') }}"><i data-feather='eye'></i> View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('weight_details.create') }}"><i data-feather='plus'></i> Create</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->

                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered common-datatables">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly"/></th>
                                        <th>Action</th>
                                        <th>Plan Type</th>
                                        <th>Increment Value</th>
                                        <th>Unit Kg</th>
                                        <th>After Weight</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($getResponse!="")
                                        @foreach($getResponse as $response)
                                        <tr id="tablerow{{ $response->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><input type="checkbox"  name="summe_code[]" id="summe_code" value="{{ $response->id }}"/></td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('weight_details.edit',$response->id) }}"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="#" onclick="singleDelete({{ $response->id }},'plans');"><i data-feather='trash-2'></i></a> --}}
                                            </td>
                                            <td><a href="#">{{ $response->plan_type }}</a></td>
                                            <td>{{ $response->increment_value }}</td>
                                            <td>
                                               {{$response->unit}}
                                            </td>

                                            <td>{{ $response->after_weight }}</td>
                                            <td>
                                                @if($response->status == '1')
                                                    <button class="btn btn-success btn-sm">Active</button>
                                                @elseif($response->status == '0')
                                                    <button class="btn btn-warning btn-sm">Inactive</button>
                                                @endif
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
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--/ Advanced Search -->


@endsection
@section('page-script')
@endsection

