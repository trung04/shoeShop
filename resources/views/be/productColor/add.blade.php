@extends('be.layout')
@section('content')
    <form action="{{route('admin.productColor.doAdd',$product->id)}}" method="post">
        @csrf
        <div class="form-group" >
            <label>Size:</label>
                @foreach ($newSizeIds as $newSize)
                <span style="margin-left:30px">
                    <input type="checkbox" name="size[{{$newSize->id}}]" value="{{$newSize->size}}">{{$newSize->size}}
                </span>
                @endforeach
            </select>
        </div>
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
            <label for="">Select Color</label>
            <div class="row">
                @forelse ($colors as $color)
                    <div class="col-md-3">
                        <div class="p-2 border">
                            Color:<input type="checkbox" name="colors[{{ $color->id }}]" value="{{ $color->id }}">
                            {{ $color->name }}
                            <br>
                            Quantity:<input type="number" name="colorQuantity[{{ $color->id }}]"
                                style="width:70px; border:1px solid" min=0>
                                @php
                                    $i=0;
                                @endphp
                            <div>
                                Image:
                                <select name="image_id[{{$color->id}}]" id="">
                                    <option value="0">all</option>
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
        </div>
        <div class="card-footer">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </div>
    </form>
@endsection
