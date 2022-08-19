@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
                <h4 class="page-title">FAQ</h4>
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
                            <label for="name">FAQ title *</label>
                            <input type="text"  name="faq_title" placeholder="Title" value="{{ setting('faq_title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">FAQ title 2*</label>
                            <input type="text"  name="faq_title2" placeholder="Title" value="{{ setting('faq_title2') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label >FAQ text *</label>
                            <textarea name="faq_text"  class="form-control editor">{{ setting('faq_text') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label >FAQ text 2*</label>
                            <textarea name="faq_text2"  class="form-control editor">{{ setting('faq_text2') }}</textarea>
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
