@extends('layouts.front')

@section('title', 'Join With Us')

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
        <div class="row">
            <div class="col-6 offset-md-3">
                <form class="p-4 forget" action="{{ route('verify.otp') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-center">
                                <strong>Verify your phone number</strong>.<br> Enter the 6 digit you received. 
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Code <span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                    <input type="number" class="form-control ps-5" placeholder="code"
                                    name="otp_verify_code">
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12 mb-0">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Verify</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

