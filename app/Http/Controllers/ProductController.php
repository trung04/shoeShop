<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Comment;

class ProductController extends Controller
{
    //
    public function detail(Request $request,$productSlug){
        $categories=Category::all();
        $product=Product::where('slug',$productSlug)->first();
        //lấy ra size của sản phẩm
        $sizeIds=array_unique($product->productColors->pluck('size_id')->toArray());
        $sizes=Size::whereIn('id',$sizeIds)->get();
        //lấy ra màu của sản phẩm
        $colorIds=array_unique($product->productColors->pluck('color_id')->toArray());
        $colors=Color::whereIn('id',$colorIds)->get();
        $comments=Comment::where('product_id',$product->id)->paginate(5);
        //lấy ra màu của 1 size mà hết hàng
        // $colorOutOfStocks=$this->filterColorOutOfStock($request,$product);
        $relevantProducts=Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->take(7)->get();
        $avgStar=Comment::where('product_id',$product->id)->avg('rate');
        return view('fe.product.detail',compact('categories','product','sizes','colors','comments','relevantProducts','avgStar'));
    }
    public function filterCurrentColor(Request $request,$product_id){
        $sizeId=$request->sizeId;
        $product=Product::findOrFail($product_id);
        $ans=[];
        if($sizeId){
            $colorIds=array_unique($product->productColors->where('size_id',$sizeId)->where('quantity','>','0')->pluck('color_id')->toArray());
            $ans=Color::whereIn('id',$colorIds)->get();
        }
        return response()->json(['currentColors'=>$ans]);
    }
    // public function filter(Request $request,$sizeId){
    //     $product=Product::findOrFail($request->productId);
    // }



}
