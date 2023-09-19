<?php

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


Route::get('/', function () {
    return view('layouts.app');
});


Route::get('/product',  [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::post('/product',  [App\Http\Controllers\ProductController::class, 'index'])->name('products.index.search');
Route::get('/readApi',  [App\Http\Controllers\ProductController::class, 'readApi'])->name('products.readApi');
Route::post('/products/import',  [App\Http\Controllers\ProductController::class, 'import'])->name('products.import');
Route::get('/products/sync',  [App\Http\Controllers\ProductController::class, 'productSync'])->name('products.sync');
Route::get('/products/force',  [App\Http\Controllers\ProductController::class, 'forceSync'])->name('products.force.sync');

Route::get('/magalu',  [App\Http\Controllers\MagaluController::class, 'index'])->name('magalu.index');
Route::post('/magalu',  [App\Http\Controllers\MagaluController::class, 'index'])->name('magalu.index.search');
Route::post('/magalu/import',  [App\Http\Controllers\MagaluController::class, 'import'])->name('magalu.import');
Route::get('/magalu/export',  [App\Http\Controllers\MagaluController::class, 'export'])->name('magalu.export');
Route::get('/magalu/interconnection',  [App\Http\Controllers\MagaluController::class, 'interconnection'])->name('magalu.interconnection');
Route::get('/magalu/newdatabase/',  [App\Http\Controllers\MagaluController::class, 'newDatabase'])->name('magalu.newDatabase');
Route::get('/magalu/force',  [App\Http\Controllers\MagaluController::class, 'forceSync'])->name('magalu.force.sync');

Route::get('/shopee',  [App\Http\Controllers\ShopeeController::class, 'index'])->name('shopee.index');
Route::post('/shopee/import',  [App\Http\Controllers\ShopeeController::class, 'import'])->name('shopee.import');
Route::get('/shopee/export',  [App\Http\Controllers\ShopeeController::class, 'export'])->name('shopee.export');
Route::get('/shopee/interconnection',  [App\Http\Controllers\ShopeeController::class, 'interconnection'])->name('shopee.interconnection');
Route::get('/shopee/newdatabase/',  [App\Http\Controllers\ShopeeController::class, 'newDatabase'])->name('shopee.newDatabase');

Route::get('/olist',  [App\Http\Controllers\OlistController::class, 'index'])->name('olist.index');
Route::post('/olist',  [App\Http\Controllers\OlistController::class, 'index'])->name('olist.index.search');
Route::post('/olist/import',  [App\Http\Controllers\OlistController::class, 'import'])->name('olist.import');
Route::get('/olist/export',  [App\Http\Controllers\OlistController::class, 'export'])->name('olist.export');
Route::get('/olist/interconnection',  [App\Http\Controllers\OlistController::class, 'interconnection'])->name('olist.interconnection');
Route::get('/olist/newdatabase/',  [App\Http\Controllers\OlistController::class, 'newDatabase'])->name('olist.newDatabase');
