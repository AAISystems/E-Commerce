@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')
    <div class="container mt-5">
        <div class="row">
            {{-- Obtenemos los productos y creamos una card para cada uno --}}
            @foreach ($products as $product)
                @php
                    // Verificamos si alguna categoría asociada al producto está visible
                    $anyCategoryVisible = false;
                    foreach ($product->categories as $category) {
                        if ($category->show) {
                            $anyCategoryVisible = true;
                            break;
                        }
                    }
                    echo "<pre>";
                    var_dump($anyCategoryVisible);
                    echo "</pre>";
                @endphp

                {{-- Si al menos una categoría asociada al producto está visible, mostramos el producto --}}
                @if ($anyCategoryVisible)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- Imagen del producto -->
                            <img src="{{ asset('storage/'.$product->images->first()->route) }}" class="card-img-top" alt="{{ $product->name }}">

                            <div class="card-body">
                                <!-- Nombre del producto -->
                                <h5 class="card-title">{{ $product->name }}</h5>

                                <!-- Descripción del producto -->
                                <p class="card-text">{{ $product->description }}</p>
                               
                                {{-- Botones para editar y ocultar el producto --}}
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}"><button>Editar Producto</button></a>
                                <a href="{{ route('product.delete', ['id' => $product->id]) }}"><button>Ocultar Producto</button></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{$products->links()}}
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
