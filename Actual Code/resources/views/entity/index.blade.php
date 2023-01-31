@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Aseguradoras</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/entity/create') }}" class="btn btn-sm btn-primary">Nueva Aseguradora</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('notification'))
                    <div class="alert alert-success" role="alert">
                         {{ session('notification') }}
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nit</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Opciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entity as $entidad)
                        <tr>
                            <th scope="row">
                                {{ $entidad->nit }}
                            </th>
                            <td scope="row">
                                {{ $entidad->name }}
                            </td>
                            <td scope="row">
                            @foreach($entidad->specialties as $array)
                                {{ $array->name}}
                            @endforeach
                            </td>
                            <td>
                                
                                <form action="{{ url('/entity/'.$entidad->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE') 
                                    
                                    <a href="{{ url('/entity/'.$entidad->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>

                                </form>
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
@endsection
