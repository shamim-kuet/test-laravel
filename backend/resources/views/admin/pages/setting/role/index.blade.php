@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Role</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active">Role Manage</li>
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
                                            <a class="btn btn-info btn-sm" href="{{ route('common.export',['extension'=>'csv','type'=>'partner']) }}">
                                                <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm" href="{{ route('common.export',['extension'=>'xlsx','type'=>'partner']) }}">
                                                <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="showModal(' for Partner','partner')">
                                                <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-danger btn-sm" href="{{ route('common.print',['action'=>'pdf','api'=>'partner']) }}" target="_blank">
                                            <i data-feather='file'></i> PDF</a></li>
                                            <li style="margin: 2px;">
                                            <a class="btn btn-warning btn-sm" href="{{ route('common.print',['action'=>'print','api'=>'partner']) }}" target="_blank">
                                            <i data-feather='printer'></i> Print</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm" href="{{ route('partner.index') }}"><i data-feather='eye'></i> View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm" href="{{ route('partner.create') }}"><i data-feather='plus'></i> Create</a></li>
                                        </ol>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" action="{{ route('partner.filter') }}">
                            @csrf
                            <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="col-lg-4">
                                                <label>Role Name:</label>
                                                <input type="text"  class="form-control" name="keyword" id="keyword" />
                                            </div>
                                            
                                            <div class="col-lg-2" style="margin-top:22px;">
                                                <input type="submit"  class="btn btn-success btn-sm" name="submit" value="Search"/>
                                                <!--<input type="button"  class="btn btn-success btn-sm" name="submit" value="Search" onclick="getData()" />-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <table class="table table-striped table-responsive table-bordered common-datatables">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly"/></th>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
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
                                                <a href="{{ route('partner.show',$response->id) }}"><i data-feather='eye'></i></a>
                                                <a href="{{ route('partner.edit',$response->id) }}"><i data-feather='edit'></i></a>
                                                 <a href="#" onclick="singleDelete({{ $response->id }},'partner');"><i data-feather='trash-2'></i></a>
                                        </td>
                                        <td>{{ $response->id }}</td>
                                        <td><a href="#">{{ $response->legal_name }}</a></td>
                                        <td>{{ $response->address }}</td>
                                        <td>{{ $response->company_name }}</td>
                                        <td>{{ $response->company_phone }}</td>
                                        <td>{{ $response->company_email }}</td>
                                        <td>{{ $response->contact_person_name }}</td>
                                        <td>{{ $response->contact_person_phone }}</td>
                                        <td>{{ $response->contact_person_email }}</td>
                                        <td>{{ $response->subscription_expiry }}</td>
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
        </section>
    </section>
    <!--/ Advanced Search -->


@endsection
@section('page-script')
@endsection

