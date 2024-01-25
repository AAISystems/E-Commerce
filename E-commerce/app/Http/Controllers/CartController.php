<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    // Crear un nuevo carrito asociado a un usuario.
    // Falta pasar el id del usuario para asociarlo.
    public function create($userId)
    {

        $newCart = new Cart();
        $newCart->amount=0;
        $newCart->total_products=0;
        $newCart->users_id=$userId;
        // $newCart->products_id=0;

        $newCart->save();
    }
}
