<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $lists=Category::OrderBy('id','desc')->paginate(5);
        return view('be.category.index',compact('lists'));
    }
    public function add()
    {
        return view('be.category.add');
    }
    public function doAdd(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug'=>['required','string'],
            'meta_title'=>['required','string'],
            'meta_keyword'=>['required','string'],
            'meta_description'=>['required','string'],
        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [
            'name'=>'Tên category',
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'brand_id'=>'Brand',
            'category_id'=>'Category',
            'brand_id'=>'Brand',
            'type_id'=>'Type',
            'material_id'=>'Material'


        ]
    );
        try{
            Category::create($request->all());
        }catch(Exception $exception){
            return redirect()->back()->with('error','Add Fail');
        }
        return redirect()->route('admin.category.list')->with('success','Add successfully');
    }
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('be.category.edit',compact('category'));
    }
    public function doEdit(Request $request,$id)
    {
        $name=$request->name;
        $slug=$request->slug;
        $metaKeyword=$request->meta_keyword;
        $metaTitle=$request->meta_title;
        $metaDescription=$request->meta_description;

        try{
            Category::where('id',$id)->update([
                'name'=>$name,
                'slug'=>$slug,
                'meta_keyword'=>$metaKeyword,
                'meta_title'=>$metaTitle,
                'meta_description'=>$metaDescription
            ]);
        }catch(Exception $exception){
            return redirect()->back()->with('error','Update Fail');
        }
        return redirect()->route('admin.category.list')->with('success','Update successfully');

    }
    public function delete($id){
        try{
            $category=Category::findOrFail($id);
            $category->delete();
        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete Fail');
        }
        return redirect()->back()->with('success','Delete successfully');
    }

}
