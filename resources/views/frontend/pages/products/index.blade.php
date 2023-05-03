@extends('frontend.layout.layout')
@section('title')
    <title>Sản phẩm</title>
@endsection
@section('content')
    <div class="container">
        <img src="{{ asset('frontend/images/shop/advertisement.jpg') }}" alt="" class="img-responsive"
            style="margin-bottom: 25px">
    </div>
    <div class="container">
        <div class="row">
            @include('frontend.partials.slidebar')
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Products</h2>
                    @foreach ($product as $item)
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
@endsection
