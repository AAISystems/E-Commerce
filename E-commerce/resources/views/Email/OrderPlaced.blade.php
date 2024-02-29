@extends('template.template')

<h1 class="text-center fw-light">Hola {{ $user->name }}</h1>
<p class="text-center">¡Gracias por tu compra! Aquí tienes los detalles de tu pedido</p>
<div class="container">
    @foreach ($order->products as $product)
        <div class="container p-3">
            <div class="row justify-content-center align-items-top g-2 p-4 shadow-sm">
                <div class="col-12 col-md-3 col-lg-2">
                    <!-- Carrusel de imágenes -->
                    <img src="{{ asset($product->images->first()->route) }}" class="img p-4 img-fluid"
                        alt="{{ $product->name }}">

                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <p>{{ $product->name }}</p>
                    <p>{{ $product->price }}€</p>
                    <p>x{{ $product->pivot->quantity }}</p>
                    <p class="border-top">Subtotal: {{$product->price*$product->pivot->quantity}}</p>

                </div>
            </div>
        </div>
    @endforeach
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-12">
            <p class="bg-purple rounded p-2 shadow">Fecha de expedición: {{ $order->created_at }}</p>
            <p>Dirección de entrega: {{ $order->dataAddress }}</p>
            <p class="fw-light fs-5 text-end border-top p-1">Total: {{ $order->total }}€</p>
        </div>
    </div>

    
</div>
