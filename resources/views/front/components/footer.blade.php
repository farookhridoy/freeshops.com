<!-- Shape Start -->
<div class="position-relative">
    <div class="shape overflow-hidden text-light">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!--Shape End-->
<footer class="footer bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="images/logo-dark.png" height="24" alt="">
                </a>
                <p class="mt-4 text-muted">Freeshopps is all in one platform where we can give away stuff we don’t need where other neighbors can pick them for free and be appreciated, it’s a lovely transaction how we can build a trust, friendly, positive environment, building a bridge in between the neighbors , that is the least we can do.</p>
                <ul class="list-unstyled social-icon social mb-0 mt-4">
                    <li class="list-inline-item"><a href="{{ setting('facebook') }}" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="{{ setting('instagram') }}" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="{{ setting('twitter') }}" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="{{ setting('linkedin') }}" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                </ul><!--end icon-->
            </div><!--end col-->

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-dark footer-head">Company</h5>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="{{ route('about.us') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> About us</a></li>
                    <li><a href="{{ route('something.new') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Something New</a></li>
                    <li><a href="{{ route('what.we.are.upto') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> What we're Upto</a></li>
                    <li><a href="{{ route('join.with.us') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Join With Us</a></li>
                    <li><a href="{{ route('why.shopps.free') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Why Shopps Free!</a></li>
                    <li><a href="{{ route('blog') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Blog</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Video Gallery</a></li>
                    {{-- <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountModal" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Login</a></li> --}}
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-dark footer-head">Usefull Links</h5>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="{{ route('our.goal') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Our Goal</a></li>
                    <li><a href="{{ route('faq') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> FAQs</a></li>
                    <li><a href="{{ route('term.services') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Terms of Services</a></li>
                    <li><a href="{{ route('privacy.policy') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('term.and.termination') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Term and Termination</a></li>
                    <li><a href="{{ route('community') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Community</a></li>
                    <li><a href="{{ route('community.guideline') }}" class="text-muted"><i class="uil uil-angle-right-b me-1"></i> Community Guidelines</a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-dark footer-head">Newsletter</h5>
                <p class="mt-4 text-muted">Sign up and receive the latest tips via email.</p>
                <form method="POST" id="EmailsubscribeForm" action="{{ route('newsletter') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="foot-subscribe foot-white mb-3">
                                <label class="text-muted form-label">Write your email <span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                    <input type="email" name="email" id="emailsubscribe" class="form-control bg-light border ps-5 rounded" placeholder="Your email : " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary" value="Subscribe">
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<footer class="footer footer-bar">
    <div class="container-fluid text-center">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> FreeShopps. Developed with <i class="mdi mdi-heart text-danger"></i> by <a href="https://inbound.pk" target="_blank" class="text-reset">Inbound Agency</a>.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
