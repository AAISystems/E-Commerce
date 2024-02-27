@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Consultar pedidos')

@section('script')
    <script defer src="{{ asset('js/orderAddress.js') }}"></script>

@endsection

@section('content')
    <div class="container mt-5 min-vh-100">
        @if (isset($orders))
            <h2 class="fw-light mb-5">Estos son tus pedidos</h2>
            @foreach ($orders as $order)
            <div class="row justify-content-center align-items-top g-2 p-4 shadow-sm">
                <div class="col-12 col-md-3 col-lg-2">
                    <!-- Carrusel de imágenes -->
                    <div id="carouselExample{{ $order->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($order->products as $index => $product)
                                <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                    <img src="{{ asset($product->images->first()->route) }}" class="img p-4 img-fluid"
                                        alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $order->id }}"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $order->id }}"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <p class="bg-purple rounded p-2 shadow">Fecha de expedición: {{ $order->created_at }}</p>
                    <p>Dirección de entrega: {{ $order->dataAddress }}</p>
                    <p class="fw-light fs-5 text-end border-top p-1">Total: {{ $order->total }}€</p>
                </div>
                <div class="text-end"> <a href="{{ route('invoices.create', $order->id) }}">Enviar factura por correo</a></div>
            </div>
        @endforeach
        
        @else
            <h2 class="fw-light">Todavía no hay pedidos</h2>
        @endif

    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
