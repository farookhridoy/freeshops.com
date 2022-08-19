@extends('layouts.front')

@section('title', 'Something New!')

@section('css')
    <style>
        .section {
            padding: 60px 0px;
        }
    </style>
@endsection

@section('content')

@include('front.components.pages_banner')


<section class="section">
    <div class="container">
        <div class="row align-items-center" id="counter">
            <div class="col-md-6 text-center">
                <img src="{{ asset(setting('some_new_image')) }}" width="250px" class="img-fluid m-auto" alt="">
            </div><!--end col-->

            <div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <h4 class="title mb-4">{{ setting('some_new_title') }}</h4>
                        <p class="text-muted">
                            {!! setting('some_new_text') !!}
                        </p>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>

<section class="section">
    <div class="container">
        <div class="row align-items-center justify-content-center" id="counter">
            <div class="col-md-8 mt-4 pt-2 mt-sm-0 pt-sm-0 text-center">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <img src="{{ asset(setting('some_new_image2')) }}" class="img-fluid" alt="">
                        <p class="text-muted mt-3">
                            <span class="text-primary fw-bold">{!! setting('some_new_text2') !!}
                        </p>
                    </div>
                </div>
            </div><!--end col-->

        </div><!--end row-->
    </div><!--end container-->
</section>

@endsection

