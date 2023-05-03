@extends('backend.layout.admin')

@section('title')
    <title>Thêm mới hình ảnh</title>
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Thêm mới albums',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Thêm mới albums</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('gallerys.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên albums</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="text" class="form-control" name="description">
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
                                            role="tab" aria-controls="profile" aria-selected="false">Thêm ảnh nhiều
                                            ảnh</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8">
                                <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="home4" role="tabpanel"
                                        aria-labelledby="home-tab4">
                                        <div class="form-group">
                                            <div id="image-preview" class="image-preview w-100">
                                                <label for="image-upload" id="image-label">Chọn file ảnh</label>

                                                <input type="file"
                                                    class="form-control @error('feature_image_path') is-invalid @enderror"
                                                    name="feature_image_path" id="image-upload">
                                                @error('feature_image_path')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile4" role="tabpanel"
                                        aria-labelledby="profile-tab4">
                                        <div class="form-group">
                                            <div class="thumbnail-wrapper">
                                                <input type="file" id="files" class="form-control"
                                                    name="image_path[]" multiple />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right"><button class="btn btn-primary ">Tạo Albums </button></div>
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
@endsection
