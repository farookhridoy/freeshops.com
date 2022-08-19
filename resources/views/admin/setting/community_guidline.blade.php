@extends('layouts.admin')

@section('title', 'Community Guidelines')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Community Guidelines</li>
                    </ol>
                </div>
                <h4 class="page-title">Community Guidelines</h4>
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
                            <label for="community_guidline">Community Guideline *</label>
                            <textarea name="community_guidline"  class="form-control editor">{{ setting('community_guidline') }}</textarea>
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
