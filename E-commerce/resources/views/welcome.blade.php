@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')

@section('content')
    <div class="container mt-5 min-vh-100">
        
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
                        <form action="@if(Auth::user()) {{route('addCart')}}@else {{route('login')}}@endif">
                            @csrf
                            <input type="text" name="idProduct" value={{ $product->id }} hidden>
                            <button class="btn btn-success" type="submit">Añadir al carrito</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
        {{ $products->links() }}

    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
