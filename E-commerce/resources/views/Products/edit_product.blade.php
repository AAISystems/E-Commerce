@extends('template.template')

@section('navbar')
    @include('template.AdminNavbar')
@endsection

@section('title', 'Editar producto')
@section('content')
    <div class="container mt-5">
        <h2 class="fw-light mb-5">Editando {{ $product->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        
        <form action="{{ route('product.save', $product->id) }}" method="POST">

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
                <input type="text" name="name" class="form-control mb-2" value="{{ $product->title }}"
                placeholder='{{ $product->name }}' autofocus>
                
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripción</label>
                <input type="text" name="description" class="form-control mb-2" value="{{ $product->title }}"
                placeholder='{{ $product->description }}' autofocus>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="text" name="price" class="form-control mb-2" value="{{ $product->title }}"
                placeholder='{{ $product->price }}' autofocus>
                
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control mb-2" value="{{ $product->title }}"
                placeholder='{{ $product->stock }}' autofocus>
                
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoría</label>
                <select name="category" id="category" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <input type="number" name="id" value="{{ $product->id }}" hidden>
            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
        </form>
    </div>

@endsection
