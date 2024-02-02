@extends('template.template')

<h1 class="text-center fw-light">Hola {{ $user->name }}</h1>
<p class="text-center">¡Gracias por tu compra! Aquí tienes los detalles de tu pedido</p>
@foreach ($order->products as $key)
    <div class="container p-3">
        <div class="row justify-content-center align-items-center border rounded g-2 p-3 mb-2">

            <p class="col-4">Producto: {{ $key->name }}</p>
            <p class="col-4">Cantidad: {{ $key->quantity }}</p>
            <p class="col-4">Precio: {{ $key->price }}</p>

        </div>
    </div>
@endforeach
<div class="row justify-content-center align-items-center g-2">
    <div class="col-6">Total: {{ $order->total }}</div>

</div>
