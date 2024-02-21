@extends('be.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('admin.category.doEdit',$category->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{$category->slug}}" class="form-control" placeholder="Enter name">
                    </div>
                    <div style="border:1px solid black; margin-top:40px; padding:20px" >
                        <h1 style="margin-bottom:10px "><strong>SEO Tags</strong></h1>
                        <div class="form-group">
                            <label>Meta Title </label>
                            <input type="text" name="meta_title" class="form-control"
                                   placeholder="Enter Meta Title" value="{{$category->meta_title}}">
                        </div>
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" name="meta_keyword" class="form-control"
                                   placeholder="Meta Keyword" value="{{$category->meta_keyword}}">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input type="text" name="meta_description" class="form-control"
                                   placeholder="Enter Meta Description" value="{{$category->meta_description}}">
                        </div>
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
