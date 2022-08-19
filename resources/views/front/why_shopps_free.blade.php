@extends('layouts.front')

@section('title', 'Why Shopps Free!')

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
            <div class="col-md-6">
                <img src="{{ asset(setting('shopfree_image')) }}" class="img-fluid" alt="">
            </div><!--end col-->

            <div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <h4 class="title mb-4">{{ setting('shopfree_title') }}</h4>
                        <p class="text-muted">
                            {!! setting('shopfree_text') !!}
                        </p>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
@endsection

