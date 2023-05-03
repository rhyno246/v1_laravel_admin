@extends('backend.layout.admin')

@section('title')
    <title>Thêm Mới Tags</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Thêm Mới Tags',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm Mới Tags</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('tags.product.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Tên tags</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Tạo tags</button>
                </form>
            </div>
        </div>
    </div>
@endsection
