@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Productos de ' . $category->name)

@section('content')
<div class="container mt-3">
    <h1>Productos de {{ $category->name }}</h1>
    {{-- {{dd($products)}} --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Precio: {{ $product->price }}</p>
                        <!-- Otros detalles del producto -->
                        <!-- Formulario para quitar el producto de la categoría -->
                        <form action="{{ route('product.removeFromCategory', ['product' => $product->id, 'category' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Quitar de la categoría</button>
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
