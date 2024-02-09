<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function prepareOrder()
    {
        $user = Auth::user();

        $userCart = Cart::where('users_id', $user->id)->first();


        $productsInCart = $userCart->products;
        $quantityOfProduct = array();
        foreach ($productsInCart as $product) {
            $quantityOfProduct[$product->id] = $userCart->products->find($product->id)->pivot->quantity;
        }

        return view('prepareOrder', compact('productsInCart', 'quantityOfProduct'));
    }

    public function buy(Request $request)
    {
        $user = Auth::user();
        $userCart = Cart::where('users_id', $user->id)->first();

        switch ($request->action) {

            case 'removeFromCart':
                $userCart->products()->detach($request->idProduct);

                return redirect()->back()->with('success', 'Producto eliminado correctamente.');
                break;
            case 'buy':
                $newOrder = new Order();

                $newOrder->users_id = $user->id;
                $newOrder->total = $userCart->amount;

                $newOrder->save();

                foreach ($request->except('_token') as $key => $value) {

                    if (Str::startsWith($key, 'idProduct_')) {

                        // Se inserta en la tabla pivote de los pedidos el producto y la cantidad asociada.
                        // Como sabemos que esta recogiendo el id de algun producto, lo concatenamos con el prefijo quantity_ del formulario
                        // para obtener la cantidad asociada al producto
                        $newOrder->products()->attach($value, ['quantity' => $request['quantity_' . $request[$key]]]);
                    }
                }


                $newOrder->save();


                // Enviar el correo electrónico
                Mail::to($user->email)->send(new OrderPlaced($user, $newOrder));

                return redirect('/');
                break;
            case 'default':

                return redirect()->back();
                break;
        }
    }
}
