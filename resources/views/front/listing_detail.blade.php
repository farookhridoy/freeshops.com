@extends('layouts.front')
@section('title', $listing->title)


@section('content')

@include('front.components.pages_banner')

<section class="section pt-5 pb-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="tiny-single-item">
                    @foreach ($listing->listing_images as $item)
                        <div class="tiny-slide"><img src="{{ asset($item->path) }}" class="img-fluid rounded" alt=""></div>
                    @endforeach
                </div>
            </div><!--end col-->

            <div class="col-md-7 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title ms-md-4">
                    <h4 class="title">{{ $listing->title }}</h4>
                    <small class="text-muted d-block"><i class="mdi mdi-clock"></i> {{ $listing->created_at->format('M d, Y H:i a') }} </small>
                    <small class="text-muted d-block"><i class="mdi mdi-map-marker"></i> {{ $listing->location }} </small>
                    <ul class="list-unstyled text-warning h5 mb-0">
                        <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                    </ul>

                    <h5 class="mt-4 py-2">Description :</h5>
                    {!! $listing->description !!}
                    @if($listing->availablity == '1')
                        <div class="mt-4 pt-2">
                           @auth
                                <a  class="btn btn-soft-primary ms-2 addCart" data-id="{{ $listing->id }}">Add to Cart</a>
                            @else
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-soft-primary ms-2">Add to Cart</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>



<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mt-4">
                    <h4>Location</h4>
                </div>
                <div id="map"></div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
    <script>
        let lat = <?php echo  $listing->location_lat; ?>;
        let lng = <?php echo  $listing->location_long; ?>;
        function initMap() {
            // The location of Uluru
            const uluru = { lat: lat, lng: lng };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
@endsection
