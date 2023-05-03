@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh Sửa Dịch Vụ</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection

@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Dịch Vụ' . ' ' . $data->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Dịch Vụ</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('services.update', ['id' => $data->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tiêu đề bài viết</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="ckeditor" name="content" rows="30">{{ $data->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện dịch vụ</label>
                        <div id="image-preview" class="image-preview"
                            style="background: url('{{ $data->feature_image_path }}');background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">
                            <label for="image-upload" id="image-label">Chọn file ảnh</label>
                            <input type="file" class="form-control" name="feature_image_path" id="image-upload" />
                        </div>
                    </div>
                    <button class="btn btn-primary">Cập nhật dịch vụ</button>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
    <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
@endsection
