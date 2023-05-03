@extends('backend.layout.admin');

@section('title')
    <title>Cài đặt trang</title>
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
        'name' => 'Cài đặt trang',
    ])
    <div class="section-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Tùy chọn</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('settings-pages.create') . '?type=Text' }}" class="dropdown-item has-icon">
                                Tạo config text</a>
                            <a href="{{ route('settings-pages.create') . '?type=Textarea' }}"
                                class="dropdown-item has-icon">
                                Tạo config area</a>
                            <a href="{{ route('settings-pages.create') . '?type=Image' }}" class="dropdown-item has-icon">
                                Tạo config image</a>
                        </div>
                    </div>
                    <div class="text-right">
                        @csrf
                        <a class="btn btn-danger d-none deleteSeleted" data-url="{{ route('settings-pages.deleteselect') }}"
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
                                    <th>Config_key</th>
                                    <th>Config_value</th>
                                    <th>Người tạo</th>
                                    <th>Tạo Ngày</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($setting_page as $item)
                                    <tr id="ids{{ $item->id }}">
                                        <td class="align-middle">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-{{ $item->id }}"
                                                    name="ids" value="{{ $item->id }}">
                                                <label for="checkbox-{{ $item->id }}"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $item->config_key }}</td>
                                        <td class="align-middle" style="width:70%">
                                            @if ($item->type === 'Image')
                                                <img src="{{ $item->config_value }}" alt="{{ $item->id }}"
                                                    style="width: 50px; height : 50px; object-fit: cover">
                                            @else
                                                <span>{{ $item->config_value }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $item->user_name }}</td>
                                        <td class="align-middle">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('settings-pages.edit', ['id' => $item->id]) }}"
                                                    class="btn btn-primary mr-2">Sửa</a>
                                                <a href="{{ route('settings-pages.delete', ['id' => $item->id]) }}"
                                                    data-url="{{ route('settings-pages.delete', ['id' => $item->id]) }}"
                                                    class="btn btn-danger delete-model">Xóa</a>
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
    </div>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->

    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/customDatatable.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteModel.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deleteSeleted.js') }}"></script>

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
