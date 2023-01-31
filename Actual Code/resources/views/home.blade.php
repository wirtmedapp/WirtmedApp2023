@extends('layouts.panel')

@section('content')

            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Mis citas</h3>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    @if(session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" 
                            href="#mis-citas" role="tab" aria-selected="true">
                            <i class="ni ni-calendar-grid-58 mr-2"></i>Mis citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" 
                            href="#citas-pendientes" role="tab" aria-selected="false">
                            <i class="ni ni-bell-55 mr-2"></i>Citas Pendientes</a>
                        </li>
              @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" 
                            href="#historial" role="tab" aria-selected="false">
                            <i class="ni ni-folder-17 mr-2"></i>Historial</a>
                        </li>
              @endif
                    </ul>
                </div>
              
@endsection