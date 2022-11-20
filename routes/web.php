<?php

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



Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/cart', function () {
    return view('frontend.cart');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

Route::get('/createacc', function () {
    return view('frontend.auth.create_acc');
});

Route::get('/prd', function () {
    return view('frontend.product');
});

Route::get('/shop', function () {
    return view('frontend.shop');
});

Route::get('/singleblog', function () {
    return view('frontend.single_blog');
});


Route::resource('/', HomeController::class);

Route::resource('/item', ItemsController::class);

Route::match(['get', 'post'], '/login', [\App\Http\Controllers\CustomerController::class, 'login'])->name('login');
//Route::middleware('auth')->group(function (){
//    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//});

Route::get('registration', [\App\Http\Controllers\CustomerController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [\App\Http\Controllers\CustomerController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [\App\Http\Controllers\CustomerController::class, 'signOut'])->name('signout');
