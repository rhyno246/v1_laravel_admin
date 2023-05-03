@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh Sửa Config</title>
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Config' . ' ' . $data->config_key,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Config</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('settings-pages.update', ['id' => $data->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Config_key</label>
                        <input type="text" class="form-control @error('config_key') is-invalid @enderror" name="config_key"
                            value="{{ $data->config_key }}">
                        @error('config_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($data->type === 'Text')
                        <div class="form-group">
                            <label>Config_value</label>
                            <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                name="config_value" value="{{ $data->config_value }}">
                            @error('config_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="text" hidden name="type" value="{{ $data->type }}">
                    @endif

                    @if ($data->type === 'Textarea')
                        <div class="form-group">
                            <label>Config_value</label>
                            <textarea name="config_value" class="form-control @error('config_value') is-invalid @enderror" rows="10">{{ $data->config_value }}</textarea>
                            @error('config_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="text" hidden name="type" value="{{ $data->type }}">
                    @endif

                    @if ($data->type === 'Image')
                        <div class="form-group">
                            <div id="image-preview" class="image-preview"
                                style="background: url('{{ $data->config_value }}');background-repeat: no-repeat;
                                background-size: cover;
                                background-position: center;">
                                <label for="image-upload" id="image-label">Chọn file ảnh</label>
                                <input type="file" class="form-control  @error('config_value') is-invalid @enderror"
                                    name="config_value" id="image-upload">
                                @error('config_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="text" hidden name="type" value="{{ $data->type }}">
                    @endif


                    <button class="btn btn-primary">Cập nhật config</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
@endsection
