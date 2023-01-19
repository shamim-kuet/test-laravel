@extends('admin.layouts.master')
@section('prefixname', $prefixname)
@section('title', $title)
@section('page_title', $page_title)
@section('content')
    <!-- Page Length Options -->

    <!-- users list start -->
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row">
                    <form action="{{ route('filter.list') }}" method="get">
                        @csrf
                        <div class="col s12 m6 l5">
                            <label for="users-list-verified">Category</label>
                            <div class="input-field">
                                <select class="select2 browser-default kagawad" name="category" id="category">
                                    <option value="">---- Select Category ----</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nameBn }} ({{ $category->nameEn }})</option>
                                    @endforeach
                                </select>
                                <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('category') }}</span>
                            </div>
                        </div>
                        <div class="col s12 m6 l5">
                            <label for="users-list-role">Sub Category</label>
                            <div class="input-field" id="">
                                <select class="select2 browser-default kagawad" name="subcateogry" id="">
                                    <option value="">--- Select Sub Category ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l2 display-flex align-items-center show-btn">
                            <button type="submit" class="btn btn-block indigo waves-effect waves-light send">Show</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="" class="table">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
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
{{--                                            <img src="{{ asset($n->subcategory->image) }}" style="border-radius: 5px;" width="50" height="50" class="responsive-img mb-10" alt="">--}}
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        <span class="badge {{ $n->status == 1 ? 'blue' : 'red' }}">{{ $n->status == 1 ? 'Active' : 'Deactive' }}</span>--}}
{{--                                    </td>--}}
                                    <td>
                                        <div class="icon-preview col s6 m3">
                                            <a href="{{ route('news.view', $n->id) }}" method="GET" title="View">
                                                <i class="material-icons dp48">remove_red_eye</i>
                                            </a>

                                        </div>
{{--                                        <div class="icon-preview col s6 m3">--}}
{{--                                            <a href="{{ route('news.edit', $n->id) }}" method="GET" title="Edit">--}}
{{--                                                <i class="material-icons dp48">edit</i>--}}
{{--                                            </a>--}}

{{--                                        </div>--}}
{{--                                        <div class="icon-preview col s6 m3">--}}
{{--                                            <form action="{{ route('news.delete', $n->id) }}" method="POST">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                <button class="btn" type="submit" onclick="return confirm(' you want to delete?');">--}}
{{--                                                    <i class="material-icons dp48">delete</i>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}

                                    </td>
                                </tr>
                            @empty
                                <p>No replies</p>
                            @endforelse

                            </tbody>
                        </table>

                    </div>
                    <!-- datatable ends -->
                    {!! $news->links() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- users list ends -->

@endsection
@push('custom-css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/data-tables.css')}}">

@endpush
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
        $('.kagawad').on('change', function () {
            $('.send').prop('disabled', !$(this).val());
        }).trigger('change');

        $("#category").on('change',function () {
            // alert($(this).val())
            var category_id = $(this).val()
            $.ajax({
                url: '/filter/subcategory/list',
                type: "get",
                data:{category_id:category_id}, // the value of input having id vid
                success: function(response){ // What to do if we succeed
                    $('select[name="subcateogry"]').empty();
                    $.each(response,function(key,value){
                        $('select[name="subcateogry"]').append('<option value="'+ key +'">'+value+'</option>');

                    });
                }
            });

        });
    </script>
@endpush
