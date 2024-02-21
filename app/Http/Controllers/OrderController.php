<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderProduct;
use App\Models\UserCart;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
class OrderController extends Controller
{
    //
    public function checkout(){
        $categories=Category::all();
        $provinces=Province::all();
        $payments=Payment::all();
        $userVoucher=null;
        if(Auth::check()){
            $userVoucher=UserVoucher::where('user_id',Auth::user()->id)->get();
        }
        return view('fe.order.checkout',compact('payments','categories','provinces','userVoucher'));
    }
    public function addOrder(Request $request){
        // dd($request->userVoucherId);

        // thêm đơn hàng
        $categories=Category::all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'phone'=> ['required', 'string',    ],
            'province_id'=>['required'],
            'district_id'=>['required'],
            'ward_id'=>['required'],
            'address'=>['required','string','min:5','max:255']
        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            // 'require'=>'xin vui lòng chọn tỉnh'
        ],
        [
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'province_id'=>'Tỉnh/Thành Phố',
            'district_id'=>'Quận/Huyện',
            'ward_id'=>'Phường/Xã',
            'address'=>'Địa chỉ'
        ]
    );
    if(isset($request->userVoucherId)){
        $userVoucher=UserVoucher::find($request->userVoucherId);
        $quantity=$userVoucher->quantity-1;
        if($quantity==0){
            $userVoucher->delete();
        }
        else{
            $userVoucher->update([
                'quantity'=>$quantity,
            ]);
        }

    }



        $order=Order::create($request->all());
        // Thêm chi tiết đơn hàng
        $cartContents=Cart::content();
        foreach($cartContents as $product){
            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'total'=>$product->total,
                'quantity'=>$product->qty,
                'size'=>$product->options->size,
                'color'=>$product->options->color,
                'path'=>$product->options->image_path,
                'price'=>$product->price
            ]);
        };
        // Xóa giỏ hàng
        Cart::destroy();
        if(Auth::check()){
            $userCarts=UserCart::where('user_id',Auth::user()->id)->get();
            foreach($userCarts as $userCart){
                $userCart->delete();
            }
        }
        return  redirect()->route('mail.send',['order_id'=>$order->id]);
    }
    // phần áp dụng voucher
    public function applyVoucher(Request $request){
        $userVoucherId=$request->userVoucherId;
        $userVoucher=UserVoucher::find($userVoucherId);
        $typeVoucher=$userVoucher->voucher->type;
        $discountAmount=$userVoucher->voucher->discount_amount;
        $cart=UserCart::where('user_id',Auth::user()->id)->get();
        $subtotal=0;
        foreach($cart as $item){
            $subtotal+=$item->quantity *$item->price;
        }
        $total=0;
        $discount=0;
        switch($typeVoucher){
            case 1:
                $discount=$subtotal*$discountAmount/100;
                $total=$subtotal-$discount;
                break;
            case 2:
                $discount=$discountAmount;
                $total=$subtotal->$discount;
                break;
        }
        return response()->json(['userVoucherId'=>$userVoucherId,'message'=>'Đã áp dụng voucher thành công','subtotal'=>$subtotal,'discount'=>$discount,'total'=>$total]);
    }
    // phần bỏ áp dụng voucher
    public function cancelApplyVoucher(){
        $cart=UserCart::where('user_id',Auth::user()->id)->get();
        $subtotal=0;
        $discount=0;
        foreach($cart as $item){
            $subtotal+=$item->quantity *$item->price;
        }


         return response()->json(['message'=>'Bạn đã hủy áp dụng voucher thành công!','subtotal'=>$subtotal,'total'=>$subtotal]);



    }

    public function filterDistrict(Request $request){
        $provinceId=$request->provinceId;
        $districts=District::where('province_id',$provinceId)->get();
        return response()->json(['districts'=>$districts]);
    }
    public function filterWard(Request $request){
        $districtId=$request->districtId;
        $wards=Ward::where('district_id',$districtId)->get();
        return response()->json(['wards'=>$wards]);
    }


}
