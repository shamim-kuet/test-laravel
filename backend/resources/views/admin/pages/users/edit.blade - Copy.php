@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User Create
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            @include('ErrorMessage')
            <!-- Tooltip validations start -->
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <div class="left">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="right">
                                    <a class="btn btn-primary btn-learge" href="{{ route('user.index') }}">User List</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action=" {{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name" id="name"
                                                    name="name" value="{{ $user->name }}">
                                                    <div id="team-message">
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" placeholder="Enter username"
                                                    id="username" name="username" value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" placeholder="Enter email"
                                                    id="email" name="email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="phone">phone</label>
                                                <input type="text" class="form-control" placeholder="Enter phone"
                                                    id="phone" name="phone" value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="text" class="form-control" placeholder="Enter password"
                                                    id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter password_confirmation" id="password_confirmation"
                                                    name="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="">---Select Role---</option>

                                                    @foreach ($roles as $key => $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Present
                                                        Address</label>

                                                    <textarea name="present_address" id="present_address" cols="30"
                                                        rows="10" class="form-control"
                                                        placeholder="Banani, Dhaka">{{ $user->present_address }}</textarea>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="modern-address">Permanent
                                                        Address</label>


                                                    <textarea name="permanent_address" id="permanent_address" cols="30"
                                                        rows="10" class="form-control"
                                                        placeholder="Banani, Dhaka">{{ $user->permanent_address }}</textarea>
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
                    </div>
                </div>
            </section>
            <!-- Tooltip validations end -->
        </div>
    </div>
@endsection
