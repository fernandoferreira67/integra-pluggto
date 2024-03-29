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



Route::get('/teste', function () {
  return view('teste');
});


Route::get('/catalog/product',  [App\Http\Controllers\CatalogController::class, 'index'])->name('products_catalog.index');
Route::post('/catalog/product/import',  [App\Http\Controllers\CatalogController::class, 'import'])->name('products_catalog.import');
Route::get('/catalog/product/export',  [App\Http\Controllers\CatalogController::class, 'exportAll'])->name('products_catalog.exportAll');
Route::post('/catalog/product/export',  [App\Http\Controllers\CatalogController::class, 'export'])->name('products_catalog.export');
Route::get('/catalog/product/{id}/edit',  [App\Http\Controllers\CatalogController::class, 'show'])->name('products_catalog.show');


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
Route::post('/magalu/force',  [App\Http\Controllers\MagaluController::class, 'interconnection'])->name('magalu.force.sync');

Route::get('/shopee',  [App\Http\Controllers\ShopeeController::class, 'index'])->name('shopee.index');
Route::post('/shopee',  [App\Http\Controllers\ShopeeController::class, 'index'])->name('shopee.index.search');
Route::post('/shopee/import',  [App\Http\Controllers\ShopeeController::class, 'import'])->name('shopee.import');
Route::get('/shopee/export',  [App\Http\Controllers\ShopeeController::class, 'export'])->name('shopee.export');
Route::get('/shopee/interconnection',  [App\Http\Controllers\ShopeeController::class, 'interconnection'])->name('shopee.interconnection');
Route::get('/shopee/newdatabase/',  [App\Http\Controllers\ShopeeController::class, 'newDatabase'])->name('shopee.newDatabase');
Route::post('/shopee/force',  [App\Http\Controllers\ShopeeController::class, 'interconnection'])->name('shopee.force.sync');
//CRUD
//Route::get('/shopee/{id}/edit',  [App\Http\Controllers\Admin\ShopeeController::class, 'edit'])->name('shopee.edit');


Route::get('/olist',  [App\Http\Controllers\OlistController::class, 'index'])->name('olist.index');
Route::post('/olist',  [App\Http\Controllers\OlistController::class, 'index'])->name('olist.index.search');
Route::post('/olist/import',  [App\Http\Controllers\OlistController::class, 'import'])->name('olist.import');
Route::get('/olist/export',  [App\Http\Controllers\OlistController::class, 'export'])->name('olist.export');
Route::get('/olist/interconnection',  [App\Http\Controllers\OlistController::class, 'interconnection'])->name('olist.interconnection');
Route::get('/olist/newdatabase/',  [App\Http\Controllers\OlistController::class, 'newDatabase'])->name('olist.newDatabase');


Route::get('/b2w',  [App\Http\Controllers\B2WController::class, 'index'])->name('b2w.index');
Route::post('/b2w',  [App\Http\Controllers\B2WController::class, 'index'])->name('b2w.index.search');
Route::post('/b2w/import',  [App\Http\Controllers\B2WController::class, 'import'])->name('b2w.import');
Route::post('/b2w/export',  [App\Http\Controllers\B2WController::class, 'export'])->name('b2w.export');
Route::get('/b2w/interconnection',  [App\Http\Controllers\B2WController::class, 'interconnection'])->name('b2w.interconnection');
Route::get('/b2w/newdatabase/',  [App\Http\Controllers\B2WController::class, 'newDatabase'])->name('b2w.newDatabase');
Route::post('/b2w/force',  [App\Http\Controllers\B2WController::class, 'interconnection'])->name('b2w.force.sync');

Route::get('/shein',  [App\Http\Controllers\SheinController::class, 'index'])->name('shein.index');
Route::post('/shein',  [App\Http\Controllers\SheinController::class, 'index'])->name('shein.index.search');
Route::post('/shein/import',  [App\Http\Controllers\SheinController::class, 'import'])->name('shein.import');
Route::get('/shein/export',  [App\Http\Controllers\SheinController::class, 'export'])->name('shein.export');
Route::get('/shein/interconnection',  [App\Http\Controllers\SheinController::class, 'interconnection'])->name('shein.interconnection');
Route::get('/shein/newdatabase/',  [App\Http\Controllers\SheinController::class, 'newDatabase'])->name('shein.newDatabase');
Route::post('/shein/force',  [App\Http\Controllers\SheinController::class, 'interconnection'])->name('shein.force.sync');
