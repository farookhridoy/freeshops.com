@extends('layouts.admin')

@section('title', 'Join with us')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Join with us</li>
                    </ol>
                </div>
                <h4 class="page-title">Join with us</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Join us title *</label>
                            <input type="text"  name="join_us_title" placeholder="Title" value="{{ setting('join_us_title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Join us Image *</label>
                            <input type="file" id="join_us_image" name="join_us_image" data-default-file="{{ asset(setting("join_us_image")) }}" class="form-control dropify">
                        </div>

                        <div class="form-group">
                            <label >Join us text *</label>
                            <textarea name="join_us_text"  class="form-control editor">{{ setting('join_us_text') }}</textarea>
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
