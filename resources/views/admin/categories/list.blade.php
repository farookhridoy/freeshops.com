@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
                <h4 class="page-title">Categories</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('admin.categories.add') }}" class="btn btn-purple waves-effect waves-light"><i class="mdi mdi-plus mr-2"></i>Add New</a>
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
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d M, Y') }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        @if ($item->status)
                                            <span class="badge badge-md badge-boxed badge-soft-success cursor-pointer"
                                            onclick="alertMessage('{{ route('admin.categories.status.change', $item->id) }}', 'You want to change status of this cateogry.')">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-md badge-boxed badge-soft-danger cursor-pointer"
                                            onclick="alertMessage('{{ route('admin.categories.status.change', $item->id) }}', 'You want to change status of this cateogry.')">
                                                Disabled
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $item->id) }}"><i class="fas fa-edit text-info font-16"></i></a>
                                        <button type="button" class="border-0 bg-transparent" onclick="deleteAlert('{{ route('admin.categories.delete', $item->id) }}')"><i class="fas fa-trash-alt text-danger font-16"></i></button>
                                    </td>
                                </tr>
                            @endforeach
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
        serverDT("{{ route('admin.categories.list') }}", data);
    </script>
@endsection
