@extends('layouts.admin')

@section('title', 'Video Gallery')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item ">Video Gallery</li>
                        <li class="breadcrumb-item active">Edit Video</li>
                    </ol>
                </div>
                <h4 class="page-title">Video Gallery</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.save',$list->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="name" id="name" name="name" placeholder="Video Name" required value="{{ $list->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="video">Upload A Video *</label>
                            <input type="file"  name="video" required data-default-file="{{ $list->video }}" class="form-control dropify">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection

