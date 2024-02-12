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

        $userAddresses = $user->addresses;

        return view('prepareOrder', compact('productsInCart', 'quantityOfProduct', 'userAddresses'));
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

                if ($request->inputAddress) {
                    $newOrder = new Order();

                    $newOrder->users_id = $user->id;
                    $newOrder->total = $userCart->amount;
                    $newOrder->dataUser = $user->name;
                    $newOrder->dataAddress = $request->inputAddress;

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

                    $cartController = new CartController();

                    dd($cartController);
                    $cartController->buy($user->cart);

                    return redirect('/');
                    break;
                } else {
                    $newOrder = new Order();

                    $newOrder->users_id = $user->id;
                    $newOrder->total = $userCart->amount;
                    $newOrder->dataUser = $user->name;
                    $newOrder->dataAddress = $request->country . ' ' . $request->province . ' ' . $request->city . ' ' . $request->pc . $request->street . ' ' . $request->number . ' ' . $request->floor . ' ' . $request->door;

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

                    $cartController = new CartController();

                    $cartController->buy($user->cart);

                    // Enviar el correo electrónico
                    Mail::to($user->email)->send(new OrderPlaced($user, $newOrder));

                    return redirect('/');
                    break;
                }

            case 'default':

                return redirect()->back();
                break;
        }
    }
}
