@extends('layouts.admin')

@section('title', 'About us Settings')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">About us Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">About us Settings</h4>
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
                            <label for="logo">About us Image *</label>
                            <input type="file" id="about_us_image" name="about_us_image" data-default-file="{{ asset(setting("about_us_image")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="logo">About us Image 2*</label>
                            <input type="file" id="about_us_image2" name="about_us_image2" data-default-file="{{ asset(setting("about_us_image2")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="logo">About us Image 3*</label>
                            <input type="file" id="about_us_image3" name="about_us_image3" data-default-file="{{ asset(setting("about_us_image3")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="name">About us section title *</label>
                            <input type="text"  name="about_sec_title" value="{{ setting('about_sec_title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">About us section title 2*</label>
                            <input type="text"  name="about_sec_title2" value="{{ setting('about_sec_title2') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">About us section details *</label>
                            <textarea  name="about_sec_detail"  class="form-control editor"> {{ setting('about_sec_detail') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">About us section details 2*</label>
                            <textarea  name="about_sec_detail2"  class="form-control editor"> {{ setting('about_sec_detail2') }}</textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label for="logo">About us Video *</label>
                            <input type="file" id="about_video" name="about_video" data-default-file="{{ asset(setting("about_video")) }}" class="form-control dropify">
                        </div> --}}

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

