@extends('be.layout')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="btn btn-primary">Kích hoạt
                        ({{ $count[1] }})</a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trashed']) }}" class="btn btn-warning">Vô hiệu hóa
                        ({{ $count[0] }})</a>
                </h3>
                <div class="card-tools">
                    <form action="">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="keyword"
                                value="{{ request()->input('keyword') }}"class="form-control float-right"
                                placeholder="Search" name="keyword">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                <div class="input-group-append">
                            </button>
                        </div>

                    </form>
                </div>
                <form action="{{ route('admin.user.action') }}" method="post">
                    @csrf
                    <select id="" name="act">
                        <option>Tác vụ</option>
                        @foreach ($listAct as $act)
                            <option value="{{ $act }}">{{ $act }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Áp dụng"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Name</th>
                        <th>Chức vụ</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                @php
                    $r = 1;
                @endphp
                <tbody>
                    @foreach ($lists as $list)
                        <tr>
                            <td>
                                <input type="checkbox" value={{ $list->id }} name="listId[]">
                            </td>
                            <td>{{ $r++ }}</td>
                            <td>{{ $list->email }}</td>
                            <td>
                                @if ($list->phone)
                                    {{ $list->phone }}
                                @else
                                    Thông tin chưa cập nhập
                                @endif
                            </td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->role->name }}</td>
                            @if ($list->id != Auth::user()->id)
                                <td>
                                    <a href="{{ route('admin.user.edit', $list->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('admin.user.delete', $list->id) }}" class="btn btn-warning">Delete</a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lists->appends(['status' => "$status", 'keyword' => "$keyword"])->links() }}
            </form>
        </div>

    </div>

    </div>
@endsection
