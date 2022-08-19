@extends('layouts.admin')

@section('title', 'Profile')

@section('css')
<style>
    #map {
        height: 350px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="dropify" data-default-file="{{ asset($user->avatar) }}" name="avatar">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ $user->name }}" autocomplete="off">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ $user->email }}" autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" value="{{ $user->phone }}" autocomplete="off">
                                    @error('phone')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" id="bio" placeholder="Bio" rows="8">{{ $user->bio }}</textarea>
                                    @error('bio')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="Website" value="{{ $user->website }}" autocomplete="off">
                                    @error('website')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="location" value="{{ $user->location }}" autocomplete="off">
                                    <input type="hidden" id="location_lat" name="location_lat" value="{{ $user->location_lat }}">
                                    <input type="hidden" id="location_long" name="location_long" value="{{ $user->location_long }}">
                                    @error('location')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div id="map"></div>
                                    <div id="infowindow-content">
                                        <span id="place-name" class="title"></span><br />
                                        <span id="place-address"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        let lat = <?php if(is_null($user->location_lat)) {echo "40.749933";} else {echo $user->location_lat;} ?>;
        let lng = <?php if(is_null($user->location_long)) {echo "-73.98633";} else {echo $user->location_long;} ?>;

        console.log(Number(lat));
        console.log(Number(lng));
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: Number(lat), lng: Number(lng) },
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
                map,
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
