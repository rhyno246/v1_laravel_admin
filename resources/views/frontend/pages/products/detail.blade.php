@extends('frontend.layout.layout')
@section('title')
    <title>{{ $product->name }}</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            @include('frontend.partials.slidebar')
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{ $product->feature_image_path }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information">
                            <!--/product-information-->
                            <h2>{{ $product->name }}</h2>
                            <p>Web ID: {{ $product->id }}</p>
                            <span>
                                <span>{{ number_format($product->sale_price) }}vnđ </span>
                                <label>Quantity:</label>
                                <input type="text" value="1">

                            </span>
                            <div class="text-left">
                                <a href="#" data-url="{{ route('cart.add', ['id' => $product->id]) }}"
                                    class="btn btn-fefault cart add-to-cart" style="margin-left: 0">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </a>
                            </div>
                            <p><b>Availability:</b> {{ $product->stock == 0 ? 'Out Stock' : 'In Stock' }}</p>
                            <p><b>category :</b> {{ optional($product->categoriesInstance)->name }}</p>
                            <div style="display: flex; margin-top: 15px">
                                @foreach ($product->tags as $item)
                                    <div style="margin-right: 10px">
                                        {{ $item->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category-tab shop-details-tab">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                            <li class=""><a href="#reviews" data-toggle="tab">Reviews</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="details" style="padding: 0 25px">
                                {!! $product->content !!}
                            </div>

                            <div class="tab-pane fade" id="reviews">
                                review
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
@endsection
