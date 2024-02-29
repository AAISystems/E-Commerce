@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/cProduct.js') }}"></script>
@endsection

@section('title', 'Lista de Productos')

@section('content')
<div class="container mt-5 shadow"> <!-- Añade un margen superior al contenedor del formulario y una sombra suave -->
    <h1>Creación del producto:</h1>

    <div class="row justify-content-center align-items-center g-2">
        <div class="col-12 col-md-6 col-lg-6">

            <form id="productForm" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Por favor, introduce un nombre válido.</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción del Producto</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                            <div class="invalid-feedback">Por favor, introduce una descripción válida.</div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Imágenes del Producto</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" required>
                            <div class="invalid-feedback">Por favor, selecciona al menos una imagen.</div>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            <div class="invalid-feedback">Por favor, introduce un precio válido.</div>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                            <div class="invalid-feedback">Por favor, introduce una cantidad válida de stock.</div>
                        </div>

                        <div class="mb-3">
                            <label for="categories" class="form-label">Categorías</label>
                            <select id="categories" name="categories[]" class="form-select" multiple required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Por favor, selecciona al menos una categoría.</div>
                        </div>

                        <button type="submit" class="btn btn-warning fw-light p-2 button mb-3">Crear Producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



  


    <div class="container mt-5"> <!-- Añade un margen superior al contenedor de la lista de productos -->
        <div class="row">
            @foreach ($products as $index => $product)
                <div class="col-md-4 mb-4">
                    <div class="card border rounded-4">
                        <a href="{{ route('product.show', $product->id) }}"
                            class="text-center p-3 text-decoration-none text-dark border-bottom shadow-sm mb-4 rounded-top-4">
                            <h5 class="card-title fw-light">{{ $product->name }}</h5>
                        </a>
                        @if ($product->images()->exists())
                            <!-- Imagen del producto -->
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ asset($product->images->first()->route) }}" class="card-img-top p-4 img-fluid"
                                    alt="{{ $product->name }}">
                            </a>
                        @else
                            <div class="text-center">
                                <p>No hay imagen disponible</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <!-- Descripción del producto -->
                            <p class="card-text">
                                @if ($product->categories->isNotEmpty())
                                    @switch($product->categories->first()->id)
                                        @case(1)
                                            <span
                                                class="badge text-bg-info fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break

                                        @case(2)
                                            <span
                                                class="badge text-bg-success fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break

                                        @case(3)
                                            <span
                                                class="badge text-bg-dark fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break

                                        @case(4)
                                            <span
                                                class="badge text-bg-warning fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break

                                        @case(5)
                                            <span
                                                class="badge text-bg-danger fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break

                                        @case(6)
                                            <span
                                                class="badge text-bg-secondary fw-normal">{{ $product->categories->first()->name }}</span>
                                        @break
                                    @endswitch
                                @else
                                    <span class="badge bg-danger fw-normal">Oculto (sin categoría)</span>
                                @endif
                            </p>
                            <div class="d-flex">
                                <!-- Precio del producto -->
                                @if($product->discount && $product->discount->valid)
                                <p class="fs-6  fw-light text-danger"><del>{{ $product->price }} €</del></p>
                                <p class="fs-3  fw-light ">{{ $product->price*(1-($product->discount->amount/100)) }} €</p>
                                @else
                                <p class="fs-3  fw-light">{{ $product->price }} €</p>
                                @endif                            </div>
                            <!-- Estado del producto -->
                            <p class="@if ($product->show) text-success @else text-danger @endif">
                                Este producto está @if ($product->show)
                                    activo.
                                @else
                                    oculto.
                                @endif
                            </p>
                            <div class="boton-group">
                                <a href="{{ route('product.edit', ['id' => $product->id]) }}">
                                    <button class="boton">
                                        <img src="{{ asset('img/editar.svg') }}" alt="">
                                    </button>                                </a>
                                @if ($product->show)
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}">
                                        <button class="boton">
                                            <img src="{{ asset('img/ojoOculto.svg') }}" alt="">
                                        </button>                                     </a>
                                @else
                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}">
                                        <img src="{{ asset('img/ojoMostrar.svg') }}" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if (($index + 1) % 3 == 0)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        {{ $products->links() }} <!-- Paginación -->
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
