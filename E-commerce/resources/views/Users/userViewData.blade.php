@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Perfil')


@section('content')
<div class="container mt-5">
    <h2 class="fw-light mb-5">Tu perfil: {{ $user->name }}</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="fw-bold">Nombre completo:</p>
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="fw-bold">Email:</p>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <p class="fw-bold">Teléfono:</p>
                <p>{{ $user->phone ?: 'No disponible' }}</p>
            </div>
         
       

            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Editar perfil</a>
        </div>
    </div>
</div>
@endsection













@section('footer')
    @include('template.footer')
@endsection