@extends('template.template')

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
