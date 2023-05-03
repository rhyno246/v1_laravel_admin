@extends('frontend.layout.layout')
@section('title')
    <title>{{ $news->name }}</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 30px">
            @include('frontend.partials.slidebar')
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
