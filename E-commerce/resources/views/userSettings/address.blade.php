@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'AAISystems')


@section('content')
    <div class="container mt-5 vh-100">
        {{-- Si el usuario tiene direcciones se mostrarán aqui --}}
        @if ($userAddresses->isNotEmpty())
            <h1 class="fw-light mb-3">Estas son tus direcciones</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @foreach ($userAddresses as $address)
                <div class="row justify-content-center align-items-center g-2 p-4 border mt-2">
                    <div class="col-12 col-md-6">
                        <p class="col-6 text-break">{{ $address->dataAddress }}</p>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="btn-group" role="group" aria-label="Button group name">
                            <a href=""><button type="button" class="btn btn-primary rounded-0 rounded-start-2">
                                    Editar
                                </button></a>
                            <a href="{{route('user.address.delete',$address->id)}}"><button type="button" class="btn btn-danger rounded-0">
                                    Borrar
                                </button></a>
                                
                            <a href="{{route('user.address.favourite',$address->id)}}"><button type="button" class="btn @if($address->favourite) btn-warning @else btn-outline-warning @endif  rounded-0 rounded-end-2">
                                    Favorito
                                </button></a>
                        </div>
                    </div>






                </div>
            @endforeach
        @else
            <h2 class="fw-light">Todavía no hay direcciones</h2>

        @endif


        <div class="d-flex gap-2 mt-3">
            <h3 class="fw-light">Nueva dirección</h3>
            <a href="{{ route('user.address.create') }}"> <button type="button" class="btn btn-success">
                    +
                </button></a>
        </div>





    </div>

@endsection
@section('footer')
    @include('template.footer')
@endsection
