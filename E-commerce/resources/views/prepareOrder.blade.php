@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Mi pedido')


@section('content')
    <div class="container mt-5">
        <h2 class="fw-light mb-5">Mi pedido</h2>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <form action="@if (Auth::user()) {{ route('buy') }}@else {{ route('login') }} @endif">
            @csrf
            @foreach ($productsInCart as $product)
                <div class="row justify-content-center align-items-center g-2 border rounded p-3 mb-3">
                    <div class="col-4">
                        {{ $product->name }}
                    </div>
                    <div class="col-4">
                        {{ $quantityOfProduct[$product->id] }}
                    </div>
                    <div class="col-4">
                        <div class="row justify-content-center align-items-center g-2 mb-2">
                            <input type="text" name="idProduct_{{$product->id}}" value={{ $product->id }} hidden>
                            <div class="row justify-content-center align-items-center g-2">
                                <button type="button" onclick="substract({{ $product->id }})"
                                    class="col-4 btn btn-secondary">
                                    -
                                </button>

                                <div class="col-4">
                                    <input type="text" class="form-control" name="quantity_{{ $product->id }}"
                                        id="quantity_{{ $product->id }}" aria-describedby="helpId"
                                        placeholder=" {{ $quantityOfProduct[$product->id] }}"
                                        value=" {{ $quantityOfProduct[$product->id] }}" readonly />

                                </div>
                                <button type="button" onclick="add({{ $product->id }})" class="col-4 btn btn-secondary">
                                    +
                                </button>

                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-12">
                                
                                <button class="btn btn-danger col-12" name="action" type="submit" value="removeFromCart">Eliminar del carrito</button>
                            </div>
                        </div>


                    
                    </div>
                </div>
            @endforeach
            
            <div class="row justify-content-center align-items-center g-2">
                <button class="btn btn-success mt-3 col-12" name="action" value="buy" type="submit">Comprar</button>
            </div>


        </form>

    </div>

@endsection
