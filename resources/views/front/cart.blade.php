@extends('layouts.front')
@section('title', 'Cart')


@section('content')

@include('front.components.pages_banner')

<section class="section">
    <div class="container">
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
        <div class="row">
            <div class="col-lg-8 col-md-6 mt-4 pt-2">
                <a href="{{ route('home') }}" class="btn btn-primary">Shop More</a>
            </div>
            <div class="col-lg-4 col-md-6 ms-auto mt-4 pt-2">
                <div class="table-responsive bg-white rounded shadow">
                    <table class="table table-center table-padding mb-0">
                        <tbody>
                            <tr class="bg-light">
                                <td class="h6">Total</td>
                                <td class="text-center fw-bold">${{ number_format(CartP::subtotal(), 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-2 text-end">
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to checkout</a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
@endsection
