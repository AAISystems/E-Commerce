@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Categorías')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/categorystyle.css') }}">
@endsection


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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            {{-- Obtenemos la categoría creada y con el foreach vamos generando tarjetas para mostrar las categorías --}}
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a
                                    href="{{ route('category.products', ['category' => $category->id]) }}">{{ $category->name }}</a>
                            </h5>
                            <h6>
                                @if ($category->show)
                                    Categoría activa
                                @else
                                    Categoría oculta
                                @endif
                            </h6>
                            <div class="d-flex justify-content-between">
                                @if ($category->show)
                                    <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger me-2">Eliminar</button>
                                    </form>
                                @else
                                    <form action="{{ route('category.activate', $category->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success me-2">Activar</button>
                                    </form>
                                @endif
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                    class="btn btn-sm btn-warning">Editar Categoría</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection






@section('footer')
    @include('template.footer')
@endsection
