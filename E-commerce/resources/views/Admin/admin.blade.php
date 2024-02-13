@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">

        <!-- Carta de Productos -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/product-image.jpg" class="card-img-top text-center" alt="Productos">
                <div class="card-body text-center">
                    <a href="{{route('admin.listp')}}" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
        </div>

        <!-- Carta de Categorías -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/category-image.jpg" class="card-img-top text-center" alt="Categorías">
                <div class="card-body text-center">
                    <a href="{{route('category.show')}}" class="btn btn-primary">Ver Categorías</a>
                </div>
            </div>
        </div>

        <!-- Carta de Usuarios -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/user-image.jpg" class="card-img-top text-center" alt="Usuarios">
                <div class="card-body text-center">
                    <a href="#" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
