@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh Sửa Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Slider' . ' ' . $data->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Slider</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('slider.update', ['id' => $data->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tiêu đề slider</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mô tả slider</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" value="{{ $data->description }}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div id="image-preview" class="image-preview"
                            style="background: url('{{ $data->image_path }}');background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">
                            <label for="image-upload" id="image-label">Chọn file</label>
                            <input type="file" name="feature_image_path" id="image-upload" />
                        </div>
                    </div>
                    <button class="btn btn-primary">Cập nhật slider</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
@endsection
