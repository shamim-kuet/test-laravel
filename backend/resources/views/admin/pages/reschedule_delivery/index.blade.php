@extends('admin.layouts.master')
@section('content')
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Delivery Reschedule</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Delivery Reschedule</li>
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
                                                    href="{{ route('common.print', ['action' => 'pdf', 'api' => 'reshedule-delivery']) }}"
                                                    target="_blank">
                                                    <i data-feather='file'></i> PDF</a>
                                            </li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('common.print', ['action' => 'print', 'api' => 'reshedule-delivery']) }}"
                                                    target="_blank">
                                                    <i data-feather='printer'></i> Print</a>
                                            </li>
                                            <li style="margin: 2px;"><a class="btn btn-primary btn-sm"
                                                    href="{{ route('delivery.reschedule') }}"><i data-feather='eye'></i>
                                                    View</a></li>
                                            <li style="margin: 2px;">
                                                <a class="btn btn-dark btn-sm" href="javascript:void(0)"
                                                    onclick="getModal('create','')"><i data-feather='plus'></i> Create</a>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Search Form -->

                        <hr class="my-0" />
                        <div class="col-sm-12">
                            <form id="form_check">
                                <table class="table table-striped table-responsive table-bordered common-datatables">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                            <th>Action</th>
                                            <th>Rider ID</th>
                                            <th>Reassign Rider ID</th>
                                            <th>Consaignment ID</th>
                                            <th>Reschedule Date</th>
                                            <th>Reassign Date</th>
                                            <th>Note</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($getResponse != '')
                                            @foreach ($getResponse as $response)
                                                <tr id="tablerow{{ $response->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><input type="checkbox" name="summe_code[]" id="summe_code"
                                                            value="{{ $response->id }}" /></td>
                                                    <td class="text-nowrap">
                                                        <a href="#"
                                                            onclick="singleDelete({{ $response->id }},'delivery_reschedules');"><i
                                                            class="fa fa-trash"></i></a>
                                                        @php
                                                            $riderid = $response->rider ? $response->rider->id : '';
                                                            $date = $response->request_date;
                                                            $note = $response->note;
                                                            $riderName = $response->reassignrider ? $response->reassignrider->name : '';

                                                        @endphp
                                                        <a href="javascript:void(0)"
                                                            onclick="getModal('edit',{{ $response->id }},{{ $riderid }},'{{ $riderName }}','{{ $date }}','{{ $note }}')"><i
                                                            class="fa fa-edit"></i></a>
                                                    </td>
                                                    <td>{{ $response->rider ? $response->rider->name : '' }}</td>
                                                    <td>{{ $response->reassignrider ? $response->reassignrider->name : '' }}</td>
                                                    <td>{{ $response->consignment_id }}</td>
                                                    <td>{{ $response->request_date }}</td>
                                                    <td>{{ $response->reassign_date }}</td>
                                                    <td>{{ $response->note }}</td>
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

    <div class="modal fade" id="exampleModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="width:700px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="max-height:600px; overflow:auto; overflow-x:hidden">
                    <form method="POST" action="{{ route('delivery.reschedule') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12" style="margin:0; padding:0 3px;">
                                <div class="row"
                                    style="padding:5px; border:1px solid #ccc; margin:20px 5px; border-radius:10px;">
                                    <div class="col-sm-12">
                                        <div class="row" style="margin-bottom:5px;">
                                            <div class="col-sm-5" style="margin:0; padding:0"><label>Rider</label></div>
                                            <div class="col-sm-7">
                                                <select name="rider_id" id="rider_id" class="form-control">
                                                    @foreach ($riders as $rider)
                                                        <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" id="consignmentid">
                                        <div class="row" style="margin-bottom:5px;">
                                            <div class="col-sm-5" style="margin:0; padding:0"><label>Consignment
                                                    ID</label></div>
                                            <div class="col-sm-7">
                                                <input type="text" id="consignment_id" class="form-control" name="consignment_id" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row" style="margin-bottom:5px;">
                                            <div class="col-sm-5" style="margin:0; padding:0"><label>Delivery Date</label></div>
                                            <div class="col-sm-7"><input type="date" class="form-control" name="delivery_date" id="delivery_date" /></div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="row" style="margin-bottom:5px;">
                                                <div class="col-sm-5" style="margin:0; padding:0"><label>Note</label></div>
                                                <div class="col-sm-7">
                                                    <textarea name="note" id="note" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="reshedule_id" id="reshedule_id" />
                                <input type="submit" name="submitbtn" value="Submit" class="btn btn-success" />
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#consignment_id").autocomplete({
                source: "{{ route('ajax.orderid') }}"
            });
        });


        let getModal = function(type, id, rider_id, rider_name, date, note) {
            //alert(type);
            if (type == 'edit') {
                $("#delivery_date").val(date);
                $('#rider_id').children('option:first-child').text(rider_name).val(rider_id);
                // $("#rider_id").html(rider_name);
                $("#note").val(note);
                $("#consignmentid").hide('fast');
                $("#reshedule_id").val(id);
            } else {
                $("#consignmentid").show('fast');
                $("#reshedule_id").val('');
            }

            $("#exampleModal").modal('show');
        }
    </script>
    <style>
        .ui-autocomplete {
            position: absolute;
            cursor: default;
            z-index: 3000000 !important;
        }
    </style>
@endsection
