@extends('frontend.layout.layout')
@section('title')
    <title>Thanh Toán</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection

@section('content')
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <h2 class="title text-center">Thanh toán</h2>
            <div class="col-md-8">
                <div class="login-form">
                    <form action="" method="POST">
                        @csrf
                        <input type="email" placeholder="Email" required name="email" />
                        <input type="text" placeholder="Tên" required name="name" />
                        <input type="number" placeholder="Điện thoại" required name="phone" />

                        <select class="js-example-placeholder-single js-city form-control" id="city" name="city">
                            <option></option>
                        </select>
                        <select class="js-example-placeholder-single js-state form-control" id="state" name="province">
                            <option></option>
                        </select>
                        <select class="js-example-placeholder-single js-state_address form-control" id="state_address"
                            name="state_address">
                            <option></option>
                        </select>
                        <input type="text" placeholder="Địa chỉ nhà" required name="address" />
                        <div class="order-message">
                            <textarea name="message" placeholder="Ghi chú" rows="16" style="margin-bottom: 0"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Đặt hàng</button>
                    </form>
                </div>
            </div>
            @php
                $total = 0;
            @endphp
            <div class="col-md-4">
                @foreach ($cart as $key => $item)
                    @php
                        $total += $item['price'] * $item['quantity'];
                    @endphp
                    <div class="checkout-item">
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <img src="{{ $item['feature_image_path'] }}" alt="{{ $item['name'] }}"
                                    style="width: 60px; height: 60px; object-fit: cover">
                            </div>
                            <div class="col-sm-9">
                                <p>{{ $item['name'] }}</p>
                                <p class="cart_total_price">
                                    {{ number_format((float) $item['price'] * $item['quantity'], 0) }} vnđ
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="total-checkout">
                    <div class="payment-options">
                        <form action="{{ route('cart.coupons') }}" method="POST" class="type_coupons"
                            style="display: flex; align-items: center">
                            @csrf
                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="type_coupons"
                                style="margin-top: 0">
                            <button type="submit" class="btn btn-primary" style="margin-top: 0">Áp dụng</button>
                        </form>
                    </div>
                    <p>Tổng cộng : <b style="color: #FE980F">{{ number_format((float) $total, 0) }} vnđ</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('frontend/js/api-address.js') }}"></script>
    @if (Session::has('message'))
        <script>
            iziToast.success({
                title: 'OK rồi !',
                message: '{{ Session::get('message') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
    @if (Session::has('fail'))
        <script>
            iziToast.error({
                title: 'Cảnh báo !',
                message: '{{ Session::get('fail') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
@endsection
