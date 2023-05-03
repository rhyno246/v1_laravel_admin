@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh Sửa Tags</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Tags' . ' ' . $data->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Tags</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('tags.product.update', ['id' => $data->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên tags</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Cập nhật tags</button>
                </form>
            </div>
        </div>
    </div>
@endsection
