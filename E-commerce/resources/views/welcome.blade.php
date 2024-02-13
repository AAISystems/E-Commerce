@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 min-vh-100">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="fw-light mb-4">Súper Ventas</h2>
        <div class="row justify-content-center align-items-center g-2">

            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">

                        @if ($product->images()->exists())
                            <!-- Imagen del producto -->
                            <img src="{{ asset('storage/' . $product->images->first()->route) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                        @else
                            <div class="text-center">
                                <p>No hay imagen disponible</p>
                            </div>
                        @endif

                        <div class="card-body">
                            <!-- Nombre del producto -->
                            <a href="{{ route('product.show', $product->id) }}">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </a>

                            <!-- Descripción del producto -->
                            <p class="card-text">{{ $product->description }}</p>

                            <!-- Stock del producto -->
                            <small class="help">Stock: {{ $product->stock }} </small>

                            {{-- Formulario para añadir al carrito --}}
                            <form
                                action="@if (Auth::user()) {{ route('addCart') }}@else {{ route('login') }} @endif">
                                @csrf
                                <input type="text" name="idProduct" value={{ $product->id }} hidden>
                                <div class="row justify-content-center align-items-center g-2">
                                    <button type="button" onclick="substract({{ $product->id }})"
                                        class="col-4 btn btn-secondary">
                                        -
                                    </button>

                                    <div class="col-4">
                                        <input type="text" class="form-control" name="inputQuantity"
                                            id="quantity_{{ $product->id }}" aria-describedby="helpId" placeholder="1"
                                            value="1" readonly />

                                    </div>
                                    <button type="button" onclick="add({{ $product->id }})"
                                        class="col-4 btn btn-secondary">
                                        +
                                    </button>

                                </div>
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <button class="btn btn-success mt-3 col-12" type="submit">Añadir al
                                            carrito</button>
                                    </div>

                                </div>


                            </form>
                            <form
                                action="@if (Auth::user()) {{ route('addWish') }}@else {{ route('login') }} @endif">
                                @csrf
                                <input type="text" name="idProduct" value={{ $product->id }} hidden>

                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        
                                        <button class="btn btn-success mt-3 col-12" type="submit">Añadir a
                                            favoritos</button>
                                    </div>

                                </div>


                            </form>


                        </div>




                    </div>

                </div>
            @endforeach

        </div>
        {{ $products->links() }}
    </div>



    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
