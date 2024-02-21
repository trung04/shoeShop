@extends('fe.layout')
@section('title')
    Your Profile
@endsection
@section('content')
    <form action="{{ route('fe.user.update', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container light-style flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-4">
                Your Profile
            </h4>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('fe.user.changePassword') }}">Change password</a>
                            <a class="list-group-item list-group-item-action" href="{{ route('fe.user.userVoucher') }}">Your
                                voucher</a>
                            <a class="list-group-item list-group-item-action" href="{{ route('fe.user.userOrder') }}">Your
                                Order</a>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    @if (auth()->user()->path)
                                        <img src="{{ asset(auth()->user()->path) }}" alt class=""
                                            style="border-radius:100%;width:100px;height:100px">
                                    @else
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                            class="d-block ui-w-80">
                                    @endif

                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" class="account-settings-fileinput" name="avatar">
                                        </label> &nbsp;
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                            name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input name="email"type="text" class="form-control mb-1"
                                            value="{{ auth()->user()->email }}" disabled>
                                        @if (auth()->user()->email_verified_at == null)
                                            <div class="alert alert-warning mt-3">
                                                Your email is not confirmed. Please check your inbox.<br>
                                                <a href="javascript:void(0)">Resend confirmation</a>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input name="phone" type="text" class="form-control"
                                                placeholder="SDT của bạn" value="<?php if (auth()->user()->phone) {
                                                    echo auth()->user()->phone;
                                                }
                                                ?>">
                                        </div>

                                    </div>

                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary" style="color:#f5f5f5">Cập nhập thông
                                        tin</a>
                                </div>

                            </div>
    </form>

    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
@endsection
@section('script')
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
@endsection
@section('style')
    <style>
        body {
            background: #f5f5f5;
            margin-top: 20px;
        }

        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: rgba(0, 0, 0, 0);
            color: #4E5155;
        }

        label.btn {
            margin-bottom: 0;
        }

        .btn-outline-primary {
            border-color: #26B4FF;
            background: transparent;
            color: #26B4FF;
        }

        .btn {
            cursor: pointer;
        }

        .text-light {
            color: #babbbc !important;
        }

        .btn-facebook {
            border-color: rgba(0, 0, 0, 0);
            background: #3B5998;
            color: #fff;
        }

        .btn-instagram {
            border-color: rgba(0, 0, 0, 0);
            background: #000;
            color: #fff;
        }

        .card {
            background-clip: padding-box;
            box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
        }

        .row-bordered {
            overflow: hidden;
        }

        .account-settings-fileinput {
            position: absolute;
            visibility: hidden;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .account-settings-links .list-group-item.active {
            font-weight: bold !important;
        }

        html:not(.dark-style) .account-settings-links .list-group-item.active {
            background: transparent !important;
        }

        .account-settings-multiselect~.select2-container {
            width: 100% !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .material-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .material-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .dark-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(255, 255, 255, 0.03) !important;
        }

        .dark-style .account-settings-links .list-group-item.active {
            color: #fff !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4E5155 !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
    </style>
@endsection
