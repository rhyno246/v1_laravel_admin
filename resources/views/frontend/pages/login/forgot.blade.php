@extends('frontend.layout.layout')
@section('title')
    <title>Quên mật khẩu</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            <div class="login-form">
                <h2>Quên mật khẩu</h2>
                <form action="{{ route('forgot') }}" method="POST">
                    @csrf
                    <input type="email" placeholder="Email" required name="email" />
                    <button type="submit" class="btn btn-default">Gửi</button>
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

    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'OK rồi !',
                message: '{{ Session::get('success') }}',
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
