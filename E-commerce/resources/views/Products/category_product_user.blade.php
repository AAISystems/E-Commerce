@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection
@section('css')
<link rel="stylesheet" href=" {{ asset('css/welcome.css') }}">
@endsection

@section('content')
    <div class="container mt-3">
        <h1 class="text-center fw-light mb-4">Productos de la categoría {{ $category->name }}</h1>

        <div class="row justify-content-center">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border rounded-4">
                    <a href="{{ route('product.show', $product->id) }}"
                        class="text-center p-3 text-decoration-none text-dark border-bottom shadow-sm mb-4 rounded-top-4">
                        <h5 class="card-title fw-light">{{ $product->name }}</h5>
                    </a>
                    @if ($product->images()->exists())
                        <!-- Imagen del producto -->

                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="{{ asset($product->images->first()->route) }}" class="card-img-top p-4 img-fluid"
                                alt="{{ $product->name }}">
                        </a>
                    @else
                        <div class="text-center">
                            <p>No hay imagen disponible</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- Nombre del producto -->


                        <!-- Descripción del producto -->
                        <p class="card-text">

                            @switch($product->categories->first()->id)
                                @case(1)
                                    <span class="badge text-bg-info fw-normal">{{ $product->categories->first()->name }}</span>
                                @break

                                @case(2)
                                    <span class="badge text-bg-success fw-normal">{{ $product->categories->first()->name }}</span>
                                @break

                                @case(3)
                                    <span class="badge text-bg-dark fw-normal">{{ $product->categories->first()->name }}</span>
                                @break

                                @case(4)
                                    <span class="badge text-bg-warning fw-normal">{{ $product->categories->first()->name }}</span>
                                @break

                                @case(5)
                                    <span class="badge text-bg-danger fw-normal">{{ $product->categories->first()->name }}</span>
                                @break

                                @case(6)
                                    <span class="badge text-bg-secondary fw-normal">{{ $product->categories->first()->name }}</span>
                                @break
                            @endswitch

                        </p>
                        <div class="d-flex">
                            <!-- Stock del producto -->
                            <p class="fs-3  fw-light">{{ $product->price }} €</p>
                            
                            <form
                                action="@if (Auth::check() && Auth::user() && !Auth::user()->wishlist->products->find($product->id)) {{ route('addWish') }} @elseif(Auth::check() && Auth::user()->wishlist->products->find($product->id)) {{ route('removeWish') }} @else {{ route('login') }} @endif"
                                class="ms-auto">
                                @csrf
                                <input type="text" name="idProduct" value={{ $product->id }} hidden>

                                <button type="submit" class="btn">
                                    
                                    <img src="@if (Auth::check()&& Auth::user()->wishlist->products->find($product->id)) {{ asset('img/heart-svgrepo-com-filled.svg') }} @else {{ asset('img/heart-svgrepo-com.svg') }} @endif"
                                        class="ms-auto" alt="icono corazon">
                                </button>


                            </form>



                        </div>


                        {{-- Formulario para añadir al carrito --}}
                        <form
                            action="@if (Auth::user()) {{ route('addCart') }}@else {{ route('login') }} @endif">
                            @csrf
                            <input type="text" name="idProduct" value="{{ $product->id }}" hidden>

                            <div class="row justify-content-center align-items-center gap-2">
                                <div class="container col-6">
                                    <div class="input-group">
                                        <button type="button" onclick="substract({{ $product->id }})"
                                            class="btn btn-light btn-outline-secondary rounded-start-pill">
                                            -
                                        </button>
                                        <input type="text" class="form-control input-group-sm " name="inputQuantity"
                                            id="quantity_{{ $product->id }}" aria-describedby="helpId" placeholder="1"
                                            value="1" readonly />

                                        <button type="button" onclick="add({{ $product->id }})"
                                            class="btn btn-secondary rounded-end-pill">
                                            +
                                        </button>
                                    </div>

                                </div>


                                <div class="col-5">
                                    <button class="btn btn-success mt-3 col-12" type="submit">
                                        <img src="{{ asset('img/cart-plus-svgrepo-com.svg') }}" alt="Añadir al carro">
                                    </button>
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