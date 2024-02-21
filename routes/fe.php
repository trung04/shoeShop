<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\NotificationController;
use App\Models\UserCart;


Route::get('layout',function(){

    return view('fe.layout');
});

Route::prefix('/home')->group(function(){
    Route::get('/index',[HomeController::class,'index'])->name('fe.home');
    Route::get('/search',[HomeController::class,'search'])->name('fe.home.search');

});
/////cart/////
Route::prefix('/cart')->group(function(){
    Route::get('/list',[CartController::class,'index'])->name('fe.cart.list');
    Route::post('/doAdd/{product_id}',[CartController::class,'doAdd'])->name('fe.cart.doAdd');
    Route::get('/delete/{row_id}',[CartController::class,'delete'])->name('fe.cart.delete');
    Route::post('/update/{row_id}',[CartController::class,'update'])->name('fe.cart.update');
    Route::get('/destroy',[CartController::class,'destroy'])->name('fe.cart.destroy');
});



Route::get('/category/{category_slug}',[CategoryController::class,'index'])->name('fe.category');
Route::prefix('/product')->group(function(){
Route::get('/detail/{product_slug}',[ProductController::class,'detail'])->name('fe.product.detail');
// Route::get('/sizeCheckColor/{size_id}/{product_id}',[ProductController::class,'sizeCheckColor'])->name('fe.product.sizeCheckColor');
Route::get('/filterCurrentColor/{product_id}',[ProductController::class,'filterCurrentColor'])->name('fe.product.filterCurrentColor');
});
Route::prefix('/order')->group(function(){
    Route::get('/checkout',[OrderController::class,'checkout'])->name('fe.order.checkout');
    Route::get('/filterDistrict',[OrderController::class,'filterDistrict'])->name('fe.order.filterDistrict');
    Route::get('/filterWard',[OrderController::class,'filterWard'])->name('fe.order.filterWard');
    Route::post('/addOrder',[OrderController::class,'addOrder'])->name('fe.order.addOrder');
    Route::post('/applyVoucher',[OrderController::class,'applyVoucher'])->name('fe.order.applyVoucher');
    Route::post('/cancelApplyVoucher',[OrderController::class,'cancelApplyVoucher'])->name('fe.order.cancelApplyVoucher');



});
Route::prefix('/comment')->group(function(){
    Route::post('/doAdd',[CommentController::class,'doAdd'])->name('fe.comment.doAdd');
});
Route::prefix('/user')->group(function(){
    Route::get('/profile',[UserController::class,'profile'])->name('fe.user.profile');
    Route::get('/userVoucher',[UserController::class,'userVoucher'])->name('fe.user.userVoucher');
    Route::get('/userOrder',[UserController::class,'userOrder'])->name('fe.user.userOrder');
    Route::get('/detailUserOrder/{id}',[UserController::class,'detailUserOrder'])->name('fe.user.detailUserOrder');
    Route::post('/update/{userId}',[UserController::class,'update'])->name('fe.user.update');
    Route::get('/changePassword',[UserController::class,'changePassword'])->name('fe.user.changePassword');
    Route::post('/doChangePassword/{userId}',[UserController::class,'doChangePassword'])->name('fe.user.doChangePassword');
});
Route::prefix('/mail')->group(function(){
    Route::get('sendEmail',[MailController::class,'index'])->name('mail.send');
    Route::get('/confirm/{order_id}',[MailController::class,'confirm'])->name('fe.mail.confirm');
    Route::get('/confirmIndex/{order_id}',[MailController::class,'indexConfirm'])->name('fe.mail.confirmIndex');

});
Route::prefix('/voucher')->group(function(){
     Route::get('/index',[VoucherController::class,'index'])->name('fe.voucher.index');
     Route::post('/redeemVoucher',[VoucherController::class,'redeemVoucher'])->name('fe.voucher.redeemVoucher');
});
Route::prefix('/notification')->group(function(){
    Route::get('/list',[NotificationController::class,'list'])->name('fe.notification.list');
    Route::get('/changeStatus',[NotificationController::class,'changeStatus'])->name('fe.notification.changeStatus');

})


?>
