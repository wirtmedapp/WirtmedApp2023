<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo paciente</h3>
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

            <form action="{{ url('/pacientes') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nombres</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellidos</label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="tdocumento">Tipo de Documento</label>
                        <input type="text" class="form-control"  name="tdocumento" value="{{ old('tdocumento') }}" required autocomplete="t_documento" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cedula">Cédula</label>
                        <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}">
                    </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                        <label for="fnacimiento">Fecha de Nacimiento</label>
                        <input class="form-control" type="date" name="fnacimiento" value="{{ old('cedula') }}" required autocomplete="fecha" title="Fecha de nacimiento">
                  </div>
                  <div class="form-group col-md-6">
                        <label for="sexo">Sexo</label>
                        <input type="text" name="sexo" class="form-control" value="{{ old('') }}">
                  </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="aseguradora">Aseguradora</label>
                        <input type="text" name="aseguradora" class="form-control" value="{{ old('aseguradora') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Correo electrónico</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="phone">Teléfono / Móvil</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone2">Teléfono / Móvil 2</label>
                        <input type="text" name="phone2" class="form-control" value="{{ old('phone2') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="dpto">Departamento</label>
                        <input type="text" name="dpto" class="form-control" value="{{ old('departamento') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="municipio">Municipio</label>
                        <input type="text" name="municipio" class="form-control" value="{{ old('municipio') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                </div>
                

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" value="{{ old('password', Str::random(8)) }}">
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Crear paciente</button>
            </form>
        </div>

    </div>

@endsection
