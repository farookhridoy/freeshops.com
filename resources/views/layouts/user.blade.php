
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') - Freeshopps.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="current" content="{{ auth()->user()->id }}">
    <meta name="role" content="{{ auth()->user()->role }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{ asset('theme/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" rel="stylesheet">
    <!-- Slider -->
    <link href="{{ asset('theme/css/tiny-slider.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{ asset('theme/css/colors/default.css') }}" rel="stylesheet" id="color-opt">
    <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet" id="color-opt">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('theme/css/font/font-fileuploader.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.css" rel="stylesheet">

    @yield('css')
</head>

<body>

    <!-- Navbar STart -->
    @include('user.components.header')
    <!-- Navbar End -->

    @if (!auth()->user()->hasVerifiedEmail())
        <div class="container" style="padding-top: 8rem;">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-outline-primary d-flex" role="alert">
                        <span class="alert-content m-auto flex-1"><i data-feather="alert-triangle" width="20px" height="20px" class="icons text-danger"></i> <strong class="ms-2">Please check your email and follow the link to verify your email address</strong> </span>
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm ms-auto flex-2">Resend verification Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Profile Start -->
    @if (Route::currentRouteName() == "user.chat")
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
    @else
        @if (auth()->user()->hasVerifiedEmail())
            <section class="section mt-60">
        @else
            <section class="section pt-0">
        @endif
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 d-lg-block d-none">
                        @include('user.components.sidebar')
                    </div><!--end col-->

                    <div class="col-lg-8 col-12">
                        @yield('content')
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
    @endif

    <!-- Profile End -->

    <!-- Footer Start -->
    @include('user.components.footer')
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
    <!-- Back to top -->

    <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>

    <!-- Nearby Modal -->
    <div class="modal fade" id="nearbyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-md">
            <div class="modal-content rounded shadow border-0">
                <div class="modal-body p-4">
                    <div class="container-fluid px-0">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-12">
                                <div class="nearby-location">
                                    <h4 class="text-center">
                                        <strong>Nearby Location</strong>
                                        <span class="float-end cursor-pointer" data-bs-dismiss="modal"><i data-feather="x" class="icons"></i></span>
                                    </h4>

                                    <div class="zip-code-area">
                                        <p>Zip Code</p>
                                        <div class="zip-code d-flex">
                                            <span class="code d-inline-block">Brimley, MI 49715</span>
                                            <span class="d-inline-block ms-auto"><i data-feather="arrow-right" class="icons"></i></span>
                                        </div>
                                    </div>

                                    <div class="distance-area">
                                        <p>Distance</p>
                                        <div class="form-group">
                                            <select name="radius" id="radius" class="form-control">
                                                <option value="5">5 Miles</option>
                                                <option value="10">10 Miles</option>
                                                <option value="20">20 Miles</option>
                                                <option value="30" selected>30 Miles</option>
                                                <option value="50">Maximum</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary w-100 mt-5 see-listing" data-bs-dismiss="modal">See Listings</button>
                                </div>

                                <div class="zip-code-wrapper text-center" style="display: none">
                                    <h4 class="text-center">
                                        <span class="float-start back-to-nearby cursor-pointer"><i data-feather="arrow-left" class="icons"></i></span>
                                        <strong>ZIP Code</strong>
                                        <span class="float-end cursor-pointer" data-bs-dismiss="modal"><i data-feather="x" class="icons"></i></span>
                                    </h4>

                                    <p class="mt-5"><strong>Where are you searching?</strong></p>
                                    <button type="button" onclick="getLocation()" class="btn btn-primary"><i data-feather="map-pin" class="icons"></i> Get my location</button>
                                    <input type="hidden" name="current_lat" value="">
                                    <input type="hidden" name="current_lng" value="">
                                    <p class="mt-3"><strong>OR</strong></p>
                                    <input type="text" maxlength="5" class="form-control w-25 m-auto text-center" name="postal_code" id="postal_code" placeholder="Enter Zip Code" autocomplete="off" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                    <p class="mt-2 postal-code-full"><strong>New Castle, DE</strong></p>

                                    <button type="button" class="btn btn-primary w-100 mt-5 apply-searching">Apply</button>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>
        </div>
    </div>
    <!-- Nearby Modal -->



    <!-- javascript -->
    <script>
        let notification_url = "{{ route('notification') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/js/gumshoe.polyfills.min.js') }}"></script>
    <!-- SLIDER -->
    <script src="{{ asset('theme/js/tiny-slider.js') }}"></script>
    <!-- Icons -->
    <script src="{{ asset('theme/js/feather.min.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('theme/js/plugins.init.js') }}"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="{{ asset('theme/js/app.js') }}"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('theme/js/jquery.fileuploader.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiMlDi4wWwmGpVcQqW09U1M68jI2OEfK0&callback=initMap&libraries=places&v=weekly" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        let zipcode = '';
        let postal_code = '';
        $(document).ready(function() {
            $('#summernote').summernote();

            $('input[name="files"]').fileuploader({
                limit: 20,
                maxSize: 50,

                addMore: true
            });
            getLocation();
        });

        $(document).on("click", ".cat-item", function(e) {
            e.preventDefault();
            let val = $(this).data('slug');
            $("[name='category']").val(val);

            $(".navbar-search").submit();
        });

        $(document).on("change", "[name='sorting']", function(e) {
            let val = $(this).val();
            $("[name='sort']").val(val);

            $(".navbar-search").submit();
        });

        // General Delete Function
        function deleteAlert(url) {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        // General alert
        function alertMessage(url, msg) {
            Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            });
        }

        // Notification Functions
        $("body").on('click', '.read-status', function (e) {
            e.preventDefault();
            let unread = "<i class='uil uil-envelope align-middle icons'></i>";
            let read = "<i class='uil uil-envelope-open align-middle icons'></i>";
            let elm = $(this);
            let id = elm.data("id");
            let count = parseInt($(".notif-count").html());

            if (elm.closest('li').hasClass('active')) {
                elm.closest('li').removeClass('active');
                markNotifRead(id);
                $(".notif-count").html(count - 1);
                elm.html(read);
            } else {
                elm.closest('li').addClass('active');
                markNotifUnread(id);
                $(".notif-count").html(count + 1);
                elm.html(unread);
            }

            e.stopPropagation();
        });

        $("body").on('click', '.read-all', function (e) {
            let unread = "<i class='uil uil-envelope align-middle icons'></i>";
            let read = "<i class='uil uil-envelope-open align-middle icons'></i>";
            let elm = $(this);
            elm.closest('.notification-dropdown').find("li").removeClass('active');
            markNotifRead();
            $(".notif-count").html("0");
            elm.html(read);
            $(".read-status").html(read);
            $(".notif button").removeClass('notif-drop');

            e.stopPropagation();
        });

        function markNotifRead(id = null) {
            let url;
            if (id) {
                url = "{{ route('mark.read') }}/"+id;
            } else {
                url = "{{ route('mark.read') }}";
            }

            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    console.log(response);
                }
            });
        }

        function markNotifUnread(id) {
            let url = "{{ route('mark.unread') }}/"+id;

            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    console.log(response);
                }
            });
        }

        function getZipCode(results) {
            for(var i=0; i < results.length; i++){
                for(var j=0;j < results[i].address_components.length; j++){
                    for(var k=0; k < results[i].address_components[j].types.length; k++){
                        if(results[i].address_components[j].types[k] == "postal_code"){
                            zipcode = results[i].address_components[j].short_name;
                        }
                    }
                }
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // let lat = position.coords.latitude;
                    let lat = 46.4323632;
                    // let long = position.coords.longitude;
                    let long = -84.7032861;

                    var latlng = new google.maps.LatLng(lat, long);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if(status == google.maps.GeocoderStatus.OK) {
                            getZipCode(results);
                            getPostalCodeDetail(zipcode);
                        };
                    });
                }, function() {
                    // var cantFindModal = new bootstrap.Modal(document.getElementById('cantFindModal'))
                    // cantFindModal.show()
                });
            }
        }

        function getPostalCodeDetail(code) {
            var coder = new google.maps.Geocoder();
            coder.geocode({'address': code, 'region': 'us'}, function(results, status) {
                if(status == google.maps.GeocoderStatus.OK) {
                    postal_code = results[0].formatted_address;
                    zipcode = results[0].address_components[0].long_name;
                    $(".header-location-name").html(postal_code);
                    $(".code").html(postal_code);
                    $("[name='postal_code']").val(zipcode);
                    $(".postal-code-full").html(postal_code);
                    $("[name='current_lat']").val(results[0].geometry.location.lat());
                    $("[name='current_lng']").val(results[0].geometry.location.lng());
                    checkZipInsertion();
                } else {
                    $(".postal-code-full").html("<small class='text-danger'>Please enter a valid US ZIP code.</small>");
                }
                console.log(results);
            });
        }

        function checkZipInsertion() {
            let val = $("[name='postal_code']").val();

            if (val.length < 5) {
                $(".apply-searching").prop('disabled', true);
            } else {
                $(".apply-searching").prop('disabled', false);
            }
        }
    </script>

    @yield('js')
</body>
</html>
