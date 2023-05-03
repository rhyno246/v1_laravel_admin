@if ($menu_parent->getChild->count())
    @foreach ($menu_parent->getChild as $menu_child)
        <ul role="menu" class="sub-menu">
            <li>
                <a href="shop.html">{{ $menu_child->name }}</a>
                @if ($menu_child->getChild->count())
                    @include('frontend.components.menu_child', ['menu_parent' => $menu_child])
                @endif
            </li>
        </ul>
    @endforeach
@endif
