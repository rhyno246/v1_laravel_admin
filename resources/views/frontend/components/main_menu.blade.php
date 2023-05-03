<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        @foreach ($menu as $key => $menu_parent)
            <li class="dropdown">
                <a href={{ URL::to($menu_parent->slug) }}
                    class="{{ request()->is($menu_parent->slug . '*') ? 'active' : '' }}">
                    {{ $menu_parent->name }}
                    @if ($menu_parent->getChild->count())
                        <i class="fa fa-angle-down"></i>
                    @endif
                </a>
                @include('frontend.components.menu_child', ['menu_parent' => $menu_parent])
            </li>
        @endforeach
    </ul>
</div>
