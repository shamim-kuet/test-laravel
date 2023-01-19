@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="{{ route('hub.index') }}"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="home" class="font-medium-5"></i>
                                    </div>
                                </div>

                                <div class="col-sm-10">
                                    <h3 class="card-text">Total Hub</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->thub }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- total users Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="{{ route('merchant.index') }}"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">Total Merchant</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->tmerchent }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="#"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">New Merchant Request</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->tmerchentRequest }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>


                    <!-- Total Driver Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="{{ route('rider.index') }}"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa-solid fa-person-biking"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">Total Rider</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->trider }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>
                    <!-- Total Driver Chart Card ends -->

                    <!-- New Driver Request Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="#"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa-solid fa-bicycle"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">New Rider Request</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->triderRequest }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>

                    <!-- total users Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="{{ route('order.index') }}"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa-duotone fa-box"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">Total Orders</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->torder }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>
                    <!-- total users Chart Card ends -->


                    <!-- Total Driver Chart Card ends -->

                    <!-- New Driver Request Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card" style="position: relative">
                            <a href="#"
                                style="position: absolute; top:0; left: 0; height:100%; width:100%; z-index:1;"></a>

                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa-light fa-box"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">New Order Request</h3>
                                    <h4 class="font-weight-bolder mt-1">{{ $homeinfo->torderRequest }}</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>

                    @foreach ($homeinfo->status as $status)
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="message-square" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <h3 class="card-text">{{ $status->name }}</h3>
                                        <h4 class="font-weight-bolder mt-1">{{ $status->total }}</h4>
                                    </div>
                                </div>
                                <div id="#"></div>
                            </div>
                        </div>
                    @endforeach


                    <!-- New Driver Request Chart Card ends -->
                </div>
                {{-- <div class="row match-height">
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
                                    <h3 class="card-text">Accounts (This Month)</h3>
                                    <h4 class="font-weight-bolder mt-1">Expense: Tk 345678</h4>
                                    <h4 class="font-weight-bolder mt-1">Income: Tk 78345678</h4>
                                    <h4 class="font-weight-bolder mt-1">Income: Tk 78000000</h4>
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
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">Attendance (Today)</h3>
                                    <h4 class="font-weight-bolder mt-1">Present: Tk 78</h4>
                                    <h4 class="font-weight-bolder mt-1">Absant: Tk 12</h4>
                                    <h4 class="font-weight-bolder mt-1">Avarage Present: 85%</h4>
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
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <h3 class="card-text">Merchant Payment (This month)</h3>
                                    <h4 class="font-weight-bolder mt-1">Payable amount: Tk 783439</h4>
                                    <h4 class="font-weight-bolder mt-1">Paid Amount: Tk 650032</h4>
                                    <h4 class="font-weight-bolder mt-1">Due Balance: 133407</h4>
                                </div>
                            </div>
                            <div id="#"></div>
                        </div>
                    </div>
                    <!-- New Driver Request Chart Card ends -->
                </div> --}}
            </section>

            {{-- <section id="">
                <div class="row match-height">

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <canvas id="myChart1" width="400" height="150"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <canvas id="myChart2" width="400" height="150"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <canvas id="myChart3" width="400" height="150"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <canvas id="myChart4" width="400" height="150"></canvas>
                        </div>
                    </div>



                </div>
            </section> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card invoice-list-wrapper">
                        <div class="card-header border-bottom">
                            <h2>Delivery Information</h2>
                        </div>
                        <div class="card-datatable table-responsive">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered common-datatables"
                                    style="width:100%; padding: 10px">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Hub</th>
                                            <th>Merchant Name</th>
                                            <th>Rider Name</th>
                                            <th>Consaignment ID</th>
                                            <th>Collectable Amount</th>
                                            <th>Status</th>
                                            <th>Assign Date</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getResponse as $response)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ @$response->hub->name }}</td>
                                                {{-- <td>{{ @$response->merchant->name }}</td> --}}
                                                <td>{{ @$response->merchant->business->name }}</td>
                                                <td>{{ @$response->rider->name }}</td>
                                                <td>{{ @$response->order->consignment_id }}</td>
                                                <td>{{ @$response->collectable_amount }}</td>
                                                <td>
                                                    <button class="btn btn-xs"
                                                        style="background: {{ @$response->deliver_status->color }}; color: {{ @$response->deliver_status->font_color }}">{{ @$response->deliver_status->name }}</button>
                                                </td>
                                                <td>{{ $response->assign_date }}</td>
                                                <td>{{ $response->delivery_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
        <script>
            const ctx1 = document.getElementById('myChart1');
            const myChart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Cash Collection History',
                        data: [10, 20, 25, 30, 45, 50, 52, 55, 60, 70, 85, 100],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // for chart2
            const ctx2 = document.getElementById('myChart2');
            const myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Cash Collection History',
                        data: [10, 20, 25, 30, 45, 50, 52, 55, 60, 70, 85, 100],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            // for chart2
            const ctx3 = document.getElementById('myChart3');
            const myChart3 = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Cash Collection History',
                        data: [10, 20, 25, 30, 45, 50, 52, 55, 60, 70, 85, 100],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // for chart2
            const ctx4 = document.getElementById('myChart4');
            const myChart4 = new Chart(ctx4, {
                type: 'doughnut',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Cash Collection History',
                        data: [10, 20, 25, 30, 45, 50, 52, 55, 60, 70, 85, 100],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
