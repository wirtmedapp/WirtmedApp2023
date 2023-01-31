@extends('layouts.panel')
@section('styles')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

@endsection
@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Sedes</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('/sedes/create') }}" class="btn btn-sm btn-primary">Nuevo Servicio</a>
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
                <table class="table align-items-center table-flush" id="tb_sedes">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre de la sede</th>
                            <th scope="col">Direccion de la sede</th>
                            <th class="col" hidden>Especialidades</th>
                            <th scope="col">Opciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sedes as $sedes)
                        <tr>
                            <th scope="row">
                                {{ $sedes->name }}
                            </th>

                            <td scope="row">
                                {{ $sedes->direccion }}
                            </td>
                    
                            <td scope="row" hidden>
                                {{$sedes-> specialties}}
                            </td>

                            <td>
                                
                                <form action="{{ url('/sedes/'.$sedes->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE') 
                                    
                                    <a href="{{ url('/sedes/'.$sedes->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
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
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#tb_sedes').DataTable();
} );
</script>
@endsection