@php
    use App\Enums\Permission;
@endphp
<aside class="sidebar" id="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @canany([Permission::USER_VIEW->value, Permission::ROLE_VIEW->value])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('master*') ? '' : 'collapsed' }}" data-bs-target="#master-menu" data-bs-toggle="collapse"
                   href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse {{ request()->is('master*') ? 'show' : '' }}" id="master-menu" data-bs-parent="#sidebar-nav">
                    @can(Permission::USER_VIEW->value)
                        <li class="{{ request()->is('master/user*') }}">
                            <a href="#">
                                <i class="bi bi-circle"></i><span>User</span>
                            </a>
                        </li>
                    @endcan
                    @can(Permission::ROLE_VIEW->value)
                        <li class="{{ request()->is('master/user*') }}">
                            <a href="#">
                                <i class="bi bi-circle"></i><span>Role</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    </ul>
</aside>
