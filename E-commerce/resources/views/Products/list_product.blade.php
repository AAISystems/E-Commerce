@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')
    <div class="container mt-5">
        <div class="row">
            {{-- Obtenemo el producto creado y con el for vamos generando cards para que se guarden los productos guardados en el obejto producto --}}
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
                           
                            {{-- Creo boton para poder editar productos, esto lo que hace es pasarle como enlace la vista donde se editan los productosy con la barra coge el producto seleccionado el cual coge su id --}}
                          <a href="{{ route('product.edit', ['id' => $product->id]) }}">  <button>Editar Producto    </button></a>
                        
                           <a href="{{ route('product.delete', ['id' => $product->id]) }}"> <button>Ocultar Producto</button></a>
                            
                        </div>
                    </div>
                </div>
                @endforeach
                {{$products->links()}}
        </div>
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
