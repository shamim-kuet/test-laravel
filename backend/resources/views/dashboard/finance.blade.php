@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
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
                                <h3 class="card-text">Total Users</h3>
                                <h4 class="font-weight-bolder mt-1">1000</h4>
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
                                <h3 class="card-text">Total Driver</h3>
                                <h4 class="font-weight-bolder mt-1">400</h4>
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
                                <h3 class="card-text">New Driver Request</h3>
                                <h4 class="font-weight-bolder mt-1">200</h4>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>
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
                                <h3 class="card-text">Cash Collection</h3>
                                <table width="100%">
                                	<tr>
                                    	<td>Collectable</td>
                                        <td>:</td>
                                        <td align="right">45689</td>
                                    </tr>
                                    <tr>
                                    	<td>Collected</td>
                                        <td>:</td>
                                        <td align="right">2500</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--<div id="order-chart"></div>-->
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 col-12">
                    <div class="card">
                        <canvas id="myChart" width="400" height="150"></canvas>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card invoice-list-wrapper">
                        <div class="card-datatable table-responsive">
                            <table class="invoice-list-table table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>SL</th>
                                        <th><i data-feather="trending-up"></i></th>
                                        <th>Total Order Value</th>
                                        <th>Merchant Paid</th>
                                        <th class="text-truncate">Merchant Due</th>
                                        <th>Driver Payment</th>
                                        <th>Payment Status</th>
                                        <th class="cell-fit">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ List DataTable -->
        </section>
        <!-- Dashboard Analytics end -->

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
 <script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June','July','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: 'Monthly Cash Collection History',
            data: [10,20,25,30,45,50,52,55,60,70,85,100],
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
