<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\Type;
use App\Models\Material;
use App\Models\Size;


class CategoryController extends Controller
{
    public function index($category_slug,Request $request){
        $categories=Category::all();
        $colors=Color::all();
        $brands=Brand::all();
        $sizes=Size::all();
        $category=Category::where('slug',$category_slug)->first();
        $types=Type::all();
        $materials=Material::all();
        if($category){
            $lists=$category->products();
            $lists=$this->filter($request,$lists)->paginate(6)->withQueryString();
            return view('fe.category',compact('categories','lists','category','brands','colors','types','sizes','materials'));
        }
        else{
            return redirect()->back();
        }
    }
    public function filter(Request $request,$products)
    {
        ///filter by brand
        $brand=$request->brand??[];
        $brandIds=array_keys($brand);
        if($brandIds){
            $products=$products->whereIn('brand_id',$brandIds);
        }
        //filter by color
        $color=$request->color ?? [];
        $colorIds=array_keys($color);
        if($colorIds){
            $productColorIds=ProductColor::whereIn('color_id',$colorIds)->pluck('product_id')->toArray();
            $products=$products->whereIn('id',$productColorIds);
        }

        //filter by type

        $type=$request->type ?? [];
        $typeIds=array_keys($type);
        if($typeIds){
            $products=$products->whereIn('type_id',$typeIds);
        }
        //filter by Material
        $material=$request->material ?? [];
        $materialIds=array_keys($material);
        if($materialIds){
            $products=$products->whereIn('material_id',$materialIds);
        }
        return $products;
    }

}
