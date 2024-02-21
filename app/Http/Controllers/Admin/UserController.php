<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $status=$request->input('status');
        $keyword=" ";
        $listAct=[
            "Delete"=>"Xóa"
        ];
        if($request->input('keyword')){
            $keyword=$request->input('keyword');
        }
        if($status=='trashed'){
            $listAct=[
                'Restore'=>"Khôi phục",
                'ForceDelete'=>"Xóa vĩnh viễn",
            ];
            $lists=User::onlyTrashed()->where('name','like',"%$keyword%")
            ->orWhere('email','like',"%$keyword%")
            ->orWhere('phone','like',"%$keyword%")
            ->orderBy('id','desc')
            ->paginate(5);
        }
        else{
            $lists=User::where('name','like',"%$keyword%")
            ->orWhere('email','like',"%$keyword%")
            ->orWhere('phone','like',"%$keyword%")
            ->orderBy('id','desc')
            ->paginate(5);
        }
        $count=[User::onlyTrashed()->count(),User::All()->count()];
      return view('be.user.index',compact('lists','count','status','keyword','listAct'));
    }
    public function add(){
        $roles =Role::all();
        return view('be.user.add',compact('roles'));
    }
    public function doAdd(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','string','min:7','confirmed'],
            'phone'=>['required','string']
        ],
        [
            'required'=>':attribute không được để trống',
            'max'=>':attribute có độ dài tối đa :max kí tự',
            'min'=>':attribute có độ dài ít nhất :min kí tự',
            'confirmed'=>'Mật khẩu xác thực không đúng'
        ],
        [
            'name'=>'Tên người dùng',
            'email'=>'Email',
            'password'=>'Mật khẩu'
        ]
    );
        $user=User::create($request->all());
        return redirect('admin/user/list')->with('success','Add successfully');
    }

   public function delete($id){
    try{
        $user=User::findOrFail($id);
        $user->delete();
    }catch(\Exception $exception){
        return redirect()->back()->with('error','Delete failed');
    }
    return redirect()->back()->with('success','Delete successfully');
   }
   public function edit($id)
   {
    $user=User::findOrFail($id);
    $roles =Role::all();
    return view('be.user.edit',compact('user','roles'));
   }
   public function doEdit($id,Request $request)
   {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'password' => ['required','string','min:7','confirmed'],
    ],
    [
        'required'=>':attribute không được để trống',
        'max'=>':attribute có độ dài tối đa :max kí tự',
        'min'=>':attribute có độ dài ít nhất :min kí tự',
        'confirmed'=>'Mật khẩu xác thực không đúng'
    ],
    [
        'name'=>'Tên người dùng',
        'password'=>'Mật khẩu'
    ]);
    try{

        User::where('id',$id)->update([
            'name'=>$request->input('name'),
            'phone'=>$request->input('phone'),
            'role_id'=>$request->input('role_id'),
            'password' => Hash::make($request->input('password')),

        ]);
    }catch(\Exception $exception){
        return redirect()->back()->with('error','Update failed');
    }
    return redirect('admin/user/list')->with('success','Update successfully');
   }
   public function action(Request $request)
   {
    $listIds=$request->input('listId');
    if($listIds){
        foreach($listIds as $index=>$id)
        {
            if(Auth::id()==$id) unset($listIds[$index]);
        }
        if(!empty($listIds)){
            $act=$request->input('act');
            if($act=='Xóa'){
                User::Destroy($listIds);
                return redirect()->back()->with('status','Bạn đã xóa thành công');

                }
            if($act=='Khôi phục'){
                User::withTrashed()
                ->whereIn('id',$listIds)
                ->restore();
                return redirect()->back()->with('status','Bạn đã khôi phục thành công');
            }
            if($act=='Xóa vĩnh viễn'){
                User::withTrashed()
                ->whereIn('id',$listIds)
                ->forceDelete();
                return redirect()->back()->with('status','Bạn đã xóa vĩnh viễn thành công');
            }
            return redirect()->back()->with('status','Bạn cần phải chọn tác vụ để thực thi');

        }
        else{
            return redirect()->back()->with('status','Bạn không thể thao tác trên tài khoản của bạn');

        }

    }
    return redirect()->back()->with('status','Bạn cần phải chọn phần tử để thực thi');
   }

   public function logout(){
    Auth::logout();
    return redirect('/login');
   }


}
