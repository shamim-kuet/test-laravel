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
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                Total = {{ $news->count() }}
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
                                    <img src="{{ asset($n->subcategory->image) }}" style="border-radius: 5px;" width="50" height="50" class="responsive-img mb-10" alt="">
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('news.view', $n->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil-square-o"></i>
                                        show
                                    </a>


                                </td>
                            </tr>
                            @empty
                            <div class="card-content red-text">
                                <p>Sorry : No Data Found</p>
                            </div>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->

            </div>
        </div>
    </div>
</section>
<!-- users list ends -->

@endsection
@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/dropify/css/dropify.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/quill/katex.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/quill/monokai-sublime.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/quill/quill.bubble.css')}}">
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