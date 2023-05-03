@extends('backend.layout.admin')

@section('title')
    <title>Tạo Quyền Truy Cập</title>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Tạo Quyền Truy Cập',
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tạo Quyền Truy Cập</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Chọn tên Module</label>
                        <select class="form-control" name="module_parent">
                            @foreach (config('permissions.table_module') as $moduleItem)
                                <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">

                            @foreach (config('permissions.module_child') as $item)
                                <div class="col-md-3">
                                    <div class="col-auto d-flex align-items-center">
                                        <label class="colorinput">
                                            <input name="module_child[]" id="{{ $item }}" type="checkbox"
                                                value="{{ $item }}" class="colorinput-input" checked>
                                            <span class="colorinput-color bg-primary"></span>
                                        </label>
                                        <span class="ml-2">{{ $item }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary">Tạo Quyền Truy Cập</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    @if (Session::has('warning'))
        <script>
            iziToast.warning({
                title: 'Cảnh báo !',
                message: '{{ Session::get('warning') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'Ok rồi !',
                message: '{{ Session::get('success') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
@endsection
