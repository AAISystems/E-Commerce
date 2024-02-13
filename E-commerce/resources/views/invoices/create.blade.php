@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Generar factura')

@section('script')
    <script defer src="{{ asset('js/orderAddress.js') }}"></script>

@endsection

@section('content')
    <div class="container mt-5 min-vh-100">

        <h2 class="fw-light">Generar factura</h2>

        <form action="{{ route('invoices.update',$userOrder->id ) }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="inputNIF" class="col-4 col-form-label">Número de identificación fiscal</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputNIF" id="inputNIF" placeholder="NIF" />
                    <input type="number" class="form-control" name="order_id" id="order_id" hidden value="1" />
                </div>
            </div>
            <div class="row justify-content-center align-items-center gap-5">

                {{-- ENVIO --}}
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-6">
                        <div class="btn-group" role="group" aria-label="Button group name">
                            <button type="button" class="btn btn-outline-primary" id="registeredBtn" value="false"
                                onclick="registeredAddress()">
                                Direcciones registradas
                            </button>
                            <button type="button" class="btn btn-outline-primary" id='newAddressBtn' value="false"
                                onclick="newAddress()">
                                Facturar a otra dirección
                            </button>

                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>

                {{-- Botones de eleccion de direcciones --}}

                <div class="col-12 col-md-12" id="delivery">

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

                <div class="mb-3 row">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">
                            Generar
                        </button>
                    </div>
                </div>
        </form>




    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
