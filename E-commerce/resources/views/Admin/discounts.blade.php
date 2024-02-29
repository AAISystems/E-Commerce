@extends('template.template')

@section('navbar')
    @include('template.adminNavbar')
@endsection

@section('title', 'Descuentos')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4 fw-light">Descuentos</h1>
        <div class="container d-flex justify-content-center">
            <a name="" id="" class="btn btn-warning shadow-sm fw-light me-2" href="{{route('discount.simple')}}" role="button">Crear
                descuento simple</a>
            <a name="" id="" class="btn btn-warning shadow-sm fw-light me-2" href="{{route('discount.category')}}"
                role="button">Crear descuento de categoría</a>
            <a name="" id="" class="btn btn-warning shadow-sm fw-light"
                href="{{ route('discount.product') }}" role="button">Crear descuento de producto</a>
        </div>



        @if ($discounts->count() > 0)

            <div class="table-responsive">
                <table class="table table-stripped fw-light">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Porcentaje %</th>
                            <th scope="col">Válido hasta</th>
                            <th scope="col">Eliminar descuento</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                            <tr class="">
                                <td scope="row">{{ $discount->code }}</td>
                                <td>{{ $discount->amount }}</td>
                                <td>{{ $discount->validUntil }}</td>
                                <td>
                                    <a name="" id="" class="btn btn-danger" href="{{route('discount.delete',$discount->id)}}"
                                        role="button">X</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h4 class="text-start fw-light">Todavía no hay descuentos</h4>

        @endif
    </div>
@endsection

@section('footer')
    @include('template.footer')
@endsection
