@php
    $user = auth()->user();
@endphp
<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ti-bell noti-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge notif-count"
                    style="{{ $user->unreadNotifications()->groupBy('notifiable_type')->count() > 0 ? 'display:block;' : 'display:none;' }}">
                        {{ $user->unreadNotifications()->groupBy('notifiable_type')->count() }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">

                    <h6 class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                        Notifications <span class="badge badge-light badge-pill">{{ $user->unreadNotifications()->groupBy('notifiable_type')->count() }}</span>
                    </h6>
                    <div class="slimscroll notification-list notifications-prepend">

                        @if (count($user->notifications) > 0)
                            @foreach ($user->notifications as $notif)
                                <!-- item-->
                                <a href="{{ route('notification', $notif->id) }}" class="dropdown-item position-relative py-3 {{ is_null($notif->read_at) ? 'unread' : '' }}">
                                    <span data-id="{{ $notif->id }}" class="read-status d-inline-block font-18"><i class="noti-icon {{ is_null($notif->read_at) ? 'mdi mdi-email-outline' : 'mdi mdi-email-open-outline' }} align-middle icons"></i></span>
                                    <small class="float-right text-muted pl-2">{{ $notif->created_at->diffForHumans() }}</small>
                                    <div class="media">
                                        <div class="avatar-md rounded-circle">
                                            <img src="{{ asset('bell-icon.jpg') }}" class="img-fluid rounded-circle" alt="Notif Icon">
                                        </div>
                                        <div class="media-body align-self-center ml-2 text-truncate">
                                            <h6 class="my-0 font-weight-normal text-dark">{{ $notif->data['data']['title'] }}</h6>
                                            <small class="text-muted mb-0">{{ $notif->data['data']['body'] }}</small>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                </a><!--end-item-->
                            @endforeach
                        @else
                           
                            
                        @endif
                    </div>
                    <!-- All-->
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset(auth()->user()->avatar) }}" alt="profile-user" class="rounded-circle" />
                    <span class="ml-1 nav-user-name hidden-sm">{{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i data-feather="user" class="align-self-center text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('admin.security') }}"><i data-feather="key" class="align-self-center text-muted mr-2"></i> Security</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out" class="align-self-center text-muted mr-2"></i>Logout</a>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <span class="responsive-logo">
                        <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm align-self-center" height="34">
                    </span>
                </a>
            </li>
            <li>
                <button class="button-menu-mobile nav-link">
                    <i data-feather="menu" class="align-self-center"></i>
                </button>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>
