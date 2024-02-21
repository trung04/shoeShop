<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    //
    public function index(){
        $lists =Slider::orderBy('id','desc')->paginate(5);
        return view('be.slider.index',compact('lists'));
    }
    public function add(){
        return view('be.slider.add');
    }
    public function edit($id){
        $slider=Slider::findOrFail($id);
        return view('be.slider.edit',compact('slider'));
    }
    public function doEdit(Request $request,$id){
        $slider=Slider::findOrFail($id);
        $title=$request->title;
        $description=$request->description;
        try{
            $slider->title=$title;
            $slider->description=$description;
            $slider->save();
            // xóa ảnh slider cũ đi
            if(!empty($request->hasFile('image'))){
                if($slider->image){
                    $a=explode("/",$slider->image);
                $nameSavedImage="";
                for($i=1;$i<sizeof($a);$i++){
                    $nameSavedImage=$nameSavedImage."/".$a[$i];
                }
                    Storage::delete($nameSavedImage);
                }
            }
            /// thêm ảnh mới
            if($request->hasFile('image')){
                $file=$request->file('image');
                $newFileName=$slider->id.$file->getClientOriginalName();
                $file->storeAs('images/slider',$newFileName);
                $slider->image='storage/images/slider/'.$newFileName;
                $slider->save();
            }

        }catch(Exception $exception){
            return redirect()->back()->with('error','update failed');
        }
        return redirect()->route('admin.slider.list')->with('success','Update successfully');
    }
    public function doAdd(Request $request){
        $title=$request->title;
        $description=$request->description;
        try{
            $slider=Slider::create([
                "title"=>$title,
                "description"=>$description
            ]);
            if($request->hasFile('image')){
                $file=$request->file('image');
                $sliderFileName=$slider->id.$file->getClientOriginalName();
                $file->storeAs('images/slider/',$sliderFileName);
                $slider->image='storage/images/slider/'.$sliderFileName;
                $slider->save();
            }
            }catch(Exception $exception){
                return redirect()->back()->with('error','Add Failed');
        }
        return redirect()->back()->with('success','Add successfully');
    }
    public function delete($id){
        try{
            $slider=Slider::findOrFail($id);
            //Xóa ảnh đi
            if($slider->image){
                $a=explode("/",$slider->image);
            $nameSavedImage="";
            for($i=1;$i<sizeof($a);$i++){
                $nameSavedImage=$nameSavedImage."/".$a[$i];
            }
                Storage::delete($nameSavedImage);
            }
            $slider->delete();

        }catch(Exception $exception){
            return redirect()->back()->with('error','Delete failed');
        }
        return redirect()->back()->with('success','Delete successfully');
    }

}
