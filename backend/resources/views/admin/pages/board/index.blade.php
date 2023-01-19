@extends('admin.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Board</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Board List
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
                        <h4 class="card-title">Board List</h4>
                    </div>
                    <div class="card-body">


                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col" class="text-nowrap">Code</th>
                                    <th scope="col" class="text-nowrap text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($model as $board)
                                <tr>
                                    <td class="text-nowrap">{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ $board->board_name }}</td>
                                    <td class="text-nowrap">{{ $board->board_code }}</td>
                                    <td>
                                        <div class="float-right">
                                            <form action="{{route('board.destroy', $board->id)}}" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <a href="{{ route('board.edit', $board->id) }}" class="btn btn-primary">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                    Edit
                                                </a>
                                                <button id="btnDelete" class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @empty
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