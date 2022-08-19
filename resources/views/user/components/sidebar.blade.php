<div class="sidebar sticky-bar p-4 rounded shadow">
    <div class="widget">
        <ul class="list-unstyled sidebar-nav mb-0" id="navmenu-nav">
            <li class="navbar-item account-menu px-0">
                <a href="{{ route('user.dashboard') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-dashboard"></i></span>
                    <h6 class="mb-0 ms-2">Dashboard</h6>
                </a>
            </li>

            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('user.listings') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-users-alt"></i></span>
                    <h6 class="mb-0 ms-2">My Listings</h6>
                </a>
            </li>

            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('user.favourite') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-envelope-star"></i></span>
                    <h6 class="mb-0 ms-2">Favourites</h6>
                </a>
            </li>

            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('user.chat') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-transaction"></i></span>
                    <h6 class="mb-0 ms-2">Chat</h6>
                </a>
            </li>

            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('user.settings') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-setting"></i></span>
                    <h6 class="mb-0 ms-2">Account Settings</h6>
                </a>
            </li>
            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('user.activity') }}" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-setting"></i></span>
                    <h6 class="mb-0 ms-2">Recent Activities</h6>
                </a>
            </li>

            <li class="navbar-item account-menu px-0 mt-2">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navbar-link d-flex rounded shadow align-items-center py-2 px-4">
                    <span class="h4 mb-0"><i class="uil uil-dashboard"></i></span>
                    <h6 class="mb-0 ms-2">Logout</h6>
                </a>
            </li>
        </ul>
    </div>
</div>
