@extends('fe.layout')
@section('title')
    Change Your Password
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('fe.user.profile') }}">Your profile</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Change Password</strong>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="changePassword">
        <h1>Thay đổi mật khẩu</h1>
        <form action="{{ route('fe.user.doChangePassword', auth()->user()->id) }}" method="post"
            id="changePasswordAdminForm">
            @csrf
            <div class="form-group">
                <label class="form-label">Current password</label>
                <input type="password" class="form-control" name="current_password" id="oldpassword">
            </div>
            @error('current_password')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label class="form-label" for="password">New password</label>
                <input type="password" class="form-control" name="new_password" id="newpassword">
            </div>
            @error('new_password')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label class="form-label" for="password-confirm ">Repeat new password</label>
                <input type="password" class="form-control" name="confirm_password" id="cnewpassword">
            </div>
            @error('confirm_password')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary" style="color:#f5f5f5">Thay đổi mật khẩu</a>
            </div>

        </form>
    </div>
@endsection
@section('style')
    <style>
        .changePassword {
            border: 1px solid gray;
            padding: 50px;
            margin: 0px auto;
            width: 40%;
        }
    </style>
@endsection
