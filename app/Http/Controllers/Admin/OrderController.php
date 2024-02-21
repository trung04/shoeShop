<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    //
    public function index(Request $request){
        $query=Order::orderBy('id','desc');
        $count=Order::all()->count();
        $status=$request->status;
        $months=Order::all()->groupBy(function($months){
            return Carbon::parse($months->created_at)->month;
        });
        if($status){
            switch($status){
                case "pending":
                    $query->where('status',1);
                    $count=Order::where('status',1)->count();
                    break;
                case "processing":
                    $query->where('status',2);
                    $count=Order::where('status',2)->count();

                    break;
                case "success":
                    $query->where('status',3);
                    $count=Order::where('status',3)->count();

                    break;
                case "canceled":
                    $query->where('status',4);
                    $count=Order::where('status',4)->count();
                    break;
            }
        }
        $list=$query->paginate(5)->withQueryString();
        if($request->input('query')!==null){
            //thanh tìm kiếm
            $q=$request->input('query');
            $list=Order::where('id','like',"%$q%")
            ->orWhere('total','like',"%$q%")
            ->orWhere('name','like',"%$q%")
            ->orWhere('address','like',"%$q%")
            ->orWhere('phone','like', "%$q%")
            ->orWhere('note','like',"%$q%")
            ->orWhere('created_at','like',"%$q%")
            ->orWhere('phone2','like',"%$q%")
            ->orWhere('email','like',"%$q%")
            ->paginate(5)->withQueryString();
        }
        // dd($month);
        if($request->month){
            foreach($months as $month=>$value){
                if($month==$request->month){
                    $query=$value;
                    // dd($query);
                    if($status){
                        switch($status){
                            case "pending":
                                $query=$query->where('status',1);
                                $count=$value->where('status',1)->count();
                                break;
                            case "processing":
                                $query=$query->where('status',2);
                                $count=$value->where('status',2)->count();

                                break;
                            case "success":
                                $query=$query->where('status',3);
                                $count=$value->where('status',3)->count();

                                break;
                            case "canceled":
                                $query=$query->where('status',4);
                                $count=$value->where('status',4)->count();
                                break;
                            default:
                            $count=$value->count();
                        }
                    }
                    $list=$query->paginate(5)->withQueryString();
                    // dd($list);
                }
            }

        };

        return view('be.order.index',compact('list','status','count','months'));
    }



    public function changeStatus(Request $request,$id,$status){
        $order=Order::findOrFail($id);
        $order->status=$status;
        $order->save();
        if(isset($request->user_id)){
            $user=User::where('id',$request->user_id)->first();
            if($status=='2'){
                Notification::create([
                    'user_id'=>$user->id,
                    'content'=>'Đơn hàng #'.$order->id." của bạn đang được xử lý !",
                    'order_id'=>$order->id
                ]);
            }
            if($status=='3'){
                $coin=$user->coin+300;
                $user->update([
                    'coin'=>$coin
                ]);
                Notification::create([
                    'user_id'=>$user->id,
                    'content'=>'Đơn hàng #'.$order->id." của bạn đang đã giao thành công !"." Bạn đã nhận được 300 xu !",
                    'order_id'=>$order->id
                ]);
            }
            if($status=='4'){
                Notification::create([
                    'user_id'=>$user->id,
                    'content'=>'Đơn hàng #'.$order->id." của bạn đã bị hủy !",
                    'order_id'=>$order->id
                ]);

            }
        }

        return redirect()->back();//quay lại điểm gọi request
    }
    public function detail($id){
        $order=Order::findOrFail($id);
        return view('be.order.detail',compact('order'));
    }
}
