@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')


    <div class="container mt-5">
        <h1>Creación del producto:</h1>
        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción del Producto</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Imágenes del Producto</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>

        <div class="mt-4"> <!-- Agregamos un margen top aquí -->
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
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
                                <p class="text-muted">Este producto esta @if ($product->show)
                                        visible.
                                    @else
                                        oculto.
                                    @endif
                                </p>

                                <!-- Botones -->
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}"> <button
                                        class="btn m-4 p-2 btn-primary float-start">Editar Producto </button></a>
                                @if ($product->show)
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}"> <button
                                            class="btn m-4 p-2 btn-danger float-start">Ocultar Producto</button></a>
                                @else
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}"> <button
                                            class="btn m-4 p-2 btn-danger float-start">Mostrar Producto</button></a>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
