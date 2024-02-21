<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    //
    public function index(){
        $lists=Material::orderBy('id','desc')->paginate(10);
        return view('be.material.index',compact('lists'));
    }
    public function add(){
        return view('be.material.add');
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
            'name'=>'material'


        ]
    );
        try{
            Material::create($request->all());

        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->route('admin.material.list')->with('success','Add successfully');
    }
    public function delete($id){
        try{
            $material=Material::findOrFail($id);
            $material->delete();
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Failed');
        }
        return redirect()->back()->with('success','Delete Successfully');
    }
    public function edit($id){
        $material=Material::findOrFail($id);
        return view('be.material.edit',compact('material'));
    }
    public function doEdit(Request $request,$id){
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
            'name'=>'material'


        ]
    );
        $material=$request->name;
        try{
            Material::where('id',$id)->update([
                "name"=>$material
            ]);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Edit Failed');
        }
        return redirect()->route('admin.material.list')->with('success','Update successfully');
    }

}
