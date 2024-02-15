@extends('template.template')

@section('content')
    <h1 class="text-center fw-light">Hola {{ $user->name }}</h1>
    <p class="text-center">¡Gracias por tu compra! Aquí tienes tu factura</p>

    <div class="container p-3">
        <div class="row justify-content-center align-items-center border rounded g-2 p-3 mb-2">

            <div class="col-12 col-md-6">
                <p class="">Nombre del vendedor : {{ $invoice->sellerName }}</p>
                <p class="">NIF del vendedor : {{ $invoice->sellerNIF }}</p>
                <p class="">Dirección del vendedor : {{ $invoice->sellerAddress }}</p>

            </div>
            <div class="col-12 col-md-6">
                <p class="">Nombre del comprador : {{ $invoice->userName }}</p>
                <p class="">NIF del comprador : {{ $invoice->userNIF }}</p>
                <p class="">Dirección del comprador : {{ $invoice->userAddress }}</p>

            </div>



        </div>
    </div>

    @foreach ($invoice->products as $key)
        <div class="container p-3">
            <div class="row justify-content-center align-items-center border rounded g-2 p-3 mb-2">

                <p class="col-12 col-md-6 col-lg-3">Producto: {{ $key->name }}</p>
                <p class="col-12 col-md-6 col-lg-3">Cantidad: {{ $key->pivot->quantity }}</p>
                <p class="col-12 col-md-6 col-lg-3">Precio/unidad: {{ $key->price }}</p>
                <p class="col-12 col-md-6 col-lg-3">Precio: {{ $key->price*$key->pivot->quantity }}</p>

            </div>
        </div>
    @endforeach
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-12 col-md-6">Nº de cuenta del vendedor: 111 1111 111 111 11111</div>
        <div class="col-12 col-md-6">

            <p>Subtotal: {{ $invoice->total*0.79 }}</p>
            <p>Base imponible: {{ $invoice->total*0.79 }}</p>
            <p>% Impuesto: 21%</p>
            <p>Total: {{ $invoice->total }}</p>
        </div>

    </div>
@endsection
