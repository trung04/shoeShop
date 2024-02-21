<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    //
    public function doAdd(Request $request){
        $content=$request->content;
        $productId=$request->product_id;
        $rate=$request->rate;

        if(Auth::check()){
            $userId=$request->input('user_id');
                Comment::create([
                    'rate'=>$rate,
                    'user_id'=>$userId,
                    'product_id'=>$productId,
                    'content'=>$content
                ]);
        }
        else{
            $fullName=$request->name;
            $phone=$request->phone;
            $email=$request->email;
            $roleId=$request->role_id;
            /// tạo user
            $user=User::create([
                'name'=>$fullName,
                'phone'=>$phone,
                'email'=>$email,
                'role_id'=>$roleId
            ]);
            /// tạo đánh giá comment

            Comment::create([
                'rate'=>$rate,
                'user_id'=>$user->id,
                'product_id'=>$productId,
                'content'=>$content,

            ]);
        }

    }
}