@extends('frontend.layout.layout')
@section('title')
    <title>Giỏ hàng</title>
@endsection


@section('css')
@endsection
@section('content')
    <div class="container">
        <h2 class="title text-center">Giỏ hàng</h2>
        @include('frontend.pages.cart.components.cart_item')
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/update-cart.js') }}"></script>
    <script src="{{ asset('frontend/js/cart-delete.js') }}"></script>
@endsection
