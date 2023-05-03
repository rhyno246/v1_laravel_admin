@extends('backend.layout.admin')

@section('title')
    <title>Sửa vai trò</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Sửa vai trò' . ' ' . $data->display_name,
    ])
    <div class="col-12">
        <div class="card card-parent">
            <div class="card-header">
                <h4>Sửa vai trò</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên vai trò</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Vai trò hiển thị</label>
                        <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                            name="display_name" value="{{ $data->display_name }}">
                        @error('display_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @foreach ($permissionParent as $item)
                        <div class="card card-child permission-item">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <label class="colorinput">
                                        <input id="{{ $item->name }}" type="checkbox"
                                            class="colorinput-input checkbox_wrapper">
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                    <h4 class="ml-2">Module - {{ $item->display_name }}</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($item->permissionChild as $childItem)
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <label class="colorinput">
                                                    <input
                                                        {{ $permissionChecked->contains('id', $childItem->id) ? 'checked' : '' }}
                                                        id="{{ $childItem->id }}" name="permission_id[]"
                                                        value="{{ $childItem->id }}" type="checkbox"
                                                        class="colorinput-input checkbox_child">
                                                    <span class="colorinput-color bg-primary"></span>
                                                </label>
                                                <span class="ml-2">{{ $childItem->display_name }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn btn-primary">Cập nhật vai trò</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script>
        $(document).on('click', '.checkbox_wrapper', function() {
            if (this.checked) {
                $(this).parents('.permission-item').find('.checkbox_child').prop('checked', true);
            } else {
                $(this).parents('.permission-item').find('.checkbox_child').prop('checked', false);
            }
        })
        $(".checkbox_child").click(function() {
            if (!$(this).prop('checked')) {
                $(this).parents('.permission-item').find('.checkbox_wrapper').prop('checked', false);
            } else {
                $(this).parents('.permission-item').find('.checkbox_wrapper').prop('checked', true);
            }
        });
    </script>
@endsection
