@extends('frontend.layout.layout')
@section('title')
    <title>Đăng nhập</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            <div class="login-form">
                <h2>Đăng nhập</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="email" placeholder="Email" required name="email" />
                    <input type="password" required placeholder="Nhập mật khẩu" name="password">
                    <p style="margin-top: 20px"> <a href="{{ route('register') }}">Tôi Chưa có tài khoản , tôi muốn đăng
                            ký</a> </p>
                    <p style="margin-top: 20px"> <a href="{{ route('forgot') }}">Quên mật khẩu</a> </p>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
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
