@extends('layouts.front')
@section('title', 'Thank You')


@section('content')

<section class="section pt-5">
    <div class="container mt-lg-3">
        <div class="row">
            <div class="col-lg-12 col-12 justify-center text-center m-auto">
                <div class="mt-5">
                    <img src="{{ asset('thumbs-up.png') }}" style="width:256px;" class="form-control border-0 m-auto" alt="">

                    <h2 class="mt-3">Thank you for participating in growing up this community</h2>
                    @if (auth()->check())
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                    @endif
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
@endsection
