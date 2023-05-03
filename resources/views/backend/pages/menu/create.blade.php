@extends('backend.layout.admin')

@section('title')
    <title>Thêm Mới Menu</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Thêm Mới Menu',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Mới Menu</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('menu.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên menu</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn menu</label>
                        <select class="form-control" name="parent_id">
                            <option value="0" selected="selected">Chọn menu cha</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Icon menu</label>
                        <input type="text" class="form-control" name="icon_menu">
                    </div>
                    <button class="btn btn-primary">Tạo Menu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
