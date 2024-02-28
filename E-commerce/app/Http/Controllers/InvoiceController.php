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
        // Reglas de validación
        $rules = [
            'inputNIF' => 'required|max:9', // Asegúrate de ajustar las reglas según tus necesidades
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pc' => 'required|digits:5', // Asume que el código postal es de 5 dígitos
            'street' => 'required|string|max:255',
            'number' => 'required|integer',
            'floor' => 'required|integer',
            'door' => 'required|string|max:255',
            // Añade aquí más reglas según sea necesario
        ];

        $messages = [
            'inputNIF.required' => 'El NIF es obligatorio.',
            'inputNIF.max' => 'El NIF no debe tener más de 9 caracteres.',
            'country.required' => 'El país es obligatorio.',
            'country.max' => 'El país no debe tener más de 255 caracteres.',
            'province.required' => 'La provincia es obligatoria.',
            'province.max' => 'La provincia no debe tener más de 255 caracteres.',
            'city.required' => 'La ciudad es obligatoria.',
            'city.max' => 'La ciudad no debe tener más de 255 caracteres.',
            'pc.required' => 'El código postal es obligatorio.',
            'pc.digits' => 'El código postal debe tener exactamente 5 dígitos.',
            'street.required' => 'La calle es obligatoria.',
            'street.max' => 'La calle no debe tener más de 255 caracteres.',
            'number.required' => 'El número es obligatorio.',
            'number.integer' => 'El número debe ser un número entero.',
            'floor.required' => 'El número de piso es obligatorio.',
            'floor.integer' => 'El número de piso debe ser un número entero.',
            'door.required' => 'La puerta es obligatoria.',
            'door.max' => 'La puerta no debe tener más de 255 caracteres.',

        ];

        // Aplica las reglas de validación al request
        $validatedData = $request->validate($rules, $messages);

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
            return view('invoices.show', compact('categories', 'productsInCart'));
        }
    }
}
