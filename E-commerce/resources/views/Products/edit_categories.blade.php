@extends('template.template')

@section('navbar')
    @include('template.AdminNavbar')
@endsection

<script src="{{ asset('js/eCategory.js') }}"></script>


@section('title', 'Editar Categoría')

@section('content')
    <div class="container mt-5">
        <h2 class="fw-light mb-5">Editando {{ $category->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        
        <form action="{{ route('category.save', $category->id) }}" method="POST" id="categoryForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control mb-2" value="{{ $category->title }}" placeholder="{{ $category->name }}" autofocus>
                <div id="nameError" class="text-danger" style="display: none;">El nombre es obligatorio.</div>
            </div>

            <input type="number" name="id" value="{{ $category->id }}" hidden>
            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
        </form>
    </div>

@endsection

@section('footer')
    @include('template.footer')
@endsection