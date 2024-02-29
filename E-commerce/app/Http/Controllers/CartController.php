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
        $user = Auth::user();

        $newCart = new Cart();
        $newCart->amount = 0;
        $newCart->total_products = 0;
        $newCart->user_id = $userId;

        $newCart->save();
    }

    public function add(Request $request)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();

        // Buscamos su carrito asociado y el producto seleccionado

        $userCart = $user->cart;


        $productToAdd = Product::find($request->idProduct);

        //Añadimos el precio de los productos al total del carrito

        $userCart->amount += $productToAdd->price * $request->inputQuantity;

        // $productToAdd->stock -= $request->inputQuantity;
        $productToAdd->save();

        if ($userCart->products->contains('id', $productToAdd->id)) {
            // Cogemos el producto del carrito y accedemos al atributo cantidad de la tabla pivote.
            // Aumentamos su valor en funcion de la cantidad seleccionada

            $newQuantity = $userCart->products->find($productToAdd->id)->pivot->quantity += $request->inputQuantity;

            $userCart->products()->updateExistingPivot($productToAdd->id, ['quantity' => $newQuantity]);
        } else {
            $newQuantity = $request->inputQuantity;
            // Añadimos el producto a la tabla pivote junto con la cantidad
            $userCart->products()->attach($productToAdd->id, ['quantity' => $newQuantity]);
        }

        $userCart->save();
        return redirect()->back();
    }

    public function remove($id)
    {
        // Recogemos el usuario que este autenticado
        $user = Auth::user();
        // Buscamos su carrito asociado y el producto seleccionado
        $userCart = $user->cart;
        $productToRemove = Product::find($id);

     
        //Eliminamos el precio de los productos al total del carrito
        $userCart->amount -= $productToRemove->price * $userCart->products()->find($productToRemove->id)->pivot->quantity;
       $userCart->save();


        $productToRemove->save();
        // Retiramos el producto de la tabla pivote 
        $userCart->products()->detach($productToRemove->id);


        return redirect()->back()->with('success','Producto eliminado del carrito correctamente');
    }

    public function dump()
    {
        $user = Auth::user();

        $userCart = $user->cart;
        $userCart->products()->detach();
        $userCart->amount = 0;
        $userCart->save();

        return redirect('/');
    }

    public function addQuantity($id){
        $user = Auth::user();
        $cartProduct = $user->cart->products->find($id);
        $cartProduct->pivot->update(['quantity'=>   $cartProduct->pivot->quantity+1]);
        return redirect()->back();
    }
 public function substractQuantity($id){
    $user = Auth::user();
    $cartProduct = $user->cart->products->find($id);
    $cartProduct->pivot->update(['quantity'=>   $cartProduct->pivot->quantity-1]);
    return redirect()->back();
    }


    public function buy($userCart)
    {
        $user = Auth::user();
        $userCart = $user->cart;

        foreach ($userCart->products as $productToRemove) {
            // Devolvemos la cantidad al stock del producto
            $quantity = $userCart->products()->find($productToRemove->id)->pivot->quantity;
            $productToRemove->stock -= $quantity;
            $productToRemove->save();
        }




        $userCart->products()->detach();
        $userCart->amount = 0;
        $userCart->save();
    }
}
