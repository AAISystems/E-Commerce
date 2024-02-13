@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4">Productos de la categoría {{ $category->name }}</h1>

        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($product->images->first()->route) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Precio: {{ $product->price }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Ver producto</a>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
