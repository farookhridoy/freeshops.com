@extends('layouts.admin')

@section('title', 'Earnings')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Earnings</li>
                    </ol>
                </div>
                <h4 class="page-title">Earnings</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class=" d-flex justify-content-between">
                        <img src="{{ asset('admin/assets/images/widgets/dollar.png') }}" alt="" height="80">
                        <div class="align-self-center">
                            <h2 class="mt-0 mb-2 font-weight-semibold">${{ $monthly }}
                                @if ($percent['dir'] == "up")
                                    <span class="badge badge-soft-warning font-11 ml-2"><i class="fas fa-arrow-up"></i> {{ $percent['fig'] }}%</span>
                                @else
                                    <span class="badge badge-soft-danger font-11 ml-2"><i class="fas fa-arrow-down"></i> {{ $percent['fig'] }}%</span>
                                @endif
                            </h2>
                            <h4 class="title-text mb-0">Last 30 days Revenue</h4>
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between bg-light p-2 mt-3 rounded">
                        <div class="align-self-center">
                            <h6 class="m-0 font-weight-semibold">All Time Earning</h6>
                        </div>
                        <div class="align-self-center">
                            <h4 class=" m-0 font-weight-semibold font-20">${{ $total_earning }}</h4>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Buyer</th>
                                    <th>PaymentID</th>
                                    <th>Narration</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection
@section('js')
    <script>
        let data = [
            {data: 'date', name: 'date'},
            {data: 'buyer', name: 'buyer'},
            {data: 'payment_id', name: 'payment_id'},
            {data: 'narration', name: 'narration'},
            {data: 'amount', name: 'amount'},
            {data: 'payment_method', name: 'payment_method'},
            {data: 'details', name: 'details'},
        ];
        serverDT("{{ route('admin.earning.all') }}", data);
    </script>
@endsection
