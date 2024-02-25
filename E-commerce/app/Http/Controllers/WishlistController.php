<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function create($userId)
    {

        $wishlist = new Wishlist();
        $wishlist->user_id = $userId;

        $wishlist->save();
    }


    public function add(Request $request)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();



        $userWishlist = $user->wishlist;


        $productToAdd = Product::find($request->idProduct);


        $productToAdd->save();

        if ($userWishlist->products->contains('id', $productToAdd->id)) {


            return redirect('/')->with('error', 'El producto ya está en tu wishlist.');
        } else {
            $userWishlist->products()->attach($productToAdd->id);
        }

        $userWishlist->save();
        return redirect('/')->with('success', 'Producto añadido a tu wishlist correctamente.');
    }


    public function remove(Request $request)
    {

        $user = Auth::user();

        $userWishlist = $user->wishlist;
        $productToRemove = Product::find($request->idProduct);


        //Eliminamos el precio de los productos al total del carrito



        $productToRemove->save();
        // Retiramos el producto de la tabla pivote 
        $userWishlist->products()->detach($productToRemove->id);

        return redirect()->back()->with('success','Producto eliminado de tu wishlist correctamente');
    }


    public function wishes()
    {
        $user = Auth::user();


        $wishlist = $user->wishlist;

        $products = $wishlist->products;
        $categories = Category::where('show', true)->get();

        return view("Users.wishlist", compact("products",'categories'));
    }
}
