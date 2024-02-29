@extends('auth.template')
@section('content')
<div class="container log">
    <div class="row justify-content-center">
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
        @endif
        <div class="col-md-8 presentation">
          
            <div class="borde border-0 text-center display-4"><h2>{{ __('Recuperar contraseña') }}</h2></div>

               
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <div class="form-group row mb-3 justify-content-center">
                           

                            <div class="col-md-6">
                                <input id="email" placeholder="Email" type="email" class="custom-input  form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="  login-button">
                                    {{ __('Enviar email') }}
                                </button>
                            </div>
                        </div>
                    </form>
              
          
        </div>
    </div>
</div>
@endsection