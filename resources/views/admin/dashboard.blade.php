@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Ecommerce</a></li> --}}
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Revenue</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="media my-3">
                                <img src="{{ asset('admin/assets/images/widgets/dollar.png') }}" alt="" class="thumb-md rounded-circle">
                                <div class="media-body align-self-center text-truncate ml-3">
                                    <h4 class="mt-0 mb-1 font-weight-semibold text-dark font-24">${{ $total_revenue }}</h4>
                                    <p class="text-muted text-uppercase mb-0 font-12">Total Revenue</p>
                                </div><!--end media-body-->
                            </div>
                        </div><!--end col-->
                    </div> <!--end row-->
                    <div class="row">
                        <div class="col-12">
                            <canvas id="bar" class="drop-shadow w-100"  height="350"></canvas>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-8">
                                    <p class="text-dark font-weight-semibold font-14">Listings</p>
                                    <h3 class="my-3">{{ $total_listings }}</h3>
                                    <p class="mb-0 text-truncate">
                                        @if (newListingToday()['dir'] == "up")
                                            <span class="text-success"><i class="mdi mdi-trending-up"></i>{{ newListingToday()['fig'] }}%</span>
                                        @else
                                            <span class="text-danger"><i class="mdi mdi-trending-down"></i>{{ newListingToday()['fig'] }}%</span>
                                        @endif
                                        New Listings Today
                                    </p>
                                </div>
                                <div class="col-4 align-self-center">
                                    <div class="report-main-icon bg-light-alt">
                                        <i data-feather="list" class="align-self-center icon-dual-primary icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-8">
                                    <p class="text-dark font-weight-semibold font-14">Active Orders</p>
                                    <h3 class="my-3">{{ $total_orders }}</h3>
                                    {{-- <p class="mb-0 text-truncate">
                                        @if (newOrdersToday()['dir'] == "up")
                                            <span class="text-success"><i class="mdi mdi-trending-up"></i>{{ newOrdersToday()['fig'] }}%</span>
                                        @else
                                            <span class="text-danger"><i class="mdi mdi-trending-down"></i>{{ newOrdersToday()['fig'] }}%</span>
                                        @endif
                                        New Orders Today
                                    </p> --}}
                                </div>
                                <div class="col-4 align-self-center">
                                    <div class="report-main-icon bg-light-alt">
                                        <i data-feather="layers" class="align-self-center icon-dual-warning icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card report-card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-8">
                                    <p class="text-dark font-weight-semibold font-14">Users</p>
                                    <h3 class="my-3">{{ $total_users }}</h3>
                                    <p class="mb-0 text-truncate">
                                        @if (newUsersToday()['dir'] == "up")
                                            <span class="text-success"><i class="mdi mdi-trending-up"></i>{{ newUsersToday()['fig'] }}%</span>
                                        @else
                                            <span class="text-danger"><i class="mdi mdi-trending-down"></i>{{ newUsersToday()['fig'] }}%</span>
                                        @endif
                                        New Users Today
                                    </p>
                                </div>
                                <div class="col-4 align-self-center">
                                    <div class="report-main-icon bg-light-alt">
                                        <i data-feather="users" class="align-self-center icon-dual-pink icon-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body order-list">
                    <h4 class="header-title mt-0 mb-3">Order List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">Order No</th>
                                    <th class="border-top-0">Product</th>
                                    <th class="border-top-0">Pro Name</th>
                                    <th class="border-top-0">Order Date/Time</th>
                                    <th class="border-top-0">Amount ($)</th>
                                    <th class="border-top-0">Status</th>
                                </tr><!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($recent_orders as $item)
                                <tr>
                                    <td>#{{ $item->order_no }}</td>
                                    <td>
                                        <img class="" src="{{ asset($item->listing->featured_image) }}" alt="user"> </td>
                                    <td>
                                        {{ $item->listing->title }}
                                    </td>
                                    <td>{{ $item->created_at->format('d M, Y H:i A') }}</td>
                                    <td> $1</td>
                                    <td>
                                        @if ($item->status == "1")
                                            <span class="badge badge-md badge-boxed  badge-soft-warning">Active</span>
                                        @elseif ($item->status == "2")
                                            <span class="badge badge-md badge-boxed  badge-soft-success">Completed</span>
                                        @elseif ($item->status == "3")
                                            <span class="badge badge-md badge-boxed  badge-soft-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr><!--end tr-->
                                @endforeach
                            </tbody>
                        </table> <!--end table-->
                    </div><!--end /div-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

</div><!-- container -->
@endsection
@section('js')
    <script>
        var currentChartCanvas = $("#bar").get(0).getContext("2d");
        var currentChart = new Chart(currentChartCanvas, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Revenue",
                    backgroundColor: "#2a76f4",
                    borderColor: "transparent",
                    borderWidth: 2,
                    categoryPercentage: 0.5,
                    hoverBackgroundColor: "#506ee4",
                    hoverBorderColor: "transparent",
                    data: <?php echo json_encode($yearly_report); ?>,
                },]
            },

            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend : {
                    display: false,
                    labels : {
                        fontColor : '#50649c'
                    }
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return data.datasets[tooltipItems.datasetIndex].label +' $ ' + tooltipItems.yLabel;
                        }
                    }
                },

                scales: {
                    xAxes: [{
                        barPercentage: 0.35,
                        categoryPercentage: 0.4,
                        display: true,
                        gridLines: {
                            color: "transparent",
                            borderDash: [0],
                            zeroLineColor: "transparent",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,
                        },
                        ticks: {
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                        },

                    }],
                    yAxes: [{
                        gridLines: {
                            color: "#8997bd29",
                            borderDash: [3],
                            drawBorder: false,
                            drawTicks: false,
                            zeroLineColor: "#8997bd29",
                            zeroLineBorderDash: [2],
                            zeroLineBorderDashOffset: [2] ,
                        },
                        ticks: {
                            fontColor: '#a4abc5',
                            beginAtZero: true,
                            padding: 12,
                            callback: function(value) {
                                if ( !(value % 10) ) {
                                    return '$' + value
                                }
                            }
                        },
                    }]
                },

            }
        });
    </script>
@endsection
