<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($product_recommended as $key => $item)
                @if ($key % 3 == 0)
                    <div class="item  {{ $key == 0 ? 'active' : '' }}">
                @endif
                @if ($item->status == 1)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{ route('product.detail', ['slug' => $item->slug]) }}"><img
                                            src="{{ $item->feature_image_path }}" alt="{{ $item->name }}" /></a>
                                    <h2>{{ number_format($item->sale_price) }} vnđ</h2>
                                    <p><a
                                            href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </p>
                                    <a href="#" class="btn btn-default add-to-cart"
                                        data-url="{{ route('cart.add', ['id' => $item->id]) }}"><i
                                            class="fa fa-shopping-cart"></i>Add
                                        to
                                        cart</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                @if ($key % 3 == 2)
        </div>
        @endif
        @endforeach
    </div>
</div>
<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
    <i class="fa fa-angle-left"></i>
</a>
<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
    <i class="fa fa-angle-right"></i>
</a>
</div>
</div>
<!--/recommended_items-->
