@extends('be.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Table</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.product.search') }}">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="search" name="query" class="form-control float-right" placeholder="Tìm kiếm">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('admin.product.add') }}" class="float-center" style="margin-left:100px;color:red">Add
                        Product</a>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th style="width:400px">Name</th>
                                <th>Information</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $r = 0;
                            @endphp
                            @foreach ($lists as $item)
                                <tr>
                                    <td>{{ ++$r }}</td>
                                    <td>
                                        @if ($item->preview)
                                            <img src="{{ asset($item->preview->path) }}" style="width: 100p;height:100px"
                                                alt="">
                                            <small> <a href="{{ route('admin.product.editPreviewImage', $item->id) }}"
                                                    class="" style="color:blue">Edit Image</a></small>
                                        @else
                                            <a href="{{ route('admin.product.previewImage', $item->id) }}">Cập nhập ảnh</a>
                                        @endif

                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <span class="badge badge-primary">
                                                    Brand:@if ($item->brand)
                                                        {{ $item->brand->name }}
                                                    @else
                                                        No Brand
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                Giá : {{ number_format($item->price, 0, '.', '.') }}
                                            </li>
                                            <li>
                                                <span class="badge badge-primary">
                                                    @if ($item->category)
                                                        {{ $item->category->name }}
                                                    @else
                                                        No Category
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="badge badge-primary">
                                                    @if ($item->material)
                                                        {{ $item->material->name }}
                                                    @else
                                                        Unknown material
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.productColor.detail', $item->id) }}"
                                                    class="">More Detail Product</a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $item->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border
                border-blue-700 rounded">Edit</a>
                                        <a href="{{ route('admin.product.delete', $item->id) }}"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border
                border-red-700 rounded"
                                            onclick="return confirm('Do you want to delete this ?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lists->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
@section('style')
@endsection
@section('scripts')
@endsection
