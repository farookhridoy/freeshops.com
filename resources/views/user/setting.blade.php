@extends('layouts.user')

@section('title', 'Account Settings')

@section('content')
<div class="card border-0 rounded shadow">
    <div class="card-body">
        <h5 class="text-md-start text-center">Personal Detail :</h5>

        <div class="mt-3 text-md-start text-center d-sm-flex">
            <img src="{{ asset($user->avatar) }}" id="avatar-img" class="avatar float-md-left avatar-medium rounded-circle shadow me-md-4" alt="">

            <div class="mt-md-4 mt-3 mt-sm-0">
                <form action="" method="POST" id="avatar-form" enctype="multipart/form-data">
                    @csrf
                    <label for="avatar" class="btn btn-primary mt-2">Change Picture</label>
                    <input type="file" id="avatar" name="avatar" hidden>
                </form>
            </div>
        </div>

        <form action="{{ route('user.personal') }}" method="POST">
            @csrf
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <div class="form-icon position-relative">
                            <i data-feather="user" class="fea icon-sm icons"></i>
                            <input name="name" value="{{ $user->name }}" id="name" type="text" class="form-control ps-5 @error('name') is-invalid @enderror" placeholder="Name :" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="form-icon position-relative">
                            <i data-feather="mail" class="fea icon-sm icons"></i>
                            <input name="email" value="{{ $user->email }}" id="email" type="email" class="form-control ps-5 @error('name') is-invalid @enderror" placeholder="Email :" autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <div class="form-icon position-relative">
                            <i data-feather="message-circle" class="fea icon-sm icons"></i>
                            <textarea name="bio" id="bio" rows="4" class="form-control ps-5 @error('bio') is-invalid @enderror" placeholder="Bio :">{{ $user->bio }}</textarea>
                            @error('bio')
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


        <div class="row">
            <div class="col-md-6 mt-4 pt-2">
                <h5>Contact Info :</h5>

                <form action="{{ route('user.contact') }}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Phone No. :</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="phone" class="fea icon-sm icons"></i>
                                    <input name="phone" value="{{ $user->phone }}" id="phone" type="text" class="form-control ps-5 @error('phone') is-invalid @enderror" placeholder="Phone :" autocomplete="off">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Website :</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="globe" class="fea icon-sm icons"></i>
                                    <input name="website" value="{{ $user->website }}" id="website" type="url" class="form-control ps-5 @error('website') is-invalid @enderror" placeholder="Url :" autocomplete="off">
                                    @error('website')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12 mt-2 mb-0">
                            <button class="btn btn-primary">Add</button>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div><!--end col-->

            <div class="col-md-6 mt-4 pt-2">
                <h5>Change password :</h5>
                <form action="{{ route('user.password') }}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Old password :</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                    <input type="password" name="old_password" class="form-control ps-5 @error('old_password') is-invalid @enderror" placeholder="Old password" autocomplete="off">
                                    @error('old_password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">New password :</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                    <input type="password" name="password" class="form-control ps-5 @error('password') is-invalid @enderror" placeholder="New password" autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Re-type New password :</label>
                                <div class="form-icon position-relative">
                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                    <input type="password" name="password_confirmation" class="form-control ps-5 @error('password_confirmation') is-invalid @enderror" placeholder="Re-type New password" autocomplete="off">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12 mt-2 mb-0">
                            <button class="btn btn-primary">Save password</button>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div>


<div class="rounded shadow mt-4">
    <div class="p-4 border-bottom">
        <h5 class="mb-0">Location :</h5>
    </div>

    <form action="{{ route('user.location') }}" method="POST">
        @csrf
        <div class="p-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label class="form-label">Location :</label>
                        <div class="form-icon position-relative">
                            <i data-feather="map-pin" class="fea icon-sm icons"></i>
                            <input type="text" value="{{ $user->location }}" name="location" id="location" class="form-control ps-5 @error('location') is-invalid @enderror" placeholder="Location">
                            @error('location')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" name="location_lat" id="location_lat" value="{{ $user->location_lat }}">
                            <input type="hidden" name="location_long" id="location_long" value="{{ $user->location_long }}">
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
        $(document).ready(function () {
            $("#avatar").change(function (e) {
                e.preventDefault();
                let elm = $(this);

                var data = new FormData();
                data.append('avatar', $('input[type=file]')[0].files[0]);
                data.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.upload.avatar') }}",
                    data: data,
                    enctype : 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        var reader = new FileReader();
                        reader.onload = function(){
                            var output = document.getElementById('avatar-img');
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
        });
        let lat = <?php echo $user->location_lat; ?>;
        let lng = <?php echo $user->location_long; ?>;
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
