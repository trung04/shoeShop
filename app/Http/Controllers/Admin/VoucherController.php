<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Voucher;
use Str;

class VoucherController extends Controller
{
    //
    public function index(){
        $lists=Voucher::all();
        return view('be.voucher.index',compact('lists'));
    }
    public function add(){
        return view('be.voucher.add');
    }
    public function doAdd(Request $request){
        $type=$request->type;
        $discount_amount=$request->discount_amount;
        $coin=$request->coin;
        try{
            Voucher::create([
                'type'=>$type,
                'discount_amount'=>$discount_amount,
                'coin'=>$request->coin
            ]);

        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->route('admin.voucher.list')->with('success','Add Voucher Successfully');
    }
    public function edit($id){
        $voucher=Voucher::where('id',$id)->first();
        return view('be.voucher.edit',compact('voucher'));
    }
    public function doEdit(Request $request, $id){
        $voucher=Voucher::find($id);
        try{
            $voucher->update([
                'discount_amount'=>$request->discount_amount,
                'type'=>$request->type,
                'coin'=>$request->coin
            ]);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Edit Failed');
        }
        return redirect()->route('admin.voucher.list')->with('success','Edit Successfully');
    }
    public function delete($id){
        try{
            $voucher=Voucher::find($id)->delete();
        }
        catch(Exception $exception){
            return redirect()->back()->with('error','delete failed');
        }
        return redirect()->route('admin.voucher.list')->with('success','Delete Successfully');

    }
}