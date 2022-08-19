@extends('layouts.admin')

@section('title', 'Blog Categories')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog Categories</li>
                    </ol>
                </div>
                <h4 class="page-title">Blog Categories</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('admin.blog.categories.add') }}" class="btn btn-purple waves-effect waves-light"><i class="mdi mdi-plus mr-2"></i>Add New</a>
        </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Created</th>
                                <th>Name</th>
                                <th>Status <small>(click to change)</small></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection
@section('js')
    <script>
        let data = [
            {data: 'id', name: 'id'},
            {data: 'date', name: 'date'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ];
        serverDT("{{ route('admin.blog.categories.list') }}", data);
    </script>
@endsection
