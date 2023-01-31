<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Sedes;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class SedesController extends Controller
{
    public function index(){
        $sedes = Sedes::all();
        return view('sedes.index', compact('sedes'));
    }

    public function create(){

        $specialties = Specialty::all();
        return view('sedes.create', compact('specialties'));
    }

    public function sendData(Request $request){

        $rules = [
            'name' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre de la sede es obligatorio.',
            'direccion.required' => 'La direccion de la sede es importante.',
        ];

        $this->validate($request, $rules, $messages);

        $sedes = new Sedes();
        $sedes->name = $request->input('name');
        $sedes->direccion = $request->input('direccion');
        $sedes->save();
        $notification = 'La aseguradora de ha creado correctamente.';

        return redirect('/sedes')->with(compact('notification'));
    }

    public function edit($id){
        $sedes = Sedes::findOrFail($id);
        $specialties = Specialty::all();
        return view('sedes.edit', compact('sedes','specialties'));
    }

    public function update(Request $request, $id){

        $rules = [
            'name' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre de la sede es obligatorio.',
            'direccion.required' => 'La direccion de la sede es importante.',
        ];

        $this->validate($request, $rules, $messages);

        $sedes = Sedes::findOrFail($id);

        $sedes->name = $request->input('name');
        $sedes->direccion = $request->input('direccion');
        $sedes->specialties = $request->input('specialties[]');
        $sedes->name = $request->input('name');
        $sedes->fill($data);
        $sedes->save();
        $sedes->specialties()->sync($request->input('specialties'));

        $notification = 'El Servicio se ha actualizado correctamente.';

        return redirect('/sedes')->with(compact('notification'));

    }

    public function destroy(Sedes $sedes){
        $deleteName = $sedes->name;        
        $sedes->delete();

        $notification = 'La Aseguradora '. $deleteName .' se ha eliminado correctamente.';

        return redirect('/sedes')->with(compact('notification'));
    }
}
