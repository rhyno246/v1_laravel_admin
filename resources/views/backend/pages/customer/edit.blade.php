@extends('backend.layout.admin')

@section('title')
    <title>Trang cá nhân</title>
@endsection



@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Trang cá nhân',
    ])
    <div class="section-body">
        <form action="{{ route('customer.update', ['id' => $users->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="form-group">
                        <div id="image-preview" class="image-preview w-100"
                            style="background: url('{{ $users ? $users->src : asset('backend/assets/img/avatar/avatar-1.png') }}');background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">
                            <label for="image-upload" id="image-label">Chọn file ảnh</label>
                            <input type="file" name="src" id="image-upload" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa thông tin khách hàng</h4>
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
                                <label>Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $users->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Vai trò</label>
                                <select class="form-control form-control-sm @error('role') is-invalid @enderror"
                                    name="role">
                                    @foreach ($role_customer as $item)
                                        <option value="{{ $item->role }}"
                                            {{ $users->role == $item->role ? 'selected' : '' }}>{{ $item->role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
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
        <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
    @endsection
