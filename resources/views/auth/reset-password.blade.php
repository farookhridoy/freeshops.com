
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Reset Password - Freeshopps.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </head>

    <body>

        <div class="back-to-home rounded d-none d-sm-block">
            <a href="{{ route('home') }}" class="btn btn-icon btn-primary"><i data-feather="home" class="icons"></i></a>
        </div>

        <!-- Hero Start -->
        <section class="bg-home bg-circle-gradiant d-flex align-items-center">
            <div class="bg-overlay bg-overlay-white"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card login-page bg-white shadow rounded border-0">
                            <div class="card-body">
                                <h4 class="card-title text-center">Reset your Password</h4>
                                <form class="login-form mt-4" action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="row">
                                        <div class="col-lg-12" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input type="email" class="form-control ps-5 @error('email') is-invalid @enderror" value="{{ old('email', $request->email) }}" placeholder="Email" name="email">
                                                    @error('email')
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5 @error('password') is-invalid @enderror" placeholder="Password" name="password">
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
                                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5" placeholder="Password" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary">Reset Password</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div><!---->
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->



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
        <script src="{{ asset('theme/js/app.js') }}"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->

    </body>
</html>
