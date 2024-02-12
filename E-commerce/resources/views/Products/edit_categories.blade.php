@extends('template.template')

@section('navbar')
    @include('template.AdminNavbar')
@endsection

@section('title', 'Editar Categoría')
@section('content')
    <div class="container mt-5">
        <h2 class="fw-light mb-5">Editando {{ $category->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        
        <form action="{{ route('category.save', $category->id) }}" method="POST">

            @csrf
            {{-- Cláusula para obtener un token de formulario al enviarlo --}}
            @error('name')
                <div class="alert alert-danger"> El nombre es obligatorio </div>
            @enderror
            

            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control mb-2" value="{{ $category->title }}"
                placeholder='{{ $category->name }}' autofocus>
                
            </div>
            
            <input type="number" name="id" value="{{ $category->id }}" hidden>
            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
        </form>
    </div>

@endsection
