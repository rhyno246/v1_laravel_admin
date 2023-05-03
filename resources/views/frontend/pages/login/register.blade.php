@extends('frontend.layout.layout')
@section('title')
    <title>Đăng ký</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            <div class="signup-form">
                <!--sign up form-->
                <h2>Đăng ký tài khoản</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="text" placeholder="Tên" required name="name" />
                    <input type="email" placeholder="Email" required name="email" />
                    <input type="number" placeholder="Điện thoại" required name="phone" />
                    <input type="password" placeholder="Mật Khẩu" required name="password" />
                    <p style="margin-top: 20px"> <a href="{{ route('login') }}">Tôi đã có tài khoản rồi , tôi muốn đăng
                            nhập</a> </p>
                    <button type="submit" class="btn btn-default">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
@endsection
