@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Producto')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <!-- Foto a la izquierda -->
            <img src="{{ $product->imagen_url }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <!-- Nombre, categoría, marca, descripción -->
            <h3>{{ $product->name }}</h3>
            <p>Categoría: {{ $product->category }}</p>
            <p>Marca: {{ $product->brand }}</p>
            <p>Descripción: {{ $product->description }}</p>
            
            <form
            action="@if (Auth::user()) {{ route('addCart') }}@else {{ route('login') }} @endif">
            @csrf
            <input type="text" name="idProduct" value={{ $product->id }} hidden>
            <div class="row justify-content-center align-items-center g-2">
                <button type="button" onclick="substract({{ $product->id }})"
                    class="col-4 btn btn-secondary btn-sm">
                    -
                </button>

                <div class="col-4">
                    <input type="text" class="form-control" name="inputQuantity"
                        id="quantity_{{ $product->id }}" aria-describedby="helpId" placeholder="1"
                        value="1" readonly />
                </div>
                <button type="button" onclick="add({{ $product->id }})"
                    class="col-4 btn btn-secondary btn-sm">
                    +
                </button>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <button class="btn btn-success mt-3 col-12 btn-sm" type="submit">Añadir al carrito</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
