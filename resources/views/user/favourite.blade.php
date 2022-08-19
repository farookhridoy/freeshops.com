@extends('layouts.user')

@section('title', 'Favourites')

@section('content')
<div class="row">
    @if(count($favourites) > 0)
        @foreach ($favourites as $item)
            <div class="col-lg-4 col-md-4 col-sm-6 col-6 pt-2">
                <div class="card shop-list border-0 position-relative">
                    @if ($item->availablity == "2")
                        <ul class="label list-unstyled mb-0">
                            <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-primary">Sold</a></li>
                        </ul>
                    @endif
                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                        <a href="{{ route('listing', $item->listing->slug) }}"><img src="{{ asset($item->listing->featured_image) }}" class="img-fluid" alt=""></a>
                        <ul class="list-unstyled shop-icons">
                            <li><a href="{{ route('remove.fav', $item->id) }}" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="trash" class="icons"></i></a></li>
                            @auth
                                <li class="mt-2"><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-icon btn-pills btn-soft-danger {{ checkFav($item->listing->id) ? 'active' : 'addFav' }}"><i data-feather="heart" class="icons"></i></a></li>
                                <li class="mt-2"><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                            @else
                                <li class="mt-2"><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>
                                <li class="mt-2"><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="card-body content p-2">
                        <small class="text-muted d-block font-12">{{ $item->listing->category->name }}</small>
                        <a href="{{ route('listing', $item->slug) }}" class="text-dark product-name h5">{{ \Str::limit($item->listing->title, 20, '...') }}</a>
                        <p class="text-muted font-14"><i data-feather="map-pin" class="fea icon-sm"> </i> {{ $item->listing->location }}</p>
                    </div>
                </div>
            </div><!--end col-->
        @endforeach
    @else
        <div class="col-12 mt-4 pt-2">
            <div class="text-center">
                <img src="{{ asset('no-data.jpg') }}" class="img-fluid" width="280px" alt="No Data Found">
                <h4 class="mt-2 font-bold">No Items in Favourites</h4>

                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Browse</a>
            </div>
        </div>
    @endif
</div>
@endsection
