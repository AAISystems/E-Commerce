<?php

use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

Route::get('createProduct', [ ProductController::class, 'create' ]) -> name('product.create'); 

Route::get('edit_product/{id}', [ ProductController::class, 'edit' ]) -> name('product.edit'); 

Route::post('edit_product', [ ProductController::class, 'update' ]) -> name('product.update'); 

Route::get('list_product', [ ProductController::class, 'list' ]) -> name('product.list'); 
