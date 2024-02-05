@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Producto')

@section('content')
<div class="container mt-3">
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
        <div class="mb-3">
            <label for="images" class="form-label">Imágenes del Producto</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Imágenes del Producto</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
