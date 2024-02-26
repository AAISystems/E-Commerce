@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/productcategory.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/eProduct.js') }}"></script>
@endsection

@section('title', 'Productos de ' . $category->name)

@section('content')
<div class="container mt-5">
    <h1>Productos de{{ $category->name }}</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col mb-4">
                <div class="card">

                    <!-- Imagen del producto -->
                    @if ($product->images()->exists())
                        <img src="{{ asset('storage/' . $product->images->first()->route) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <div class="text-center">
                            <p>No hay imagen disponible</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- Nombre del producto -->
                        <h5 class="card-title">{{ $product->name }}</h5>

                        <!-- Descripción del producto -->
                        <p class="card-text">{{ $product->description }}</p>
                        <!-- Precio del producto -->
                        <p class="card-text">Precio: {{ $product->price }}</p>
                        <!-- Otros detalles del producto -->
                        <!-- Formulario para quitar el producto de la categoría -->
                        <form action="{{ route('product.removeFromCategory', ['product' => $product->id, 'category' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton btn btn-danger mt-2">Quitar de la categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
