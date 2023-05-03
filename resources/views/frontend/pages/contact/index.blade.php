@extends('frontend.layout.layout')
@section('title')
    <title>Liên hệ</title>
@endsection
@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-12">
                {!! getConfigValueSettingTable('contact_config') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Phản hồi chúng tôi</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact_form" method="post"
                        action="{{ route('message.create') }}">
                        @csrf
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required"
                                placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required"
                                placeholder="Tiêu đề">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"
                                maxlength="255"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên hệ</h2>
                    <address>
                        <p>{{ getConfigValueSettingTable('address_config') }}</p>
                        <p>Mobile: {{ getConfigValueSettingTable('phone_config') }}</p>
                        <p>Email: {{ getConfigValueSettingTable('email_config') }}</p>
                    </address>
                </div>
            </div>
        </div>
    </div>
@endsection
