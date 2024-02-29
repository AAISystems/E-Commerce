@extends('template.template')

@section('navbar')
    @include('template.navbar')
@endsection

@section('title', 'Perfil')


@section('content')
<div class="container mt-5">
    <h2 class="fw-light mb-5">Tu perfil: {{ $user->name }}</h2>

    <div class="card border rounded-4 shadow">
        <div class="card-body ">
            <div class="row d-flex mt-5">
                <div class="col-md-4 ">
                    <div class="mb-3">
                        <div class="d-flex justify-content-center"><img src="{{asset('img/profile-svgrepo-com.svg')}}" alt="icono perfil" class="mb-3 "></div>
                        <p class="text-center">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                       <div class="d-flex justify-content-center"> <img src="{{asset('img/email-svgrepo-com.svg')}}" alt="icono perfil" class="mb-3"></div>
                        <p class="text-center">{{ $user->email }}</p>
                    </div>
                </div>
            

            <div class="col-md-4">
               <div class="d-flex justify-content-center"> <img src="{{asset('img/phone-svgrepo-com.svg')}}" alt="icono perfil" class="mb-3 "></div>
                <p class="text-center">{{ $user->phone ?: 'No disponible' }}</p>
            </div>
         </div>
       

           <div class="d-flex  mt-5 justify-content-center"> <a href="{{ route('user.edit', $user->id) }}" class="btn  btn-primary">Editar perfil</a></div>
        </div>
    </div>
</div>
@endsection













@section('footer')
    @include('template.footer')
@endsection