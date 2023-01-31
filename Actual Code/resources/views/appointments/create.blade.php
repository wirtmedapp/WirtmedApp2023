<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Crear nueva cita</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">
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

            <form action="{{ url('/reservarcitas') }}" method="POST">
                @csrf



                <!-- <div class="form-group">
                    <label for="date" class="ml-3">Seleccionar paciente</label>
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-search"></i></span>
                            </div>
                            <input class="form-control search" id="search" name="search" placeholder="Buscar paciente"
                            type="search" value="{{old('cedula_id')}}">
                        </div>
                    </div> -->

                    <div class="form-group col-md-6">
                        <label for="Aseguradora">Aseguradora</label>
                        <select name="entidad_id" id="entidad" class="form-control" required>
                            <option value="">Seleccionar Aseguradora</option>
                            @foreach ($entity as $entidad)
                            <option value="{{$entidad->id}}" @if(old('entidad_id') == $entidad->id) selected @endif>
                                {{$entidad->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="specialty">Especialides</label>
                        <select name="specialty_id" id="specialty" class="form-control">
                            <option value="">Seleccionar Especialidad</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="doctor">Médico</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            <option value="">Seleccionar Médico</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sedes">Sedes</label>
                        <select name="sedes_id" id="sedes" class="form-control" required>
                            <option value="">Seleccionar Sede</option>
                        </select>
                    </div>


                    


                    <div class="form-group col-md-6">
                        <label for="Servicio">Servicio</label>
                        <select name="servicio_id" id="servicio" class="form-control" required>
                            <option value="">Seleccionar Servicio</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="date" class="ml-3">Fecha</label>
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" id="date" name="scheduled_date" placeholder="Escoge la fecha de tu cita"
                            type="date" value="{{old('scheduled_date'), date('Y-m-d')}}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}" 
                            data-date-end-date="+300d">
                        </div>
                    </div>

                <div class="form-group">
                    <label for="hours" class="ml-3">Hora de atención</label>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="m-3" id="titleMorning"></h4>
                                <div id="hoursMorning">
                                    @if($intervals)
                                        <h4 class="m-3">En la mañana</h4>
                                        @foreach ($intervals['morning'] as $key => $interval)
                                            <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="intervalMorning{{ $key }}" name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input">
                                            <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <mark>
                                            <small class="text-warning display-5">
                                                Selecciona un médico y una fecha, para ver las horas.
                                            </small>
                                        </mark>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="m-3" id="titleAfternoon"></h4>
                                <div id="hoursAfternoon">
                                    @if($intervals)
                                        <h4 class="m-3">En la tarde</h4>
                                        @foreach ($intervals['afternoon'] as $key => $interval)
                                            <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="intervalAfternoon{{ $key }}" name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input">
                                            <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @endif 
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="description" class="ml-3">Comentarios</label>
                    <textarea name="description" id="description" type="text" class="form-control ml-3"
                    rows="5" placeholder="Deje sus comentarios a continuación..." required></textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-primary ml-3">Generar Cita</button>
            </form>
        </div>

    </div>

@endsection

@section('scripts')

<script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>

<script src="{{ asset('/js/appointments/create.js') }}" ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    //Variables
    let id_busqueda;
    var valor;
    let select;
    let nombreselect;
    
    // Limpiar los options
    function clearoption(valor){
        switch(valor){
            case 1:
                    $('#specialty').find('option').not(':first').remove();
                    $('#doctor').find('option').not(':first').remove();
                    $('#sedes').find('option').not(':first').remove();
                    $('#servicio').find('option').not(':first').remove();
                break;
            case 2:
                    $('#doctor').find('option').not(':first').remove();
                    $('#sedes').find('option').not(':first').remove();
                    $('#servicio').find('option').not(':first').remove();
                break;
            case 3:
                    $('#sedes').find('option').not(':first').remove();
                    $('#servicio').find('option').not(':first').remove();
                break;
            case 4:
                    $('#servicio').find('option').not(':first').remove();
                break;
            default:
        }
    }

    //Limpiar select terceros al realizar cambios
    function clearoptionchange(valor){
        switch(valor){
            case 1:
                $('#doctor').find('option').not(':first').remove();
                $('#sedes').find('option').not(':first').remove();
                $('#servicio').find('option').not(':first').remove();
                break;
            case 2:
                $('#sedes').find('option').not(':first').remove();
                $('#servicio').find('option').not(':first').remove();
                break;
            case 3:
                $('#servicio').find('option').not(':first').remove();
                break;
            case 4:
                $('#servicio').find('option').not(':first').remove();
            break;
            default:
        }
    }
 
    function cargaroptions(id,valor,select,nombreselect,id_specialty){
        if(id){
            $.ajax({
                url: '/reservarcitas/create',
                method: 'POST',
                data: {
                    valor:valor,
                    id:id,
                    id_specialty:id_specialty,
                    "_token":$('input[name="_token"]').val()
                }
            }).done(function(res){
                let option;
                if(res && valor != 4){
                    option +=`<option value="">Seleccionar ${nombreselect}</option>`;
                    for(const [key, value] of Object.entries(res)){
                        option +=`<option value="${value}">${key}</option>`;
                    }
                    $(select).html(option);
                    clearoptionchange(valor);
                }
                if(valor == 4){
                    option +=`<option value="">Seleccionar ${nombreselect}</option>`;
                    res.forEach(e => {
                            option +=`<option value="${e.id}">${e.name}</option>`;
                        $(select).html(option);
                    });
                }
                if(res ==""){
                    clearoption(valor);
                }
            });
        }else clearoption(valor);
    }
    
    // Cambios  en el input de las aseguradoras
    $(document).on('change','#entidad', ()=>{
        id_busqueda = document.getElementById('entidad').value;
        valor = 1;
        select = '#specialty';
        nombreselect = 'Especialidad';
        cargaroptions(id_busqueda,valor,select,nombreselect);    
    });

    // Cambios  en el input de las especialidades
    $(document).on('change','#specialty', ()=>{
        id_busqueda = document.getElementById('specialty').value;
        valor = 2;
        select = '#doctor';
        nombreselect = 'Médico';
        cargaroptions(id_busqueda,valor,select,nombreselect);
    });

    
    $(document).on('change','#doctor', ()=>{
        id_busqueda = document.getElementById('doctor').value;
        valor = 3;
        select = '#sedes';
        nombreselect = 'Sede';
        cargaroptions(id_busqueda,valor,select,nombreselect);
    });

    $(document).on('change','#sedes', ()=>{
        id_busqueda = document.getElementById('sedes').value;
        id_specialty= document.getElementById('specialty').value;
        valor = 4;
        select = '#servicio';
        nombreselect = 'Servicio';
        cargaroptions(id_busqueda,valor,select,nombreselect,id_specialty);
    });
</script>
@endsection