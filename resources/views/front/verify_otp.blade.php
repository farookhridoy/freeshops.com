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
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center">
                            <div class="alert alert-outline-primary d-flex" role="alert">
                                <span class="alert-content m-auto flex-1"><i data-feather="alert-triangle" width="20px" height="20px" class="icons text-danger"></i> 
                                    <strong class="ms-2">We take your privacy seriously, just want to make sure this is you , please check your email and click on the link below to verify and complete the sign in process.</strong> </span>
                                </div>
                            </p>
                            @if(auth()->user())
                            <p class="text-center">
                               <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-primary rounded">Logout</a>  
                               <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form> 
                           </p>
                           @endif
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>


   @endsection

