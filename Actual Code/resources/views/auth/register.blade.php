@extends('layouts.form')

@section('title', 'Regístrate')

@section('content')
<div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
                @if ($errors->any())
                    <div class="text-center text-muted mb-2">
                        <h4>Se encontro el siguiente error.</h4>
                    </div>

                    <div class="alert alert-danger mb-4" role="alert">
                        {{ $errors->first() }}
                    </div>
                @else
                    <div class="text-center text-muted mb-4">
                        <small>Ingresa tus datos</small>
                    </div>
                @endif

              <form role="form" method="POST" action="{{ route('register') }}" >
                  @csrf 
                <div class="row"> 
                  <div class="form-group col-md-6">
                    <label for="name">Nombres</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Nombres" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Apellidos</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Apellidos" type="text" name="apellido" value="{{ old('apellido') }}" required autofocus>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Tipo de documento</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                      </div>
                      <input class="form-control" placeholder="Tipo de Documento" type="text" name="tdocumento" value="{{ old('tdocumento') }}" required autofocus>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Numero de documento</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                      </div>
                      <input class="form-control" placeholder="Nro. documento" type="text" name="cedula" value="{{ old('cedula') }}" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Fecha de nacimiento</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                      </div>
                      <input class="form-control" placeholder="Fecha de nacimiento" type="date" name="fnacimiento" value="{{ old('fnacimiento') }}" required title="Fecha de nacimiento">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Sexo</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Sexo" type="text" name="sexo" value="{{ old('sexo') }}" required>
                    </div>
                  </div>
                </div> 

                <!-- <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Aseguradora" type="text" name="aseguradora" value="{{ old('email') }}">
                  </div>
                </div> -->

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Celular</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                      </div>
                      <input class="form-control" placeholder="Celular" type="tel" name="phone" value="{{ old('phone') }}" required>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Celular (familiar)</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                      </div>
                      <input class="form-control" placeholder="Celular (Familiar)" type="tel" name="phone2" value="{{ old('phone2') }}" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                 <label for="name">Correo electronico</label>
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Correo electronico" type="email" name="email" value="{{ old('email') }}" required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Departamento</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Departamento" type="text" name="dpto" value="{{ old('dpto') }}" required>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                  <label for="name">Municipio</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Municipio" type="text" name="municipio" value="{{ old('municipio') }}" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                <label for="name">Dirección</label>
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Dirección" type="text" name="address" value="{{ old('address') }}">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                  <label for="name">Pin (4 digitos)</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="4 ultimos digitos de la cedula" type="password" name="password" required autocomplete="new-password">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                  <label for="name">Repetir pin</label>
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Repetir pin" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Registrarse</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
