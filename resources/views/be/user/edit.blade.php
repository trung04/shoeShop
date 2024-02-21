@extends('be.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa thông tin người dùng</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('admin.user.doEdit',['id'=>$user->id])}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control"
                               placeholder="Enter email" disabled>
                    </div>
                    @error('email')
                    <p style="color: red">{{$message}}</p>

                    @enderror
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control"
                               placeholder="Full Name">
                    </div>
                    @error('name')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control"
                               placeholder="Phone">
                    </div>
                    @error('phone')
                    <p style="color: red">{{$message}}</p>

                    @enderror

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    @error('password')
                    <p style="color: red">{{$message}}</p>

                    @enderror
                    <div class="form-group">
                        <label for="password-confirm">Xác nhận lại mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password" id="password-confirm">
                    </div>
                </div>
                <div class="form-group">
                    <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chọn Quyền</label>
                    <select name="role_id"id="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($roles as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach

                    </select>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
