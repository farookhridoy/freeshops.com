@extends('layouts.admin')

@section('title', 'Contact Queries')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Queries</li>
                    </ol>
                </div>
                <h4 class="page-title">Contact Queries</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="modal fade text-left" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($list[0]))
                            @foreach ($list as $key=> $item)
                            <tr>
                                <td>{{  ($list->currentpage()-1) * $list->perpage() + $key + 1  }}</td>
                                <td>{{ $item->created_at->format('d M, Y') }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>
                                    <button type="button" class="btn btn-success"
                                        onclick="crudModal('{{ route('admin.contact.view',$item->id) }}')">Details</i>
                                    </buton>

                                    <button type="button" class="btn btn-danger"
                                        onclick="deleteAlert('{{ route('admin.contact.delete', $item->id) }}')"><i
                                            class="fas fa-trash-alt text-white font-16"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                @if($list)
                                    {{$list->links()}}
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection
@section('js')
<script>
    function crudModal(url) {
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response)
                if (response.statusCode == 200) {
                    $("#crudModal .modal-content").html(response.html);
                    $("#crudModal").modal("show");
                }
            },
        });
    }

</script>
@endsection
