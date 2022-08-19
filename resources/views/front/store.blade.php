@extends('layouts.front')
@section('title', $store->name)

@section('content')
<section class="bg-half-260 d-table w-100" style="background: url('{{ asset($store->banner) }}') center center;">
    <div class="bg-overlay"></div>
</section><!--end section-->

<!-- Store Detail Start -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-12">
                <div class="job-profile position-relative">
                    <div class="rounded shadow bg-white">
                        <div class="text-center py-5 border-bottom">
                            <img src="{{ asset($store->logo) }}" class="avatar avatar-medium mx-auto rounded-circle d-block" alt="">
                            <h5 class="mt-3 mb-0">{{ $store->name }}</h5>
                            <p class="text-muted mb-0">{{ $store->tagline }}</p>
                        </div>

                        <div class="p-4">
                            <h5>Store Details :</h5>
                            <ul class="list-unstyled mb-4">
                                <li class="h6"><i data-feather="clock" class="fea icon-sm text-warning me-3"></i><span class="text-muted">Member Since :</span> {{ $store->created_at->format('d M, Y') }}</li>
                                <li class="h6"><i data-feather="mail" class="fea icon-sm text-warning me-3"></i><span class="text-muted">Email :</span> {{ $store->email }}</li>
                                <li class="h6"><i data-feather="map-pin" class="fea icon-sm text-warning me-3"></i><span class="text-muted">Location :</span> {{ $store->location }}</li>
                                <li class="h6"><i data-feather="link" class="fea icon-sm text-warning me-3"></i><span class="text-muted">Website :</span> {{ $store->website }}</li>
                                <li class="h6"><i data-feather="phone" class="fea icon-sm text-warning me-3"></i><span class="text-muted">Mobile :</span> {{ $store->phone }}</li>
                                <li>
                                    <ul class="list-unstyled social-icon mb-0 mt-4">
                                        @if(!is_null($store->facebook))
                                        <li class="list-inline-item"><a href="{{ $store->facebook }}" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                                        @endif
                                        @if(!is_null($store->instagram))
                                        <li class="list-inline-item"><a href="{{ $store->instagram }}" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                                        @endif
                                        @if(!is_null($store->twitter))
                                        <li class="list-inline-item"><a href="{{ $store->twitter }}" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                                        @endif
                                        @if(!is_null($store->linkedin))
                                        <li class="list-inline-item"><a href="{{ $store->linkedin }}" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                                        @endif
                                        @if(!is_null($store->youtube))
                                        <li class="list-inline-item"><a href="{{ $store->youtube }}" class="rounded"><i data-feather="youtube" class="fea icon-sm fea-social"></i></a></li>
                                        @endif
                                    </ul><!--end icon-->
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="rounded shadow bg-white mt-4">
                        <div class="p-4">
                            <h5>Store Schedule :</h5>
                            @foreach ($store->store_schedules as $sc)
                                <div class="row mt-2">
                                    <div class="col-6"><p><small>{{ $sc->day }}</small></p></div>
                                    @if ($sc->is_closed == 0)
                                        <div class="col-6"><p><small>Closed</small></p></div>
                                    @elseif($sc->is_24 == 1)
                                        <div class="col-6"><p><small>Open 24h</small></p></div>
                                    @else
                                        <div class="col-6"><p><small>{{ $sc->opening_time }} - {{ $sc->closing_time }}</small></p></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="map mt-4 pt-2">
                        <div id="map"></div>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-8 col-md-7 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="ms-md-4">
                    <h4>Description :</h4>
                    <p class="text-muted">{{ $store->description }}</p>

                </div>

                @if (count($listings) > 0)
                    <div class="ms-md-4">
                        <h4>Listing :</h4>

                        <div class="row">
                            @foreach ($listings as $item)
                                <div class="col-lg-4 col-md-4 col-sm-4 col-6 mt-3">
                                    <div class="card shop-list border-0 position-relative">
                                        <ul class="label list-unstyled mb-0">
                                            <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-success">New</a></li>
                                        </ul>
                                        <div class="shop-image position-relative overflow-hidden rounded shadow">
                                            <a href="{{ route('listing', $item->slug) }}"><img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""></a>
                                            <ul class="list-unstyled shop-icons">
                                                <li><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>
                                                <li class="mt-2"><a href="javascript:void(0)" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body content p-2">
                                            <small class="text-muted d-block font-12">{{ $item->category->name }}</small>
                                            <a href="{{ route('listing', $item->slug) }}" class="text-dark product-name h5">{{ \Str::limit($item->title, 20, '...') }}</a>
                                            <p class="text-muted font-14"><i data-feather="map-pin" class="fea icon-sm"> </i> {{ $item->location }}</p>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            @endforeach
                        </div>
                    </div>
                @endif
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
@endsection

@section('js')
    <script>
        let lat = <?php echo  $store->location_lat; ?>;
        let lng = <?php echo  $store->location_long; ?>;
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
