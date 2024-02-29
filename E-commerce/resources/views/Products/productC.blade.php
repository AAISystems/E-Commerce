@extends('template.template')

@section('navbar')
    @include('template.AdminNavbar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/productcategory.css') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('title', 'Productos de ' . $category->name)

@section('content')
    <div class="container mt-5">
        <h1>Productos de {{ $category->name }}</h1>
        <div class="row">
            @foreach ($products->chunk(4) as $chunk) <!-- Cambiar el 4 por el número de tarjetas que deseas por fila -->
                @foreach ($chunk as $product)
                    <div class="col-md-3 mb-4"> <!-- Cambiar col-md-3 por col-md-4 -->
                        <div class="card border rounded-4">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="text-center p-3 text-decoration-none text-dark border-bottom shadow-sm mb-4 rounded-top-4">
                                <h5 class="card-title fw-light">{{ $product->name }}</h5>
                            </a>
                            @if ($product->images()->exists())
                                <!-- Imagen del producto -->
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ asset($product->images->first()->route) }}" class="card-img-top p-4 img-fluid"
                                        alt="{{ $product->name }}">
                                </a>
                            @else
                                <div class="text-center">
                                    <p>No hay imagen disponible</p>
                                </div>
                            @endif

                            <div class="card-body">
                                <!-- Nombre del producto -->

                                <!-- Descripción del producto -->
                                <p class="card-text">
                                    @switch($product->categories->first()->id)
                                        @case(1)
                                            <span class="badge text-bg-info fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                        @case(2)
                                            <span class="badge text-bg-success fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                        @case(3)
                                            <span class="badge text-bg-dark fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                        @case(4)
                                            <span class="badge text-bg-warning fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                        @case(5)
                                            <span class="badge text-bg-danger fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                        @case(6)
                                            <span class="badge text-bg-secondary fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                    @endswitch
                                </p>
                                <div class="d-flex">
                                    <!-- Precio del producto -->
                                    @if($product->discount && $product->discount->valid)
                                    <p class="fs-6  fw-light text-danger"><del>{{ $product->price }} €</del></p>
                                    <p class="fs-3  fw-light ">{{ $product->price*(1-($product->discount->amount/100)) }} €</p>
                                    @else
                                    <p class="fs-3  fw-light">{{ $product->price }} €</p>
                                    @endif                                     </div>
                                <!-- Botones de acción -->
                                <div class="boton-group">
                                    <!-- Puedes agregar aquí los botones de acción si es necesario -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
        <!-- Paginación de productos -->
        {{ $products->links() }}
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
