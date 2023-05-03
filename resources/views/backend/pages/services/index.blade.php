@extends('backend.layout.admin')

@section('title')
    <title>Danh Sách Dịch Vụ</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Danh Sách Dịch Vụ',
        'button' => 'Thêm Mới',
        'link' => 'services.create',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Danh Sách Dịch Vụ</h4>
                <div class="text-right">
                    @csrf
                    <a class="btn btn-danger d-none deleteSeleted" data-url="{{ route('services.deleteselect') }}"
                        style="color: #fff"></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-page">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                            class="custom-control-input" id="checkbox-all" name="main-checkbox">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Tên bài viết</th>
                                <th>Hình ảnh</th>
                                <th>Hiện ở trang chủ</th>
                                <th>Ẩn / Hiện</th>
                                <th>Tạo ngày</th>
                                <th>Người tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr id="ids{{ $item->id }}">
                                    <td class="align-middle">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                id="checkbox-{{ $item->id }}" name="ids"
                                                value="{{ $item->id }}">
                                            <label for="checkbox-{{ $item->id }}"
                                                class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        {{ $item->name }}
                                    </td>
                                    <td class="align-middle">
                                        <img src="{{ $item->feature_image_path ? $item->feature_image_path : 'https://dummyimage.com/60/873d87/fff.png' }}"
                                            alt="{{ $item->feature_image_name }}"
                                            style="width: 60px; height: 40px; object-fit: cover">
                                    </td>
                                    <td class="align-middle">
                                        <label class="custom-switch">
                                            <input type="checkbox"
                                                data-url="{{ route('services.statushome', ['id' => $item->id]) }}"
                                                name="is-show-home" class="custom-switch-input"
                                                {{ $item->is_show_home == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <label class="custom-switch">
                                            <input type="checkbox"
                                                data-url="{{ route('services.statusproduct', ['id' => $item->id]) }}"
                                                name="status" class="custom-switch-input"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($item->created_at)) }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $item->user_name }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('services.edit', ['id' => $item->id]) }}"
                                                class="btn btn-primary mr-2">Sửa</a>
                                            <a href="{{ route('services.delete', ['id' => $item->id]) }}"
                                                class="btn btn-danger delete-model mr-2"
                                                data-url="{{ route('services.delete', ['id' => $item->id]) }}">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteModel.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteSeleted.js') }}"></script>
    <script src="{{ asset('backend/assets/js/customDatatable.js') }}"></script>
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
