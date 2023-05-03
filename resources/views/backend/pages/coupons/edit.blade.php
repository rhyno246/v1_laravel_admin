@extends('backend.layout.admin')

@section('title')
    <title>Thêm Mới Mã Giảm Giá</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Mã Giảm Giá',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Mã Giảm Giá</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('coupons.update', ['id' => $data->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Mã</label>
                        <input type="text" class="form-control @error('coupons_key') is-invalid @enderror"
                            name="coupons_key" value="{{ $data->coupons_key }}">
                        @error('coupons_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Từ ngày</label>
                        <input type="text" class="form-control datepicker" name="date_start"
                            value="{{ $data->date_start }}">
                    </div>
                    <div class="form-group">
                        <label>Đến ngày</label>
                        <input type="text" class="form-control datepicker" name="date_end" value="{{ $data->date_end }}">
                    </div>

                    <div class="form-group">
                        <label>Loại giảm giá</label>
                        <select name="coupons_value" class="form-control">
                            <option value="0" {{ 0 == $data->coupons_value ? 'selected' : '' }}>Tiền (vnđ)</option>
                            <option value="1" {{ 1 == $data->coupons_value ? 'selected' : '' }}>Phần trăm (%)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tiền & tỉ lệ giảm</label>
                        <input type="number" class="form-control @error('coupons_price') is-invalid @enderror"
                            name="coupons_price" value="{{ $data->coupons_price }}">
                        @error('coupons_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Giỏ hàng phải trên</label>
                        <input type="number" class="form-control @error('coupons_cart_value') is-invalid @enderror"
                            name="coupons_cart_value" value="{{ $data->coupons_cart_value }}">
                        @error('coupons_cart_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Thuộc nhóm khách hàng</label>
                        <select class="form-control" name="customer_group">
                            @foreach ($customer_group as $item)
                                <option value="{{ $item->role }}"
                                    {{ $item->role == $data->customer_group ? 'selected' : '' }}>{{ $item->role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary">Chỉnh sửa mã giảm giá</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection
