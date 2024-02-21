<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Color;
use App\Models\Material;
use App\Models\Size;
use App\Models\Type;
use App\Models\ProductColor;

class ProductController extends Controller
{
    //
    public function index()
    {
        $lists=Product::orderBy('id','desc')->paginate(5);
        return view('be.product.index',compact('lists'));
    }
    public function add()
    {
        $colors=Color::all();
        $categories=Category::all();
        $brands =Brand::all();
        $materials=Material::all();
        $sizes=Size::all();
        $types=Type::all();
        return view('be.product.add',compact('categories','brands','colors','materials','sizes','types'));
    }
    public function doAdd(Request $request)
    {
                // dd($images);
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'brand_id' => ['required'],
                    'category_id' => ['required'],
                    'type_id'=>['required'],
                    'material_id'=>['required'],
                    'price'=>['required'],
                    'slug'=>['required','string'],
                    'meta_title'=>['required','string'],
                    'meta_keyword'=>['required','string'],
                    'meta_description'=>['required','string'],
                    'images'=>['required'],
                ],
                [
                    'required'=>':attribute không được để trống',
                    'max'=>':attribute có độ dài tối đa :max kí tự',
                    'min'=>':attribute có độ dài ít nhất :min kí tự',
                    'confirmed'=>'Mật khẩu xác thực không đúng'
                ],
                [
                    'name'=>'Tên người dùng',
                    'email'=>'Email',
                    'password'=>'Mật khẩu',
                    'brand_id'=>'Brand',
                    'category_id'=>'Category',
                    'brand_id'=>'Brand',
                    'type_id'=>'Type',
                    'material_id'=>'Material'


                ]
            );
        $name=$request->name;
        $categoryId=$request->category_id;
        $content=$request->input('description');
        $price=$request->price;
        $brandId=$request->brand_id;
        $discountType=$request->discount_type;
        $discountAmount=$request->discount_amount;
        $metaKeyword=$request->meta_keyword;
        $metaTitle=$request->meta_title;
        $metaDescription=$request->meta_description;
        $shortDescription=$request->short_description;
        $typeId=$request->type_id;
        $colorId=$request->color_id;
        $slug=$request->slug;
        $sizeId=$request->size_id;
        $materialId=$request->material_id;
        try{
            $product=Product::create([
                "name"=>$name,
                "category_id"=>$categoryId,
                "content"=>$content,
                "price"=>$price,
                "brand_id"=>$brandId,
                "discount_type"=>$discountType,
                "discount_amount"=>$discountAmount,
                "slug"=>$slug,
                "meta_keyword"=>$metaKeyword,
                "meta_title"=>$metaTitle,
                "meta_description"=>$metaDescription,
                "short_description"=>$shortDescription,
                "type_id"=>$typeId,
                "material_id"=>$materialId,
                     ]);
            if($request->hasFile('images')){
                $images=$request->file('images');
                $i=0;
                foreach($images as $image){
                    $newFileName=time().$i.'.'.$image->getClientOriginalExtension();
                    try{
                        $image->storeAs('images/products',$newFileName);
                        Image::create([
                            'product_id'=>$product->id,
                            'path'=>'storage/images/products/'.$newFileName,
                            'is_preview'=>0
                        ]);
                    }catch(Exception $exception){
                        dd($exception->getMessage());
                    }
                    $i+=1;
                }
            }
            // if($request->colors){
            //     foreach($request->colors as $key=>$color){
            //         try{
            //             ProductColor::create([
            //                 'product_id'=>$product->id,
            //                 'color_id'=>$color,
            //                 'quantity'=>$request->colorQuantity[$key] ?? 0,
            //                 'size_id'=>$sizeId

            //             ]);
            //         }catch(Exception $exception){
            //             dd($exception->getMessage());
            //         }

            //     }
            // }

        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->route('admin.product.list')->with('success','Add successfully');
    }




    public function delete($id){
        try{
            $product=Product::findOrFail($id);
            //xóa ảnh
            $savedImages=Image::where('product_id',$id)->get();
               foreach($savedImages as $savedImage){
                $a=explode("/",$savedImage->path);
                $nameSavedImage="";
                for($i=1;$i<sizeof($a);$i++){
                    $nameSavedImage=$nameSavedImage."/".$a[$i];
                }
                Storage::delete($nameSavedImage);
                $savedImage->delete();
               }
            $product->delete();
            $productColors=ProductColor::where('product_id',$id)->get();
            foreach($productColors as $productColor){
                $productColor->delete();
            }
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Failed');
        }
        return redirect()->back()->with('success','Delete successfully');
    }



    public function edit($id){
        $product=Product::findOrFail($id);
        $categories=Category::all();
        $brands=Brand::all();
        $types=Type::all();
        $product_color_id=$product->productColors->pluck('color_id')->toArray();
        $materials=Material::all();
        $colors =Color::whereNotIn('id',$product_color_id)->get();
        return view('be.product.edit',compact('materials','product','brands','categories','colors','types','colors'));
    }



    public function doEdit(Request $request,$id){
        $request->validate([
            'brand_id' => ['required'],
            'category_id' => ['required'],
            'type_id'=>['required'],
            'material_id'=>['required'],
        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
        ],
        [
            'name'=>'Tên người dùng',
            'brand_id'=>'Brand',
            'category_id'=>'Category',
            'brand_id'=>'Brand',
            'type_id'=>'Type',
            'material_id'=>'Material'


        ]
    );
        $oldProductColors=productColor::where('product_id',$id)->get();
        $name=$request->name;
        $categoryId=$request->category_id;
        $content=$request->input('description');
        $price=$request->price;
        $brandId=$request->brand_id;
        $discountType=$request->discount_type;
        $discountAmount=$request->discount_amount;
        $metaKeyword=$request->meta_keyword;
        $metaTitle=$request->meta_title;
        $metaDescription=$request->meta_description;
        $shortDescription=$request->short_description;
        $typeId=$request->type_id;
        $colorId=$request->color_id;
        $slug=$request->slug;
        $materialId=$request->material_id;

        try{
            $product=Product::where('id',$id)->update([
                "name"=>$name,
                "category_id"=>$categoryId,
                "content"=>$content,
                "price"=>$price,
                "brand_id"=>$brandId,
                "slug"=>$slug,
                "discount_type"=>$discountType,
                "discount_amount"=>$discountAmount,
                "meta_keyword"=>$metaKeyword,
                "meta_title"=>$metaTitle,
                "meta_description"=>$metaDescription,
                "short_description"=>$shortDescription,
                "type_id"=>$typeId,
                "material_id"=>$materialId,
            ]);
            if($request->hasFile('images')){
                // xóa ảnh cũ đi
               $savedImages=Image::where('product_id',$id)->get();
               foreach($savedImages as $savedImage){
                $a=explode("/",$savedImage->path);
                $nameSavedImage="";
                for($i=1;$i<sizeof($a);$i++){
                    $nameSavedImage=$nameSavedImage."/".$a[$i];
                }
                Storage::delete($nameSavedImage);
                $savedImage->delete();
               }
               //thêm ảnh mới
               $images=$request->file('images');
               $i=0;
               foreach($images as $image){
                $newFileName =time().$i.'.'.$image->getClientOriginalExtension();
                try{
                    $image->storeAs('images/products',$newFileName);
                    Image::create([
                        'product_id'=>$id,
                        'path'=>'storage/images/products/'.$newFileName,
                        'is_preview'=>0
                    ]);
                }catch(Exception $exception){
                    dd($exception->getMessage());
                }
                $i++;
               }
            }
            /// chưa có màu thì tạo thêm
            // if($request->colors){
            //     foreach($request->colors as $key=>$color){
            //         try{
            //             ProductColor::create([
            //                 'product_id'=>$id,
            //                 'color_id'=>$color,
            //                 'quantity'=>$request->colorQuantity[$key] ?? 0

            //             ]);
            //         }catch(Exception $exception){
            //             dd($exception->getMessage());
            //         }

            //     }
            // }
            }catch(Exception $exception){
                return redirect()->back()->with('error','Update Failed');
            }
            return redirect()->route('admin.product.list')->with('success','Update Successfully');
    }



    public function  updateProductColorQty(Request $request,$product_color_id){
        $productColorData=Product::findOrFail($request->product_id)
        ->productColors()->where('id',$product_color_id)->first();
        $productColorData->update([
            'quantity'=>$request->qty,
            'image_id'=>$request->imageId,
        ]);
        return response()->json(['message'=>'Update successfully']);
    }





    public function deleteProductColor($product_color_id){
        $productColor=ProductColor::findOrFail($product_color_id);
        $productColor->delete();
        return response()->json(['message'=>'Delete successfully']);

    }

    public function previewImage($product_id){
        $images=Image::where('product_id',$product_id)->get();
        return view('be.product.previewImage',compact('images'));



    }
    public function updatePreviewImage(Request $request){
        $image=Image::findOrFail($request->image_id);
        try{

            $image->update([
                'is_preview'=>1
            ]);

        }catch(Exception $e){
            return redirect()->back()->with('error','Cập nhập ảnh thất bại');
        }
        return redirect()->route('admin.product.list')->with('success','Update Successfully');
    }
    public function editPreviewImage($product_id){
        $images=Image::where('product_id',$product_id)->get();
        $previewImage=Image::where('product_id',$product_id)->where('is_preview',1)->first();
        return view('be.product.editPreviewImage',compact('images','previewImage'));


    }
    public function doEditPreviewImage($before_image_id,Request $request){
        // cho ảnh đại diện cũ về ảnh thường
        $beforeImage=Image::findOrFail($before_image_id);
        $beforeImage->update([
            'is_preview'=>0,
        ]);
        // cập nhập ảnh đại diện mới
        $image=Image::findOrFail($request->image_id);
        $image->update([
            'is_preview'=>1,
        ]);
        return redirect()->route('admin.product.list')->with('success','Update Successfully');
    }
    public function search(Request $request){
        $query=$request->input('query');
        $lists=Product::where('name','like',"%$query%")
        ->orWhere('price','like',"%$query%")
        ->orWhere('short_description','like',"%$query%")
        ->orWhere('content','like',"%$query%" )
        ->orderBy('id','desc')
        ->paginate(5)->withQueryString();
        return  view('be.product.index',compact('lists'));
    }



}
