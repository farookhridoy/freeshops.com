@extends('layouts.admin')

@section('title', 'Newsletter')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Newsletter</li>
                    </ol>
                </div>
                <h4 class="page-title">Newsletter</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!-- end page title end breadcrumb -->


    <div class="row">

        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="datatables table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Created</th>
                                {{-- <th>Name</th> --}}
                                <th>Email</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d M, Y') }}</td>
                                {{-- <td>{{ $item->name }}</td> --}}
                                <td>{{ $item->email }}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-danger"
                                        onclick="deleteAlert('{{ route('admin.newsletter.delete', $item->id) }}')"><i
                                            class="fas fa-trash-alt text-white font-16"></i>
                                    </button>
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

