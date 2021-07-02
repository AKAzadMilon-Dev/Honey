<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/order-invoice', function () {
    return view('frontend.invoice.order-invoice');
});

require __DIR__.'/auth.php';
// ForndEnd Design Route
Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');

Route::get('product/{slug}', [FrontendController::class, 'singleProduct'])->name('singleProduct');

Route::get('shop', [FrontendController::class, 'shop'])->name('shop');

Route::get('/get-product-size/{color_id}/{product_id}', [FrontendController::class, 'getProductSize'])->name('getProductSize');

Route::get('/get-product-size-2/{colorId}/{productId}', [FrontendController::class, 'getProductSize2'])->name('getProductSize2');

// Route::get('/get-product-size/modal/{color_id}/{product_id}', [FrontendController::class, 'getProductSizeModal'])->name('getProductSizeModal');

Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('cart/{slug}', [CartController::class, 'cart'])->name('couponCart');
Route::get('single-cart/{slug}', [CartController::class, 'singleCart'])->name('singleCart');
Route::get('single-cart/delete/{id}', [CartController::class, 'cartDelet'])->name('cartDelet');
Route::post('/add-to-product-cart', [CartController::class, 'productCart'])->name('productCart');
Route::post('/add-to-product-cart-from-model', [CartController::class, 'productCartFromModel'])->name('productCartFromModel');
Route::post('cart/update', [CartController::class, 'cartUpdate'])->name('cartUpdate');
Route::post('cart/update/ajax', [CartController::class, 'cartUpdateAjax'])->name('cartUpdateAjax');
// Checkout Page
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('checkout-post', [CheckoutController::class, 'checkPost'])->name('checkPost');

Route::get('paypal-status', [CheckoutController::class, 'PayPalStatus'])->name('PayPalStatus');

Route::get('api/get-state-list/{sateId}', [CheckoutController::class, 'getState'])->name('getState');
Route::get('api/get-city-list/{cityId}', [CheckoutController::class, 'getCity'])->name('getCity');
Route::get('api/get-upzilas-list/{upazilasId}', [CheckoutController::class, 'getUpazilas'])->name('getUpazilas');

// Backend Controller
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::group(['prefix' =>'admin'], function(){
    Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
    Route::get('category-add', [CategoryController::class, 'CategoryAdd'])->name('CategoryAdd');
    Route::post('category-post', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
    Route::get('category-edit/{cat_id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');

    // {{-- Akhane cat_id akta argument jekhane id pass kora hobe edit and delete korar jonno --}}
    Route::post('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
    Route::get('category-delete/{cat_id}', [CategoryController::class, 'CategoryDelete'])->name('CategoryDelete');
    Route::get('category-trashlist', [CategoryController::class, 'CategoryTrashList'])->name('CategoryTrashList');
    Route::post('category-selecteddelete', [CategoryController::class, 'CategorySelectedDelete'])->name('CategorySelectedDelete');
    Route::get('category-restore/{cat_id}', [CategoryController::class, 'CategoryRestore'])->name('CategoryRestore');
    Route::get('category-permanent-delete/{cat_id}', [CategoryController::class, 'CategoryPermanentDelete'])->name('CategoryPermanentDelete');
    Route::post('category-selected-DeleteRestore',[CategoryController::class, 'CatSelectDeleteRestore'])->name('CatSelectDeleteRestore');

    //Sub-Category Start.
    Route::get('subcategory-add', [SubCategoryController::class, 'SubCategoryAdd'])->name('SubCategoryAdd');
    Route::post('subcategory-post', [SubCategoryController::class, 'SubCategoryPost'])->name('SubCategoryPost');
    Route::get('subcategory-view', [SubCategoryController::class, 'SubCategoryView'])->name('SubCategoryView');
    Route::get('subcategory-edit/{subcat_id}',[SubCategoryController::class, 'SubCategoryEdit'])->name('SubCategoryEdit');
    Route::post('subcategor-update', [SubCategoryController::class, 'SubcategoyUpdate'])->name('SubcategoyUpdate');
    Route::get('subcategory-delete/{subcat_id}', [SubCategoryController::class, 'SubcategoyDelete'])->name('SubcategoyDelete');
    Route::post('subcategory-multi-delete', [SubCategoryController::class, 'SubCategorySelectedDelete'])->name('SubCategorySelectedDelete');
    Route::get('subcategory-trashlist', [SubCategoryController::class, 'SubcategoryTrashlist'])->name('SubcategoryTrashlist');
    Route::get('subcategory-restore/{subcat_id}', [SubCategoryController::class, 'SubcategoryRestore'])->name('SubcategoryRestore');
    Route::get('subcategory-per-delete/{subcat_id}', [SubCategoryController::class, 'SubcategoryPerDelete'])->name('SubcategoryPerDelete');

    // Brand Route and Url
    Route::get('brand-add', [BrandController::class, 'brandAdd'])->name('brandAdd');
    Route::post('brand-post', [BrandController::class, 'brandPost'])->name('brandPost');
    Route::get('brand-list', [BrandController::class, 'brandView'])->name('brandView');
    Route::get('brand-edit', [BrandController::class, 'brandEdit'])->name('brandEdit');
    Route::get('brand-trash', [BrandController::class, 'brandTrash'])->name('brandTrash');

    // Product
    // ajax dia data request kore subcategory name show korano..
    Route::get('get-subcate/{cat_id}', [ProductController::class, 'GetSubcate'])->name('GetSubcate');
    Route::get('get-brand/{cat_id}', [ProductController::class, 'GetBrand'])->name('GetBrand');
    Route::get('product-add', [ProductController::class, 'ProductAdd'])->name('ProductAdd');
    Route::post('product-post', [ProductController::class, 'ProductPost'])->name('ProductPost');
    Route::get('product-list', [ProductController::class, 'ProductView'])->name('ProductView');
    Route::get('product-edit/{product_id}', [ProductController::class, 'ProductEdit'])->name('ProductEdit');
    Route::post('product-update', [ProductController::class, 'ProductUpdate'])->name('ProductUpdate');
    Route::get('product-delete/{product_id}', [ProductController::class, 'ProductDelete'])->name('ProductDelete');
    Route::get('product-restore/{product_id}', [ProductController::class, 'ProductRestore'])->name('ProductRestore');
    Route::get('product-permanent-delete/{product_id}', [ProductController::class, 'ProductPerDelete'])->name('ProductPerDelete');
    Route::get('product-trashlist', [ProductController::class, 'ProductTrashlist'])->name('ProductTrashlist');

    // Coupon Code
    Route::get('coupon', [CouponController::class, 'coupon'])->name('coupon');
    Route::post('coupon-post', [CouponController::class, 'couponPost'])->name('couponPost');
    Route::get('coupon-edit/{couponId}', [CouponController::class, 'couponEdit'])->name('couponEdit');
});

// Jei Page Theke Logout kora hobe sei page a login korle redirect kore oi page a nia jabe.
Route::get('/redirects', function(){
    return redirect(Redirect::intended()->getTargetUrl());
});
