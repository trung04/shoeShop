<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\userVoucher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function profile(){
        $categories=Category::all();
        return view('fe.user.profile',compact('categories'));
    }
    public function update(Request $request,$userId){
        $name=$request->name;
        $phone=$request->phone;
        try{
            User::where('id',$userId)->update([
                'name'=>$name,
                'phone'=>$phone,
            ]);
            if($request->hasFile('avatar')){
                //xóa ảnh đại diện cũ nếu có
                $savedAvatar=User::where('id',$userId)->first();
                $a=explode("/",$savedAvatar->path);
                $nameSavedAvatar="";
                for($i=1;$i<sizeof($a);$i++){
                    $nameSavedAvatar=$nameSavedAvatar."/".$a[$i];
                }
                if($savedAvatar->path!=null){
                    Storage::delete($nameSavedAvatar);
                }
                // cập nhập ảnh đại diện
                $avatar=$request->file('avatar');
                $newName=time().'.'.$avatar->getClientOriginalExtension();
                $avatar->storeAs('images/avatars',$newName);
                User::where('id',$userId)->update([
                    'path'=>'storage/images/avatars/'.$newName,
                ]);
            }

        }catch(Exception $exception){
            return redirect()->back()->with('error','Cập nhập thông tin thất bại');
        }

        return redirect()->back()->with('success','bạn đã cập nhập thông tin thành công');
    }
    public function changePassword(){
        $categories=Category::all();
        return view('fe.user.changePassword',compact('categories'));
    }
    public function  doChangePassword(Request $request,$userId){
        // dd($request);
        $request->validate([
            'current_password' => ['required','string','min:7'],
            'new_password' => ['required','string','min:7',],
            'confirm_password' => ['required','same:new_password'],
        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'same'=>'Mật khẩu xác thực không đúng'
        ],
        [
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'password'=>'Mật khẩu'
        ]
    );
        $user=User::where('id',$userId)->first();
        // dd($user->password);
        if(Hash::check($request->current_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->new_password),
            ]);
            return redirect()->back()->with(['success'=>"Bạn đã cập nhập mật khẩu thành công"]);
        }
        else{
            return redirect()->back()->with(['error'=>'Mật khẩu của bạn không chính xác !']);

        }

}
        public function userVoucher(){
            $categories=Category::all();
            $userVoucher=UserVoucher::where('user_id',Auth::user()->id)->get();
            // dd($userVoucher);

            return view('fe.user.userVoucher',compact('categories','userVoucher'));
        }
        public function userOrder(){
            $categories=Category::all();
            $userOrder=Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(5);
            return view('fe.user.userOrder',compact('categories','userOrder'));
        }
        public function detailUserOrder($id){
            $categories=Category::all();
            $order=Order::findOrFail($id);
            return view('fe.user.detailUserOrder',compact('categories','order'));
        }
}
