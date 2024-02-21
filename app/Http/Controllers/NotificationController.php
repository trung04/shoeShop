<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    //
    public function list(){
        $userId=Auth::user()->id;
        $lists=Notification::OrderBy('id','desc')->where('user_id',$userId)->where('status',0)->get();
        $listOne=Notification::OrderBy('id','desc')->where('user_id',$userId)->where('status',1)->get();


        return response()->json(['lists'=>$lists,'listOne'=>$listOne]);
    }
    public function changeStatus(){
        $userId=Auth::user()->id;
        $list=Notification::where('user_id',$userId)->where('status',0)->get();
        foreach($list as $item){
            $item->update([
                'status'=>1
            ]);

        }
        $lists=Notification::OrderBy('id','desc')->where('user_id',$userId)->where('status',1)->get();
        return response()->json(['lists'=>$lists]);
        // return response()->json(['lists'=>$lists]);
    }
}
