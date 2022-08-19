@extends('layouts.admin')

@section('title', 'Disabled Stores')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Disabled Stores</li>
                    </ol>
                </div>
                <h4 class="page-title">Disabled Stores</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Owner</th>
                                    <th>Action</th>
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
            {data: 'logo', name: 'logo'},
            {data: 'name', name: 'name'},
            {data: 'location', name: 'location'},
            {data: 'owner', name: 'owner'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ];
        serverDT("{{ route('admin.store.disabled') }}", data);
    </script>
@endsection
