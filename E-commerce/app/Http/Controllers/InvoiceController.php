<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMailable;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{

    public function create($orderId)
    {
        $user = Auth::user();
        $userAddresses = $user->addresses;
        $userOrder = $user->cart->orders->find($orderId);
        $categories = Category::where('show', true)->get();


        $user = Auth::user();
        $existingInvoice = Invoice::where('order_id', $userOrder->id)->first();

        if ($existingInvoice) {
            // Ya existe una factura para esta orden, puedes manejar esto según tus necesidades
            return redirect()->route('invoices.generate', $existingInvoice->id);
        }
        $productsInCart = $user->cart->products;

        return view('invoices.create', compact('userAddresses', 'userOrder', 'categories', 'productsInCart'));
    }

    public function update(Request $request)
    {
        $order = Order::find($request->order_id);
        $user = Auth::user();
        $existingInvoice = Invoice::where('order_id', $order->id)->first();

        if ($existingInvoice) {
            // Ya existe una factura para esta orden, puedes manejar esto según tus necesidades
            return redirect()->route('invoices.generate', $existingInvoice->id);
        }




        $invoice = new Invoice();

        $invoice->sellerName = 'AAISystems S.L.';
        $invoice->sellerNIF = '000000000';
        $invoice->sellerAddress = 'Calle falsa 123, apt 4';
        $invoice->date = Date::now();

        $invoice->userNIF = $request->inputNIF;

        if ($request->inputAddress) {
            $invoice->userAddress = $request->inputAddress;
        } else {
            $invoice->userAddress = $request->country . ' ' . $request->province . ' ' . $request->city . ' ' . $request->pc . $request->street . ' ' . $request->number . ' ' . $request->floor . ' ' . $request->door;
        }


        $invoice->userName = $order->dataUser;

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

        // Mail::to($user->email)->send(new InvoiceMailable($user, $invoice));
        return redirect()->route('invoices.generate', $invoice->id);
    }

    public function generatePDF($id)
    {
        $invoice = Invoice::find($id);


        // Pasar los datos de la factura dentro de un array
        $data = ['invoice' => $invoice];

        // Cargar la vista con los datos de la factura
        $pdf = PDF::loadView('pdf.Invoice', $data);

        return $pdf->download('invoice.pdf');
    }


    public function show()
    {
        $user = Auth::user();
        $categories = Category::where('show', true)->get();
        $productsInCart = $user->cart->products;
        if ($user->cart->orders) {
            $orders = $user->cart->orders()->orderBy('created_at', 'desc')->get();

            return view('invoices.show', compact('orders', 'categories', 'productsInCart'));
        } else {
            return view('invoices.show', compact('categories','productsInCart'));
        }
    }
}
