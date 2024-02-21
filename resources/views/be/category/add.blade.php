@extends('be.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('admin.category.doAdd') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name">
                        </div>
                        @error('name')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Enter slug">
                        </div>
                        @error('slug')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                        <div style="border:1px solid black; margin-top:40px; padding:20px">
                            <h1 style="margin-bottom:10px "><strong>SEO Tags</strong></h1>
                            <div class="form-group">
                                <label>Meta Title </label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Enter Meta Title">
                                @error('meta_title')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword">
                                @error('meta_keyword')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <input type="text" name="meta_description" class="form-control"
                                    placeholder="Enter Meta Description">
                                @error('meta_description')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
