<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Voucher;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;


class VoucherController extends Controller
{
    //
    public function index(){
        $vouchers=Voucher::all();
        $categories=Category::all();
        return view('fe.voucher.index',compact('categories','vouchers'));
    }
    public function redeemVoucher(Request $request){
        // dd($request->input('listId'));
        $listId=$request->input('listId');
        if($listId==null){
            return redirect()->back()->with('error','Bạn cần phải chọn voucher để đổi ');

        }
        $totalCoin=0;
        foreach($listId as $voucherId){
            $voucher=Voucher::find($voucherId);
            $totalCoin+=$voucher->coin;
        }
        $user=User::find(Auth::user()->id);
        $userCoin=$user->coin;
        if($userCoin >= $totalCoin){
            $userCoin-=$totalCoin;
            $user->update([
                'coin'=>$userCoin,
            ]);
            foreach($listId as $voucherId){
                $userVoucher=UserVoucher::where('user_id',$user->id)->where('voucher_id',$voucherId)->first();
                if(isset($userVoucher)){
                    $quantity=$userVoucher->quantity+1;
                    $userVoucher->update([
                        'quantity'=>$quantity
                    ]);
                }
                else{
                    $userVoucher=UserVoucher::create([
                        'user_id'=>$user->id,
                        'voucher_id'=>$voucherId,
                        'quantity'=>1,
                    ]);

                }

            }
        return redirect()->back()->with('success','Bạn đã đổi voucher thành công');




        }
        else{
            return redirect()->back()->with('error','Bạn không đủ xu để đổi');
        }

    }
}