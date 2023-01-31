@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Médicos</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/medicos/create') }}" class="btn btn-sm btn-primary">Nuevo médico</a>
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Sedes</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Opciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>         
                        @foreach($doctors as $doctor)
                        <tr>
                            <th scope="row">
                                {{ $doctor->name }}
                            </th>
                            <td>
                            @foreach($doctor->sedes as $array)
                                {{$array->name}}
                            @endforeach
                            </td>
                            <td>
                                {{ $doctor->cedula }}
                            </td>
                            
                            <td>
                            @foreach($doctor->specialties as $array)
                                {{$array->name}}
                            @endforeach
                            </td>
                            <td>
                                
                                <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE') 
                                    
                                    <a href="{{ url('/medicos/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>

                                </form>
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                {{ $doctors->links() }}
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
