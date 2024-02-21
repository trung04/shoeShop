@extends('be.layout')
@section('content')
<div class="h1">Size:{{$size->size}}</div>
@php
            $r=0;
        @endphp
        <div class="flex">
            @foreach ($images as $image)
            <div class="mr-8">
                Image {{++$r}}
                <img src="{{asset($image->path)}}" alt="" style="width:150px;heigh:150px">
            </div>

            @endforeach


        </div>
<div class="mb-3" style="border:1px solid black;padding:10px">
    <form action="{{route('admin.productColor.doEdit',['product_id'=>$product->id,'size_id'=>$size->id])}}" method="post">
        @csrf
    <label for="">Select Color</label>
    <div class="row">
        @forelse ($newColors as $newColor)

        <div class="col-md-3">
            <div class="p-2 border">
                Color:<input type="checkbox" name="colors[{{$newColor->id}}]" value="{{$newColor->id}}">
                {{$newColor->name}}
                <br>
                Quantity:<input type="number" name="colorQuantity[{{$newColor->id}}]" style="width:70px; border:1px solid">
                @php
                $i=0;
            @endphp
        <div>
            Image:
            <select name="image_id[{{$newColor->id}}]" id="">
                @foreach ($images as $image)
                <option value="{{$image->id}}">{{++$i}}</option>
                @endforeach
            </select>
        </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <h1>No colors found</h1>
        </div>
        @endforelse
    </div>

    <div class="table-responsive">
        <div class="table  table-sm table-border">
            <table>

                <thead>
                    <tr>
                        <th>Color Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colorProducts as $item)
                <tr class="product-color-tr">
                    <td>
                        @if ($item->color)
                        {{$item->color->name}}
                        @else
                        No Color Found
                        @endif
                    </td>
                    <td class="">
                        @php
                            $t=0;
                        @endphp
                        <select name="" id="imageId">
                            <option value="0">all </option>
                            @foreach ($images as $image)
                            <option value="{{$image->id}}">{{++$t}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <div class="input-group mb-3">
                            <input type="text" value="{{$item->quantity}}" class="productColorQuantity form-control form-control-sm" style="width:50px">
                            <button  data-url="{{route('admin.product.updateColorQty',$item->id)}}" type="button" value="{{$item->id}}" class="updateProductColorBtn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Update</button>
                        </div>
                    </td>

                    <td>
                        <button type="button" data-url="{{route('admin.product.deleteColorQty',$item->id)}}"value="{{$item->id}}" class="deleteProductColorBtn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </div>
</form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
       });
        $(document).on('click','.updateProductColorBtn',function(){
           let product_color_id=$(this).val();
           let product_id="{{$product->id}}"
           let qty=$(this).closest('.product-color-tr').find('.productColorQuantity').val();
           let imageId=$(this).closest('.product-color-tr').find('#imageId option:selected').val();
           let url=$(this).attr('data-url');
            if(qty<=0){
                alert('Quantity is required');
                return false;
            }
            var data={
                'product_id':product_id,
                'product_color_id':product_color_id,
                'qty':qty,
                'imageId':imageId
            };
            $.ajax({
                type:'POST',
                url:url,
                data:data,
                success:function(response){
                    alert(response.message);
                }
            });
        });
        $(document).on('click','.deleteProductColorBtn',function(){
            let product_color_id=$(this).val();
            let thisClick = $(this);
            let url=$(this).attr('data-url');
            $.ajax({
                type:'GET',
                url:url,
                success:function(){
                    thisClick.closest('.product-color-tr').remove();
                    alert('delete successfully');
                }
            });

        })
    });
</script>

@endsection
