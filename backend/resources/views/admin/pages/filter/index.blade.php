@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Filter</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Filter
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter</h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('filter.list') }}" method="get">
                            @csrf
                            <div class="row">

                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="description">Category</label>
                                        <select class="form-control kagawad" name="category" id="category">
                                            <option value="">---- Select Category ----</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nameBn }} ({{ $category->nameEn }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mb-1">
                                    <div class="form-group">
                                        <label for="description">Category</label>
                                        <select class="form-control kagawad" name="subcateogry" id="">
                                            <option value="">--- Select Sub Category ----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn btn-success right" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th scope="col" class="text-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($news as $key => $n)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $n->title }}</td>
                                    <td>{{ $n->category->nameBn }}</td>
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($n->description, 100, '') }}
                                        ................
                                    </td>
                                    <td>
                                        @if($n->image != null)
                                        <img src="{{ asset($n->image) }}" style="border-radius: 5px;" width="50" height="50" class="responsive-img mb-10" alt="">
                                        @else
                                        {{-- <img src="{{ asset($n->subcategory->image) }}" style="border-radius: 5px;" width="50" height="50" class="responsive-img mb-10" alt="">--}}
                                        @endif
                                    </td>
                                    {{-- <td>--}}
                                    {{-- <span class="badge {{ $n->status == 1 ? 'blue' : 'red' }}">{{ $n->status == 1 ? 'Active' : 'Deactive' }}</span>--}}
                                    {{-- </td>--}}
                                    <td>
                                        <div class="icon-preview col s6 m3">
                                            <a href="{{ route('news.view', $n->id) }}" method="GET" title="View">
                                                <i class="material-icons dp48">remove_red_eye</i>
                                            </a>

                                        </div>
                                        {{-- <div class="icon-preview col s6 m3">--}}
                                        {{-- <a href="{{ route('news.edit', $n->id) }}" method="GET" title="Edit">--}}
                                        {{-- <i class="material-icons dp48">edit</i>--}}
                                        {{-- </a>--}}

                                        {{-- </div>--}}
                                        {{-- <div class="icon-preview col s6 m3">--}}
                                        {{-- <form action="{{ route('news.delete', $n->id) }}" method="POST">--}}
                                        {{-- {{ csrf_field() }}--}}
                                        {{-- {{ method_field('DELETE') }}--}}
                                        {{-- <button class="btn" type="submit" onclick="return confirm(' you want to delete?');">--}}
                                        {{-- <i class="material-icons dp48">delete</i>--}}
                                        {{-- </button>--}}
                                        {{-- </form>--}}
                                        {{-- </div>--}}

                                    </td>
                                </tr>
                                @empty
                                <p>No replies</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@push('custom-js')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('admin/app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('admin/app-assets/js/scripts/data-tables.js')}}"></script>
<!-- END PAGE LEVEL JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('admin/app-assets/js/scripts/ui-alerts.js')}}"></script>
<!-- END PAGE LEVEL JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('admin/app-assets/js/scripts/page-users.js')}}"></script>
<!-- END PAGE LEVEL JS-->
<script !src="">
    $('.kagawad').on('change', function() {
        $('.send').prop('disabled', !$(this).val());
    }).trigger('change');

    $("#category").on('change', function() {
        // alert($(this).val())
        var category_id = $(this).val()
        $.ajax({
            url: '/filter/subcategory/list',
            type: "get",
            data: {
                category_id: category_id
            }, // the value of input having id vid
            success: function(response) { // What to do if we succeed
                $('select[name="subcateogry"]').empty();
                $.each(response, function(key, value) {
                    $('select[name="subcateogry"]').append('<option value="' + key + '">' + value + '</option>');

                });
            }
        });

    });
</script>
@endpush