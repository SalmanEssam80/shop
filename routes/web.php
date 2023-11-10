<?php

use App\Http\Controllers\AdminHelperController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productLikeController;
use App\Http\Controllers\welcomeController;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\ContactedMessage;
use App\Livewire\Admin\Faq;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Product;
use App\Livewire\Admin\Users;
use App\Livewire\Subscribe;
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
Route::view('/cart','cart')->name('cart');
Route::view('/addresses','addresses')->name('addresses');
Route::view('/order','orders')->name('order');
Route::view('/shop','shop')->name('shop');
Route::view('/checkout','checkout')->name('checkout');
Route::get('/about-us',[welcomeController::class,'aboutUs'])->name('about_us');
Route::view('/profile','profile')->name('user_profile');
Route::view('/contact-us','contact_us')->name('contact_us');
Route::view('/privacy','privacy')->name('privacy');

Route::get('/faq',[welcomeController::class,'faq'])->name('faq');
Route::get('/show_product/{id}',[welcomeController::class,'show_single_product'])->name('single_product');


Route::middleware('auth','checksuperadmin')->group(function (){
    Route::prefix('admin')->group(function (){
        Route::view('/dashboard','admin.dashboard ')->name('admin.dashboard');
        Route::get('manage-category',Category::class)->name('admin.category');
        Route::get('manage-products',Product::class)->name('admin.products');
        Route::get('manage-orders',Orders::class)->name('admin.orders');
        Route::get('manage-FAQ',Faq::class)->name('admin.faq');
        Route::get('manage-customers',Users::class)->name('admin.users');
        Route::get('manage-subscribers',Subscribe::class)->name('admin.subscribers');
        Route::get('show-customer/{id}',[AdminHelperController::class,'showSingleCustomer'])->name('admin.user_details');
        Route::get('/admin/contactMessages',[ContactedMessage::class])->name('admin.messages');
        Route::get('manage-about-us-page',[AdminHelperController::class,'manage_aboutUs_page'])->name('admin.aboutUs');
        Route::post('manage-about-us-page',[AdminHelperController::class,'store'])->name('admin.aboutUs');
        Route::post("upload_cke_image",[AdminHelperController::class,'uploadCKEImage'])->name('ckeditor.image-upload');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/add_to_cart/{id}',[CartController::class,'store'])->name('add_product_to_cart');
    Route::view('/MyCart','cart')->name('cart');
    Route::view('/MyProfile','profile')->name('user_profile');
});

Route::get('/contact/developer',function (){
    return "contact developer";
})->name('contact_developer');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
