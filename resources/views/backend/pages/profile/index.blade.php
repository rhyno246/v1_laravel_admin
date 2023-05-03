@extends('backend.layout.admin')

@section('title')
    <title>Trang cá nhân</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Trang cá nhân',
    ])
    <div class="section-body">
        <h2 class="section-title">Hi, {{ $users->name }}</h2>
        <p class="section-lead">
            Thay đổi thông tin về bạn trên trang này
        </p>
        <form action="{{ route('profile.update', ['id' => $users->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="form-group">
                        <div id="image-preview" class="image-preview w-100"
                            style="background: url('{{ $avartar ? $avartar->src : asset('backend/assets/img/avatar/avatar-1.png') }}');background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">
                            <label for="image-upload" id="image-label">Chọn file ảnh</label>
                            <input type="file" name="image_path" id="image-upload" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa trang cá nhân</h4>
                        </div>
                        <div class="feild pl-4 pr-4 pt-4">
                            <div class="form-group">
                                <label>Tên tài khoản</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $users->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $users->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ $users->password_dehash }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    @endsection

    @section('js')
        <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
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
    @endsection
