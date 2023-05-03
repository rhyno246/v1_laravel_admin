@extends('frontend.layout.layout')
@section('title')
    <title>Trang cá nhân của {{ $user->name }}</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#profile">Thông tin cá nhân</a></li>
                <li><a data-toggle="tab" href="#change_pass">Đổi mật khẩu</a></li>
                <li><a data-toggle="tab" href="#order">Đã mua</a></li>
                <li><a data-toggle="tab" href="#coupons">Mã giảm giá của bạn</a></li>
            </ul>
            <div class="tab-content" style="margin-bottom: 30px">
                <div id="profile" class="tab-pane fade in active">
                    <div class="login-form" style="margin-bottom: 20px">




                        <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="img text-center" style="margin-bottom: 20px;">
                                <div id="image-preview" class="image-preview w-100"
                                    style="background: url('{{ session()->get('users')->src ? session()->get('users')->src : asset('backend/assets/img/avatar/avatar-1.png') }}');background-repeat: no-repeat;
                                background-size: cover;
                                background-position: center;">
                                    <label for="image-upload" id="image-label">Chọn file ảnh</label>
                                    <input type="file" name="src" id="image-upload" />
                                </div>
                            </div>
                            @csrf
                            <input type="text" name="role" value="{{ $user->role }}" readonly>
                            <input type="text" placeholder="" required value="{{ $user->name }}" name="name">
                            <input type="email" placeholder="" required value="{{ $user->email }}" name="email">
                            <input type="password" placeholder="" required value="{{ $user->password_dehash }}"
                                name="password">
                            <input type="number" placeholder="" required value="{{ $user->phone }}" name="phone">
                            <button type="submit" class="btn btn-default">Cập nhật</button>
                        </form>
                    </div>
                </div>
                <div id="change_pass" class="tab-pane fade">
                    <h3 class="text-center">Đổi mật khẩu</h3>
                    <div class="login-form">
                        <form action="{{ route('change.password', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <input type="password" name="old_password" placeholder="Nhập mật khẩu cũ" required>
                            <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
                            <button type="submit" class="btn btn-default">Đổi mật khẩu</button>
                        </form>
                    </div>

                </div>

                <div id="order" class="tab-pane fade">
                    <div class="col-sm-4">
                        <div class="product-image-wrapper" style="margin-top: 20px">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href=""><img src="{{ asset('frontend/images/cart/one.png') }}" /></a>
                                    <h2>200.000 vnđ</h2>
                                    <p><a href="">dsfdsdsds</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper" style="margin-top: 20px">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href=""><img src="{{ asset('frontend/images/cart/one.png') }}" /></a>
                                    <h2>200.000 vnđ</h2>
                                    <p><a href="">dsfdsdsds</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="coupons" class="tab-pane fade">
                    <div class="coupons" style="margin-top: 50px">
                        <div class="content">
                            @foreach ($user_coupons as $item)
                                @if (date('Y-m-d') >= $item->date_start)
                                    <div class="coupon-wrapper tooltips"
                                        tooltip="{{ $item->date_end >= date('Y-m-d') ? 'Mã này còn hạn' : 'Mã này đã hết hạn' }}"
                                        tooltip-position="top"
                                        tooltip-type="{{ $item->date_end >= date('Y-m-d') ? 'success' : 'danger' }}">
                                        <input class="coupon-input" readonly="true" value="{{ $item->coupons_key }}" />
                                        <button class="coupon-button clickCoupon"
                                            {{ $item->date_end >= date('Y-m-d') ? '' : 'disabled' }}>
                                            Copy
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
    <script src="{{ asset('frontend/js/copy-coupons.js') }}"></script>
    @if (Session::has('fail'))
        <script>
            iziToast.error({
                title: 'Cảnh báo !',
                message: '{{ Session::get('fail') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
    @if (Session::has('message'))
        <script>
            iziToast.success({
                title: 'OK rồi !',
                message: '{{ Session::get('message') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
@endsection
