<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
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
        $userCart->amount=0;
        foreach ($productsInCart as $product) {

            $quantityOfProduct[$product->id] = $userCart->products->find($product->id)->pivot->quantity;
            $userCart->amount+=($product->price*$quantityOfProduct[$product->id]);

        }

        if($user->cart->discount && $user->cart->discount->valid){
            $user->cart->amount*=(1-($user->cart->discount->amount/100));
            $user->cart->save();
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
                $newOrder = new Order();

                if ($request->inputAddress) {
                    $request->validate([
                        'inputAddress' => 'required',
                    ]);

                    $newOrder->dataAddress = $request->inputAddress;
                } else {
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

                    $newOrder->dataAddress = $request->country . ' ' . $request->province . ' ' . $request->city . ' ' . $request->pc . $request->street . ' ' . $request->number . ' ' . $request->floor . ' ' . $request->door;
                }

                $newOrder->users_id = $user->id;
                $newOrder->total = 0;
                $newOrder->dataUser = $request->inputName;
                $newOrder->cart_id = $user->cart->id;

                $newOrder->save();

                foreach ($request->except('_token') as $key => $value) {
                    if (Str::startsWith($key, 'idProduct_')) {
                        $quantityKey = 'quantity_' . $request[$key];
                        $quantity = $request[$quantityKey] ?? 0;
                
                        $product = Product::find($value);
                        $totalProduct = $product->price * $quantity;
                
                        $newOrder->products()->attach($value, ['quantity' => $quantity]);
                     
                    }
                }
                $newOrder->total=$user->cart->amount;

                $newOrder->save();

                // Enviar el correo electrónico
                Mail::to($user->email)->send(new OrderPlaced($user, $newOrder));

                $cartController = new CartController();
                $cartController->buy($user->cart);

                return redirect('/');

            case 'default':
                return redirect()->back();
        }
    }


}
