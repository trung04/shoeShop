<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index(){
        $lists=Type::orderBy('id','desc')->paginate(10);
        return view('be.type.index',compact('lists'));
    }
    public function add(){
        return view('be.type.add');
    }
    public function doAdd(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [
            'name'=>'type',

        ]
    );
        try{
            Type::create($request->all());
        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->route('admin.type.list')->with('success','Add Successfully');
    }
    public function edit($id){
        $type=Type::findOrFail($id);
        return view('be.type.edit',compact('type'));
    }
    public function doEdit(Request $request,$id){
        $type=$request->name;
        try{
            Type::where('id',$id)->update([
                "name"=>$type
            ]);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Edit Failed');
        }
        return redirect()->route('admin.type.list')->with('success','Edit successfully');
    }
    public function delete($id){
        try{
            $type=Type::findOrFail($id);
            $type->delete();
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Failed');
        }
        return redirect()->route('admin.type.list')->with('success','Delete successfully');
    }

}
