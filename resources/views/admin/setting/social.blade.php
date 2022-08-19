@extends('layouts.admin')

@section('title', 'Social Settings')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Social Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">Social Settings</h4>
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
                            <label for="name">Facebook *</label>
                            <input type="text"  name="facebook" value="{{ setting('facebook') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slogan">Twitter *</label>
                            <input type="text" name="twitter" value="{{ setting('twitter') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slogan">Linkedin *</label>
                            <input type="text" name="linkedin" value="{{ setting('linkedin') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="slogan">Instagram *</label>
                            <input type="text" name="instagram" value="{{ setting('instagram') }}" class="form-control">
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
