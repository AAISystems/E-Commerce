<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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

Route::get('/', [ProductController::class, 'listMain'])->name('home');
//Cargamos las rutas con los métodos que vamos a utilizar para guardar la información en cada vista correspondiente. 

Route::get('createProduct', [ProductController::class, 'create'])->name('product.create')->middleware('admin');

// Aquí ya tenemos el producto creado, por  lo que accedemos a él a través del id con el método editar guardando en el alias product.edit.

//En la ruta "edit_product", pongo id para acceder a un producto en concreto no a todos 
Route::get('edit_product/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('admin');

Route::post('product_update', [ProductController::class, 'add'])->name('product.update')->middleware('admin');

Route::get('list_product', [ProductController::class, 'list'])->name('product.list')->middleware('admin');

Route::get('/admin', [AdminController::class, 'mostrarAdmin'])->name('admin')->middleware('admin');

Route::get('/admin/products', [AdminController::class, 'list'])->name('admin.listp')->middleware('admin');

Route::post('saveProduct/{id}', [ProductController::class, 'update'])->name('product.save')->middleware('admin');
Route::get('deleteProduct/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('admin');

Route::get('addToCart', [CartController::class, 'add'])->name('addCart')->middleware('auth');

Route::get('removeFromCart/{id}', [CartController::class, 'remove'])->name('removeFromCart')->middleware('auth');

Route::get('product/{id}', [ProductController::class, 'showProduct'])->name('product.show');

Route::get('dumpCart', [CartController::class, 'dump'])->middleware('auth')->name('dumpCart');

Route::get('checkout', [OrderController::class, 'prepareOrder'])->name('checkout');
Route::get('buy', [OrderController::class, 'buy'])->name('buy');

Route::get('user/addresses', [AddressController::class, 'show'])->middleware('auth')->name('user.address');
Route::get('user/addresses/create', [AddressController::class, 'prepare'])->middleware('auth')->name('user.address.create');

Route::post('user/address/save', [AddressController::class, 'create'])->middleware('auth')->name('user.address.save');
Route::get('user/address/delete/{id}', [AddressController::class, 'delete'])->middleware('auth')->name('user.address.delete');
Route::get('user/address/favourite/{id}', [AddressController::class, 'favourite'])->middleware('auth')->name('user.address.favourite');
Route::get('user/address/edit/{id}', [AddressController::class, 'edit'])->middleware('auth')->name('user.address.edit');
Route::post('user/address/edit/update', [AddressController::class, 'update'])->middleware('auth')->name('user.address.update');

Route::get('user/invoices', [InvoiceController::class, 'show'])->middleware('auth')->name('invoices.show');
Route::get('user/invoices/create/{id}', [InvoiceController::class, 'create'])->middleware('auth')->name('invoices.create');
Route::post('user/invoices/update/{id}', [InvoiceController::class, 'update'])->middleware('auth')->name('invoices.update');
Route::get('user/invoices/generatePdf/{id}', [InvoiceController::class, 'generatePDF'])->middleware('auth')->name('invoices.generate');

Route::get('admin/categories', [CategoryController::class, 'list'])->name('category.show');

Route::post('category_update', [CategoryController::class, 'add'])->name('categories.update')->middleware('admin');

Route::get('/category/{category}', [CategoryController::class, 'showProducts'])->name('category.products');

Route::get('edit_categories/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('admin');


Route::post('saveCategory/{id}', [CategoryController::class, 'update'])->name('category.save')->middleware('admin');

Route::delete('admin/categories/removeFromCategory/{product}/{category}', [ProductController::class, 'removeFromCategory'])->name('product.removeFromCategory');

Route::delete('/admin/categories/{category}', [CategoryController::class, 'delete'])->name('category.delete');

Route::post('/category/{id}/activate', [CategoryController::class, 'activate'])->name('category.activate');

Route::post('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');

Route::get('user_data', [UserController::class, 'seeData'])->name('user.data');

Route::post('profile_update', [UserController::class, 'update'])->name('user.update');
Route::get('user/profile', [UserController::class, 'edit'])->name('user.edit');

Route::get('wishlist', [WishlistController::class, 'wishes'])->name('wishlist.wishes');
Route::get('addToWishlist', [WishlistController::class, 'add'])->name('addWish')->middleware('auth');
Route::get('wishlist/delete', [WishlistController::class, 'remove'])->name('removeWish');

Route::get('admin/discounts', [DiscountController::class, 'show'])->middleware('auth','admin')->name('admin.discounts');
Route::get( 'admin/discounts/newProductDiscount', [DiscountController::class,'productDiscount'])->middleware('auth','admin')->name('discount.product');
Route::post('admin/discounts/save', [DiscountController::class,'save'])->middleware('auth','admin')->name('discount.save');
Route::get('admin/discounts/delete/{id}', [DiscountController::class,'invalid'])->middleware('auth','admin')->name('discount.delete');

Route::get( 'admin/discounts/newCategoryDiscount', [DiscountController::class,'categoryDiscount'])->middleware('auth','admin')->name('discount.category');
Route::post('admin/discounts/saveCategory', [DiscountController::class,'saveCategory'])->middleware('auth','admin')->name('discount.saveCategory');
Route::get('admin/discounts/applyCategoryDiscount/{category}/{discount}', [DiscountController::class,'applyCategoryDiscount'])->middleware('auth','admin')->name('discount.aplyCategory');


