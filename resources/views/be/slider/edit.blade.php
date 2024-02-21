@extends('be.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('admin.slider.doEdit',$slider->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="input-group">
                        <div class="custom-file">
                            <label for="">Image</label>
                            <input type="file" name="image" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input value="{{$slider->title}}" type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input  value="{{$slider->description}}" type="text" name="description" class="form-control" placeholder="Enter description">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

