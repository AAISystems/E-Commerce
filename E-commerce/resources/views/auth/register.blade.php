@extends('auth.template')
@section('content')
<div class="container log">
    <div class="row justify-content-center">
        <div class="col-md-8 presentation">
           
                <div class="borde border-0 text-center display-4"><h2>{{ __('Regístrate en AAI') }}</h2></div>
                <div class="img-fluid  space "><img   src="{{ asset('img/lavandaResize.png') }}" alt="Foto del logo AAI Systems" height="100" ></div>
             
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-3 justify-content-center">
                           

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Nombre y apellidos" class="custom-input   form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3 justify-content-center">
                          

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email"  class="custom-input   form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3 justify-content-center">
                           

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Contraseña" class="custom-input  form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3  justify-content-center">
                           

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Repetir contraseña" class="custom-input   form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="  login-button">
                                    {{ __('Registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
              
            
        </div>
    </div>
</div>
@endsection