@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection
@section('script')
    <script defer src="{{ asset('js/orderAddress.js') }}"></script>
    <script defer src="{{ asset('js/addressForm.js') }}"></script>

@endsection

@section('title', 'Generar factura')

@section('content')
    <div class="container mt-5 min-vh-100">

        <h2 class="fw-light">Generar factura</h2>
        @error('inputNIF')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

        <form action="{{ route('invoices.update', $userOrder->id) }}" method="POST" id="addressForm">
            @csrf
            <div class="mb-3 row">
                <label for="inputNIF" class="col-4 col-form-label">Número de identificación fiscal</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputNIF" id="inputNIF" placeholder="NIF" required />
                    <input type="number" class="form-control" name="order_id" id="order_id" hidden
                        value="{{ $userOrder->id }}" />
                    
                </div>
            </div>
            <div class="row justify-content-center align-items-center gap-5">

                {{-- ENVIO --}}

                <div class="row justify-content-center align-items-top g-2">
                    <div class="col-12">

                        <div class="btn-group" role="group" aria-label="Button group name">
                           
                            <button type="button" class="btn btn-outline-warning fw-light shadow-sm" id='newAddressBtn'
                                value="false" onclick="newAddress()">
                                Insertar dirección
                            </button>

                        </div>
                    </div>
                    <div class="col-12 shadow-sm p-3" id="delivery">
                        <div id="registeredAddresses">
                          
                        </div>

                        <div id="newAddress">
                            <h4 class="fw-light mb-3 mt-3">Facturar a otra dirección</h4>
                            <div class="container">
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputCountry" class="col-4 col-form-label">País</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="country" id="inputCountry"
                                                    placeholder="País" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputProvince" class="col-4 col-form-label">Provincia</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="province"
                                                    id="inputProvince" placeholder="Provincia" required />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputCity" class="col-4 col-form-label">Ciudad</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="city" id="inputCity"
                                                    placeholder="Ciudad" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputCP" class="col-4 col-form-label">Código postal</label>
                                            <div class="col-8">
                                                <input type="number" class="form-control" name="pc" id="inputCP"
                                                    placeholder="CP" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center g-2">

                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputStreet" class="col-4 col-form-label">Calle</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="street" id="inputStreet"
                                                    placeholder="Calle" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputNumber" class="col-4 col-form-label">Número</label>
                                            <div class="col-8">
                                                <input type="number" class="form-control" name="number"
                                                    id="inputNumber" placeholder="Nº" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 row">
                                            <label for="inputFloor" class="col-4 col-form-label">Piso</label>
                                            <div class="col-8">
                                                <input type="number" class="form-control" name="floor"
                                                    id="inputFloor" placeholder="Nº de piso" />
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
                </div>


                {{-- Botones de eleccion de direcciones --}}



                <div class="mb-3 row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning p-3">
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
