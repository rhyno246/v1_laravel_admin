@extends('frontend.layout.layout')
@section('title')
    <title>Dịch vụ</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            @include('frontend.partials.slidebar')
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Service</h2>
                    @foreach ($news as $item)
                        @if ($item->status == 1)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('news.detail', ['slug' => $item->slug]) }}"><img
                                                    src="{{ $item->feature_image_path }}" alt="{{ $item->name }}" /></a>
                                            <p style="margin-top: 20px"><a
                                                    href="{{ route('news.detail', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                            </p>
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
