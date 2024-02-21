@extends('be.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.product.doEdit', $product->id) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Images</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="images[]" multiple
                                                class="images-input custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $product->name }}"name="name" class="form-control"
                                        placeholder="Enter name">
                                </div>
                                @error('name')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror

                                <div>
                                    <label>Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('type_id')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Material</label>
                                    <select name="material_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('material_id')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control">{{ $product->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control txt-content" placeholder="Enter Content">{{ $product->content }}
                                </textarea>
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                        value="{{ $product->price }}">
                                </div>
                                @error('price')
                                    <p style="color:red">{{ $message }}</p>
                                @enderror
                                <div>
                                    <label>Discount Type</label>
                                    <select name="discount_type" class="form-control">
                                        <option value="1">Percentage</option>
                                        <option value="2">Direct Amount</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Discount Amount</label>
                                    <input type="number" name="discount_amount" class="form-control"
                                        placeholder="Enter Discount Amount" value="{{ $product->discount_amount }}">
                                </div>
                                <div>
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter slug"
                                        value="{{ $product->slug }}">
                                    @error('slug')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div style="border:1px solid black; margin-top:40px; padding:20px">
                                    <h1 style="margin-bottom:10px "><strong>SEO Tags</strong></h1>
                                    <div class="form-group">
                                        <label>Meta Title <Title></Title></label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Enter Meta Title" value="{{ $product->meta_title }}">
                                        @error('meta_title')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keyword</label>
                                        <input type="text" name="meta_keyword" class="form-control"
                                            placeholder="Meta Keyword" value="{{ $product->meta_keyword }}">
                                        @error('meta_keyword')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input type="text" name="meta_description" class="form-control"
                                            placeholder="Enter Meta Description"
                                            value="{{ $product->meta_description }}">
                                        @error('meta_description')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
