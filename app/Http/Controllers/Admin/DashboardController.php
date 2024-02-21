<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;


class DashboardController extends Controller
{
    //
    public function index(){
        $user=User::where('role_id',0)->get();
        $walkInGuest=User::where('role_id',2)->count();
        $data=Order::select('id','created_at','total')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->month;
        });
        $result="";
        foreach($data as $month=>$values){
            $result=$result."['".$month."',".count($values)."],";
        }
        //lấy ra doanh thu từng tháng
        $result2="";
        foreach($data as $month=>$values){
            $revenue=0;
            foreach($values as $item){
                $revenue+=$item->total;
            }
            $result2=$result2."['".$month."',".number_format($revenue,0,'','')."],";
        }

        $order=Order::all();
        //lấy ra số đơn hàng của tháng này
        $currentMonth=Carbon::now()->month;
        $orderByMonth=Order::select('created_at')->get()->groupBy(function($orderMonth){
            return Carbon::parse($orderMonth->created_at)->month;
        });
        $orderMonth=0;
        foreach($orderByMonth as $month=>$values){
            if($month==$currentMonth){
                $orderMonth=count($values);
            };
        }
        // dd($orderMonth);

        //lấy ra số đơn hàng của ngày hôm nay
        $today=Carbon::now()->toDateString();
        // dd($today);
        $orderByDay=Order::select('created_at')->get()->groupBy(function($orderByDay){
            return Carbon::parse($orderByDay->created_at)->toDateString();
        });
        // dd($orderByDay);
        $orderToday=0;
        foreach($orderByDay as $day=>$values){
            if($day==$today){
                $orderToday=count($values);
            };
        }

        return view('be.dashboard',compact('data','result','user','order','orderToday','orderMonth','result2'));
    }
}
