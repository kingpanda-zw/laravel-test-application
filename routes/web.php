<?php

use App\Http\Controllers\CustomerDepositPaymentController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Models\CustomerDepositPayment;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\SiteController::class, 'welcome'])->name('home');

Route::get('/product/{name}', [App\Http\Controllers\SiteController::class, 'product_details'])->name('product-details');

Route::get('/product-category/{name}', [App\Http\Controllers\SiteController::class, 'product_category'])->name('product-category');

Route::get('/success-payment/{order_id}', [App\Http\Controllers\SiteController::class, 'success_payment'])->name('success-payment');

Route::get('/deposit-successful', function() {
    return view('success-payment');
});

Route::get('/failed-payment/{order_id}', [App\Http\Controllers\SiteController::class, 'failed_payment'])->name('failed-payment');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customer-orders', CustomerOrderController::class);
    Route::resource('customer-deposit-orders', CustomerDepositPaymentController::class);
});
