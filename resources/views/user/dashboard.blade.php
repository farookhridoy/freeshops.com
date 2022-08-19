@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<h5>Listings</h5>
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
        <div class="card shadow rounded border-0">
            <div class="card-body text-center">
                <i data-feather="list" class="fea icon-md icons"></i>
                <h5 class="mt-2 mb-0">{{ $active }}</h5>
                <p class="text-muted mb-0">Active</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
        <div class="card shadow rounded border-0">
            <div class="card-body text-center">
                <i data-feather="alert-circle" class="fea icon-md icons"></i>
                <h5 class="mt-2 mb-0">{{ $rejected }}</h5>
                <p class="text-muted mb-0">Rejected</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
        <div class="card shadow rounded border-0">
            <div class="card-body text-center">
                <i data-feather="clock" class="fea icon-md icons"></i>
                <h5 class="mt-2 mb-0">{{ $available }}</h5>
                <p class="text-muted mb-0">Available</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
        <div class="card shadow rounded border-0">
            <div class="card-body text-center">
                <i data-feather="check-circle" class="fea icon-md icons"></i>
                <h5 class="mt-2 mb-0">{{ $sold }}</h5>
                <p class="text-muted mb-0">Sold</p>
            </div>
        </div>
    </div>
</div>

@if(count($orders_placed_review) > 0)
    <div class="border-bottom pb-4 mb-4">
        <h5>In Review Orders Placed</h5>

        @foreach ($orders_placed_review as $item)
            <div class="d-flex key-feature align-items-center p-3 rounded shadow mt-4">
                <img src="{{ asset($item->listing->featured_image) }}" class="avatar rounded-circle" width="60px" alt="">
                <div class="flex-1 content ms-3">
                    <small class="text-muted mb-0 font-10">{{ $item->listing->location }}</small>
                    <h4 class="title mb-0">{{ $item->listing->title }}</h4>
                </div>
                <div class="flex-2 content ms-3">
                    <small class="text-muted mb-0 font-10">Order No:</small>
                    <h4 class="title mb-0">#{{ $item->order_no }}</h4>
                </div>
                <div class="flex-3 content ms-3">
                    <span class="badge rounded-pill bg-soft-warning me-2 mt-2">In Review</span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@if(count($orders_receive_review) > 0)
    <div class="border-bottom pb-4 mb-4">
        <h5>In Review Orders Received</h5>

        @foreach ($orders_receive_review as $item)
            <div class="d-flex flex-md-row flex-column key-feature align-items-center p-3 rounded shadow mt-4">
                <img src="{{ asset($item->listing->featured_image) }}" class="avatar rounded-circle" width="60px" alt="">
                <div class="flex-1 content ms-3">
                    <small class="text-muted mb-0 font-10">{{ $item->listing->location }}</small>
                    <h4 class="title mb-0 text-md-start text-center">{{ $item->listing->title }}</h4>
                </div>
                <div class="flex-2 content ms-3">
                    <small class="text-muted mb-0 font-10">Order No:</small>
                    <h4 class="title mb-0">#{{ $item->order_no }}</h4>
                </div>
                <div class="flex-3 content ms-3">
                    <span class="badge rounded-pill bg-soft-warning me-2 mt-2">In Review</span>
                    <a href="{{ route('user.order', $item->order_no) }}" class="btn btn-secondary btn-sm">View</a>
                </div>
            </div>
        @endforeach
    </div>
@endif

@if (count($orders_placed) > 0 || count($orders_receive) > 0)
    @if (count($orders_placed) > 0)
    <div class="border-bottom pb-4 mb-4">
        <h5>Active Orders Placed</h5>

        @foreach ($orders_placed as $item)
            <div class="d-flex key-feature align-items-center p-3 rounded shadow mt-4">
                <img src="{{ asset($item->listing->featured_image) }}" class="avatar rounded-circle" width="60px" alt="">
                <div class="flex-1 content ms-3">
                    <small class="text-muted mb-0 font-10">{{ $item->listing->location }}</small>
                    <h4 class="title mb-0">{{ $item->listing->title }}</h4>
                </div>
                <div class="flex-2 content ms-3">
                    <small class="text-muted mb-0 font-10">Order No:</small>
                    <h4 class="title mb-0">#{{ $item->order_no }}</h4>
                </div>
                <div class="flex-3 content ms-3">
                    <a href="{{ route('user.chat') }}?active={{ $item->listing->user->id }}" class="btn btn-primary btn-sm"><i data-feather="message-circle" class="fea icon-sm icons"></i> Message</a>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    @if (count($orders_receive) > 0)
    <div class="border-bottom pb-4 mb-4">
        <h5>Active Orders Received</h5>

        @foreach ($orders_receive as $item)
            <div class="d-flex flex-md-row flex-column key-feature align-items-center p-3 rounded shadow mt-4">
                <img src="{{ asset($item->listing->featured_image) }}" class="avatar rounded-circle" width="60px" alt="">
                <div class="flex-1 content ms-3">
                    <small class="text-muted mb-0 font-10">{{ $item->listing->location }}</small>
                    <h4 class="title mb-0 text-md-start text-center">{{ $item->listing->title }}</h4>
                </div>
                <div class="flex-2 content ms-3">
                    <small class="text-muted mb-0 font-10">Order No:</small>
                    <h4 class="title mb-0">#{{ $item->order_no }}</h4>
                </div>
                <div class="flex-3 content ms-3">
                    <a href="{{ route('user.chat') }}?active={{ $item->transaction->user->id }}" class="btn btn-primary btn-sm"><i data-feather="message-circle" class="fea icon-sm icons"></i> Message</a>
                    <a href="{{ route('user.order', $item->order_no) }}" class="btn btn-secondary btn-sm">View</a>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@else
    <div class="row">
        <div class="col-12 mt-4 pt-2">
            <div class="text-center">
                <img src="{{ asset('no-data.jpg') }}" class="img-fluid" width="280px" alt="No Data Found">
                <h4 class="mt-2 font-bold">No Active Orders</h4>

                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Browse</a>
            </div>
        </div>
    </div>
@endif

@endsection
