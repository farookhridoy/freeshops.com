
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Freeshopps.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('og')
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{ asset('theme/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" rel="stylesheet">
    <!-- Slider -->
    <link href="{{ asset('theme/css/tiny-slider.css') }}" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('theme/css/font/font-fileuploader.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('admin/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Main Css -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{ asset('theme/css/colors/default.css') }}" rel="stylesheet" id="color-opt">
    <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet" id="color-opt">

    <style>
        #toast-container .toast {
            opacity: 1;
        }
    </style>
    @yield('css')
</head>

<body>

    <!-- Navbar STart -->
    @include('front.components.header')
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    @include('front.components.footer')
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
    <!-- Back to top -->


    <!-- Account Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <div class="modal-body p-0">
                    <div class="container-fluid px-0">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-6 col-md-5">
                                <img src="{{ asset('theme/images/course/online/ab02.jpg') }}" class="img-fluid" alt="">
                            </div><!--end col-->

                            <div class="col-lg-6 col-md-7">
                                <div id="status" class="loader" style="display: none;">
                                    <div class="spinner">
                                        <div class="double-bounce1"></div>
                                        <div class="double-bounce2"></div>
                                    </div>
                                </div>

                                <form class="login-form p-4 accounts" action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="text-center">Sign up / Log in</h3>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="{{ route('social.login','facebook') }}" class="btn btn-primary facebook d-block"><i class="mdi mdi-facebook mdi-18px icons"></i> Continue with Facebook</a>
                                        </div><!--end col-->
                                        <div class="col-lg-12 mb-3">
                                            <a href="{{ route('social.login','google') }}" class="btn btn-primary google d-block"><i class="mdi mdi-google mdi-18px icons"></i> Continue with Google</a>
                                        </div><!--end col-->
                                        <div class="col-lg-12 mb-3">
                                            <button type="button" class="btn btn-primary d-block w-100" onclick="accountsModalHandle('.login')"><i class="mdi mdi-email mdi-18px icons"></i> Continue with Email</button>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>

                                <form class="login-form p-4 login" style="display: none;" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input type="email" class="form-control ps-5" placeholder="Email"
                                                    name="email">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5" placeholder="Password"
                                                    name="password">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="remember" type="checkbox" value="" id="flexCheckDefault4">
                                                        <label class="form-check-label" for="flexCheckDefault4">Remember me</label>
                                                    </div>
                                                </div>
                                                <p class="forgot-pass mb-0"><a href="javascript:;" class="text-dark fw-bold" onclick="accountsModalHandle('.forget')">Forgot password ?</a></p>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary">Log in</button>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Don't have an account ?</small> <a href="javascript:;" onclick="accountsModalHandle('.signup')" class="text-dark fw-bold">Sign Up</a></p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>

                                <form class="login-form p-4 signup" style="display: none;" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control ps-5" placeholder="Name"
                                                    name="name">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input type="email" class="form-control ps-5" placeholder="Email"
                                                    name="email">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5" placeholder="Password"
                                                    name="password">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary">Sign up</button>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Already have an account ?</small> <a href="javascript:;" onclick="accountsModalHandle('.login')" class="text-dark fw-bold">Log in</a></p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>

                                <form class="login-form p-4 forget" style="display: none;" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <strong>Forgot your password?</strong> No problem. Just let us know your email address and we will
                                                email you a password reset link that will allow you to choose a new one.
                                            </p>
                                        </div>

                                        <div class="col-lg-12 status-message"></div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input type="email" class="form-control ps-5" placeholder="Email"
                                                    name="email">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary">Send</button>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Already have an account ?</small> <a href="javascript:;" onclick="accountsModalHandle('.login')" class="text-dark fw-bold">Log in</a></p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
                </div>
            </div>
        </div>
    </div>
    <!-- Account Modal -->

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
                                            <span class="code d-inline-block"></span>
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

    <!-- Can't Find Location Modal -->
    {{-- <div class="modal fade" id="cantFindModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <div class="modal-body p-4">
                    <div class="container-fluid px-0">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-12">
                                <h4 class="text-center">
                                    <strong>We can't find your location</strong>
                                    <span class="float-end cursor-pointer" data-bs-dismiss="modal"><i data-feather="x" class="icons"></i></span>
                                </h4>

                                <p>First, try refreshing the page and tapping the location again.</p>
                                <p>Make sure you click <strong>"Allow"</strong> or <strong>"Grant Permissions"</strong> if your browser asks for your location. You can always enter a ZIP code on the location screen.</p>

                                <button type="button" class="btn btn-primary w-100 mt-5" data-bs-dismiss="modal">Got it!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Can't Find Location Modal -->
    
     <!-- Out of region Modal -->
    <div class="modal fade" id="outOfRegion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <div class="modal-body p-4">
                    <div class="container-fluid px-0">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-12">
                                <h4 class="text-center">
                                    <strong>We can't find your location</strong>
                                    <span class="float-end cursor-pointer" data-bs-dismiss="modal"><i data-feather="x" class="icons"></i></span>
                                </h4>

                                <p>Sorry You seem to be out of our operating region.</p>
                                <p>Make sure you click <strong>"Allow"</strong> or <strong>"Grant Permissions"</strong> if your browser asks for your location. You can always enter a ZIP code on the location screen.</p>

                                <button type="button" class="btn btn-primary w-100 mt-5" data-bs-dismiss="modal">Got it!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Out of region Modal -->


    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('theme/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/js/gumshoe.polyfills.min.js') }}"></script>
    <!-- SLIDER -->
    <script src="{{ asset('theme/js/tiny-slider.js') }}"></script>
    <!-- Icons -->
    <script src="{{ asset('theme/js/feather.min.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('theme/js/plugins.init.js') }}"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="{{ asset('theme/js/app.js?v=1.1') }}"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('theme/js/jquery.fileuploader.min.js') }}"></script>
    {{-- <script src="http://www.google.com/jsapi"></script> --}}
    @if (Route::currentRouteName() == "post.ad" || Route::currentRouteName() == "user.listings.edit")
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSGmioE5YdinM_BR5MDEyB3E7qamhiDNw&callback=initMap&libraries=places&v=weekly" async defer></script>
    @else
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiMlDi4wWwmGpVcQqW09U1M68jI2OEfK0&libraries=places&v=weekly" async defer></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#EmailsubscribeForm').submit(function(e) {
                e.preventDefault();
                var email = $('#emailsubscribe').val();
                 var CSRF_TOKEN = "{{ csrf_token() }}";
                $.ajax({
                       type:'POST',
                       url:"{{ route('newsletter') }}",
                       data: {
                             _token: CSRF_TOKEN,
                             email:email,
                       },
                       dataType: 'JSON',
                       success:function(data){
                            if(data.status == 1)
                            {
                                alert('Your email address already subscribed');
                            }
                            else
                            {
                                $('#emailsubscribe').val('');
                                alert('Thank you email successfully subscribed');
                            }
                       }
                });
        });


        let zipcode = '';
        let postal_code = '';
        function featherIcon() {
            feather.replace();
        }
        function accountsModalHandle(target) {
            $(".login-form").find("span.invalid-feedback").remove();
            $(".login-form").find(".form-control").removeClass('is-invalid');
            $(".login-form").hide();
            $(target).fadeIn();
        }
        function printValidationMessages(errorObj) {
            $(document).find('.login-form .form-control').closest('div').find('span.invalid-feedback').remove();
		    $.map(errorObj, function(value, index) {
                $(document).find('[name="' + index + '"]').closest('div').find('span.invalid-feedback').remove();
                let appendIn = $(document).find('[name="' + index + '"]').closest('div');
                if (!$(appendIn).find('span.invalid-feedback').length) {
                    $(document).find('[name="' + index + '"]').addClass('is-invalid');
                    $(appendIn).append('<span class="invalid-feedback"><strong>' + value[0] + '</strong></span>')
                }
            });
        }

        function getListing() {
            let lat = $("[name='current_lat']").val();
            let lng = $("[name='current_lng']").val() ;
            let rad = $("[name='radius']").val();

            $.ajax({
                type: "GET",
                url: "{{ route('home') }}",
                data: {
                    lat: lat,
                    lng: lng,
                    rad: rad,
                },
                success: function (response) {
                    // console.log(response.statusCode)
                    if (response.statusCode == 200) {
                        $('.listing-load').html(response.html);
                        featherIcon();
                    }else if(response.statusCode == 100){
                        var text = '<div class="container mt-2"><div class="text-center"><h4><b>Sorry!</b> No Products available right now. </h4></div></div>'
                         $('.listing-load').html(text);
                    }
                }
            });
        }

        // Current Location
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
                navigator.geolocation.getCurrentPosition(success, showError) 
            }
            else{
                alert('em too good');
                console.log('abc')
            }
            
            function success (position){
                let lat = position.coords.latitude;
                let long = position.coords.longitude;

                var latlng = new google.maps.LatLng(lat, long);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'latLng': latlng}, function(results, status) {
                    
                    if(status == google.maps.GeocoderStatus.OK) {
                        getZipCode(results);
                        getPostalCodeDetail(zipcode);
                    };
                });
            }
            
            function showError(error)
            {
                switch(error.code) 
                {
                    case error.PERMISSION_DENIED:
                        alert("Please turn on your location services to proceed, You have denied permission for geolocation or your location services are turned off.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Please turn on your location services to proceed, You have denied permission for geolocation or your location services are turned off.");
                        break;
                    case error.TIMEOUT:
                        alert("Please turn on your location services to proceed, You have denied permission for geolocation or your location services are turned off.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("Please turn on your location services to proceed, You have denied permission for geolocation or your location services are turned off.");
                        break;
                }
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
                    getListing();
                } else {
                    $('#outOfRegion').modal('show');
                    $(".postal-code-full").html("<small class='text-danger'>Please enter a valid US ZIP code.</small>");
                }
                
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

        $(document).ready(function () {
            getLocation();
        });

        // Login Form Event
        $(".login-form").submit(function (e) {
            e.preventDefault();
            let elm = $(this);
            let url = elm.attr('action');
            elm.hide();
            $(".loader").show();
            $.ajax({
                type: "POST",
                url: url,
                data: elm.serialize(),
                success: function (response) {
                    // console.log(response);
                    if (response.statusCode == 200) {
                        if (response.reload) {
                            window.location.reload(true);
                        } else {
                            elm.show();
                            $(".loader").hide();
                            $(document).find('.login-form .form-control').closest('div').find('span.invalid-feedback').remove();
                            elm.find(".status-message").html('<div class="alert alert-success">'+response.message+'</div>')
                        }
                    }
                    if (response.statusCode == 400) {
                        if (response.reload) {
                            window.location.reload(true);
                        } else {
                            elm.show();
                            $(".loader").hide();
                            $(document).find('.login-form .form-control').closest('div').find('span.invalid-feedback').remove();
                            elm.find(".status-message").html('<div class="alert alert-danger">'+response.message+'</div>')
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // console.log(xhr);
                    elm.show();
                    if (xhr.status == 422) {
                        let errorObj = xhr.responseJSON.errors;
                        printValidationMessages(errorObj);
                    } else {
                        // toastr.error('Unknown Error!');
                    }
                    $(".loader").hide();
                }
            });
        });

        // Add To Fav Event
        $(document).on("click", ".addFav", function() {
            let elm = $(this);
            let parent = $(this).closest("li");

            elm.addClass('active');
            elm.removeClass('addFav');

            $.ajax({
                type: "GET",
                url: "{{ route('add.fav') }}/"+elm.data('id'),
                success: function (response) {
                    if (response.statusCode == 200) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });

        // Add To Cart Event
        $(document).on("click", ".addCart", function() {
            let elm = $(this);
            let parent = $(this).closest("li");

            

            $.ajax({
                type: "GET",
                url: "{{ route('add.cart') }}/"+elm.data('id'),
                success: function (response) {
                    if (response.statusCode == 200) {
                        $(".cart-dropdown").click();
                        $('.cart-block').hide();
                        $(".dropdown .loader").show();

                        elm.addClass('active');
                        elm.removeClass('addCart');
            
                        $(".cart").html(response.html);
                        $(".dropdown .loader").hide();
                        $('.cart-block').show();
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });

        $(document).on("click", ".removeCart", function(e) {
            let elm = $(this);
            alert('df');
            elm.closest("div").remove();

            $.ajax({
                type: "GET",
                url: "{{ route('remove.cart') }}/"+elm.data('id'),
                success: function (response) {
                    if (response.statusCode == 200) {

                    } else {
                        toastr.error(response.message);
                    }
                }
            });
            e.stopPropagation();
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

        $(document).on("click", ".zip-code", function(e) {
            $(".nearby-location").hide();
            $(".zip-code-wrapper").show();
        });

        $(document).on("click", ".back-to-nearby", function(e) {
            $(".zip-code-wrapper").hide();
            $(".nearby-location").show();
        });

        $(document).on("keyup", "[name='postal_code']", function(e) {
            checkZipInsertion();
        });

        $(document).on("click", ".apply-searching", function(e) {
            $('#nearbyModal').modal('hide');
            let val = $("[name='postal_code']").val();
            getPostalCodeDetail(val);
        });

        $(document).on("click", ".see-listing", function(e) {
            getListing();
        });



    </script>
    @yield('js')
</body>
</html>
