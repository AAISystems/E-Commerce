<?php

use App\Http\Controllers\CartController;
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

Route::get('/', [ ProductController::class, 'listMain' ]);

//Cargamos las rutas con los métodos que vamos a utilizar para guardar la información en cada vista correspondiente. 

Route::get('createProduct', [ ProductController::class, 'create' ]) -> name('product.create'); 

// Aquí ya tenemos el producto creado, por  lo que accedemos a él a través del id con el método editar guardando en el alias product.edit.

Route::get('edit_product/{id}', [ ProductController::class, 'edit' ]) -> name('product.edit'); 

Route::post('edit_product', [ ProductController::class, 'update' ]) -> name('product.update'); 

Route::get('list_product', [ ProductController::class, 'list' ]) -> name('product.list'); 


Route::get('addToCart',[ CartController::class, 'add' ]) -> name('addCart'); 