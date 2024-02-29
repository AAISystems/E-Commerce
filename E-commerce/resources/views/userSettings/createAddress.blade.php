@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection
@section('script')
<script defer src="{{asset('js/addressForm.js')}}"></script>
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 vh-100">
        <h2 class="fw-light">Creando una nueva dirección</h2>
        <form action="{{ route('user.address.save') }}" method="POST" class="p-3 shadow rounded mt-5" id="addressForm">
            @csrf
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputCountry" class="col-4 col-form-label">País</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="country" id="inputCountry" placeholder="País" required />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputProvince" class="col-4 col-form-label">Provincia</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="province" id="inputProvince" placeholder="Provincia" required />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputCity" class="col-4 col-form-label">Ciudad</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="city" id="inputCity" placeholder="Ciudad" required/>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputCP" class="col-4 col-form-label">Código postal</label>
                        <div class="col-8">
                            <input type="number" class="form-control" name="pc" id="inputCP" placeholder="CP" required/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputStreet" class="col-4 col-form-label">Calle</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="street" id="inputStreet" placeholder="Calle" required/>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputNumber" class="col-4 col-form-label">Número</label>
                        <div class="col-8">
                            <input type="number" class="form-control" name="number" id="inputNumber" placeholder="Nº" required />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputFloor" class="col-4 col-form-label">Piso</label>
                        <div class="col-8">
                            <input type="number" class="form-control" name="floor" id="inputFloor" placeholder="Nº de piso" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="mb-3 row">
                        <label for="inputDoor" class="col-4 col-form-label">Puerta</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="door" id="inputDoor" placeholder="Puerta" />
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>
            </div>            
        </form>




    </div>

@endsection
@section('footer')
    @include('template.footer')
@endsection
