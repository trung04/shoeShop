@extends('be.layout')
@section('content')
<div class="card">
    <div class="card-header">
        Bảng số lượng sản phẩm
    </div>
    <div class="card-body">
        @if ($product->preview)
        <img src="{{asset($product->preview->path)}}" alt="" style="width:150px;heigh:150px">
        @else
        <a href="{{route('admin.product.previewImage',$product->id)}}">Cập nhập ảnh đại diện</a>

        @endif
      <h5 class="card-title">{{$product->name}}</h5>
      <a href="{{route('admin.productColor.add',$product->id)}}" class="btn btn-primary">Thêm size mới</a>
    </div>
  </div>

        <div class="card-body">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Size</th>
                        <th>Color-Quantity</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                @php
                    $r = 0;
                @endphp
                <tbody>
                    @foreach ($sizes as $size)
                        <tr>
                            <td>{{ ++$r }}</td>
                            <td>{{ $size->size }}</td>
                            <td>

                                        @foreach ($productColors as $productColor)
                                        <ul>
                                            @if ($productColor->size_id==$size->id)
                                            <li>
                                                <span>
                                                    <strong >
                                                        @if ($productColor->image)
                                                        <img src="{{asset($productColor->image->path)}}" alt="" style="width:50px;heigh:50px ">
                                                        @else
                                                        <p>cần chọn ảnh đại diện</p>

                                                        @endif
                                                        {{ $productColor->color->name }} -
                                                        <div class="badge bg-primary rounded-pill">{{$productColor->quantity}}</div>
                                                    </strong>
                                                </span>
                                                <hr style="border-top : 1px solid black">
                                            </li>

                                            @endif

                                        </ul>
                                        @endforeach
                            </td>
                            <td>
                                <a href="{{route('admin.productColor.edit',['product_id'=>$product->id,'size_id'=>$size->id])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Edit</a>
                                <a href="{{route('admin.productColor.delete',$size->id)}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
