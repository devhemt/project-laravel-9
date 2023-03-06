<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('admin.login');
});
Route::get('/signout', [\App\Http\Controllers\ProfileController::class,'signOut']);

Route::match(['get', 'post'], '/login', [\App\Http\Controllers\ProfileController::class, 'login']);

Route::get('/addbatch/{id}', [\App\Http\Controllers\ProductController::class,'batch']);

Route::get('/allorder', [\App\Http\Controllers\InvoiceController::class, 'index6'])->middleware('isdirector');
Route::get('/canceledorder', [\App\Http\Controllers\InvoiceController::class, 'index0'])->middleware('isordermanager4');
Route::get('/noprocessorder', [\App\Http\Controllers\InvoiceController::class, 'index1'])->middleware('isordermanager5');
Route::get('/confirmedorder', [\App\Http\Controllers\InvoiceController::class, 'index2'])->middleware('isordermanager6');
Route::get('/packingorder', [\App\Http\Controllers\InvoiceController::class, 'index3'])->middleware('isordermanager7');
Route::get('/deliveryorder', [\App\Http\Controllers\InvoiceController::class, 'index4'])->middleware('isdeliverymanager');
Route::get('/successfulorder', [\App\Http\Controllers\InvoiceController::class, 'index5'])->middleware('isordermanager8');
Route::get('/order/{id}/{type}', [\App\Http\Controllers\InvoiceController::class, 'show']);


Route::post('/invoice',[\App\Http\Controllers\InvoiceController::class, 'store']);


Route::get('/product',[\App\Http\Controllers\ProductController::class, 'index'])->middleware('isimportmanager');
Route::post('/product',[\App\Http\Controllers\ProductController::class, 'store'])->middleware('isimportmanager');
Route::get('product/create',[\App\Http\Controllers\ProductController::class,'create'])->middleware('isimportmanager');
Route::get('/product/{product}/edit',[\App\Http\Controllers\ProductController::class,'edit'])->middleware('isimportmanager');
Route::post('/product/edit',[\App\Http\Controllers\ProductController::class,'editInside'])->middleware('isimportmanager');
Route::post('/product/addbatch',[\App\Http\Controllers\ProductController::class,'batchinside'])->middleware('isimportmanager');
Route::get('/product/{id}',[\App\Http\Controllers\ProductController::class,'show'])->middleware('isimportmanager');


Route::get('/profile',[\App\Http\Controllers\ProfileController::class,'index']);
Route::post('/profile',[\App\Http\Controllers\ProfileController::class,'store']);
Route::get('/profile/create',[\App\Http\Controllers\ProfileController::class,'create'])->middleware('isdirector');
Route::get('/profile/showall',[\App\Http\Controllers\ProfileController::class,'showall'])->middleware('isdirector');


