 @foreach(CartP::content() as $row)
        @php
            $listing = App\Models\Listing::get_single($row->id);
        @endphp
     <div class="d-flex align-items-center mb-4">
        <img src="{{ asset($listing->featured_image) }}" class="shadow rounded" style="max-height: 64px;" alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">{{ $listing->title }}</h6>
            <small class="text-muted mb-0">{{ $listing->category->name }}</small>
        </div>
        {{-- <span data-id="{{ $item->id }}" class="d-inline-block text-danger cursor-pointer removeCart"><i data-feather="trash" class="icons"></i></span> --}}
    </div>
 @endforeach


{{-- 
@foreach ($cart as $item)

    <div class="d-flex align-items-center mb-4">
        <img src="{{ asset($item->listing->featured_image) }}" class="shadow rounded" style="max-height: 64px;" alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">{{ $item->listing->title }}</h6>
            <small class="text-muted mb-0">{{ $item->listing->category->name }}</small>
        </div> --}}
        {{-- <span data-id="{{ $item->id }}" class="d-inline-block text-danger cursor-pointer removeCart"><i data-feather="trash" class="icons"></i></span> --}}
    {{-- </div>
@endforeach --}}
