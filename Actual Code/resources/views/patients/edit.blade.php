<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar paciente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>
                        Regresar</a>
                </div>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif

            <form action="{{ url('/pacientes/'.$patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nombre del paciente</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name)}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido del paciente</label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $patient->apellido) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="tdocumento">Tipo de Documento</label>
                        <input type="text" class="form-control"  name="tdocumento" value="{{ old('tdocumento', $patient->tdocumento) }}" required autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cedula">Cédula</label>
                        <input type="text" name="cedula" class="form-control" value="{{ old('cedula', $patient->cedula) }}" disabled>
                    </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                        <label for="fnacimiento">Fecha de Nacimiento</label>
                        <input class="form-control" type="date" name="fnacimiento" value="{{ old('fnacimiento', $patient->fnacimiento) }}" required>
                  </div>
                  <div class="form-group col-md-6">
                        <label for="sexo">Sexo</label>
                        <input type="text" name="sexo" class="form-control" value="{{ old('sexo', $patient->sexo) }}">
                  </div>
                </div>

                
                    <!-- <div class="form-group col-md-6">
                        <label for="aseguradora">Aseguradora</label>
                        <input type="text" name="aseguradora" class="form-control" value="{{ old('aseguradora') }}">
                    </div> -->

                    <div class="form-group col-md-6">
                        <label for="email">Correo electrónico</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="phone">Teléfono / Móvil</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone2">Teléfono / Móvil 2</label>
                        <input type="text" name="phone2" class="form-control" value="{{ old('phone2', $patient->phone2) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="dpto">Departamento</label>
                        <input type="text" name="dpto" class="form-control" value="{{ old('dpto', $patient->dpto) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" class="form-control" value="{{ old('municipio', $patient->municipio) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" >
                    <small class="text-warning">Solo llena el campo si desea cambiar la contraseña.</small>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
            </form>
        </div>

    </div>

@endsection
