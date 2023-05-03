@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh sửa nhóm khách hàng</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh sửa nhóm khách hàng',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh sửa nhóm khách hàng</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('customer-role.update', ['id' => $data->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên nhóm</label>
                        <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                            value="{{ $data->role }}">
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Cập nhật nhóm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
