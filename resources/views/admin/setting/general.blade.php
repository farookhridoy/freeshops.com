@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">General Settings</h4>
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
                            <label for="logo">Logo *</label>
                            <input type="file" id="logo" name="logo" data-default-file="{{ asset(setting("logo")) }}" class="form-control dropify">
                        </div>
                        <div class="form-group">
                            <label for="name">Website Name *</label>
                            <input type="text" id="name" name="website_name" value="{{ setting('website_name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slogan">Slogan *</label>
                            <input type="text" id="slogan" name="slogan" value="{{ setting('slogan') }}" class="form-control">
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
