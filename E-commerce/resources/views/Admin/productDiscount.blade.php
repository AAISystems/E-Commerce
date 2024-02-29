@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Descuentos - Producto')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4 fw-light">Creando un descuento de prodcuto</h1>

        {{-- Errores de validacion en servidor --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <form action="{{route('discount.save')}}" method="post" class="shadow-sm border p-3">
            @csrf

            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="inputCode" class="form-label">Código</label>
                        <input type="text" class="form-control" name="inputCode" id="inputCode" aria-describedby="helpId"
                            placeholder="" required />

                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="inputAmount" class="form-label">Porcentaje de descuento</label>
                        <input type="number" class="form-control" name="inputAmount" id="inputAmount"
                            aria-describedby="helpId" placeholder="" required />

                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="inputDate" class="form-label">Válido hasta</label>
                        <input type="date" class="form-control" name="inputDate" id="inputDate" aria-describedby="helpId"
                            placeholder="" required />

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Producto</label>
                        <select class="form-select form-select-lg" name="productToAdd" id="productToAdd" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>



            <div class="d-flex justify-content-end"><button type="submit" class="btn btn-warning fw-light shadow-sm p-2">
                    Guardar
                </button></div>





        </form>
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
