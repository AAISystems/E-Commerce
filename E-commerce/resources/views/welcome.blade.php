@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 min-vh-100">
        <h2 class="fw-light mb-4">Súper Ventas</h2>
        <div class="row justify-content-center align-items-center g-2">

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
                                <div class="row justify-content-center align-items-center g-2">
                                    <button class="btn btn-success mt-3 col-12" type="submit">Añadir al carrito</button>
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
