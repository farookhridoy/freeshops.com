@extends('layouts.front')

@section('title', 'FAQs')

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
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <h5 class="card-title">Frequently Asked Questions</h5>
                        <div class="accordion mt-4 pt-2" id="payquestion">
                            <div class="accordion-item rounded">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                       {{ setting('faq_title') }}
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse border-0 collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#payquestion">
                                    <div class="accordion-body text-muted bg-white">
                                        {!! setting('faq_text') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item rounded">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button border-0 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="true" aria-controls="collapseTwo">
                                       {{ setting('faq_title2') }}
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse border-0 collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#payquestion">
                                    <div class="accordion-body text-muted bg-white">
                                       {!! setting('faq_text2') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Terms & Conditions -->

@endsection

