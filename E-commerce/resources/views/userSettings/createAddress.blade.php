@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 vh-100">
        <h2 class="fw-light">Creando una nueva dirección</h2>
        <form action="{{route('user.address.save')}}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="inputCountry" class="col-4 col-form-label">País</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputCountry" id="inputCountry" placeholder="País" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProvince" class="col-4 col-form-label">Provincia</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputProvince" id="inputProvince" placeholder="Provincia" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCity" class="col-4 col-form-label">Ciudad</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputCity" id="inputCity" placeholder="Ciudad" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCP" class="col-4 col-form-label">Código postal</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="inputCP" id="inputCP" placeholder="CP" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputStreet" class="col-4 col-form-label">Calle</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputStreet" id="inputStreet" placeholder="Calle" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputNumber" class="col-4 col-form-label">Número</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="inputNumber" id="inputNumber" placeholder="Nº" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputFloor" class="col-4 col-form-label">Piso</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="inputFloor" id="inputFloor" placeholder="Nº de piso" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDoor" class="col-4 col-form-label">Puerta</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="inputDoor" id="inputDoor" placeholder="Puerta" />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>
                </div>
            </div>
        </form>




    </div>

@endsection
@section('footer')
    @include('template.footer')
@endsection