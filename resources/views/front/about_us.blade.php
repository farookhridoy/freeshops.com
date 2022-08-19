@extends('layouts.front')

@section('title', 'About Us')

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
                <img src="{{ asset(setting('about_us_image')) }}" class="img-fluid" alt="">
                <img src="{{ asset(setting('about_us_image2')) }}" class="img-fluid" alt="">
            </div><!--end col-->

            <div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <h4 class="title mb-4">{{ setting('about_sec_title') }}</h4>
                        <p class="text-muted">We are the neighbors…..</p>
                        <p class="text-muted">
                            {!! setting('about_sec_detail') !!}
                            {{-- We Love to share our thought’s and vision with them we should talk about We Love to share our thought’s and vision with them how we can create a better community.<br>
                            How we can live better? How can we be more active? and yes We are working making a bridge. We will do it, for a beautiful world, we are here. <br>
                            We are Co-operating every way <br>
                            We like to hear from them <br>
                            We ask if they need help <br>
                            We join them to discuss <br>
                            We connect them to build a good neighborhood, we know we can be more stronger only when we are together and that’s why We need to communicate and this is the power <br> --}}
                        </p>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>

<section class="section">
    <div class="container">
        <div class="row align-items-center" id="counter">
            <div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="ms-lg-4">
                    <div class="section-title">
                        <h4 class="title mb-4">{{ setting('about_sec_title2') }}</h4>
                        <p class="text-muted">
                            <span class="text-primary fw-bold">Free shopps</span> {!! setting('about_sec_detail2') !!}
                        </p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-6">
                <img src="{{ asset(setting('about_us_image3')) }}" class="img-fluid" alt="">
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>

<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h6 class="text-primary">Work Process</h6>
                    <h4 class="title mb-4">How do we works ?</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Start using <span class="text-primary fw-bold">Freeshopps</span> , help others and get helped.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-md-4 mt-4 pt-2">
                <div class="card features feature-clean work-process bg-transparent process-arrow border-0 text-center">
                    <div class="icons text-primary text-center mx-auto">
                        <i class="uil uil-presentation-edit d-block rounded h3 mb-0"></i>
                    </div>

                    <div class="card-body">
                        <h5 class="text-dark">Create Account</h5>
                        <p class="text-muted mb-0">It’s important for us to communicate with you , your safety, security and privacy is our first priority, please make sure your information is accurate. We are always happy to answer your any questions you may have.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-4 mt-md-5 pt-md-3 mt-4 pt-2">
                <div class="card features feature-clean work-process bg-transparent process-arrow border-0 text-center">
                    <div class="icons text-primary text-center mx-auto">
                        <i class="uil uil-airplay d-block rounded h3 mb-0"></i>
                    </div>

                    <div class="card-body">
                        <h5 class="text-dark">List your Stuff</h5>
                        <p class="text-muted mb-0">We appreciate your support and can’t be successful without your participation, please encourage others as you posting yours together we always be more strong.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-4 mt-md-5 pt-md-5 mt-4 pt-2">
                <div class="card features feature-clean work-process bg-transparent d-none-arrow border-0 text-center">
                    <div class="icons text-primary text-center mx-auto">
                        <i class="uil uil-image-check d-block rounded h3 mb-0"></i>
                    </div>

                    <div class="card-body">
                        <h5 class="text-dark">Please Response</h5>
                        <p class="text-muted mb-0">Whenever any neighbor inquire your item we will notify you with a confirmation code which you will be matching with the person who will be picking the item , with your help and co-operation we can build an unique world community.</p>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
@endsection

