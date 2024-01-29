@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')


<div class="container mt-5">

    <h1>Creación del producto:</h1>
    <form action="{{ route('product.update') }}" method="POST">
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

        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>

    <div class="mt-4"> <!-- Agregamos un margen top aquí -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                       <!-- Imagen del producto -->
        <img src="{{ $product->imagen_url }}" class="card-img-top" alt="{{ $product->name }}">

        <div class="card-body">
            <!-- Nombre del producto -->
            <h5 class="card-title">{{ $product->name }}</h5>

            <!-- Descripción del producto -->
            <p class="card-text">{{ $product->description }}</p>

            <!-- Botones -->
            <a href="{{ route('product.edit', ['id' => $product->id]) }}">  <button class="btn m-4 p-2 btn-primary float-start">Editar Producto    </button></a>
                        
            <a href="{{ route('product.delete', ['id' => $product->id]) }}"> <button class="btn m-4 p-2 btn-danger float-start">Ocultar Producto</button></a>
        </div>
    </div>
</div>
            @endforeach
        </div>
        {{$products->links()}}
    </div>
</div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
