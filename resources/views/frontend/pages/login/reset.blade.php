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
                <h2>Reset password</h2>
                <form action="{{ route('reset.token') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">


                    <input type="email" placeholder="Email" required name="email" value="{{ $email }}"
                        readonly />
                    <input type="password" required placeholder="Nhập mật khẩu mới" name="new_password">

                    <button type="submit" class="btn btn-default">Reset password</button>
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
