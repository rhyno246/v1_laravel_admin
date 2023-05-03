@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh sửa hình ảnh</title>
@endsection

@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh sửa albums' . ' ' . $data->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Albums</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('gallerys.update', ['id' => $data->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên albums</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="text" class="form-control" name="description" value="{{ $data->description }}">
                    </div>

                    <div class="tab-gallery">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                            role="tab" aria-controls="home" aria-selected="true">Ảnh đại điện albums</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4"
                                            role="tab" aria-controls="profile" aria-selected="false">Sửa ảnh nhiều
                                            ảnh</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8">
                                <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="home4" role="tabpanel"
                                        aria-labelledby="home-tab4">
                                        <div class="form-group">
                                            <div id="image-preview" class="image-preview w-100"
                                                style="background: url('{{ $data->feature_image_path }}');background-repeat: no-repeat;
                                                background-size: cover;
                                                background-position: center;">
                                                <label for="image-upload" id="image-label">Chọn file ảnh</label>

                                                <input type="file" class="form-control" name="feature_image_path"
                                                    id="image-upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile4" role="tabpanel"
                                        aria-labelledby="profile-tab4">
                                        <div class="form-group">
                                            <div class="thumbnail-wrapper">
                                                <input type="file" id="files" class="form-control"
                                                    name="image_path[]" multiple />
                                                @foreach ($data->images as $item)
                                                    <div class="thumbnail">
                                                        <img class="imageThumb" src="{{ $item->src }}"
                                                            alt="{{ $item->image_name }}">
                                                        <a class="remove deletethumb btn btn-icon btn-danger"
                                                            href="{{ route('gallerys.deletethumbnail', ['id' => $item->id]) }}"
                                                            data-url="{{ route('gallerys.deletethumbnail', ['id' => $item->id]) }}">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right"><button class="btn btn-primary ">Cập nhật Albums </button></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
    <script src="{{ asset('backend/assets/js/uploadMutipleImage.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteThumbnailUpload.js') }}"></script>
@endsection
