@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Mi pedido')

@section('script')
    <script defer src="{{ asset('js/orderAddress.js') }}"></script>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection

@section('content')
    <div class="container mt-5 min-vh-100">

        <form action="@if (Auth::user()) {{ route('buy') }}@else {{ route('login') }} @endif">
            @csrf

            <h2 class="fw-light mb-5">Mi pedido</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center align-items-center gap-5">

                {{-- ENVIO --}}
                <h3 class="fw-light mb-3">Envío</h3>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-6">
                        <div class="btn-group" role="group" aria-label="Button group name">
                            @if ($userAddresses->isNotEmpty())
                                <button type="button" class="btn btn-outline-primary" id="registeredBtn" value="false"
                                    onclick="registeredAddress()">
                                    Direcciones registradas
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-primary" id='newAddressBtn' value="false"
                                onclick="newAddress()">
                                Insertar dirección
                            </button>

                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>

                {{-- Botones de eleccion de direcciones --}}

                <div class="col-12 col-md-6" id="delivery">

                    <div id="registeredAddresses">
                        @if ($userAddresses->isNotEmpty())
                            <h4 class="fw-light mb-3">Direcciones registradas</h4>
                            @foreach ($userAddresses as $address)
                                <div class="form-check">
                                    <input class="form-check-input p-2" type="radio" name="inputAddress" id="inputAddress"
                                        value="{{ $address->dataAddress }}" />
                                    <label class="form-check-label" for=""> {{ $address->dataAddress }} </label>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div id="newAddress">
                        <h4 class="fw-light mb-3 mt-3">Enviar a otra dirección</h4>
                        <div class="container">
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputCountry" class="col-4 col-form-label">País</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="country" id="inputCountry"
                                                placeholder="País" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputProvince" class="col-4 col-form-label">Provincia</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="province" id="inputProvince"
                                                placeholder="Provincia" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputCity" class="col-4 col-form-label">Ciudad</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="city" id="inputCity"
                                                placeholder="Ciudad" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputCP" class="col-4 col-form-label">Código postal</label>
                                        <div class="col-8">
                                            <input type="number" class="form-control" name="pc" id="inputCP"
                                                placeholder="CP" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputStreet" class="col-4 col-form-label">Calle</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="street" id="inputStreet"
                                                placeholder="Calle" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 row">
                                        <label for="inputNumber" class="col-4 col-form-label">Número</label>
                                        <div class="col-8">
                                            <input type="number" class="form-control" name="number" id="inputNumber"
                                                placeholder="Nº" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3 row">
                                        <label for="inputFloor" class="col-4 col-form-label">Piso</label>
                                        <div class="col-8">
                                            <input type="number" class="form-control" name="floor" id="inputFloor"
                                                placeholder="Nº de piso" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3 row">
                                        <label for="inputDoor" class="col-4 col-form-label">Puerta</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="door" id="inputDoor"
                                                placeholder="Puerta" />
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>



                </div>

                <div class="col-12 col-md-5">

                    {{-- PRODUCTOS --}}
                    <h3 class="fw-light mb-3">Productos</h3>
                    <div class="overflow-auto products p-3 shadow">
                        @foreach ($productsInCart as $product)
                            <div class="row justify-content-center align-items-center g-2 border rounded p-3 mb-3">
                                <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                    @if ($product->images()->exists())
                                        <!-- Imagen del producto -->

                                        <a href="{{ route('product.show', $product->id) }}">
                                            <img src="{{ asset($product->images->first()->route) }}"
                                                class="card-img-top p-4 img-fluid" alt="{{ $product->name }}">
                                        </a>
                                    @else
                                        <div class="text-center">
                                            <p>No hay imagen disponible</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                    {{ $product->name }}
                                </div>
                                
                                <div class="col-12 col-md-6 col-lg-1" id="showQuantity_{{ $product->id }}">
                                    {{ $quantityOfProduct[$product->id] }}
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="row justify-content-center align-items-center g-2 mb-2">
                                        <div class="input-group">
                                            <input type="text" name="idProduct_{{ $product->id }}"
                                                value={{ $product->id }} hidden>
                                            <button type="button" onclick="substract({{ $product->id }})"
                                                class="btn btn-light btn-outline-secondary rounded-start-pill">
                                                -
                                            </button>
                                            <input type="text" class="form-control"
                                                name="quantity_{{ $product->id }}" id="quantity_{{ $product->id }}"
                                                aria-describedby="helpId"
                                                placeholder=" {{ $quantityOfProduct[$product->id] }}"
                                                value=" {{ $quantityOfProduct[$product->id] }}" readonly />

                                            <button type="button" onclick="add({{ $product->id }})"
                                                class="btn btn-secondary rounded-end-pill">
                                                +
                                            </button>
                                        </div>


                                    </div>






                                </div>
                                <div class="col-12 col-md-1 col-lg-1 text-end">

                                    <a href="{{ route('removeFromCart', $product->id) }}" class="btn fw-light col-12">
                                        X</a>
                                </div>
                                <p class="text-end">{{$product->price}}€</p> 
                            </div>
                            
                        @endforeach

                    </div>



                </div>



            </div>
            <div class="row justify-content-center align-items-center g-2 mt-5 mb-3">
                <p class="text-end fw-light fs-5 p-3 border">Total: {{Auth::user()->cart->amount}}€</p>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <button class="btn btn-success mt-3 col-12" name="action" value="buy"
                    type="submit">Comprar</button>
            </div>

        </form>



    </div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
