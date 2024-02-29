@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Administrador')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">

            <h1>Panel de Administrador</h1>

            <!-- Carta de Productos -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="text-center">
                        <img src="{{ asset('img/product-o-svgrepo-com.svg') }}" class="w-25 card-img-top" alt="Productos">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('admin.listp') }}" class="boton">Ver Productos</a>
                    </div>
                </div>
            </div>

            <!-- Carta de Categorías -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="text-center">

                        <img src="{{ asset('img/category-svgrepo-com.svg') }}" class="w-25 card-img-top" alt="Categorías">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('category.show') }}" class="boton">Ver Categorías</a>
                    </div>
                </div>
            </div>

            <!-- Carta de Usuarios -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="text-center">

                        <img src="{{ asset('img/discount-label-svgrepo-com.svg') }}" class="w-25 card-img-top"
                            alt="Descuentos">
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ route('admin.discounts') }}" class="boton">Ver descuentos</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('footer')
    @include('template.footer')
@endsection
