<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\productLikeController;
use App\Http\Controllers\welcomeController;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\Clients;
use App\Livewire\Admin\ContactedMessage;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[welcomeController::class,'welcome']);
Route::get('/category/{id}',[welcomeController::class,'show_searched_item_by_category'])->name('show_searched_item_by_category');
Route::get('/product/{name}',[welcomeController::class,'show_searched_item_by_name'])->name('show_searched_item_by_name');
Route::get('/search/{item}',[welcomeController::class,'show_searched_items'])->name('show_searched_items');
Route::view('/thankYou','confirmation')->name('thanks_for_shoping');
Route::view('/dashboard','user_dashboard')->name('user_dashboard');
Route::view('/cart','cart')->name('cart');
Route::view('/blog','blog')->name('blog');
Route::view('/addresses','addresses')->name('addresses');
Route::view('/order','orders')->name('order');
Route::view('/shop','shop')->name('shop');
Route::view('/checkout','checkout')->name('checkout');
Route::view('/about-us','about')->name('about_us');
Route::view('/profile','profile')->name('user_profile');
Route::view('/contact-us','contact_us')->name('contact_us');
Route::view('/faq','faq')->name('faq');
Route::view('/privacy','privacy')->name('privacy');


Route::middleware('auth','checksuperadmin')->group(function (){
    Route::prefix('admin')->group(function (){
        Route::view('/dashboard','admin.dashboard ')->name('admin.dashboard');
        Route::get('/products',Product::class)->name('admin.products');
        Route::get('/category',Category::class)->name('admin.category');
        Route::get('/orders',Orders::class)->name('admin.orders');
        Route::get('/contactmessages',ContactedMessage::class)->name('admin.messages');
        Route::get('/clients',Clients::class)->name('admin.clients');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/like/{id}',[productLikeController::class,'like'])->name('like-product');
    Route::get('/add_to_cart/{id}',[CartController::class,'store'])->name('add_product_to_cart');
    Route::view('/MyCart','cart')->name('cart');
    Route::view('/MyProfile','profile')->name('user_profile');
});

Route::get('/contact/developer',function (){
    return "contact developer";
})->name('contact_developer');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
