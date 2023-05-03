<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('backend.dashboard') }}">ADMIN</a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('backend.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Bảng Điều
                        Khiển</span></a>
            </li>

            @can('gate-menu-view')
                <li class="dropdown {{ Request::is('admin/menu*') ? 'active' : '' }}">
                    <a href="{{ route('menu.index') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Danh Sách
                            Menu</span></a>
                </li>
            @endcan

            @can('gate-post-view')
                <li class="dropdown {{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('post.index') }}" class="nav-link"><i class="fas fa-sticky-note"></i><span>Danh Sách
                            Bài viết</span></a>
                </li>
            @endcan

            @can('gate-products-view')
                <li class="dropdown {{ Request::is('admin/products*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="nav-link"><i class="far fa-square"></i><span>Danh
                            sách sản phẩm</span></a>
                </li>
            @endcan

            @can('gate-customer-view')
                <li class="dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
                    <a href="{{ route('customer.index') }}" class="nav-link"><i class="far fa-user"></i><span>Danh sách
                            khách hàng</span></a>
                </li>
            @endcan

            <li class="dropdown  {{ Request::is('admin/order*') ? 'active' : '' }}">
                <a href="{{ route('order.index') }}" class="nav-link"><i class="fas fa-cart-arrow-down"></i><span>Danh
                        sách
                        Đơn hàng</span></a>
            </li>




            <li
                class="dropdown {{ Request::is('admin/product-category*') || Request::is('admin/post-category*') ? 'active' : '' }}">
                @canany(['gate-category-view', 'gate-post-category-view'])
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-columns"></i> <span>Danh Mục</span></a>
                @endcanany
                <ul class="dropdown-menu">
                    @can('gate-category-view')
                        <li class="{{ Request::is('admin/product-category*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('category.product.index') }}">Danh Mục Sản Phẩm</a></li>
                    @endcan

                    @can('gate-post-category-view')
                        <li class="{{ Request::is('admin/post-category*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('category.post.index') }}">Danh Mục Bài Viết</a></li>
                    @endcan
                </ul>
            </li>


            <li
                class="dropdown {{ Request::is('admin/post-tags*') || Request::is('admin/product-tags*') ? 'active' : '' }}">
                @canany(['gate-post-tags-view', 'gate-products-tags-view'])
                    <a class="nav-link has-dropdown" href="#"><i class="fa-solid fa-tags"></i> <span>Tags</span></a>
                @endcanany
                <ul class="dropdown-menu">
                    @can('gate-post-tags-view')
                        <li class="{{ Request::is('admin/post-tags*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('tags.post.index') }}">Tags Bài Viết</a></li>
                    @endcan
                    @can('gate-products-tags-view')
                        <li class="{{ Request::is('admin/product-tags*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('tags.product.index') }}">Tags Sản Phẩm</a></li>
                    @endcan
                </ul>
            </li>


            @can('gate-services-view')
                <li class="dropdown {{ Request::is('admin/services*') ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}" class="nav-link"><i
                            class="fas fa-window-maximize"></i><span>Dịch
                            vụ</span></a>
                </li>
            @endcan

            @can('gate-slider-view')
                <li class="dropdown {{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <a href="{{ route('slider.index') }}" class="nav-link"><i
                            class="fas fa-image"></i><span>Slider</span></a>
                </li>
            @endcan

            @can('gate-albums-view')
                <li class="dropdown {{ Request::is('admin/gallerys*') ? 'active' : '' }}">
                    <a href="{{ route('gallerys.index') }}" class="nav-link"><i
                            class="fas fa-image"></i><span>Albums</span></a>
                </li>
            @endcan

            @can('gate-coupons-view')
                <li class="dropdown {{ Request::is('admin/coupons*') ? 'active' : '' }}">
                    <a href="{{ route('coupons.index') }}" class="nav-link"><i class="fas fa-gift"></i></i><span>Mã giảm
                            giá</span></a>
                </li>
            @endcan


            @can('gate-message-view')
                <li class="dropdown {{ Request::is('admin/message*') ? 'active' : '' }}">
                    <a href="{{ route('message.index') }}" class="nav-link"><i
                            class="fas fa-envelope-square"></i><span>Phản hồi</span></a>
                </li>
            @endcan
        </ul>
    </aside>
</div>
