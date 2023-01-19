@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Manage Complaints</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Complaints</li>
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
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'complaint']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'complaint']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            {{-- <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Store','complaint')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li> --}}
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'complaint']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'complaint']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('complaint.index') }}"><i data-feather='eye'></i> View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('complaint.create') }}"><i data-feather='plus'></i> Create</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('complaint.filter') }}">
                            @csrf
                            <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-2">
                                                <label>Purpose/Message:</label>
                                                <input type="text"  class="form-control" name="keyword" id="keyword" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Status:</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            {{-- <div class="col-lg-2">
                                                <label>From Date</label>
                                                <input type="date"  class="form-control" name="formdate" id="fromdate" />
                                            </div>
                                            <div class="col-lg-2">
                                                <label>To Date</label>
                                                <input type="date"  class="form-control" name="todate" id="todate" />
                                            </div> --}}
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered common-datatables">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Action</th>
                                        <th>Merchant Name</th>
                                        <th>Rider Name</th>
                                        <th>Purpose</th>
                                        <th>Message</th>
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
                                            <td class="text-nowrap">
                                                    <a href="{{ route('complaint.edit',$response->id) }}"><i class="fa fa-edit"></i></a>
                                                    <a href="#" onclick="singleDelete({{ $response->id }},'complaints');"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <td>{{ @$response->merchant->business->name }}</td>
                                            <td>{{ @$response->rider->name }}</td>
                                            <td>{{ $response->purpose }}</td>
                                            <td>{{ $response->message }}</td>
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

