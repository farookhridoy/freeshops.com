<div class="left-sidenav">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            {{-- <span>
                <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span> --}}
            <span>
                <img src="{{ asset('admin/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('logo.png') }}" alt="logo-large" class="logo-lg logo-dark" style="height:auto; width:70px;">
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="leftbar-profile p-3 w-100">
        <div class="media position-relative">
            <div class="leftbar-user online">
                <img src="{{ asset(auth()->user()->avatar) }}" alt="" class="thumb-md rounded-circle">
            </div>
            <div class="media-body align-self-center text-truncate ml-3">
                <h5 class="mt-0 mb-1 font-weight-semibold">{{ auth()->user()->name }}</h5>
                <p class="text-uppercase mb-0 font-12">Admin</p>
            </div><!--end media-body-->
        </div>
    </div>
    <ul class="metismenu scroll left-sidenav-menu ">
        <li class="menu-label">Main</li>
        <li class="leftbar-menu-item @routeis('admin.dashboard') mm-active @endrouteis">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i data-feather="grid" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="leftbar-menu-item @routeis('admin.categories.*') mm-active @endrouteis">
            <a href="{{ route('admin.categories.list') }}" class="menu-link">
                <i data-feather="archive" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="leftbar-menu-item @routeis('admin.listing.*') mm-active @endrouteis">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="list" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Manage Listings</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.listing.all') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>All</span>
                        @if (countAllListings() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countAllListings() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.listing.review') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>In Review</span>
                        @if (countReviewListings() > 0)
                            <span class="flex-2 ml-auto badge badge-warning">{{ countReviewListings() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.listing.published') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Published</span>
                        @if (countPublishedListings() > 0)
                            <span class="flex-2 ml-auto badge badge-success">{{ countPublishedListings() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.listing.rejected') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Rejected</span>
                        @if (countRejectedListings() > 0)
                            <span class="flex-2 ml-auto badge badge-danger">{{ countRejectedListings() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>

        <li class="leftbar-menu-item @routeis('admin.order.*') mm-active @endrouteis">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="layers" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Manage Orders</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.order.all') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>All Orders</span>
                        @if (countAllOrders() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countAllOrders() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.order.review') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>In Review</span>
                        @if (countReviewOrders() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countReviewOrders() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.order.active') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Active</span>
                        @if (countActiveOrders() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countActiveOrders() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.order.completed') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Completed</span>
                        @if (countCompletedOrders() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countCompletedOrders() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.order.cancelled') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Cancelled</span>
                        @if (countCancelledOrders() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countCancelledOrders() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="leftbar-menu-item @routeis('admin.customer.*') mm-active @endrouteis">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="users" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Manage Customers</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.customer.buyer') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Buyers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.customer.seller') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Sellers</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="leftbar-menu-item @routeis('admin.setting.*') mm-active @endrouteis">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="list" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>CMS</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.general') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>General </span>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.home') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.social') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Socila Links</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.about_us') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>About us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.privacy') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Privacy Policy</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.terms') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Terms of Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.something.new') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Something New</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.what.we.are.upto') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>What we are upto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.join.with.us') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Join with us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.why.shopps.free') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Why Shopps free</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.our.goal') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Our Goal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.faq') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>FAQS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.term.and.termination') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Term & Termination</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.community') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Community</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.settings.community.guideline') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Community Guide</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="leftbar-menu-item @routeis('admin.gallery.*') mm-active @endrouteis">
            <a href="{{ route('admin.gallery.list') }}" class="menu-link">
                <i data-feather="users" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Gallery</span>
            </a>
        </li>
        <li class="leftbar-menu-item @routeis('admin.user.all') mm-active @endrouteis">
            <a href="{{ route('admin.user.all') }}" class="menu-link">
                <i data-feather="users" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="leftbar-menu-item @routeis('admin.earning.all') mm-active @endrouteis">
            <a href="{{ route('admin.earning.all') }}" class="menu-link">
                <i data-feather="dollar-sign" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Earnings</span>
            </a>
        </li>


        <li class="menu-label">Blogs</li>
        <li class="leftbar-menu-item @routeis('admin.blog.categories.*') mm-active @endrouteis">
            <a href="{{ route('admin.blog.categories.list') }}" class="menu-link">
                <i data-feather="columns" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="leftbar-menu-item @routeis('admin.post.*') mm-active @endrouteis">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="copy" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Posts</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.post.add') }}">
                        <i class="ti-control-record"></i>Add Post
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.post.all') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>All Posts</span>
                        @if (countAllPosts() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countAllPosts() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.post.review') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>In Review</span>
                        @if (countReviewPosts() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countReviewPosts() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.post.draft') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Draft</span>
                        @if (countDraftPosts() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countDraftPosts() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.post.published') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Published</span>
                        @if (countPublishedPosts() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countPublishedPosts() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.post.rejected') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Rejected</span>
                        @if (countRejectedPosts() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countRejectedPosts() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>

        <li class="leftbar-menu-item">
            <a href="javascript: void(0);" class="menu-link">
                <i data-feather="message-circle" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Comments</span>
                <span class="menu-arrow">
                    <i class="mdi mdi-chevron-right"></i>
                </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.comment.all') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>All Comments</span>
                        @if (countAllBlogComments() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countAllBlogComments() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.comment.active') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Active</span>
                        @if (countActiveBlogComments() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countActiveBlogComments() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" href="{{ route('admin.comment.hidden') }}">
                        <span class="flex-1"><i class="ti-control-record"></i>Hidden</span>
                        @if (countHiddenBlogComments() > 0)
                            <span class="flex-2 ml-auto badge badge-primary">{{ countHiddenBlogComments() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Contact Us</li>
        <li class="leftbar-menu-item @routeis('admin.contact') mm-active @endrouteis">
            <a href="{{ route('admin.contact.list') }}" class="menu-link">
                <i data-feather="grid" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Contact Queries</span>
            </a>
        </li>
        <li class="menu-label">Newsletter</li>
        <li class="leftbar-menu-item @routeis('admin.newsletter') mm-active @endrouteis">
            <a href="{{ route('admin.newsletter.list') }}" class="menu-link">
                <i data-feather="grid" class="align-self-center vertical-menu-icon icon-dual-vertical"></i>
                <span>Newsletter</span>
            </a>
        </li>
        <div style="margin-bottom: 300px"></div>
    </ul>

</div>
