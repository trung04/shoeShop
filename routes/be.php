<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VoucherController;
Route::prefix('/admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::prefix('/user')->group(function(){
        Route::get('/list',[UserController::class,'index'])->name('admin.user.list');
        Route::get('/delete/{id}',[UserController::class,'delete'])->name('admin.user.delete');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
        Route::post('/doEdit/{id}',[UserController::class,'doEdit'])->name('admin.user.doEdit');
        Route::post('/doAdd',[UserController::class,'doAdd'])->name('admin.user.doAdd');
        Route::get('/add',[UserController::class,'add'])->name('admin.user.add');
        Route::post('/search',[UserController::class,'search'])->name('admin.user.search');
        Route::post('/action',[UserController::class,'action'])->name('admin.user.action');
    });
    Route::prefix('/product')->group(function(){
        Route::get('/list',[ProductController::class,'index'])->name('admin.product.list');
        Route::get('/add',[ProductController::class,'add'])->name('admin.product.add');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
        Route::get('/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
        Route::post('/doAdd',[ProductController::class,'doAdd'])->name('admin.product.doAdd');
        Route::post('/doEdit/{id}',[ProductController::class,'doEdit'])->name('admin.product.doEdit');
        Route::post('/updateQty/{product_color_id}',[ProductController::class,'updateProductColorQty'])->name('admin.product.updateColorQty');
        Route::get('/deleteProductColor/{product_color_id}',[ProductController::class,'deleteProductColor'])->name('admin.product.deleteColorQty');
        Route::get('/previewImage/{product_id}',[ProductController::class,'previewImage'])->name('admin.product.previewImage');
        Route::get('/editPreviewImage/{product_id}',[ProductController::class,'editPreviewImage'])->name('admin.product.editPreviewImage');
        Route::post('/updatePreviewImage',[ProductController::class,'updatePreviewImage'])->name('admin.product.updatePreviewImage');
        Route::get('/search',[ProductController::class,'search'])->name('admin.product.search');
        Route::post('/doEditPreviewImage/{before_image_id}',[ProductController::class,'doEditPreviewImage'])->name('admin.product.doEditPreviewImage');
    });
    Route::prefix('/category')->group(function(){
        Route::get('list',[CategoryController::class,'index'])->name('admin.category.list');
        Route::get('add',[CategoryController::class,'add'])->name('admin.category.add');
        Route::post('doAdd',[CategoryController::class,'doAdd'])->name('admin.category.doAdd');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
        Route::post('doEdit/{id}',[CategoryController::class,'doEdit'])->name('admin.category.doEdit');
    });
    Route::prefix('/brand')->group(function(){
        Route::get('list',[BrandController::class,'index'])->name('admin.brand.list');
        Route::get('add',[BrandController::class,'add'])->name('admin.brand.add');
        Route::get('edit/{id}',[BrandController::class,'edit'])->name('admin.brand.edit');
        Route::get('delete/{id}',[BrandController::class,'delete'])->name('admin.brand.delete');
        Route::post('doAdd',[BrandController::class,'doAdd'])->name('admin.brand.doAdd');
        Route::post('doEdit/{id}',[BrandController::class,'doEdit'])->name('admin.brand.doEdit');
    });
    Route::prefix('/image')->group(function(){
        Route::get('/list',[ImageController::class,'index'])->name('admin.image.list');
        Route::get('/add',[ImageController::class,'add'])->name('admin.image.add');
    });
    Route::prefix('/size')->group(function(){
        Route::get('/list',[SizeController::class,'index'])->name('admin.size.list');
        Route::get('/add',[SizeController::class,'add'])->name('admin.size.add');
        Route::post('/doAdd',[SizeController::class,'doAdd'])->name('admin.size.doAdd');
        Route::post('/doEdit/{id}',[SizeController::class,'doEdit'])->name('admin.size.doEdit');
        Route::get('/delete/{id}',[SizeController::class,'delete'])->name('admin.size.delete');
        Route::get('/edit/{id}',[SizeController::class,'edit'])->name('admin.size.edit');
    });
    Route::prefix('/material')->group(function(){
        Route::get('/add',[MaterialController::class,'add'])->name('admin.material.add');
        Route::get('/list',[MaterialController::class,'index'])->name('admin.material.list');
        Route::get('/delete/{id}',[MaterialController::class,'delete'])->name('admin.material.delete');
        Route::post('/doAdd',[MaterialController::class,'doAdd'])->name('admin.material.doAdd');
        Route::post('/doEdit/{id}',[MaterialController::class,'doEdit'])->name('admin.material.doEdit');
        Route::get('/edit/{id}',[MaterialController::class,'edit'])->name('admin.material.edit');
    });
    Route::prefix('/color')->group(function(){
        Route::get('/list',[ColorController::class,'index'])->name('admin.color.list');
        Route::get('/add',[ColorController::class,'add'])->name('admin.color.add');
        Route::get('/delete/{id}',[ColorController::class,'delete'])->name('admin.color.delete');
        Route::get('/edit/{id}',[ColorController::class,'edit'])->name('admin.color.edit');
        Route::post('/doAdd',[ColorController::class,'doAdd'])->name('admin.color.doAdd');
        Route::post('/doEdit/{id}',[ColorController::class,'doEdit'])->name('admin.color.doEdit');
    });
    Route::prefix('/type')->group(function(){
        Route::get('/list',[TypeController::class,'index'])->name('admin.type.list');
        Route::get('/add',[TypeController::class,'add'])->name('admin.type.add');
        Route::get('/delete{id}',[TypeController::class,'delete'])->name('admin.type.delete');
        Route::get('/edit/{id}',[TypeController::class,'edit'])->name('admin.type.edit');
        Route::post('/doEdit/{id}',[TypeController::class,'doEdit'])->name('admin.type.doEdit');
        Route::post('/doAdd',[TypeController::class,'doAdd'])->name('admin.type.doAdd');
    });
    Route::prefix('slider')->group(function(){
        Route::get('list',[SliderController::class,'index'])->name('admin.slider.list');
        Route::get('add',[SliderController::class,'add'])->name('admin.slider.add');
        Route::get('edit/{id}',[SliderController::class,'edit'])->name('admin.slider.edit');
        Route::get('delete/{id}',[SliderController::class,'delete'])->name('admin.slider.delete');
        Route::post('doEdit/{id}',[SliderController::class,'doEdit'])->name('admin.slider.doEdit');
        Route::post('doAdd',[SliderController::class,'doAdd'])->name('admin.slider.doAdd');
    });
    Route::prefix('/productColor')->group(function(){
        Route::get('detail/{product_id}',[ProductColorController::class,'detail'])->name('admin.productColor.detail');
        Route::get('edit/{product_id}/{size_id}',[ProductColorController::class,'edit'])->name('admin.productColor.edit');
        Route::get('add/{product_id}',[ProductColorController::class,'add'])->name('admin.productColor.add');
        Route::post('doAdd/{product_id}',[ProductColorController::class,'doAdd'])->name('admin.productColor.doAdd');
        Route::post('doEdit/{product_id}/{size_id}',[ProductColorController::class,'doEdit'])->name('admin.productColor.doEdit');
        Route::get('delete/{size_id}',[ProductColorController::class,'delete'])->name('admin.productColor.delete');

    });
    Route::prefix('/order')->group(function(){
        Route::get('/list',[OrderController::class,'index'])->name('be.order.list');
        Route::get('/changeStatus/{id}/{status}',[OrderController::class,'changeStatus'])->name('be.order.changeStatus');
        Route::get('/detail/{id}',[OrderController::class,'detail'])->name('be.order.detail');
    });
    Route::prefix('/voucher')->group(function(){
        Route::get('/list',[VoucherController::class,'index'])->name('admin.voucher.list');
        Route::get('/add',[VoucherController::class,'add'])->name('admin.voucher.add');
        Route::get('/edit/{id}',[VoucherController::class,'edit'])->name('admin.voucher.edit');
        Route::get('/delete/{id}',[VoucherController::class,'delete'])->name('admin.voucher.delete');
        Route::post('/doAdd',[VoucherController::class,'doAdd'])->name('admin.voucher.doAdd');
        Route::post('/doEdit/{id}',[VoucherController::class,'doEdit'])->name('admin.voucher.doEdit');
    });

})




?>
