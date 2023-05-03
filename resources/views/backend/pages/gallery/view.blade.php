@extends('backend.layout.admin')

@section('title')
    <title>Albums {{ $view->name }} </title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection
@section('content')
    @include('backend.partials.headercontent', [
        'name' => 'Albums' . ' ' . $view->name,
    ])
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>
                    <a href="{{ url()->previous() }}" style="text-decoration: none"> <i
                            class="fas fa-arrow-alt-circle-left"></i> <span>Trở về Albums</span>
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="gallery-albums gallery">
                                @foreach ($view->images as $item)
                                    <div class="items gallery-item" data-image="{{ $item->src }}"
                                        data-title="{{ $item->image_name }}">
                                        <img src="{{ $item->src }}" alt="{{ $item->image_name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endsection
