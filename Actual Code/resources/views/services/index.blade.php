@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Servicios</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/services/create') }}" class="btn btn-sm btn-primary">Nuevo Servicio</a>
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
                            <th scope="col">Cups</th>
                            <th scope="col">Nombre del Servicio</th>
                            <th scope="col">Especialidades</th>
                            <th scope="col">Sedes</th>
                            <th scope="col">Opciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service as $servicio)
                        <tr>
                            <th scope="row">
                                {{ $servicio->cups }}
                            </th>
                            <td>
                                {{ $servicio->name }}
                            </td>
                            <td>
                            @foreach($servicio->specialty as $array)
                                {{ $array->name}}
                            @endforeach
                            </td>
                            <td>
                            @foreach($servicio->sedes as $array)
                                {{ $array->name}}
                            @endforeach
                            </td>
                            <td>
                                
                                <form action="{{ url('/services/'.$servicio->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE') 
                                    
                                    <a href="{{ url('/services/'.$servicio->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
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
