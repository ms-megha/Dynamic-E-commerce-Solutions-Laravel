<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/view_category',[AdminController::class, 'view_category']);
Route::post('/add_category',[AdminController::class, 'add_category']);
Route::get('/delete_category/{id}',[AdminController::class, 'delete_category']);
Route::get('/update_category/{id}',[AdminController::class, 'update_category']);
Route::post('/update_category_confirm/{id}',[AdminController::class, 'update_category_confirm']);
Route::get('/view_product',[AdminController::class, 'view_product']);
Route::post('/add_product',[AdminController::class, 'add_product']);
Route::get('/show_product',[AdminController::class, 'show_product']);
Route::get('/delete_product/{id}',[AdminController::class, 'delete_product']);
Route::get('/update_product/{id}',[AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class, 'update_product_confirm']);
Route::get('order',[AdminController::class, 'order']);
Route::get('delivered/{id}',[AdminController::class, 'delivered']);
Route::get('print_pdf/{id}',[AdminController::class, 'print_pdf']);




Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified');
Route::get('/product_details_page/{id}',[HomeController::class, 'product_details_page']);
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);
Route::get('/show_cart',[HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class, 'remove_cart']);
Route::post('/update_cart/{id}',[HomeController::class, 'update_cart']);
Route::get('/cash_order',[HomeController::class, 'cash_order']);
Route::get('/stripe/{totalPrice}',[HomeController::class, 'stripe']);
Route::post('stripe/{totalPrice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/success', [HomeController::class, 'success'])->name('success');
Route::get('/cancel', [HomeController::class, 'cancel'])->name('cancel');
