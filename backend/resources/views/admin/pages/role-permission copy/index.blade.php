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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i
                                    class="fas fa-arrow-circle-left"></i> Back</a>
                            <div class="col-sm-10 mt-1">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol class="breadcrumb float-sm-right">
                                            <li style="margin: 2px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'csv', 'type' => 'partner']) }}">
                                                    <i data-feather='file-text'></i> CSV</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('common.export', ['extension' => 'xlsx', 'type' => 'partner']) }}">
                                                    <i data-feather='download'></i> Excel</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    onclick="showModal(' for Partner','partner')">
                                                    <i data-feather='upload'></i> Import</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'partner']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'partner']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route('partner.index') }}"><i data-feather='eye'></i>
                                                    View</a></li>
                                            <li style="margin: 2px;"><a class="btn btn-dark btn-sm"
                                                    href="{{ route('partner.create') }}"><i data-feather='plus'></i>
                                                    Create</a></li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="dt_adv_search" method="POST" action="{{ route('role-permission.store') }}">
                            @csrf
                            <!--Search Form -->
                            <div class="card-body mt-2">

                                <input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row mb-1">
                                            <div class="form-group">
                                                <label for="name">Select Role</label>
                                                <select name="role_id" class="form-control">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <hr class="my-0" />
                            <div class="col-sm-12">
                                <table role="table" aria-busy="false" aria-colcount="5" class="table b-table table-striped"
                                    id="__BVID__1398">
                                    <thead role="rowgroup" class="">
                                        <tr role="row" class="">
                                            <th role="columnheader" scope="col" aria-colindex="1" class=""><div>Role Group</div></th>
                                            <th colspan="10" align="center" style="text-align: center">Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody role="rowgroup">
                                            @foreach ($groups as $group)
                                            <form id="form_check{{ $group->id }}">
                                            <tr role="row" class="">
                                                    <td aria-colindex="1" role="cell" class="">
                                                        {{ $group->name }}
                                                    </td>
                                                    <td aria-colindex="2" role="cell" class="">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input" value="true" onclick='checkedAllRole({{ $group->id }});'
                                                                id="all{{ $group->name }}" /><label
                                                                class="custom-control-label"
                                                                for="all{{ $group->name }}">all</label></div>
                                                    </td>


                                                    <input type="hidden" name="group[]" value="{{ $group->id }}">
                                                    @foreach ($group->group_has_permission as $permission)

                                                        <td class="">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="permissions[{{ $group->id }}][]"
                                                                    value="{{ $permission->id }}"
                                                                    id="{{ $group->name }}{{ $permission->name }}">
                                                                <label class="custom-control-label"
                                                                    for="{{ $group->name }}{{ $permission->name }}"> {{ $permission->name }} </label>
                                                            </div>
                                                        </td>
                                                    @endforeach

                                                </tr>
                                            </form>
                                            @endforeach

                                    </tbody>
                                    <!---->
                                </table>
                                <div class="input-field col s12">
                                    <button class="btn btn-danger right waves-effect waves-float waves-light" type="reset" id="cancel">Cancel</button>
                                    <button class="btn btn-success right waves-effect waves-float waves-light" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--/ Advanced Search -->
    <script>

    </script>

@endsection
@section('page-script')
@endsection
