@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Categorías')

@section('content')
<div class="container mt-3">
    {{-- <h1>Creación del producto:</h1>
    <form action="{{ route('') }}" method="POST">
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
</div> --}}

<div class="row">
    {{-- Obtenemo el producto creado y con el for vamos generando cards para que se guarden los productos guardados en el obejto producto --}}
    @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Imagen del producto -->

                <div class="card-body">
                    <!-- Nombre del producto -->
                    <h5 class="card-title">{{ $category->name }}</h5>

                    <!-- Descripción del producto -->
                   
                    {{-- Creo boton para poder editar productos, esto lo que hace es pasarle como enlace la vista donde se editan los productosy con la barra coge el producto seleccionado el cual coge su id --}}
                  {{-- <a href="{{ route('product.edit', ['id' => $product->id]) }}">  <button>Editar Producto    </button></a>
                
                   <a href="{{ route('product.delete', ['id' => $product->id]) }}"> <button>Ocultar Producto</button></a>
                     --}}
                </div>
            </div>
        </div>
        @endforeach
        {{$categories->links()}}
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
