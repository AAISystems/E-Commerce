@extends('template.template')

@section('navbar')
    @include('template.AdminNavbar')
@endsection

@section('title', 'Editar producto')

@section('scripts')
    <script src="{{ asset('js/eProduct.js') }}"></script>
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="fw-light mb-5">Editando {{ $product->name }}</h2>
        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif

        <form action="{{ route('product.save', $product->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf

            @error('name')
                <div class="alert alert-danger"> El nombre es obligatorio </div>
            @enderror
            @error('description')
                <div class="alert alert-danger"> La descripción es obligatoria </div>
            @enderror

            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                    placeholder='{{ $product->name }}' autofocus required>
                <div class="invalid-feedback">Por favor, introduce un nombre válido.</div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripción</label>
                <input type="text" name="description" class="form-control mb-2" value="{{ $product->description }}"
                    placeholder='{{ $product->description }}' autofocus required>
                <div class="invalid-feedback">Por favor, introduce una descripción válida.</div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="text" name="price" class="form-control mb-2" value="{{ $product->price }}"
                    placeholder='{{ $product->price }}' autofocus required>
                <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control mb-2" value="{{ $product->stock }}"
                    placeholder='{{ $product->stock }}' autofocus required>
                <div class="invalid-feedback">Por favor, introduce una cantidad válida de stock.</div>
            </div>
            <div class="mb-3">
                <label for="categories" class="form-label">Categorías</label>
                <div class="row">
                    <div class="col">
                        <select id="available-categories" class="form-select" multiple>
                            @foreach ($categories as $category)
                                @unless ($product->categories->contains($category))
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endunless
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="categories[]" id="product-categories" class="form-select" multiple>
                            @foreach ($product->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" id="remove-category" class="btn btn-danger">Eliminar categoría seleccionada</button>
                </div>
            </div>
            
            
    <input type="number" name="id" value="{{ $product->id }}" hidden>
    <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
    </form>
    </div>

@endsection
