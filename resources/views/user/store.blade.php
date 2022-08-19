@extends('layouts.user')

@section('title', 'Store Settings')

@section('content')
<div class="card border-0 rounded shadow">
    <div class="card-body">
        <h5>Store Images :</h5>

        <div class="mt-3 d-sm-flex">
            <img src="{{ asset($store->logo ?? 'logo.png') }}" id="logo-img" class="avatar float-md-left avatar-medium rounded-circle shadow me-md-4" alt="">

            <div class="mt-md-4 mt-3 mt-sm-0">
                <form action="" method="POST" id="logo-form" enctype="multipart/form-data">
                    @csrf
                    <label for="logo" class="btn btn-primary mt-2">Change Logo</label>
                    <input type="file" id="logo" name="logo" hidden>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12">
                <form action="" method="POST" id="banner-form" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label">Banner</label>
                    <input type="file" id="banner" name="banner" data-default-file="{{ asset($store->banner ?? 'freeshopps-banner.png') }}" class="dropify">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0">Store Information :</h5>
    </div>

    <div class="p-4">
        <form action="{{ route('user.store.information') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="form-icon position-relative">
                            <i data-feather="user" class="fea icon-sm icons"></i>
                            <input name="name" value="{{ $store->name }}" id="name" type="text" class="form-control ps-5 @error('name') is-invalid @enderror" placeholder="Name :" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <div class="form-icon position-relative">
                            <i data-feather="link" class="fea icon-sm icons"></i>
                            <input name="slug" value="{{ $store->slug }}" id="slug" type="text" class="form-control ps-5 @error('slug') is-invalid @enderror" placeholder="Slug : " autocomplete="off" readonly>
                            @error('slug')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Tagline</label>
                        <div class="form-icon position-relative">
                            <i data-feather="anchor" class="fea icon-sm icons"></i>
                            <input name="tagline" value="{{ $store->tagline }}" id="tagline" type="text" class="form-control ps-5 @error('tagline') is-invalid @enderror" placeholder="Tagline : " autocomplete="off">
                            @error('tagline')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="form-icon position-relative">
                            <i data-feather="mail" class="fea icon-sm icons"></i>
                            <input name="email" value="{{ $store->email }}" id="email" type="email" class="form-control ps-5 @error('name') is-invalid @enderror" placeholder="Email :" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <div class="form-icon position-relative">
                            <i data-feather="phone" class="fea icon-sm icons"></i>
                            <input name="phone" value="{{ $store->phone }}" id="phone" type="text" class="form-control ps-5 @error('phone') is-invalid @enderror" placeholder="Phone :" autocomplete="off">
                            @error('phone')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <div class="form-icon position-relative">
                            <i data-feather="globe" class="fea icon-sm icons"></i>
                            <input name="website" value="{{ $store->website }}" id="website" type="text" class="form-control ps-5 @error('website') is-invalid @enderror" placeholder="Website :" autocomplete="off">
                            @error('website')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div class="form-icon position-relative">
                            <i data-feather="message-circle" class="fea icon-sm icons"></i>
                            <textarea name="description" id="description" rows="4" class="form-control ps-5 @error('description') is-invalid @enderror" placeholder="Description :">{{ $store->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div><!--end row-->
            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Save Changes">
                </div><!--end col-->
            </div><!--end row-->
        </form><!--end form-->
    </div>
</div>

<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0">Store Location :</h5>
    </div>

    <form action="{{ route('user.store.location') }}" method="POST">
        @csrf
        <div class="p-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Location :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="map-pin" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->location }}" name="location" id="location" class="form-control ps-5 @error('location') is-invalid @enderror" placeholder="Location">
                            @error('location')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" name="location_lat" id="location_lat" value="{{ $store->location_lat }}">
                            <input type="hidden" name="location_long" id="location_long" value="{{ $store->location_long }}">
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-12">
                    <div id="map"></div>
                </div>

                <div class="col-lg-12 mt-2 mb-0">
                    <button class="btn btn-primary">Save</button>
                </div><!--end col-->
            </div>
        </div>
    </form>
</div>

<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0">Store Schedule :</h5>
    </div>

    <form action="{{ route('user.store.schedule') }}" method="POST">
        @csrf
        <div class="p-4">
            <div class="row">
                <div class="col-4">
                    <div class="mb-2"><strong>Day</strong></div>
                    <div style="margin-bottom: 1.3rem;"><p>Monday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Tuesday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Wednesday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Thursday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Friday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Saturday</p></div>
                    <div style="margin-bottom: 1.3rem;"><p>Sunday</p></div>
                </div>

                <div class="col-2 text-center">
                    <div class="mb-2"><strong>Closed/Opened</strong></div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[0]" value="1" id="is_closed_monday" {{ count($is_closed) > 0 ? $is_closed[0] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_monday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[1]" value="1" id="is_closed_tuesday" {{ count($is_closed) > 0 ? $is_closed[1] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_tuesday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[2]" value="1" id="is_closed_wednesday" {{ count($is_closed) > 0 ? $is_closed[2] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_wednesday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[3]" value="1" id="is_closed_thursday" {{ count($is_closed) > 0 ? $is_closed[3] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_thursday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[4]" value="1" id="is_closed_friday" {{ count($is_closed) > 0 ? $is_closed[4] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_friday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[5]" value="1" id="is_closed_saturday" {{ count($is_closed) > 0 ? $is_closed[5] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_saturday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_closed[6]" value="1" id="is_closed_sunday" {{ count($is_closed) > 0 ? $is_closed[6] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_closed_sunday"></label>
                    </div>
                </div>

                <div class="col-2 text-center">
                    <div class="mb-2"><strong>24h</strong></div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[0]" value="1" id="is_24_monday" {{ count($is_24h) > 0 ? $is_24h[0] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_monday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[1]" value="1" id="is_24_tuesday" {{ count($is_24h) > 0 ? $is_24h[1] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_tuesday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[2]" value="1" id="is_24_wednesday" {{ count($is_24h) > 0 ? $is_24h[2] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_wednesday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[3]" value="1" id="is_24_thursday" {{ count($is_24h) > 0 ? $is_24h[3] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_thursday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[4]" value="1" id="is_24_friday" {{ count($is_24h) > 0 ? $is_24h[4] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_friday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[5]" value="1" id="is_24_saturday" {{ count($is_24h) > 0 ? $is_24h[5] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_saturday"></label>
                    </div>
                    <div class="form-check form-switch" style="margin-bottom: 1.3rem">
                        <input class="form-check-input" type="checkbox" name="is_24[6]" value="1" id="is_24_sunday" {{ count($is_24h) > 0 ? $is_24h[6] == 1 ? 'checked' : '' : '' }}>
                        <label class="form-check-label" for="is_24_sunday"></label>
                    </div>
                </div>

                <div class="col-2 text-center">
                    <div class="mb-2"><strong>From</strong></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[0]" value="{{ count($opening_time) > 0 ? $opening_time[0] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[1]" value="{{ count($opening_time) > 0 ? $opening_time[1] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[2]" value="{{ count($opening_time) > 0 ? $opening_time[2] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[3]" value="{{ count($opening_time) > 0 ? $opening_time[3] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[4]" value="{{ count($opening_time) > 0 ? $opening_time[4] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[5]" value="{{ count($opening_time) > 0 ? $opening_time[5] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="opening_time[6]" value="{{ count($opening_time) > 0 ? $opening_time[6] : '' }}"></"></div>
                </div>

                <div class="col-2 text-center">
                    <div class="mb-2"><strong>To</strong></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[0]" value="{{ count($opening_time) > 0 ? $closing_time[0] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[1]" value="{{ count($opening_time) > 0 ? $closing_time[1] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[2]" value="{{ count($opening_time) > 0 ? $closing_time[2] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[3]" value="{{ count($opening_time) > 0 ? $closing_time[3] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[4]" value="{{ count($opening_time) > 0 ? $closing_time[4] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[5]" value="{{ count($opening_time) > 0 ? $closing_time[5] : '' }}"></"></div>
                    <div><input type="text" class="form-control text-center timepicker mb-1" name="closing_time[6]" value="{{ count($opening_time) > 0 ? $closing_time[6] : '' }}"></"></div>
                </div>

                <div class="col-lg-12 mt-2 mb-0">
                    <button class="btn btn-primary">Save</button>
                </div><!--end col-->
            </div>
        </div>
    </form>
</div>

<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0">Store Social :</h5>
    </div>

    <form action="{{ route('user.store.social') }}" method="POST">
        @csrf
        <div class="p-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Facebook :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="facebook" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->facebook }}" name="facebook" id="facebook" class="form-control ps-5 @error('facebook') is-invalid @enderror" placeholder="Facebook : ">
                            @error('facebook')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Instagram :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="instagram" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->instagram }}" name="instagram" id="instagram" class="form-control ps-5 @error('instagram') is-invalid @enderror" placeholder="Instagram : ">
                            @error('instagram')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Twitter :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="twitter" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->twitter }}" name="twitter" id="twitter" class="form-control ps-5 @error('twitter') is-invalid @enderror" placeholder="Twitter : ">
                            @error('twitter')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">LinkedIn :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="linkedin" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->linkedin }}" name="linkedin" id="linkedin" class="form-control ps-5 @error('linkedin') is-invalid @enderror" placeholder="LinkedIn : ">
                            @error('linkedin')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">YouTube :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="youtube" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $store->youtube }}" name="youtube" id="youtube" class="form-control ps-5 @error('youtube') is-invalid @enderror" placeholder="YouTube : ">
                            @error('youtube')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-2 mb-0">
                    <button class="btn btn-primary">Save</button>
                </div><!--end col-->
            </div>
        </div>
    </form>
</div>

<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0 text-danger">Delete Account :</h5>
    </div>

    <div class="p-4">
        <h6 class="mb-0">Do you want to delete the account? Please press below "Delete" button</h6>
        <div class="mt-4">
            <button class="btn btn-danger">Delete Account</button>
        </div><!--end col-->
    </div>
</div>
@endsection
@section('js')
    <script>
        $(".dropify").dropify();
        $(".timepicker").timepicker({
            minuteStep: 1,
        });
        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'')
                ;
        }
        $(document).ready(function () {
            $("#logo").change(function (e) {
                e.preventDefault();
                let elm = $(this);

                var data = new FormData();
                data.append('logo', $('input[type=file]#logo')[0].files[0]);
                data.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.store.logo') }}",
                    data: data,
                    enctype : 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        var reader = new FileReader();
                        reader.onload = function(){
                            var output = document.getElementById('logo-img');
                            output.src = reader.result;
                        };
                        reader.readAsDataURL(e.target.files[0]);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 422) {
                            let errorObj = xhr.responseJSON.errors;
                            printValidationMessages(errorObj);
                        }
                    }
                });
            });

            $("#banner").change(function (e) {
                e.preventDefault();
                let elm = $(this);

                var data = new FormData();
                data.append('banner', $('input[type=file]#banner')[0].files[0]);
                data.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.store.banner') }}",
                    data: data,
                    enctype : 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 422) {
                            let errorObj = xhr.responseJSON.errors;
                            printValidationMessages(errorObj);
                        }
                    }
                });
            });

            $("#name").keyup(function (e) {
                let elm = $(this);
                $("#slug").val(convertToSlug(elm.val()));
            });
        });
        let lat = <?php if($store->location_lat) { echo $store->location_lat; } else { echo "50.7843252"; }  ?>;
        let lng = <?php if($store->location_long) { echo $store->location_long; } else { echo "-77.782352"; }  ?>;
        function initMap() {
            const uluru = { lat: lat, lng: lng };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: uluru,
                zoom: 13,
            });
            const input = document.getElementById("location");
            const options = {
                // componentRestrictions: { country: "us" },
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
                types: ["establishment"],
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
                map: map,
                position: uluru,
                anchorPoint: new google.maps.Point(0, -29),
            });
            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                console.log(place.geometry.location.lat());

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
