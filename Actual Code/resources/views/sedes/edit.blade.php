@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar sede</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/sedes') }}" class="btn btn-sm btn-success">
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

            <form action="{{ url('/sedes/'.$sedes->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre de la sede</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $sedes->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de la sede</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $sedes->direccion) }}" required>
                </div>

                <div class="form-group" hidden>
                    <label for="specialties">Especialidades de las sedes</label>
                    <input type="text" name="specialties" class="form-control" value="{{ old('specialties', $sedes->specialties) }}" required>
                </div>

                <button type="submit" class="btn btn-sm btn-primary ">Guardar Sede</button>
            </form>
        </div>

    </div>

@endsection
