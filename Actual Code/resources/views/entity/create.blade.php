<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')
@section('styles')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection
@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva Aseguradora</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/entity') }}" class="btn btn-sm btn-success">
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

            <form action="{{ url('/entity') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nit">Nit de la aseguradora</label>
                    <input type="number" name="nit" class="form-control" value="{{ old('nit') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Nombre de la aseguradora</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="specialties">Especialidades</label>
                    <select name="specialties[]" id="specialties" class="form-control"
                    data-style="btn-primary" title="Seleccionar especialidades" multiple required>
                        @foreach ($specialties as $especialidad)
                            <option value="{{ $especialidad->id}}">{{ $especialidad->name }}</option>
                        @endforeach
                    </select>
                </div>



                <button type="submit" class="btn btn-sm btn-primary">Crear Aseguradora</button>
            </form>
        </div>

    </div>

@endsection
@section('scripts')

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(()=> {});
    $('#specialties').selectpicker('val');
</script>

@endsection