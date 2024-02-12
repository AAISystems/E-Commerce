@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Editar datos')


@section('content')
<div class="container mt-5">
        <h2 class="fw-light mb-5">Editando perfil de: {{ $user->name }}</h2>
        
        <form action="{{ route('user.update', $user->id) }}" method="POST">

            @csrf
            {{-- Cláusula para obtener un token de formulario al enviarlo --}}
            @error('name')
                <div class="alert alert-danger"> El nombre es obligatorio </div>
            @enderror
            @error('description')
                <div class="alert alert-danger"> La descripción es obligatoria </div>
            @enderror

            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control mb-2" value="{{ $user->name }}"
                placeholder='{{ $user->name }}' autofocus>
                
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" class="form-control mb-2" value="{{ $user->email }}"
                placeholder='{{ $user->email }}' autofocus>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Telefono</label>
                <input type="number" name="phone" class="form-control mb-2" value="@if($user->phone){{ $user->phone }}@endif"
                placeholder='{{ $user->telefono }}' autofocus>
                
            </div>
          
            <input type="number" name="id" value="{{ $user->id }}" hidden>
            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
        </form>
    </div>
@endsection




@section('footer')
    @include('template.footer')
@endsection
