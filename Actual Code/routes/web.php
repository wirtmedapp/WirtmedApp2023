<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'id_role:admin'])->group(function () {

    //Rutas Especialidades admin
    Route::get('/especialidades', [App\Http\Controllers\Admin\SpecialtyController::class, 'index']);
    Route::get('/especialidades/create', [App\Http\Controllers\Admin\SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [App\Http\Controllers\Admin\SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [App\Http\Controllers\Admin\SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [App\Http\Controllers\Admin\SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [App\Http\Controllers\Admin\SpecialtyController::class, 'destroy']);


    //Rutas Médicos
    Route::resource('medicos', 'App\Http\Controllers\Admin\DoctorController');

    //Rutas Asesores
    Route::resource('asesor', 'App\Http\Controllers\Admin\AsesorController');

    //Rutas Pacientes
    Route::resource('pacientes', 'App\Http\Controllers\Admin\PatientController');

    //Rutas Reportes
    Route::get('/reportes/citas/line', [App\Http\Controllers\Admin\ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [App\Http\Controllers\Admin\ChartController::class, 'doctors']);

    Route::get('/reportes/doctors/column/data', [App\Http\Controllers\Admin\ChartController::class, 'doctorsJson']);
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [App\Http\Controllers\Doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\Doctor\HorarioController::class, 'store']);

});

Route::middleware('auth')->group(function(){
   
    Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create']);
    Route::post('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'autocompleteform']);
    Route::post('/reservarcitas', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::get('/miscitas/{appointment}', [App\Http\Controllers\AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel']);
    Route::post('/miscitas/{appointment}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm']);

    Route::get('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'formCancel']);
    
    //JSON
    Route::get('/especialidades/{specialty}/medicos', [App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']);
});

Route::middleware(['auth', 'admin'])->group(function () {
//Rutas servicios
Route::get('/services', [App\Http\Controllers\Admin\ServiceController::class, 'index']);
Route::get('/services/create', [App\Http\Controllers\Admin\ServiceController::class, 'create']);
Route::get('/services/{service}/edit', [App\Http\Controllers\Admin\ServiceController::class, 'edit']);
Route::post('/services', [App\Http\Controllers\Admin\ServiceController::class, 'sendData']);
Route::put('/services/{service}', [App\Http\Controllers\Admin\ServiceController::class, 'update']);
Route::delete('/services/{service}', [App\Http\Controllers\Admin\ServiceController::class, 'destroy']);
 
});


Route::middleware(['auth', 'admin'])->group(function () {
    //Rutas sedes
    Route::get('/sedes', [App\Http\Controllers\Admin\SedesController::class, 'index']);
    Route::get('/sedes/create', [App\Http\Controllers\Admin\SedesController::class, 'create']);
    Route::get('/sedes/{sedes}/edit', [App\Http\Controllers\Admin\SedesController::class, 'edit']);
    Route::post('/sedes', [App\Http\Controllers\Admin\SedesController::class, 'sendData']);
    Route::put('/sedes/{sedes}', [App\Http\Controllers\Admin\SedesController::class, 'update']);
    Route::delete('/sedes/{sedes}', [App\Http\Controllers\Admin\SedesController::class, 'destroy']);
    
    }); 


Route::middleware(['auth', 'admin'])->group(function () {
    //Rutas Aseguradoras
    
    Route::get('/entity', [App\Http\Controllers\Admin\EntityController::class, 'index']);
    Route::get('/entity/create', [App\Http\Controllers\Admin\EntityController::class, 'create']);
    Route::get('/entity/{entity}/edit', [App\Http\Controllers\Admin\EntityController::class, 'edit']);
    Route::post('/entity', [App\Http\Controllers\Admin\EntityController::class, 'sendData']);
    Route::put('/entity/{entity}', [App\Http\Controllers\Admin\EntityController::class, 'update']);
    Route::delete('/entity/{entity}', [App\Http\Controllers\Admin\EntityController::class, 'destroy']);
    
});



