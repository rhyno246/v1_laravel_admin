<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach ($product_hot as $item)
        @if ($item->status == 1)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{ route('product.detail', ['slug' => $item->slug]) }}"><img
                                    src="{{ $item->feature_image_path }}" alt="{{ $item->name }}" /></a>
                            <h2>{{ number_format($item->sale_price) }} vnđ</h2>
                            <p><a href="{{ route('product.detail', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                            </p>
                            <a href="#" data-url="{{ route('cart.add', ['id' => $item->id]) }}"
                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to
                                cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
<!--features_items-->
