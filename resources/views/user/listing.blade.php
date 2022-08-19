@extends('layouts.user')

@section('title', 'My Listings')

@section('content')
<div class="row">
    @if(count($listings) > 0)
        @foreach ($listings as $item)
            <div class="col-12 mt-4 pt-2">
                <div class="card shop-list border-0 shadow position-relative">
                    <div class="row align-items-center g-0">
                        <div class="col-lg-4 col-md-6">
                            <div class="shop-image position-relative overflow-hidden">
                                <a href="{{ route('listing', $item->slug) }}"><img src="{{ asset($item->featured_image) }}" class="img-fluid" alt=""></a>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-8 col-md-6">
                            <div class="card-body content p-4">
                                <a href="{{ route('listing', $item->slug) }}" class="text-dark product-name h6">{{ $item->title }}</a>
                                <div class="align-items-center mt-2 mb-3">
                                    <small class="text-muted d-block"><i class="mdi mdi-clock"></i>{{ $item->created_at->format('d M, Y H:i a') }} </small>
                                    <small class="text-muted d-block"><i class="mdi mdi-map-marker"></i>{{ $item->location }} </small>
                                </div>
                                <p class="para-desc text-muted mb-1">
                                    <strong>Status:</strong>
                                    @if ($item->status == "1")
                                        <span class="badge rounded-pill bg-soft-warning me-2 mt-2">In Review</span>
                                    @elseif ($item->status == "2")
                                        <span class="badge rounded-pill bg-soft-success me-2 mt-2">Published</span>
                                    @elseif ($item->status == "3")
                                        <span class="badge rounded-pill bg-soft-danger me-2 mt-2">Rejected</span>
                                    @endif
                                </p>
                                <p class="para-desc text-muted mb-1">
                                    <strong>Avalablity:</strong>
                                    @if ($item->availablity == "1")
                                        <span class="badge rounded-pill bg-soft-success me-2 mt-2">Available</span>
                                    @elseif ($item->availablity == "2")
                                        <span class="badge rounded-pill bg-soft-warning me-2 mt-2">Sold</span>
                                    @endif
                                </p>

                                <a href="{{ route('user.listings.edit', $item->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                <button type="button" onclick="deleteAlert('{{ route('user.listings.delete', $item->id) }}')" class="btn btn-danger btn-sm">Delete</button>
                                @if ($item->availablity == "1")
                                    <a href="" class="btn btn-warning btn-sm">Mark as Sold</a>
                                @endif
                            </div>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end blog post-->
            </div><!--end col-->
        @endforeach
    @else
        <div class="col-12 mt-4 pt-2">
            <div class="text-center">
                <img src="{{ asset('no-data.jpg') }}" class="img-fluid" width="280px" alt="No Data Found">
                <h4 class="mt-2 font-bold">No Listings Found</h4>

                <a href="{{ route('post.ad') }}" class="btn btn-primary mt-3">Post an Ad</a>
            </div>
        </div>
    @endif
</div>
@endsection
