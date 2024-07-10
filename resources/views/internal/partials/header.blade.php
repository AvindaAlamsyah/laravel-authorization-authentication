<header class="header fixed-top d-flex align-items-center" id="header">
    <div class="d-flex align-items-center justify-content-between">
        <a class="logo d-flex align-items-center" href="index.html">
            <img src="{{ asset('internal/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">LAA</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown" href="#">
                    <img class="rounded-circle" src="{{ asset(Auth::user()->avatar ? 'storage/uploads/' . Auth::user()->avatar : 'internal/img/profile-img.jpg') }}" alt="Profile">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Hi, {{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Account</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center" type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
