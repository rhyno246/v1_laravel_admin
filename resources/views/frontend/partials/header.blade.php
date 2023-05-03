<header id="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i>
                                    {{ getConfigValueSettingTable('phone_config') }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>
                                    {{ getConfigValueSettingTable('email_config') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ getConfigValueSettingTable('facebook_config') }}"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ getConfigValueSettingTable('youtube_config') }}"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/home/logo.png') }}"
                                alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav" style="display: flex; align-items: center">

                            <li>
                                <a href="{{ route('cart.index') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    Giỏ hàng
                                </a>
                            </li>
                            @if (session()->get('users'))
                                <li>
                                    <a href="#" data-toggle="dropdown">
                                        <img src="{{ session()->get('users')->src ? session()->get('users')->src : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                            style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;  border-radius: 50px">
                                        {{ session()->get('users')->name }}</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('users.index', ['id' => session()->get('users')->id]) }}">Trang
                                                cá nhân</a></li>
                                        <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    @include('frontend.components.main_menu')
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Tìm kím sản phẩm" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
