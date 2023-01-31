@extends('layouts.form')

@section('title', 'Iniciar sesión')

@section('content')
<!-- Page content -->
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-form card-body px-lg-5 py-lg-5">
                @if ($errors->any())
                    <div class="text-center text-muted mb-2">
                        <h4>Se encontro el siguiente error.</h4>
                    </div>

                    <div class="alert alert-danger mb-4" role="alert">
                        {{ $errors->first() }}
                    </div>
                @else
                    <div class="text-center text-muted mb-4">
                        <h2>Ingresa tus datos</h2>
                    </div>
                @endif

              
              <form class="form" method="POST" action="{{ route('login') }}">
                  @csrf 
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Cédula" type="text" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="current-password">
                  </div>
                  <p class="text-sugerence">Ingresa los 4 ultimos digitos de tu cedula</p>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input name="remember" class="custom-control-input" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember">
                    <span class="text-muted">Recordar usuario</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-light"><small>¿Olvidate tu contraseña?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="btn btn-primary"><small>Crear cuenta nueva</small></a>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
