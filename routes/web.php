<?php

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



Route::view('/admin/dashboard','admin.dashboard ')->name('admin.dashboard');
Route::get('/admin/products',Product::class)->name('admin.products');
Route::view('/admin/category','admin.categories')->name('admin.categories');
Route::get('/admin/orders',Orders::class)->name('admin.orders');
Route::get('/admin/contactmessages',ContactedMessage::class)->name('admin.messages');
Route::get('/admin/clients',Clients::class)->name('admin.clients');

Route::get('/contact/developer',function (){
    return "contact developer";
})->name('contact_developer');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
