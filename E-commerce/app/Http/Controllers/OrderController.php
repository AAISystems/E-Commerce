<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Category;
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

        if ($user->cart->products->isEmpty()) {
            return back()->with("error", "El carrito está vacío");
        }

        $userCart = $user->cart;
        $categories = Category::where('show', true)->get();



        $productsInCart = $userCart->products;
        $quantityOfProduct = array();
        foreach ($productsInCart as $product) {
            $quantityOfProduct[$product->id] = $userCart->products->find($product->id)->pivot->quantity;
        }

        $userAddresses = $user->addresses;

        return view('prepareOrder', compact('productsInCart', 'quantityOfProduct', 'userAddresses', 'categories'));
    }

    public function buy(Request $request)
    {
        $user = Auth::user();
        $userCart = $user->cart;

        switch ($request->action) {

            case 'buy':


                if ($request->inputAddress) {
                    $newOrder = new Order();

                    $request->validate([
                        'inputAddress' => 'required'
                    ]);

                    $newOrder->users_id = $user->id;
                    $newOrder->total = 0;
                    $newOrder->dataUser = $request->inputName;
                    $newOrder->dataAddress = $request->inputAddress;
                    $newOrder->cart_id = $user->cart->id;

                    $newOrder->save();

                    foreach ($request->except('_token') as $key => $value) {

                        if (Str::startsWith($key, 'idProduct_')) {

                            // Se inserta en la tabla pivote de los pedidos el producto y la cantidad asociada.
                            // Como sabemos que esta recogiendo el id de algun producto, lo concatenamos con el prefijo quantity_ del formulario
                            // para obtener la cantidad asociada al producto
                            $newOrder->products()->attach($value, ['quantity' => $request['quantity_' . $request[$key]]]);
                            $newOrder->total += $newOrder->products->last()->price*$newOrder->products->last()->pivot->quantity;
                        }
                    }


                    $newOrder->save();


                    // Enviar el correo electrónico
                    Mail::to($user->email)->send(new OrderPlaced($user, $newOrder));

                    $cartController = new CartController();

                    $cartController->buy($user->cart);

                    return redirect('/');

                } else {
                    $newOrder = new Order();

                    $request->validate([
                        'country' => 'required',
                        'province' => 'required',
                        'city' => 'required',
                        'pc' => 'required|integer|min:10000|max:99999',
                        'street' => 'required',
                        'number' => 'required|integer',
                        'floor' => 'integer|min:0',
                        'door' => '',
                    ]);

                    $newOrder->users_id = $user->id;
                    $newOrder->total = $userCart->amount;
                    $newOrder->dataUser = $user->name;
                    $newOrder->dataAddress = $request->country . ' ' . $request->province . ' ' . $request->city . ' ' . $request->pc . $request->street . ' ' . $request->number . ' ' . $request->floor . ' ' . $request->door;
                    $newOrder->cart_id = $user->cart->id;

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

                }

            case 'default':

                return redirect()->back();

        }
    }
}
