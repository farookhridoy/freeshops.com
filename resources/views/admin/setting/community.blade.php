@extends('layouts.admin')

@section('title', 'Community')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Community</li>
                    </ol>
                </div>
                <h4 class="page-title">Community</h4>
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
                            <label for="community_image">Community Image *</label>
                            <input type="file" id="community_image" name="community_image" data-default-file="{{ asset(setting("community_image")) }}" class="form-control dropify">
                        </div>

                        <div class="form-group">
                            <label >Community text *</label>
                            <textarea name="community_text"  class="form-control editor">{{ setting('community_text') }}</textarea>
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
