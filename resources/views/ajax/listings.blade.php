@foreach ($listings as $item)
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-4 pt-2">
        <div class="card shop-list border-0 position-relative">
            @if ($item->availablity == "2")
                <ul class="label list-unstyled mb-0">
                    <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-primary">Sold</a></li>
                </ul>
            @endif
            <div class="shop-image position-relative overflow-hidden rounded shadow">
                <a href="{{ route('listing', $item->slug) }}"><img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""></a>
                @if ($item->availablity == "1")
                    <ul class="list-unstyled shop-icons">
                        @auth
                            <li><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-icon btn-pills btn-soft-danger {{ checkFav($item->id) ? 'active' : 'addFav' }}"><i data-feather="heart" class="icons"></i></a></li>
                            <li class="mt-2"><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-icon btn-pills btn-soft-warning {{ checkCart($item->id) ? 'active' : 'addCart' }}"><i data-feather="shopping-cart" class="icons"></i></a></li>
                        @else
                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>
                            <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>
                        @endauth
                    </ul>
                @endif
            </div>
            <div class="card-body content p-2">
                <small class="text-muted d-block font-12">{{ $item->category->name }}</small>
                <a href="{{ route('listing', $item->slug) }}" class="text-dark text-capitalize product-name h5">{{ \Str::limit($item->title, 15, '...') }}</a>
                <p class="text-muted font-14"><i data-feather="map-pin" class="fea icon-sm"> </i> {{ $item->location }}</p>
            </div>
        </div>
    </div><!--end col-->
@endforeach
