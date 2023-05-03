@extends('backend.layout.admin')

@section('title')
    <title>Thêm Mới Danh Mục</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Thêm Mới Danh Mục',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Mới Danh Mục</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('category.product.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên Danh Mục</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn Danh Mục</label>
                        <select class="form-control" name="parent_id">
                            <option value="0" selected="selected">Chọn danh mục cha</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    <button class="btn btn-primary">Tạo danh mục</button>
                </form>
            </div>
        </div>
    </div>
@endsection
