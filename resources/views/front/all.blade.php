@extends('layouts.front')
@section('title', $category->name ?? 'All Listings')


@section('content')

@include('front.components.pages_banner')

<!-- Start Products -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card border-0 sidebar sticky-bar">
                    <div class="card-body p-0">

                        <!-- Categories -->
                        <div class="widget mt-4 pt-2">
                            <h5 class="widget-title">Categories</h5>
                            <ul class="list-unstyled mt-4 mb-0 blog-categories">
                                @foreach ($cats as $item)
                                    <li><a data-slug="{{ $item->slug }}" href="{{ route('all') }}?category={{ $item->slug }}" class="cat-item">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Categories -->
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-9 col-md-8 col-12 mt-5 pt-2 mt-sm-0 pt-sm-0">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-md-8">
                        <div class="section-title">
                            <h5 class="mb-0">Showing 1–{{ $listings->count() }} of {{ $listings->total() }} results</h5>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-3 col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="justify-content-md-between align-items-center">
                            <div class="form custom-form">
                                <div class="mb-0">
                                    <select class="form-select form-control" name="sorting" aria-label="Default select example" id="Sortbylist-job">
                                        <option value="latest" {{ !isset($req->sort) || $req->sort == "latest" ? 'selected' : '' }}>Sort by latest</option>
                                        <option value="oldest" {{ $req->sort == "oldest" ? 'selected' : '' }}>Sort by oldest</option>
                                        <option value="title_asc" {{ $req->sort == "title_asc" ? 'selected' : '' }}>Sort by title: A to Z</option>
                                        <option value="title_desc" {{ $req->sort == "title_desc" ? 'selected' : '' }}>Sort by title: Z to A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    @foreach ($listings as $item)
                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                @if ($item->availablity == "2")
                                    <ul class="label list-unstyled mb-0">
                                        <li><a href="javascript:void(0)" class="badge badge-link rounded-pill bg-primary">Sold</a></li>
                                    </ul>
                                @endif
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('listing', $item->slug) }}"><img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""></a>
                                    <ul class="list-unstyled shop-icons">
                                        @auth
                                            <li><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-icon btn-pills btn-soft-danger {{ checkFav($item->id) ? 'active' : 'addFav' }}"><i data-feather="heart" class="icons"></i></a></li>
                                         {{--    <li class="mt-2"><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-icon btn-pills btn-soft-warning {{ checkCart($item->id) ? 'active' : 'addCart' }}"><i data-feather="shopping-cart" class="icons"></i></a></li> --}}
                                        @else
                                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart" class="icons"></i></a></li>

                                            {{-- <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accountModal" class="btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li> --}}
                                        @endauth

                                           <li class="mt-2"><a href="javascript:void(0)" data-id="{{ $item->id }}" class="addCart btn btn-icon btn-pills btn-soft-warning"><i data-feather="shopping-cart" class="icons"></i></a></li>

                                    </ul>
                                </div>
                                <div class="card-body content p-2">
                                    <small class="text-muted d-block font-12">{{ $item->category->name }}</small>
                                    <a href="{{ route('listing', $item->slug) }}" class="text-dark text-capitalize product-name h5">{{ \Str::limit($item->title, 15, '...') }}</a>
                                    <p class="text-muted font-14"><i data-feather="map-pin" class="fea icon-sm"> </i> {{ $item->location }}</p>
                                </div>
                            </div>
                        </div><!--end col-->
                    @endforeach

                    <!-- PAGINATION START -->
                    <!--<div class="col-12 mt-4 pt-2">-->
                    <!--    {{ $listings->appends(request()->query())->links() }}-->
                    <!--</div><!--end col-->-->
                    <!-- PAGINATION END -->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Products -->
@endsection
