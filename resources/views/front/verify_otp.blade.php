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
                {{-- <form class="p-4 forget" action="{{ route('verify.otp') }}" method="POST">
                    @csrf --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-center">
                                <div class="alert alert-outline-primary d-flex" role="alert">
                                <span class="alert-content m-auto flex-1"><i data-feather="alert-triangle" width="20px" height="20px" class="icons text-danger"></i> 
                                <strong class="ms-2">We take your privacy seriously, just want to make sure this is you , please check your email and click on the link below to verify and complete the sign in process.</strong> </span>
                            </div>
                            </p>
                        </div>
                        {{-- <div class="col-lg-12">
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
                        </div><!--end col--> --}}
                    </div><!--end row-->
                {{-- </form> --}}
            </div>
        </div>
    </div>
</section>
@endsection

