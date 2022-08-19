@extends('layouts.admin')

@section('title', 'Something new')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Something new</li>
                    </ol>
                </div>
                <h4 class="page-title">Something new</h4>
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
                            <label for="name">Something new title *</label>
                            <input type="text"  name="some_new_title" placeholder="Title" value="{{ setting('some_new_title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="logo">Something new Image *</label>
                            <input type="file" id="some_new_image" name="some_new_image" data-default-file="{{ asset(setting("some_new_image")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="logo">Something new Image 2*</label>
                            <input type="file" id="some_new_image2" name="some_new_image2" data-default-file="{{ asset(setting("some_new_image2")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label >Something new text *</label>
                            <textarea name="some_new_text"  class="form-control editor">{{ setting('some_new_text') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label >Something new text *</label>
                            <textarea name="some_new_text2"  class="form-control editor">{{ setting('some_new_text2') }}</textarea>
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
