@extends('backend.layout.admin')

@section('title')
    <title>Danh sách phản hồi</title>
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
        'name' => 'Danh sách phản hồi',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Danh sách phản hồi</h4>
                <div class="text-right">
                    @csrf
                    <a class="btn btn-danger d-none deleteSeleted" data-url="{{ route('message.deleteselect') }}"
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
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Xem</th>
                                <th>Ngày gửi</th>
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
                                        {{ $item->email }}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('message.view', ['email' => $item->email]) }}"><i
                                                class="fas fa-eye"></i></a>
                                    </td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($item->created_at)) }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('message.delete', ['id' => $item->id]) }}"
                                                class="btn btn-danger delete-model mr-2"
                                                data-url="{{ route('message.delete', ['id' => $item->id]) }}">Xóa</a>
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
