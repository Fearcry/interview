<nav id="sidebarMenu" class="pt-0 col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->routeIs('dashboard.countries') ? 'active' : '' }}"" href="{{ route('dashboard.countries') }}">
                    <span data-feather="flag"></span>
                    Countries
                </a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link {{ request()->routeIs('dashboard.users') ? 'active' : '' }}" href="{{ route('dashboard.users') }}">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>

        </ul>

    </div>
</nav>
