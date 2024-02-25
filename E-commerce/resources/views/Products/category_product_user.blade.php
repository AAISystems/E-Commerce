@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('content')
    <div class="container mt-3">
        <h1 class="text-center fw-light mb-4">Productos de la categoría {{ $category->name }}</h1>

        <div class="row justify-content-center">
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
                            <div class="d-flex">
                                <!-- Stock del producto -->
                                <small class="help">Stock: {{ $product->stock }} </small>

                                <form
                                    action="@if (Auth::user()) {{ route('addWish') }}@else {{ route('login') }} @endif"
                                    class="ms-auto">
                                    @csrf
                                    <input type="text" name="idProduct" value={{ $product->id }} hidden>

                                    <button type="submit" class="btn">
                                        <img src="{{ asset('img/heart-svgrepo-com.svg') }}" class="ms-auto"
                                            alt="icono corazon">
                                    </button>


                                </form>



                            </div>


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
                                        <button class="btn btn-success mt-3 col-12" type="submit"><img
                                                src="{{ asset('img/cart-plus-svgrepo-com.svg') }}"
                                                alt="Anyadir al carro"></button>
                                    </div>

                                </div>


                            </form>



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
@section('footer')
    @include('template.footer')
@endsection