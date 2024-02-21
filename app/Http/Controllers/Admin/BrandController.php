<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Brand;
use App\Models\Category;

class BrandController extends Controller
{
    //
    public function index()
    {
        $lists=Brand::orderBy('id','desc')->paginate(5);
        return view('be.brand.index',compact('lists'));
    }
    public function add()
    {
        $categories=Category::all();
        return view('be.brand.add',compact('categories'));
    }
    public function doAdd(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo'=>['required'],

        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [
            'name'=>'Tên brand',

        ]
    );
          $name=$request->name;
        try{
            $brand=Brand::create([
                "name"=>$name,
            ]);
            if(!empty($request->hasFile('logo'))){
                $file=$request->file('logo');
                $logoFileName=$brand->id.$file->getClientOriginalName();
                $file->storeAs('images/brand/logo',$logoFileName);
                $brand->logo_path='storage/images/brand/logo/'.$logoFileName;

               $brand->save();

            }
        }catch(Exception $exception){
            return redirect()->back()->with('error','Add failed');
        }
        return redirect()->route('admin.brand.list')->with('success','Add successfully');

    }
    public function edit($id){
        $item=Brand::findOrFail($id);
        $categories=Category::all();
        return view('be.brand.edit',compact('item','categories'));
    }
    public function doEdit(Request $request,$id)
    {
        $name=$request->name;
        try{
            $brand=Brand::findOrFail($id);
            $brand->name=$name;
            $brand->save();
            // xóa ảnh cũ
            if($request->hasFile('logo')){
                if($brand->logo_path){
                    \Storage::disk('public')->delete($brand->logo_path);
                }
            }
            // thêm ảnh mới
            if($request->hasFile('logo')){
                $file=$request->file('logo');
                $logoFileName=$id.$file->getClientOriginalName();
                $file->storeAs('images/brand/logo',$logoFileName);
                $brand->logo_path="/storage/images/brand/logo/".$logoFileName;
                $brand->save();
            }

        }catch(Exception $exception){
            return redirect()->back()->with('error','Update failed');
        }
        return redirect()->route('admin.brand.list')->with('success','Edit successfully');
    }
    public function delete($id)
    {
        try{
            $item=Brand::findOrFail($id);
            $item->delete($id);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete unsuccessfully');
        }
        return redirect()->back()->with('success','Delete successfully');

    }
}
