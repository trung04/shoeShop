@extends('be.layout')
@section('content')
<form action="{{route('admin.product.doEditPreviewImage',$previewImage->id)}}" method="post">
    @csrf
    <p style="font-size: 50px;font-family:'Courier New', Courier, monospace">Cập nhập ảnh đại diện</p>
    <div class="flex">
        @php
            $r = 0;
        @endphp
        @foreach ($images as $image)
            <div class="mr-8">
                <input type="radio" name="image_id" value="{{$image->id}}">
                Image {{ ++$r }}
                <img src="{{ asset($image->path) }}" alt="" style="width:150px;heigh:150px">
            </div>
        @endforeach
    </div>
    <div style="margin-top:20px">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cập nhập</button>
    </div>
</form>


@endsection
