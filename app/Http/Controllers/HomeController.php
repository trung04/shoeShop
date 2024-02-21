<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;

class HomeController extends Controller
{
    //
    public function index(){
        $brands=Brand::all();
        $categories=Category::all();
        $sliders=Slider::all();
        $newestProducts=Product::OrderBy('id','desc')->take(5)->get();
        // $newProducts=Product::orderBy('create_at','desc')->take(8)->get();
        return view('fe.home',compact('brands','categories','sliders','newestProducts'));
    }
    public function search(Request $request){
            $q=$request->search;
            $categories=Category::all();
            $products=Product::where('name','LIKE','%'.$q.'%')
            ->orWhere('content','LIKE','%'.$q.'%')
            ->paginate(6)->withQueryString();
            // dd($products);
            return view('fe.search',compact('products','q','categories'));
    }
}
