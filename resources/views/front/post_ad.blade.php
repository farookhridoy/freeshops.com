@extends('layouts.front')
@section('title', 'Post Ad')


@section('content')

@include('front.components.pages_banner')

<section class="section pt-5">
    <div class="container mt-lg-3">
        <div class="row">
            <div class="col-lg-12 col-12">
                <form action="{{ route('post.ad.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card border-0 rounded shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h5><i data-feather="tag" class="fea icon-sm icons"></i> Category :</h5>
                                    <div class="form-group mb-3">
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="" disabled selected>Select Option</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <h5><i data-feather="info" class="fea icon-sm icons"></i> Product Information :</h5>
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ old('title') }}" autocomplete="off">
                                        @error('title')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-3 img-div">
                                    <h5><i data-feather="image" class="fea icon-sm icons"></i> Images :</h5>

                                    <small class="d-block">Recommended image size to (870x493px)</small>
                                    <small class="d-block">Image maximum size 3 MB</small>
                                    <small class="d-block">Allowed image type (png, jpg, jpeg)</small>
                                    <small class="d-block">You can upload up to 5 images</small>
                                    <input type="file" name="images" class="form-control @error('images') is-invalid @enderror">
                                    @error('images')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <h5><i data-feather="link-2" class="fea icon-sm icons"></i> Video URL :</h5>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="Only YouTube & Vimeo URL" autocomplete="off">
                                        @error('video_url')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <h5><i data-feather="user" class="fea icon-sm icons"></i> Contact Details :</h5>
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone no" autocomplete="off">
                                        @error('phone')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        @if (auth()->check())
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Name" autocomplete="off">
                                        @else
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="off">
                                        @endif
                                        @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        @if (auth()->check())
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Email" autocomplete="off">
                                        @else
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="off">
                                        @endif
                                        @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="Select Location" autocomplete="off">
                                        @error('location')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="hidden" name="location_lat" id="location_lat" value="{{ old('location_lat') }}">
                                        <input type="hidden" name="location_long" id="location_long" value="{{ old('location_long') }}">
                                    </div>
                                    <div id="map"></div>
                                    <div id="infowindow-content">
                                        <span id="place-name" class="title"></span><br />
                                        <span id="place-address"></span>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="show_map" name="show_map">
                                        <label class="form-check-label" for="show_map">Don't show map</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="agree_terms" name="agree_terms">
                                        <label class="form-check-label" for="agree_terms">I have read and agree to the website <a href="">Terms & Conditions</a>.</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary submit-btn" disabled>Submit Ad</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });

            $('input[name="images"]').fileuploader({
                limit: 5,
                // fileMaxSize: 3,
                extensions: ['jpg', 'jpeg', 'png',],
                addMore: true
            });

            $("#agree_terms").change(function (e) {
                e.preventDefault();
                let elm = $(this);

                if ($(this).is(':checked')) {
                    $(".submit-btn").prop('disabled', false);
                } else {
                    $(".submit-btn").prop('disabled', true);
                }
            });
        });

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 40.749933, lng: -73.98633 },
                zoom: 13,
            });
            const input = document.getElementById("location");
            const options = {
                componentRestrictions: { country: "us" },
                // fields: ["formatted_address", "geometry", "name"],
                // strictBounds: false,
                types: ["geocode"],
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo("bounds", map);
            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");
            infowindow.setContent(infowindowContent);
            const marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
            });
            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                console.log(place);

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                document.getElementById('location_lat').value = place.geometry.location.lat();
                document.getElementById('location_long').value = place.geometry.location.lng();
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent =
                place.formatted_address;
                infowindow.open(map, marker);
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                const radioButton = document.getElementById(id);
                radioButton.addEventListener("click", () => {
                    autocomplete.setTypes(types);
                    input.value = "";
                });
            }
        }
    </script>
@endsection
