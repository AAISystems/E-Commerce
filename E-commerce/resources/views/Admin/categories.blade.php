@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Categorías')

@section('content')
<div class="container mt-3">
    <h1 class="text-center mb-4">Creación de Categorías</h1>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="{{ route('categories.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear Categoría</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        {{-- Obtenemos la categoría creada y con el foreach vamos generando tarjetas para mostrar las categorías --}}
        @foreach ($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></h5>
                        <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">Editar Categoría</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
