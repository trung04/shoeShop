<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    //
    public function index(){
        $lists=Size::all();
        return view('be.size.index',compact('lists'));
    }
    public function add(){
        return view('be.size.add');
    }
    public function doAdd(Request $request){
        $request->validate([
            'size' => ['required', 'string', 'max:255'],

        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [


        ]
    );

        try{
            $size=$request->size;
            Size::create($request->all());
        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->back()->with('success','Add successfully');

    }
    public function delete($id)
    {
        try{
            $size=Size::findOrFail($id);
            $size->delete();
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Failed');
        }
        return redirect()->back()->with('success','Delete Successfully');
    }
    public function edit($id){
        $size=Size::findOrFail($id);
        return view('be.size.edit',compact('size'));
    }
    public function doEdit(Request $request, $id){
        $request->validate([
            'size' => ['required', 'string', 'max:255'],

        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [


        ]
    );
       $size=$request->size;
       try{
        Size::where('id',$id)->update([
            'size'=>$size
        ]);
       }catch(Exception $exception){
        return redirect()->back()->with('error','Update Failed');
       }
       return redirect()->route('admin.size.list')->with('success','Update Successfully');






    }
}
