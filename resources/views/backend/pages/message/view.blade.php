@extends('backend.layout.admin')

@section('title')
    <title>Phản hồi của {{ $data->name }}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection


@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Phản hồi của' . ' ' . $data->name,
    ])
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ $data->email }}</h4>
            </div>
            <div class="card-body">
                <div class="ticket-content">
                    <div class="ticket-header">
                        <div class="ticket-detail">
                            <div class="ticket-title">
                                <h4>Tiêu đề : {{ $data->subject }}</h4>
                            </div>
                            <div class="ticket-info">
                                <div class="font-weight-600 mb-2">Tên : {{ $data->name }}</div>
                                <div class="text-primary font-weight-600 mb-2">
                                    {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-description">
                        <p>{{ $data->message }}</p>
                    </div>
                </div>
                <hr>
                <div class="ticket-content">
                    <div class="ticket-title">
                        <h4>Trả lời mail {{ $data->email }}</h4>
                    </div>
                    <form action="{{ route('message.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Gửi tới</label>
                            <input type="text" class="form-control" name="email" value="{{ $data->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea type="text" class="form-control" name="message"></textarea>
                        </div>
                        <button class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
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
