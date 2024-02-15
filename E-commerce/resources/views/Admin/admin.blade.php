@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title','Administrador')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">

        <!-- Carta de Productos -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/product-image.jpg" class="card-img-top" alt="Productos">
                <div class="card-body text-center">
                    <a href="{{route('admin.listp')}}" class="boton">Ver Productos</a>
                </div>
            </div>
        </div>

        <!-- Carta de Categorías -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/category-image.jpg" class="card-img-top" alt="Categorías">
                <div class="card-body text-center">
                    <a href="{{route('category.show')}}" class="boton">Ver Categorías</a>
                </div>
            </div>
        </div>

        <!-- Carta de Usuarios -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="path/to/user-image.jpg" class="card-img-top" alt="Usuarios">
                <div class="card-body text-center">
                    <a href="#" class="boton">Ver Usuarios</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
