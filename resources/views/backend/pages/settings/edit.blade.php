@extends('backend.layout.admin');

@section('title')
    <title>Chỉnh sửa tài khoản</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh sửa tài khoản' . ' ' . $userDetail->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh sửa tài khoản</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update', ['id' => $userDetail->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên tài khoản</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $userDetail->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $userDetail->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            value="{{ $userDetail->password_dehash }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label> Chọn vai trò</label>
                        <select class="form-control select2 @error('role_id') is-invalid @enderror" multiple=""
                            name="role_id[]">
                            @foreach ($role as $item)
                                <option {{ $roleOfUser->contains('id', $item->id) ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->display_name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Cập nhật tài khoản</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endsection
