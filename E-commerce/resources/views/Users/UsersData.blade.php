@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Editar datos')


@section('content')
<div class="container mt-3">
    <h1>Edita tus datos</h1>
    <form action="{{ route('product.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Email</label>
            <input class="form-control" type="mail" id="email" name="email" >
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Fecha nacimiento</label>
            <input type="date" class="form-control" id="fechaNac" name="fechaNac" >
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="telefono" name="telefono">
        </div>
     
        

        <button type="submit" class="btn btn-primary">Modificar datos</button>
    </form>
</div>
@endsection




@section('footer')
    @include('template.footer')
@endsection
