<aside class="sidebar" id="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @canany([PermissionsEnum::USER_VIEW->value, PermissionsEnum::ROLE_VIEW->value])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('master*') ? '' : 'collapsed' }}" data-bs-target="#master-menu" data-bs-toggle="collapse"
                   href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse {{ request()->is('master*') ? 'show' : '' }}" id="master-menu" data-bs-parent="#sidebar-nav">
                    @can(PermissionsEnum::USER_VIEW->value)
                        <li>
                            <a href="{{ url('master/user') }}" class="{{ request()->is('master/user*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>User</span>
                            </a>
                        </li>
                    @endcan
                    @can(PermissionsEnum::ROLE_VIEW->value)
                        <li>
                            <a href="{{ url('master/role') }}" class="{{ request()->is('master/role*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Role</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="nav-heading">Account & Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile') ? '' : 'collapsed' }}" href="{{ url('profile') }}">
                <i class="bi bi-person"></i>
                <span>My Account</span>
            </a>
        </li>
    </ul>
</aside>
