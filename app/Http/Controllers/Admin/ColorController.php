<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    //
    public function index(){
        $lists=Color::orderBy('id','desc')->paginate(10);
        return view('be.color.index',compact('lists'));
    }
    public function add(){
        return view('be.color.add');
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
            'name'=>'color',

        ]
    );

        try{
            Color::create($request->all());
        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->route('admin.color.list')->with('success','Add successfully');
    }
    public function delete($id){
        try{
            $color=Color::findOrFail($id);
            $color->delete();
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Failed');
        }
        return redirect()->back()->with('success','Delete successfully');
    }
    public function edit($id){
        $color=Color::findOrFail($id);
        return view('be.color.edit',compact('color'));
    }
    public function doEdit(Request $request,$id){
        $color=$request->name;
    try{
            Color::where('id',$id)->update([
                "name"=>$color
            ]);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Edit Failed');
        }
        return redirect()->route('admin.color.list')->with('success','Edit Successfully');
    }
}