<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\UserCart;
use Gloudemans\Shoppingcart\Facades\Cart;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->role_id=="1"){
            return redirect()->route('admin.user.list')->with('status','Welcome Back!');
        }
        else{
            Cart::destroy();
            $userCart=UserCart::where('user_id',Auth::user()->id)->get();
                foreach($userCart as $item){
                    Cart::add([
                        'id'=>$item->product_id,
                        'name'=>$item->name,
                        'qty'=>$item->quantity,
                        'price'=> $item->price,
                        'options'=>['size'=>$item->size->size,
                                    'image_path'=>$item->path,
                                    'color'=>$item->color->name,
                                    'user_cart_id'=>$item->id
                        ]
                    ]);

                }
            return redirect()->route('fe.home')->with('status','Welcome My mate');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('fe.home');
    }
}
