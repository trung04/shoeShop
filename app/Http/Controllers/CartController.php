<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\UserCart;
// use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    public function index(){

        $categories=Category::all();
        $cartCount=0;
        $userCart=null;
        if(Auth::check()){
            $cartCount=UserCart::where('user_id',Auth::user()->id)->sum('quantity');
            $userCart=UserCart::where('user_id',Auth::user()->id)->get();
        }
        else{
            $cartCount=Cart::count();
        }

        return view('fe.cart.list',compact('categories','userCart','cartCount'));
    }
    public function doAdd(Request $request,$product_id){
        $product=Product::findOrFail($product_id);
        $size = Size::findOrFail($request->sizeId)->size;
        $color = Color::findOrFail($request->colorId)->name;
        $imagePath=$product->productColors->where('size_id',$request->sizeId)->where('color_id',$request->colorId)->first()->image->path;
        $qty=$request->quantity;
        $price=$product->price;
        if($product->discount_amount){
            switch($product->discount_type){
                case "1":
                   $price= $product->price*(100-$product->discount_amount)/100;
                    break;
                case "2":
                    $price=$product->price-$product->discount_amount;
                    break;
            }
        };
        $cartCount=0;
        if(Auth::check()){
            $productSize=UserCart::where('user_id',Auth::user()->id)->where('product_id',$product_id)->where('size_id',$request->sizeId)->where('color_id',$request->colorId)->first();
            $userCartId=0;
            if($productSize==null){
                $userCart=UserCart::create([
                    'name'=>$product->name,
                    'quantity'=>$qty,
                    'price'=>$price,
                    'path'=>$imagePath,
                    'size_id'=>$request->sizeId,
                    'color_id'=>$request->colorId,
                    'product_id'=>$product->id,
                    'user_id'=>Auth::user()->id
                ]);
                $userCartId=$userCart->id;

            }
            else{
                $quantity=$qty+$productSize->quantity;
                UserCart::where('id',$productSize->id)->update([
                    'quantity'=>$quantity
                ]);
                $userCartId=$productSize->id;

            }
            $cartCount=UserCart::where('user_id',Auth::user()->id)->sum('quantity');
            Cart::add([
                'id'=>$product->id,
                'name'=>$product->name,
                'qty'=>$request->quantity,
                'price'=> $price,
                'options'=>['size'=>$size,
                            'image_path'=>$imagePath,
                            'color'=>$color,
                            'user_cart_id'=>$userCartId
                ]
            ]);

        }
        else{
            Cart::add([
                'id'=>$product->id,
                'name'=>$product->name,
                'qty'=>$request->quantity,
                'price'=> $price,
                'options'=>['size'=>$size,
                            'image_path'=>$imagePath,
                            'color'=>$color
                ]
            ]);
            $cartCount=Cart::count();
        }
     return response()->json(['product'=>$product, 'message'=>"Add To Cart Successfully",'cartCount'=>$cartCount]);
    }
    public function delete($rowId){
        if(Auth::check()){
            $cart=Cart::get($rowId);
            UserCart::where('id',$cart->options->user_cart_id)->delete();
        }
        Cart::remove($rowId);
        $cartTotal=Cart::total();
        $count=Cart::count();


        return response()->json(['message'=>"Delete successfully",'cartTotal'=>$cartTotal,'Count'=>$count]);

    }
    public function update(Request $request,$rowId){
        if(Auth::check()){
            $cart=Cart::get($rowId);
            UserCart::where('id',$cart->options->user_cart_id)->update([
                'quantity'=>$request->qty
            ]);
        }
        Cart::update($rowId,$request->qty);
        $cart=Cart::content();
        $currentCart=$cart[$rowId];
        $cartTotal=Cart::total();
        $count=Cart::count();
        return response()->json(['currentCart'=>$currentCart,'cartTotal'=>$cartTotal,'count'=>$count]);

    }
    public function destroy(){
        Cart::destroy();
        if(Auth::check()){
            $userCarts=UserCart::where('user_id',Auth::user()->id)->get();
            foreach($userCarts as $item){
                $item->delete();
            }
        }
        return redirect()->back()->with('success',"Xóa toàn bộ giỏ hàng thành công");
    }
}
