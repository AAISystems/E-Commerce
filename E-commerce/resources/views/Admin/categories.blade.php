@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Categorías')

@section('content')
<div class="container mt-3">
    <h1>Creación de la categoría:</h1>
    <form action="{{ route('categories.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Crear Categoría</button>
        </div>
    </form>
</div> 

<div class="row">
    {{-- Obtenemos la categoría creada y con el foreach vamos generando tarjetas para mostrar las categorías --}}
    <div class="col-md-12"> <!-- Utilizando toda la anchura de la fila -->
        <div class="ms-md-auto"> <!-- Margen izquierdo automático para mover las tarjetas hacia la izquierda -->
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4 d-inline-block"> <!-- d-inline-block para que se muestren en línea -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a></h5>
                            <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">Editar Categoría</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        {{ $categories->links() }}
    </div>
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
