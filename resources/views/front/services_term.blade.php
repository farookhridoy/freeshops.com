@extends('layouts.front')

@section('title', 'Term of Services')

@section('content')

@include('front.components.pages_banner')


<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                      {!! setting('terms') !!}



                        {{-- <div class="mt-3">
                            <a href="javascript:void(0)" class="btn btn-primary mt-2 me-2">Accept</a>
                            <a href="javascript:void(0)" class="btn btn-outline-primary mt-2">Decline</a>
                        </div> --}}
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Terms & Conditions -->

@endsection

