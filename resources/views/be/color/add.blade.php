@extends('be.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Color</h3>
            </div>
            <!-- /.card-header -->
            <!-- form sart -->
            <form method="post" action="{{route('admin.color.doAdd')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="name" class="form-control" placeholder="Fill color">
                    </div>
                    @error('name')
                    <p style="color:red">{{$message}}</p>

                    @enderror
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
