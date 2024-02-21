<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductColor;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
class ProductColorController extends Controller
{
    //
    public function detail($product_id){
        $product=Product::findOrFail($product_id);
        $productColors=$product->productColors;
        $sizeIds=array_unique($productColors->pluck('size_id')->toArray());
        $sizes=Size::whereIn('id',$sizeIds)->get();
        return view('be.productColor.index',compact('product','sizes','sizeIds','productColors'));
    }
    public function add($product_id){
        //lấy ra id của size đã có
        $product=Product::findOrFail($product_id);
        $productColors=$product->productColors;
        $sizeIds=array_unique($productColors->pluck('size_id')->toArray());
        //lấy ra id của size chưa có
        $newSizeIds=Size::whereNotIn('id',$sizeIds)->get();
        $colors=Color::all();
        $images=$product->images;

        return view('be.productColor.add',compact('colors','newSizeIds','product','images'));
    }
    public function doAdd(Request $request,$product_id){
        // dd($request->size);
        $sizes=$request->size;
        if($request->size){
            foreach($sizes as $sizeId=>$size){
                $colors=$request->colors;
                if($colors){
                    foreach($colors as $key=>$color){
                        try{
                            ProductColor::create([
                                'product_id'=>$product_id,
                                'color_id'=>$color,
                                'size_id'=>$sizeId,
                                'quantity'=>$request->colorQuantity[$key]?? 0,
                                'image_id'=>$request->image_id[$key]?? 0,
                            ]);
                        }catch(Exception $exception){
                           return redirect()->back()->with('error','Add failed');                }
                    }
                }
                else{
                    return redirect()->back()->with('error','Bạn cần phải chọn màu');
                }
            }
        }else{
            return redirect()->back()->with('error','Bạn cần phải chọn size');
        }

        return redirect()->route('admin.productColor.detail',$product_id)->with('success','Add successfully');
    }
    public function edit($product_id,$size_id){
        $size=Size::findOrFail($size_id);
        $product=Product::findOrFail($product_id);
        $images=$product->images;
        //lẩy ra các màu mà size đã có
        $colorProducts=$product->productColors->where('size_id',$size_id);
        //lấy ra id màu mà size  đã có
        $colorIds=$colorProducts->pluck('color_id')->toArray();
        //lấy ra màu mà size chưa có
        $newColors=Color::whereNotIn('id',$colorIds)->get();
        return view('be.productColor.edit',compact('images','newColors','product','colorProducts','size'));
    }
    public function doEdit(Request $request,$product_id,$size_id){
        $colors=$request->colors;
        if($colors){
            foreach($colors as $key=>$color){
                try{
                    ProductColor::create([
                        'product_id'=>$product_id,
                        'color_id'=>$color,
                        'size_id'=>$size_id,
                        'quantity'=>$request->colorQuantity[$key]?? 0,
                        'image_id'=>$request->image_id[$key]?? 0,

                    ]);
                }catch(Exception $exception){
                   return redirect()->back()->with('error','Add failed');                }
            }
        }
        return redirect()->route('admin.productColor.detail',$product_id);

    }
    public function delete($sizeId){
        $infSize=ProductColor::where('size_id',$sizeId)->get();
        try{
            foreach($infSize as $item){
                $item->delete();
            }
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete failed');
        }
        return redirect()->back()->with('success','Delete successfully');

    }
}
