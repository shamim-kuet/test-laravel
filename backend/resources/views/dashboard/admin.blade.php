@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
             <div class="row match-height">
                <!-- total users Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="users" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Total Merchant</h3>
                                <h4 class="font-weight-bolder mt-1">1000</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- total users Chart Card ends -->

                <!-- Total Driver Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Total Rider</h3>
                                <h4 class="font-weight-bolder mt-1">400</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- Total Driver Chart Card ends -->

                <!-- New Driver Request Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="message-square" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">New Rider Request</h3>
                                <h4 class="font-weight-bolder mt-1">200</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- New Driver Request Chart Card ends -->
            </div>
            <div class="row match-height">
                <!-- total users Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="users" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Total Orders</h3>
                                <h4 class="font-weight-bolder mt-1">1000</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- total users Chart Card ends -->

                <!-- Total Driver Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">New Merchant Request</h3>
                                <h4 class="font-weight-bolder mt-1">400</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- Total Driver Chart Card ends -->

                <!-- New Driver Request Chart Card starts -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="message-square" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">New Order Request</h3>
                                <h4 class="font-weight-bolder mt-1">200</h4>
                            </div>
                        </div>
                        <div id="#"></div>
                    </div>
                </div>
                <!-- New Driver Request Chart Card ends -->
            </div>
            <div class="row match-height">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="col-sm-2">
                           	 <div class="avatar bg-light-warning">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Unassigned Order</h3>
                                <h4 class="font-weight-bolder mt-1">100</h4>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="col-sm-2">
                                <div class="avatar bg-light-warning">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Assigned Order</h3>
                                <table class="mt-2" width="100%">
                                    <tr>
                                        <td class="font-weight-bolder">In Progress</td>
                                        <td>:</td>
                                        <td align="right">250</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bolder">Pending</td>
                                        <td>:</td>
                                        <td align="right">50</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bolder">Done</td>
                                        <td>:</td>
                                        <td align="right">200</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>
                {{--<div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="col-sm-2">
                           	 <div class="avatar bg-light-warning">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Orders Received</h3>
                                <h4 class="font-weight-bolder mt-1">38.4K</h4>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>--}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="col-sm-2">
                           	 <div class="avatar bg-light-warning">
                                <div class="avatar-content">
                                    <i data-feather="package" class="font-medium-5"></i>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-10">
                                <h3 class="card-text">Order Returned</h3>
                                <h4 class="font-weight-bolder mt-1">55</h4>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>
            </div>


            <h4 class="card-text text-center mt-2"> Rider's Live Location</h4>

			<div class="row">
                <div class="col-sm-12 mt-2">
                    @include('dashboard.map')
                </div>
            </div>

            <!-- List DataTable -->
            {{--<div class="row">
                <div class="col-12">
                    <div class="card invoice-list-wrapper">
                        <div class="card-datatable table-responsive">
                            <table class="invoice-list-table table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th><i data-feather="trending-up"></i></th>
                                        <th>Client</th>
                                        <th>Total</th>
                                        <th class="text-truncate">Issued Date</th>
                                        <th>Balance</th>
                                        <th>Invoice Status</th>
                                        <th class="cell-fit">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!--/ List DataTable -->
        </section>
        <!-- Dashboard Analytics end -->

    </div>
</div>


@endsection
