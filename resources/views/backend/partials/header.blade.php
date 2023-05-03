<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <span>Welcome to </span>{{ Auth::user()->name }}
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ session()->get('avartar') ? session()->get('avartar')->src : asset('backend/assets/img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    {{ Auth::user()->name }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('home') }}" class="dropdown-item has-icon" target="__bank">
                    <i class="fas fa-link"></i> Thăm website
                </a>


                <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-user-alt"></i> Trang cá nhân
                </a>



                @can('gate-settings-view')
                    <a href="{{ route('settings.index') }}" class="dropdown-item has-icon">
                        <i class="fas fa-users"></i> Danh sách tài khoản
                    </a>
                @endcan


                @can('gate-setting-page-view')
                    <a href="{{ route('settings-pages.index') }}" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Cài đặt
                    </a>
                @endcan





                @can('gate-permissions-view')
                    <a href="{{ route('permissions.create') }}" class="dropdown-item has-icon">
                        <i class="fas fa-key"></i> Cấp quyền
                    </a>
                @endcan


                @can('gate-role-view')
                    <a href="{{ route('role.index') }}" class="dropdown-item has-icon">
                        <i class="fas fa-lock"></i> Vai trò
                    </a>
                @endcan

                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Thoát
                </a>
            </div>
        </li>
    </ul>
</nav>
