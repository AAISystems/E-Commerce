@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Categorías')

@section('content')
<div class="container mt-3">
    <h1>Creación de la categoría:</h1>
    <form action="{{ route('categories.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

      

        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div> 

<div class="row">
    {{-- Obtenemo el producto creado y con el for vamos generando cards para que se guarden los productos guardados en el obejto producto --}}
    @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Imagen del producto -->

                <div class="card-body">
                    <!-- Nombre del producto -->
                    <h5 class="card-title"><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></h5>

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
