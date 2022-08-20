@extends('layouts.front')
@section('title', 'Checkout')

@section('css')
<style>
    /*.StripeElement {*/
    /*    box-sizing: border-box;*/
    /*    height: 40px;*/
    /*    padding: 12px 15px;*/
    /*    border: 1px solid #dee2e6;*/
    /*    height: 43px;*/
    /*    border-radius: .25rem;*/
    /*}*/
    /*.StripeElement--invalid {*/
    /*    border-color: #fa755a;*/
    /*}*/
    /*.StripeElement--webkit-autofill {*/
    /*    background-color: #fefde5 !important;*/
    /*}*/
    #card-errors{
        color: #fa755a;
    }
    .error_form {
         color: red;
    }
</style>
@endsection

@section('content')

@include('front.components.pages_banner')
<!-- Start -->
<div class="modal fade" id="detailModal" tabindex="-1"  role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Cart Detail</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>

                <div class="modal-body blog-details">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive bg-white shadow">
                                <table class="table table-center table-padding mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom py-3" style="min-width:20px "></th>
                                            <th class="border-bottom py-3" style="min-width: 300px;">Product</th>
                                            <th class="border-bottom text-center py-3" style="min-width: 160px;">Processing Fee</th>
                                            <th class="border-bottom text-center py-3" style="min-width: 160px;">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach(CartP::content() as $row)
                                            @php
                                                $listing = App\Models\Listing::get_single($row->id);
                                            @endphp
                                            <tr class="shop-list">
                                                <td class="h6"><a href="{{ route('remove.cart', $row->rowId) }}" class="text-danger">X</a></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($listing->featured_image) }}" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;" alt="">
                                                        <h6 class="mb-0 ms-3">{{ $listing->title }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-center">${{ $row->price }}</td>
                                                <td class="text-center fw-bold">${{ $row->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="rounded shadow-lg p-4 sticky-bar">
                    <div class="d-flex mb-4 justify-content-between">
                        <h5>{{ CartP::count() }} Items</h5>
                        <a class="text-muted h6" style="cursor: pointer" onclick="$('#detailModal').modal('show')">Show Details</a>
                        {{--   <a href="{{ route('cart') }}" class="text-muted h6">Show Details</a> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-center table-padding mb-3">
                            <tbody>
                                <tr>
                                    <td class="h6 border-0">Subtotal</td>
                                    <td class="text-end fw-bold border-0">${{ CartP::subtotal() }}</td>
                                </tr>
                                <tr class="bg-light">
                                    <td class="h5 fw-bold">Total</td>
                                    <td class="text-end text-primary h4 fw-bold">${{ CartP::subtotal() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        @if (isset($req->customer_id))
                            <div class="text-center justify-content-center">
                                <img src="{{ asset('processing.gif') }}" width="180px" class="img-fluid" alt="">
                                <h1 class="mt-3" id="processing-heading">Processing</h1>
                                <p id="processing-text">Please Wait</p>
                            </div>
                        @else
                            <form id="payment-form">
                            @csrf
                            @if(empty(Auth::check()))
                                <input type="text" class="form-control" required name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="off">
                                <div class="error_form">{{$errors->first('name')}}</div>
                                 <div class="mt-3"></div>
                                <input type="email" class="form-control" required name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                                <div class="error_form">{{$errors->first('email')}}</div>
                                <div class="mt-3"></div>
                                <input type="password" class="form-control" required name="password" value="" placeholder="Password" autocomplete="off">
                                <div class="error_form">{{$errors->first('password')}}</div>
                                <div class="mt-3"></div>
                                <hr>
                            @endif 

                            <input id="c_name" type="text" class="form-control mb-3" name="c_name" value="{{ (Auth::user()->name)?Auth::user()->name:old('c_name') }}" placeholder="Card Holder Name" autocomplete="off">
                            <input type="email" id="c_email" class="form-control" required name="c_email" value="{{ (Auth::user()->email)?Auth::user()->email:old('c_email') }}" placeholder="Card Holder Email" autocomplete="off">
                            <div id="stripe-element" class="mt-3"></div>
                            <div id="card-errors" role="alert"></div>
                            <div class="mt-4 pt-2">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" id="purchase-btn">
                                        <span class="spinner-border spinner-border-sm align-middle d-none" id="spinner"></span>
                                        <span id="button-text">Place Order</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
@endsection
@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('theme/js/checkout.js') }}" STRIPE_PUBLISHABLE_KEY="pk_live_51JzVL8DjSoojJtxhbV404PLsFP8MtokrnkWJkJKJJZZ1rAjuBsxn5jApJsudsGMRbcm0ILDffGUcZisH5oWGORSd00JpHDgWxm" defer></script>
    {{-- <script src="{{ asset('theme/js/checkout.js') }}" STRIPE_PUBLISHABLE_KEY="pk_test_51GsRHaFIQnHdLDIGTLSqcVcu8KCJxuLOsA5xpBDiBaz9OU3fsIvud4kJYKtr78qT3qv7IcDuFjWhjF7pWFLyShOf009Nm67zCP" defer></script> --}}

@endsection
