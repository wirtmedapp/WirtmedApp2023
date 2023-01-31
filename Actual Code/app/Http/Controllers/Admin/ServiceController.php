<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Sedes;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class ServiceController extends Controller
{
    public function index(){
        $service = Service::all();
        return view('services.index', compact('service'));
    }

    public function create(){
        $specialties = Specialty::all();
        $sedes = Sedes::all();
        return view('services.create', compact('specialties','sedes'));
    }

    public function sendData(Request $request){

        $rules = [
            'cups' => 'required',
            'name' => 'required'
        ];

        $messages = [
            'cups.required' => 'El cups del servicio es obligatorio.',
            'nombre.required' => 'El nombre del servicio es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $service = Service::create(
            $request->only('cups','name')
        );
        $service->specialty()->attach($request->input('specialties'));
        $service->sedes()->attach($request->input('sedes'));
        $notification = 'El servicio de ha creado correctamente.';

        return redirect('/services')->with(compact('notification'));
    }

    public function edit($id){
        $service = Service::findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $service->specialty()->pluck('specialties.id');
        $sedes = Sedes::all();
        $sedes_ids = $service->sedes()->pluck('sedes.id');
        return view('services.edit', compact('service','specialties','specialty_ids','sedes','sedes_ids'));
    }

    public function update(Request $request, $id){

        $rules = [
            'cups' => 'required',
            'name' => 'required',
            'specialties'=> 'required',
            'sedes'=> 'required'
        ];

        $messages = [
            'cups.required' => 'El cups del servicio es obligatorio.',
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'specialties.required'=>'De seleccionar mínimo una especialidad',
            'sedes.required'=>'De seleccionar mínimo una sedes',
        ];

        $this->validate($request, $rules, $messages);
        $service = Service::findOrFail($id);
        $data = $request->only('cups', 'name');
        $service->fill($data);
        $service->save();
        $service->specialty()->sync($request->input('specialties'));
        $service->sedes()->sync($request->input('sedes'));

        $notification = 'El Servicio se ha actualizado correctamente.';

        return redirect('/services')->with(compact('notification'));

    }

    public function destroy(Service $service){
        $deleteCups = $service->cups;        
        $service->delete();

        $notification = 'El Servicio '. $deleteCups .' se ha eliminado correctamente.';

        return redirect('/services')->with(compact('notification'));
    }
}
