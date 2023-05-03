@extends('backend.layout.admin')

@section('title')
    <title>Danh sách hình ảnh </title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Danh sách Albums',
        'button' => 'Thêm Mới',
        'link' => 'gallerys.create',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Danh sách Albums</h4>
            </div>
            <div class="card-body">
                @if ($gallerys->count() === 0)
                    @include('backend.partials.empty')
                @else
                    <div class="row">
                        @foreach ($gallerys as $item)
                            <div class="col-md-4">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h4>{{ $item->name ? $item->name : 'Không tên' }}</h4>
                                        <div class="card-header-action d-flex">
                                            <label class="custom-switch mr-2">
                                                <input type="checkbox"
                                                    data-url="{{ route('gallerys.statusgallery', ['id' => $item->id]) }}"
                                                    name="status" class="custom-switch-input"
                                                    {{ $item->status == 1 ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                    class="btn btn-warning dropdown-toggle">Tùy chọn</a>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('gallerys.view', ['id' => $item->id]) }}"
                                                        class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                                                        Xem</a>
                                                    <a href="{{ route('gallerys.edit', ['id' => $item->id]) }}"
                                                        class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                        Sửa</a>
                                                    <a href="{{ route('gallerys.delete', ['id' => $item->id]) }}"
                                                        data-url="{{ route('gallerys.delete', ['id' => $item->id]) }}"
                                                        class="dropdown-item has-icon delete-model"><i
                                                            class="far fa-trash-alt"></i>
                                                        Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('gallerys.view', ['id' => $item->id]) }}" class="d-block"><img
                                                src="{{ $item->feature_image_path }}" alt="{{ $item->feature_image_name }}"
                                                class="w-100 d-block img-albums"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteGallery.js') }}"></script>
    <script src="{{ asset('backend/assets/js/changeStatusHome.js') }}"></script>
    @if (Session::has('message-edit'))
        <script>
            iziToast.success({
                title: 'OK rồi !',
                message: '{{ Session::get('message-edit') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif

    @if (Session::has('message'))
        <script>
            iziToast.success({
                title: 'OK rồi !',
                message: '{{ Session::get('message') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
@endsection
