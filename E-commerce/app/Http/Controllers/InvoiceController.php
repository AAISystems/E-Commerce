<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMailable;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $userAddresses = $user->addresses;

        return view('invoices.create', compact('userAddresses'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $invoice = new Invoice();

        $invoice->sellerName = 'AAISystems S.L.';
        $invoice->sellerNIF = '000000000';
        $invoice->sellerAddress = 'Calle falsa 123, apt 4';
        $invoice->date = Date::now();
        $invoice->userName = $user->name;
        $invoice->userNIF = $request->inputNIF;

        if ($request->inputAddress) {
            $invoice->userAddress = $request->inputAddress;
        } else {
            $invoice->userAddress = $request->country . ' ' . $request->province . ' ' . $request->city . ' ' . $request->pc . $request->street . ' ' . $request->number . ' ' . $request->floor . ' ' . $request->door;
        }

        $order = Order::find($request->order_id);


        $products = $order->products;

        $invoice->user()->associate($user);
        $invoice->order()->associate($order);
        $invoice->total = $order->total;

        $invoice->save();
        // Asociar los productos a la factura
        foreach ($products as $product) {
            $quantity = $product->pivot->quantity;
            // Asociar el producto a la factura
            $invoice->products()->attach($product->id, ['quantity' => $quantity]);
        }



        $invoice->save();

        Mail::to($user->email)->send(new InvoiceMailable($user, $invoice));
        return redirect('/');
    }


    public function show()
    {
        $user = Auth::user();


        $invoices = $user->invoices->get();

        return view('invoices.show');
    }
}
