@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/cProduct.js') }}"></script>
@endsection

@section('title', 'Lista de Productos')

@section('content')
    <div class="container mt-5">
        <h1>Creación del producto:</h1>
        <form id="productForm" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">Por favor, introduce un nombre válido.</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción del Producto</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                <div class="invalid-feedback">Por favor, introduce una descripción válida.</div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
                <div class="invalid-feedback">Por favor, introduce una cantidad válida de stock.</div>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Imágenes del Producto</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*"
                    required>
                <div class="invalid-feedback">Por favor, selecciona al menos una imagen.</div>
            </div>

            <button type="submit" class="boton">Crear Producto</button>
        </form>
    </div>
    <div class="container mt-4">
        <div class="row row-cols-1 card-columns">
            @foreach ($products as $product)
                <div class="col mb-4"> <!-- Eliminamos la clase mx-auto -->
                    <div class="card">

                        @if ($product->images()->exists())
                            <!-- Imagen del producto -->
                            <img src="{{ asset('storage/' . $product->images->first()->route) }}" class="card-img-top"
                                alt="{{ $product->name }}">
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
                            <p class="card-text">{{ $product->price }}</p>
                            <p class="card-text">{{ $product->stock }}</p>
                            <!-- Estado del producto -->
                            <p class="@if ($product->show) visible-status @else hidden-status @endif">
                                Este producto está @if ($product->show)
                                    visible.
                                @else
                                    oculto.
                                @endif
                            </p>

                            <div class="boton-group">
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}">
                                    <button class="boton">Editar Producto</button>
                                </a>
                                @if ($product->show)
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}">
                                        <button class="boton">Ocultar Producto</button>
                                    </a>
                                @else
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}">
                                        <button class="boton">Mostrar Producto</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <div class="container mt-4">
        {{ $products->links() }} <!-- Paginación -->
    </div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
