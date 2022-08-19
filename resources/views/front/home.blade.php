@extends('layouts.front')
@section('title', 'Home')
@section('content')

<!-- Hero Start -->
<section class="bg-half bg-primary d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h3 class="title text-white"> {{ setting('slogan') }} </h3>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

<!-- Shape Start -->
<div class="position-relative">
    <div class="shape overflow-hidden text-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!--Shape End-->

<!-- Start Products -->
<section class="section pt-5">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-12 mt-5 pt-2 mt-sm-0 pt-sm-0">

                <div class="row listing-load">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
                    </div>
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Products -->

<section class="w-100">
    <div class="container">
        <div class="row align-items-center m-auto">
            <div class="col-md-10 m-auto">
                <img src="{{ asset(setting('home_image')) }}" class="img-fluid w-100" alt="">
            </div>
        </div>
    </div>
</section>

<section class="section d-table w-100">
    <div class="container-fluid">
        <div class="row mt-5 align-items-center position-relative" style="z-index: 1;">
            <div class="col-lg-6">
                <div class="title-heading text-center text-lg-start">
                    <h4 class="heading fw-bold mb-3 mt-3">Sharing is, <br> Better than, <br> Throwing away...</h4>
                    <p class="para-desc text-muted mx-auto mx-lg-start mb-0">{{ setting('video_sec_text') }}</p>
                    <div class="mt-3">
                        <a href="{{ route('post.ad') }}" class="btn btn-primary me-2 mt-2">+ Post you Ad</a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-6 mt-4 pt-2 mt-lg-0 pt-lg-0">
                <div class="card border-0 shadow rounded ms-lg-4 overflow-hidden">
                    <div class="d-flex p-2 bg-light justify-content-between align-items-center">
                        <div>
                            <a href="javascript:void(0)" class="text-danger"><i class="mdi mdi-circle"></i></a>
                            <a href="javascript:void(0)" class="text-warning"><i class="mdi mdi-circle"></i></a>
                            <a href="javascript:void(0)" class="text-success"><i class="mdi mdi-circle"></i></a>
                        </div>

                        <small class="fw-bold"><i class="mdi mdi-circle-medium text-success"></i> FreeShopps</small>
                    </div>
                    <div class="bg-light px-2 position-relative">
                        <video class="w-100 rounded" controls loop>
                            <source src="{{ asset(setting('home_video')) }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->



@endsection
