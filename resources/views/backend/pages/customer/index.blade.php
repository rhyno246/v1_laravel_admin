@extends('backend.layout.admin');

@section('title')
    <title>Danh Sách Khách Hàng</title>
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
        'name' => 'Danh Sách Khách Hàng',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="d-flex align-items-center">
                    <span class="mr-3">Danh Sách Khách Hàng</span>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Tạo và xem nhóm
                            khách hàng</a>
                        <div class="dropdown-menu">
                            <a href="#view" data-toggle="modal" data-target="#view" class="dropdown-item has-icon"><i
                                    class="fas fa-eye"></i>
                                Xem</a>
                            <a href="{{ route('customer-role.create') }}" class="dropdown-item has-icon"><i
                                    class="far fa-edit"></i>
                                Tạo mới</a>
                        </div>
                    </div>
                </h4>
                <div class="text-right">
                    @csrf
                    <a class="btn btn-danger d-none deleteSeleted" data-url="{{ route('customer.deleteselect') }}"
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
                                <th>Tên tài khoản</th>
                                <th>Ảnh đại diện</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Thuộc nhóm</th>
                                <th>Mật khẩu</th>
                                <th>Đăng ký ngày</th>
                                <th>Status</th>
                                <th>Hành Động</th>
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
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle"><img
                                            src="{{ $item->src ? $item->src : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                            alt="{{ $item->image_name }}"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px">
                                    </td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="align-middle">{{ $item->phone }}</td>
                                    <td class="align-middle">{{ $item->role }}</td>
                                    <td class="align-middle">{{ $item->password_dehash }}</td>
                                    <td class="align-middle">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td class="align-middle">
                                        <label class="custom-switch">
                                            <input type="checkbox"
                                                data-url="{{ route('customer.statushome', ['id' => $item->id]) }}"
                                                name="is-show-home" class="custom-switch-input"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('customer.edit', ['id' => $item->id]) }}"
                                                class="btn btn-primary mr-2">Sửa</a>
                                            <a href="{{ route('customer.delete', ['id' => $item->id]) }}"
                                                data-url="{{ route('customer.delete', ['id' => $item->id]) }}"
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
@endsection
<div class="modal fade bd-example-modal-lg" id="view" tabindex="-1" role="dialog" aria-labelledby="view"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Danh sách nhóm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-0" style="box-shadow: none">
                    <div class="card-body card-popup-customer pt-0 pb-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nhóm</th>
                                    <th scope="col">Tạo Ngày</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role_customer as $item)
                                    <tr>
                                        <td>
                                            {{ $item->role }}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @if ($item->role !== 'normal')
                                                    <a href="{{ route('customer-role.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-primary mr-2"
                                                        data-url="{{ route('customer-role.edit', ['id' => $item->id]) }}">Sửa</a>
                                                    <a href="{{ route('customer-role.delete', ['id' => $item->id]) }}"
                                                        data-url="{{ route('customer-role.delete', ['id' => $item->id]) }}"
                                                        class="btn btn-danger delete-model">Xóa</a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
    <script src="{{ asset('backend/assets/js/changeStatusHome.js') }}"></script>

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
