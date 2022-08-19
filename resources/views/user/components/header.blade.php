<header id="topnav" class="defaultscroll sticky">
    <div class="container-fluid">
        <!-- Logo container-->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-1 col-sm-2 col-2 order-lg-1 order-1">
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-2 col-3 order-lg-2 order-2 px-1">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" height="60" alt="">
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 order-lg-3 order-4 m-auto">
                <form action="{{ route('all') }}" class="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Entery Keyword..." name="q" value="{{ $req->q ?? '' }}" autocomplete="off">
                        <button class="btn btn-sm btn-primary"><i data-feather="search" class="icons"></i></button>
                    </div>
                    <input type="hidden" name="category" value="{{ $req->category ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $req->sort ?? 'latest' }}">
                </form>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-12 order-lg-4 order-5 m-auto">
                <a href="javascript:;" class="location" data-bs-toggle="modal" data-bs-target="#nearbyModal"><i data-feather="map-pin" class="icons"></i> <span class="header-location-name">Nearby</span></a>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-10 col-sm-8 col-7 order-lg-5 order-3 m-auto">
                <div class="top-nav text-end">
                    <ul>
                        <li class="d-sm-inline-block d-none"><a href="">About</a></li>
                        <li class="d-sm-inline-block d-none"><a href="">Terms of Service</a></li>
                        @auth
                            @if (auth()->user()->role == "1")
                            <li class="d-sm-inline-block d-none"><a href="{{ route('user.dashboard') }}">My Account</a></li>
                            @else
                                <li class="d-sm-inline-block d-none"><a href="{{ route('admin.dashboard') }}">My Account</a></li>
                            @endif
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-icon btn-soft-primary cart-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-shopping-cart align-middle icons"></i></button>
                                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 p-4" style="width: 300px; margin: 0px;">
                                        <div id="status" class="loader" style="display: none">
                                            <div class="spinner">
                                                <div class="double-bounce1"></div>
                                                <div class="double-bounce2"></div>
                                            </div>
                                        </div>
                                        <div class="cart-block">
                                            <div class="cart">
                                                @if (count(getCart()) > 0)

                                                    @foreach (getCart() as $item)
                                                        <div class="d-flex align-items-center mb-4">
                                                            <img src="{{ asset($item->listing->featured_image) }}" class="shadow rounded" style="max-height: 64px;" alt="">
                                                            <div class="flex-1 text-start ms-3">
                                                                <h6 class="text-dark mb-0">{{ $item->listing->title }}</h6>
                                                                <small class="text-muted mb-0">{{ $item->listing->category->name }}</small>
                                                            </div>
                                                            {{-- <span class="d-inline-block text-danger cursor-pointer removeCart" data-id="{{ $item->id }}"><i data-feather="trash" class="icons"></i></span> --}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h4 class="text-center">Cart is Empty</h4>
                                                @endif
                                            </div>

                                            <div class="mt-3 text-center pt-4 border-top">
                                                <a href="{{ route('cart') }}" class="btn btn-primary d-block">View Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @php
                                $user = auth()->user();
                            @endphp
                            <li>
                                <div class="dropdown notif">
                                    <button type="button" class="btn btn-icon btn-soft-primary {{ $user->unreadNotifications()->groupBy('notifiable_type')->count() > 0 ? 'notif-drop' : '' }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-bell align-middle icons"></i></button>
                                    <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 notification-dropdown">
                                        <div class="d-flex px-3 py-2">
                                            <h6 class="text-sm text-muted m-0">
                                                You have
                                                <strong class="text-primary notif-count">
                                                    {{ $user->unreadNotifications()->groupBy('notifiable_type')->count() }}
                                                </strong>
                                                unread notifications.
                                            </h6>
                                            <span class="read-all d-inline-block cursor-pointer font-20 ms-auto">
                                                <i class="uil {{ $user->unreadNotifications()->groupBy('notifiable_type')->count() > 0 ? 'uil-envelope' : 'uil-envelope-open' }} align-middle icons"></i>
                                            </span>
                                        </div>
                                        <ul class="notifications">
                                            @if (count($user->notifications) > 0)
                                                @foreach ($user->notifications as $notif)
                                                    <a href="{{ route('notification', $notif->id) }}" style="text-decoration: none; color:inherit;">
                                                        <li class="{{ is_null($notif->read_at) ? 'active' : '' }}">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    <div class="notif-icon">
                                                                        <img src="{{ asset('bell-icon.jpg') }}" class="img-fluid" alt="Notif Icon">
                                                                    </div>
                                                                </div>
                                                                <div class="px-1">
                                                                    <strong>{{ $notif->data['data']['title'] }}</strong>
                                                                    <p>{{ $notif->data['data']['body'] }}</p>
                                                                    <small class="text-muted text-end">{{ $notif->created_at->diffForHumans() }}</small>
                                                                </div>
                                                                <div class="px-1 ms-auto">
                                                                    <span data-id="{{ $notif->id }}" class="read-status d-inline-block font-20"><i class="uil {{ is_null($notif->read_at) ? 'uil-envelope' : 'uil-envelope-open' }} align-middle icons"></i></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>
                                                @endforeach
                                            @else
                                                <li class="text-center"><h4>No notification yet!</h4></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountModal">Login</a></li>
                        @endauth
                        <li><a href="{{ route('post.ad') }}" class="btn btn-primary">Post Ad</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Logo container-->


    </div><!--end container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        @foreach (getNavCat() as $item)
                            <li><a data-slug="{{ $item->slug }}" href="{{ route('all') }}?category={{ $item->slug }}" class="sub-menu-item cat-item">{{ $item->name }}</a></li>
                        @endforeach
                        @if (count(getOtherNavCat()) > 0)

                        @endif
                        <li class="has-submenu parent-parent-menu-item">
                            <a href="javascript:void(0)">Others</a><span class="menu-arrow"></span>
                            <ul class="submenu">
                                @foreach (getOtherNavCat() as $item)
                                    <li><a data-slug="{{ $item->slug }}" href="{{ route('all') }}?category={{ $item->slug }}" class="sub-menu-item cat-item">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div>
        </div>
    </div>
</header><!--end header-->
