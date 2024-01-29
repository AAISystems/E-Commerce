<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // Crear un nuevo carrito asociado a un usuario.
    // Falta pasar el id del usuario para asociarlo.
    public function create($userId)
    {

        $newCart = new Cart();
        $newCart->amount = 0;
        $newCart->total_products = 0;
        $newCart->users_id = $userId;
        // $newCart->products_id=0;

        $newCart->save();
    }

    public function add(Request $request)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();

        // Buscamos su carrito asociado y el producto seleccionado

        $userCart = Cart::where('users_id', $user->id)->first();

        $productToAdd = Product::find($request->idProduct);

        if ($userCart->products->contains('id', $productToAdd->id)) {
            // Cogemos el producto del carrito y accedemos al atributo cantidad de la tabla pivote.
            $currentQuantity = $userCart->products->find($productToAdd->id)->pivot->quantity;
            // Aumentamos su valor
            $currentQuantity += 1;
        } else {
            // Añadimos el producto a la tabla pivote junto con la cantidad
            $userCart->products()->attach($productToAdd->id, ['quantity' => 1]);
        }
        return redirect('/');
    }

    public function remove(Request $request)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();
        // Buscamos su carrito asociado y el producto seleccionado
        $userCart = Cart::where('users_id', $user->id)->first();
        $productToRemove = Product::find($request->idProduct);

        // Retiramos el producto de la tabla pivote 
        $userCart->products()->detach($productToRemove->id);

        return redirect('/');
    }
}
