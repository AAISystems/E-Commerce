@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 vh-100">
        {{-- Si el usuario tiene direcciones se mostrarán aqui --}}
        @if (!empty($userAddresses->items))
            <h2 class="fw-light">Estas son tus direcciones</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @foreach ($userAddresses as $address)
                <div class="row justify-content-center align-items-center g-2 p-4 border">
                    <div class="col-6">
                        <p class="col-6 text-break">{{ $address->address }}</p>

                    </div>

                    <div class="col-2"><button type="button" class="btn btn-primary">
                            Editar
                        </button></div>
                    <div class="col-2"><button type="button" class="btn btn-danger">
                            Eliminar
                        </button></div>
                    <div class="col-2"><button type="button" class="btn btn-warning">
                            Marcar como predeterminada
                        </button></div>




                </div>
            @endforeach
        @else
            <h2 class="fw-light">Todavía no hay direcciones</h2>

        @endif


        <div class="d-flex gap-2">
            <p>Nueva dirección</p>
            <a href="{{ route('user.address.create') }}"> <button type="button" class="btn btn-success">
                    +
                </button></a>
        </div>





    </div>

@endsection
@section('footer')
    @include('template.footer')
@endsection
