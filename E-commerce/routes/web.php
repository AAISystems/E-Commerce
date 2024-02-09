<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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

//Hacer route group para no tener 80 líneas

Route::get('/', [ ProductController::class, 'listMain' ]);
//Cargamos las rutas con los métodos que vamos a utilizar para guardar la información en cada vista correspondiente. 

Route::get('createProduct', [ ProductController::class, 'create' ]) -> name('product.create')->middleware('admin'); 

// Aquí ya tenemos el producto creado, por  lo que accedemos a él a través del id con el método editar guardando en el alias product.edit.

//En la ruta "edit_product", pongo id para acceder a un producto en concreto no a todos 
Route::get('edit_product/{id}', [ ProductController::class, 'edit' ]) -> name('product.edit')->middleware('admin'); 

Route::post('product_update', [ ProductController::class, 'add' ]) -> name('product.update')->middleware('admin'); 

Route::get('list_product', [ ProductController::class, 'list' ]) -> name('product.list')->middleware('admin'); 

Route::get('/admin', [AdminController::class, 'mostrarAdmin'])->name('admin')->middleware('admin');

Route::get('/admin/products', [ AdminController::class, 'list' ]) -> name('admin.listp')->middleware('admin'); 

Route::post('saveProduct/{id}', [ ProductController::class, 'update' ]) -> name('product.save')->middleware('admin'); 
Route::get('deleteProduct/{id}', [ ProductController::class, 'delete' ]) -> name('product.delete')->middleware('admin'); 

Route::get('addToCart',[ CartController::class, 'add' ]) -> name('addCart')->middleware('auth'); 

Route::get('removeFromCart',[ CartController::class, 'remove' ]) -> name('removeFromCart')->middleware('auth');

Route::get('product/{id}', [ProductController::class,'showProduct' ])->name('product.show');

Route::get('dumpCart', [ CartController::class, 'dump' ])->middleware('auth') -> name('dumpCart'); 

Route::get('checkout', [ OrderController::class, 'prepareOrder' ])->middleware('auth') -> name('checkout'); 
Route::get('buy', [ OrderController::class, 'buy' ]) ->middleware('auth')-> name('buy'); 

Route::get('user/addresses', [AddressController::class,'show'])->middleware('auth')->name('user.address');
Route::view('user/addresses/create', 'userSettings.createAddress')->middleware('auth')->name('user.address.create');

Route::post('user/address/save',[AddressController::class,'create'])->middleware('auth')->name('user.address.save');
Route::get('user/address/delete/{id}',[AddressController::class,'delete'])->middleware('auth')->name('user.address.delete');
Route::get('user/address/favourite/{id}',[AddressController::class,'favourite'])->middleware('auth')->name('user.address.favourite');
