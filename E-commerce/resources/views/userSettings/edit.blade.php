@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 vh-100">
        <h2 class="fw-light">Creando una nueva dirección</h2>
        <form action="{{ route('user.address.update') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="inputCountry" class="col-4 col-form-label">País</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="country" id="inputCountry" placeholder="País" value="{{$address->country}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProvince" class="col-4 col-form-label">Provincia</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="province" id="inputProvince" placeholder="Provincia" value="{{$address->province}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCity" class="col-4 col-form-label">Ciudad</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="city" id="inputCity" placeholder="Ciudad" value="{{$address->city}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputCP" class="col-4 col-form-label">Código postal</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="pc" id="inputCP" placeholder="CP" value="{{$address->pc}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputStreet" class="col-4 col-form-label">Calle</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="street" id="inputStreet" placeholder="Calle" value="{{$address->street}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputNumber" class="col-4 col-form-label">Número</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="number" id="inputNumber" placeholder="Nº" value="{{$address->number}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputFloor" class="col-4 col-form-label">Piso</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="floor" id="inputFloor" placeholder="Nº de piso" value="{{$address->floor}}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDoor" class="col-4 col-form-label">Puerta</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="door" id="inputDoor" placeholder="Puerta" value="{{$address->door}}"/>
                </div>
            </div>
            <input type="text" class="form-control" name="id" id="inputId" placeholder="id" value="{{$address->id}}" hidden/>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </div>
        </form>




    </div>

@endsection
@section('footer')
    @include('template.footer')
@endsection
