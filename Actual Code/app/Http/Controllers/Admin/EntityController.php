<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Entity;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class EntityController extends Controller
{
    public function index(){
        $entity = Entity::all();
        return view('entity.index', compact('entity'));
    }

    public function create(){

        $specialties = Specialty::all();
        return view('entity.create', compact('specialties'));
    }

    public function sendData(Request $request){

        $rules = [
            'nit' => 'required',
            'name' => 'required'
        ];

        $messages = [
            'nit.required' => 'El nit de la aseguradora es obligatorio.',
            'name.required' => 'El nombre de la aseguradora es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $entity = Entity::create(
           $request->only('nit','name')
        );
        // $entity->nit = $request->input('nit');
        // $entity->specialties = implode(",",$request->input('specialties'));
        // $entity->name = $request->input('name');
        // $entity->save();
        $entity->specialties()->attach($request->input('specialties'));
        $notification = 'La aseguradora de ha creado correctamente.';

        return redirect('/entity')->with(compact('notification'));
    }

    public function edit(/* Entity $entity */$id){
        $entity = Entity::findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $entity->specialties()->pluck('specialties.id');
        return view('entity.edit', compact('entity','specialties','specialty_ids'));
    }

    public function update(Request $request, $id){

        $rules = [
            'nit' => 'required',
            'name' => 'required',
            'specialties' => 'required'    
        ];

        $messages = [
            'nit.required' => 'El nit de la aseguradora es obligatorio.',
            'nombre.required' => 'El nombre de la aseguradora es obligatorio.',
            'specialties.required' => 'Debe seleccionar mínimo una es obligatorio.',
        ];

        $this->validate($request, $rules, $messages);

        $entity = Entity::findOrFail($id);

        $data = $request->only('nit','name');
        /* $entity->nit = $request->input('nit');
        $entity->specialties = $request->input('specialties[]');
        $entity->name = $request->input('name'); */
        $entity->fill($data);
        $entity->save();
        $entity->specialties()->sync($request->input('specialties'));

        $notification = 'El Servicio se ha actualizado correctamente.';

        return redirect('/entity')->with(compact('notification'));

    }

    public function destroy(Entity $entity){
        $deleteName = $entity->name;        
        $entity->delete();

        $notification = 'La Aseguradora '. $deleteName .' se ha eliminado correctamente.';

        return redirect('/entity')->with(compact('notification'));
    }
}
