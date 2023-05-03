@extends('backend.layout.admin')

@section('title')
    <title>Chỉnh Sửa Sản Phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection

@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Chỉnh Sửa Sản Phẩm' . ' ' . $data->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh Sửa Sản Phẩm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', ['id' => $data->id]) }}" method="POST"
                    enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nhập giá tiền</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                            value="{{ $data->price }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nhập số lượng</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                            value="{{ $data->stock }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Chọn danh mục</label>
                        <select class="form-control select2" name="categories_id">
                            <option selected="selected" disabled></option>
                            {!! $htmlOption !!}
                        </select>
                    </div>


                    <div class="form-group">
                        <select class="form-control choose_sale" name="choose_sale">
                            <option {{ $data->choose_sale == '' ? 'selected' : '' }} value="">Giảm giá theo</option>
                            <option {{ $data->choose_sale == 'sale_persent' ? 'selected' : '' }} value="sale_persent">Giảm
                                theo %</option>
                            <option {{ $data->choose_sale == 'sale_price' ? 'selected' : '' }} value="sale_price">Giảm theo
                                giá tiền</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control sale {{ $data->choose_sale == '' ? 'd-none' : '' }}"
                            name="sale" value="{{ $data->choose_sale == '' ? '' : $data->sale }}">
                    </div>


                    <div class="form-group">
                        <textarea class="form-control" id="ckeditor" name="content" rows="30">
                            {{ $data->content }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Chọn tags cho sản phẩm</label>
                        <select class="form-control select2" name="tags[]" multiple="multiple">
                            @foreach ($product_tag as $item)
                                <option value="{{ $item->id }}"
                                    @foreach ($data->tags as $tag)
                                        @if ($tag->id == $item->id)
                                            selected 
                                        @endif @endforeach>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện sản phẩm</label>
                        <div id="image-preview" class="image-preview"
                            style="background: url('{{ $data->feature_image_path }}');background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">
                            <label for="image-upload" id="image-label">Chọn file ảnh</label>
                            <input type="file" name="feature_image_path" id="image-upload" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Thumnail sản phẩm</label>
                        <div class="thumbnail-wrapper">
                            <input type="file" id="files" name="image_path[]" multiple />

                            @foreach ($data->images as $item)
                                <div class="thumbnail">
                                    <img class="imageThumb" src="{{ $item->src }}" alt="{{ $item->image_name }}">
                                    <a class="remove deletethumb btn btn-icon btn-danger"
                                        href="{{ route('products.deletethumbnail', ['id' => $item->id]) }}"
                                        data-url="{{ route('products.deletethumbnail', ['id' => $item->id]) }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-primary">Cập nhật sản phẩm</button>

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
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chooseImage.js') }}"></script>
    <script src="{{ asset('backend/assets/js/uploadMutipleImage.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteThumbnailUpload.js') }}"></script>
    <script>
        $('.choose_sale').on('change', function() {
            $('.sale').addClass('d-block');
        });
    </script>
@endsection
