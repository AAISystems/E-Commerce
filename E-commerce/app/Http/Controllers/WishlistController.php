<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function create($userId)
    {

        $wishlist = new Wishlist();
        $wishlist->users_id = $userId;
        $wishlist->save();
    }


    public function add(Request $request)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();

       

        $userWishlist = Wishlist::where('users_id', $user->id)->first();


        $productToAdd = Product::find($request->idProduct);

        //Añadimos el precio de los productos al total del carrito

        $productToAdd->save();

        if ($userWishlist->products->contains('id', $productToAdd->id)) {
          

            return redirect('/')->back()->with('error', 'El producto ya está en tu wishlist.');
        } else {
            $userWishlist->products()->attach($productToAdd->id);
        }

        $userWishlist->save();
        return redirect('/')->with('success', 'Producto añadido a tu wishlist correctamente.');
    }



    public function wishes(){
        $user = Auth::user();
        return view("Users.wishlist", compact("user"));
    }


}
