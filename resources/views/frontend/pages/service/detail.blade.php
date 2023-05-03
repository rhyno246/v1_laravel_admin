@extends('frontend.layout.layout')
@section('title')
    <title>{{ $service->name }}</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            @include('frontend.partials.slidebar')
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    {!! $service->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
