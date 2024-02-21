<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use App\Mail\ConfirmSuccessMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Str;

class MailController extends Controller
{
    //
    public function index(Request $request){
        $order_id=$request->order_id;
        $categories=Category::all();
        $orderProducts=OrderProduct::where('order_id',$request->order_id)->get();
        $order=Order::where('id',$order_id)->first();
        $token=Str::upper(Str::random());
        session(["order$order_id"=>$token]);
        $mailData=[
            'orderProducts'=>$orderProducts,
            'order'=>$order,

        ];
        Mail::to("$order->email")->send(new DemoMail($mailData));

        return view('fe.thanks',compact('categories'));
    }
        public function indexConfirm($order_id){
            return view('fe.order.confirmOrderSuccess',compact('order_id'));
        }

        public function confirm(Request $request,$order_id){
            if(session()->has("order$order_id")){
                $order=Order::where('id',$order_id)->first();
                $orderProducts=OrderProduct::where('order_id',$order_id)->get();
                $mailData=[
                    'orderProducts'=>$orderProducts,
                    'order'=>$order,
                ];
               Mail::to("$order->email")->send(new ConfirmSuccessMail($mailData));
               $order->update(['status'=>1]);
            //    if(isset($request->user_id)){
            //     $user=User::where('id',$request->user_id)->first();
            //     $coin=$user->coin+300;
            //     $user->update([
            //         'coin'=>$coin
            //     ]);
            //    }
            //    session()->forget("order$order_id");
            }
            return redirect()->route('fe.mail.confirmIndex',$order_id);



        }

}