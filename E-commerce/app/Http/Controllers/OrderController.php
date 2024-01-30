<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

                $newOrder->users_id=$user->id;
                $newOrder->products()->attach($request->idProduct);

                $newOrder->total=$userCart->amount;

                $newInvoice=new Invoice();
                $newOrder->invoices()->attach($newInvoice);

                $newOrder->save();

                break;
            case 'default':

                return redirect()->back();
                break;
        }
    }
}
