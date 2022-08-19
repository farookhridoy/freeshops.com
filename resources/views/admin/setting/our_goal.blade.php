@extends('layouts.admin')

@section('title', 'Our goal')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Our goal</li>
                    </ol>
                </div>
                <h4 class="page-title">Our goal</h4>
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
                            <label for="name">Goal title *</label>
                            <input type="text"  name="goal_title" placeholder="Title" value="{{ setting('goal_title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Goal title 2*</label>
                            <input type="text"  name="goal_title2" placeholder="Title" value="{{ setting('goal_title2') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="goal_image">Goal Image *</label>
                            <input type="file" id="goal_image" name="goal_image" data-default-file="{{ asset(setting("goal_image")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="goal_image2">Goal Image 2*</label>
                            <input type="file" id="goal_image2" name="goal_image2" data-default-file="{{ asset(setting("goal_image2")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label >Goal text *</label>
                            <textarea name="goal_text"  class="form-control editor">{{ setting('goal_text') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label >Goal text 2*</label>
                            <textarea name="goal_text2"  class="form-control editor">{{ setting('goal_text2') }}</textarea>
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
