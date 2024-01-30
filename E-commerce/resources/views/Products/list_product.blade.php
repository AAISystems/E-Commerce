@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Lista de Productos')

@section('content')
    <div class="container mt-5">
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
