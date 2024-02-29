@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

<script src="{{ asset('js/cCategory.js') }}"></script>

@section('title', 'Categorías')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/categorystyle.css') }}">
@endsection

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4">Creación de Categorías</h1>
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="{{ route('categories.update') }}" method="POST" id="categoryForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la categoría</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div id="nombreErrorCategory" class="text-danger" style="display: none;">El nombre es obligatorio</div>
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

        {{-- Mostrar todas las categorías en dos columnas --}}
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="{{ route('category.products', ['category' => $category->id]) }}">{{ $category->name }}</a></h5>
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
                                        <button type="submit" class="btn btn-sm btn-danger me-2">                                        <img src="{{ asset('img/ojoMostrar.svg') }}" alt="">
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('category.activate', $category->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success me-2">                                            <img src="{{ asset('img/ojoOculto.svg') }}" alt="">
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-warning me-2">
                                    <i class="bi bi-pencil"></i>         <img src="{{ asset('img/editar.svg') }}" alt="Editar Producto">

                                </a>
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
