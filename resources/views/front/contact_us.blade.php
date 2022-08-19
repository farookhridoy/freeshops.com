@extends('layouts.front')

@section('title', 'Contact Us')

@section('css')
    <style>
        .section {
            padding: 60px 0px;
        }
    </style>
@endsection

@section('content')

@include('front.components.pages_banner')

@if(session('success'))
    <div class="container mt-5"  style="margin-bottom: -3%">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-success text-center">Your message has been sent!</h3>
            </div>
        </div>
    </div>
@endif
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <div class="card-body py-5">
                            <h4 class="card-title">Get In Touch !</h4>
                            <div class="custom-form mt-3">
                                <form method="post" name="myForm" action="{{ route('contact.save') }}" >
                                    @csrf
                                    <p id="error-msg" class="mb-0"></p>
                                    <div id="simple-msg"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input name="name" id="name" type="text" required class="form-control ps-5" placeholder="Name :">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input name="email" id="email" type="email" required class="form-control ps-5" placeholder="Email :">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Subject</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="book" class="fea icon-sm icons"></i>
                                                    <input name="subject" id="subject" required class="form-control ps-5" placeholder="subject :">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Comments <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="message-circle" class="fea icon-sm icons clearfix"></i>
                                                    <textarea name="comment" id="comments" required rows="4" class="form-control ps-5" placeholder="Message :"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div><!--end custom-form-->
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Terms & Conditions -->

@endsection

