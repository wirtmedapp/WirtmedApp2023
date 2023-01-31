<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Sedes;
use App\Http\Requests\SaveUsersRequest;
class DoctorController extends Controller
{
    
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        $specialties = Specialty::all();
        return view('doctors.index', compact('doctors'));
    }

    
    public function create()
    {
        $specialties = Specialty::all();
        $sedes = Sedes::all();
        return view('doctors.create', compact('specialties','sedes'));
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|min:6',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del médico es obligatorio',
            'name.min' => 'El nombre del médico debe tener más de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresa una dirección de correo electrónico válido',
            'cedula.required' => 'La cédula es obligatorio',
            'cedula.digits' => 'La cédula debe de tener 10 dígitos',
            'address.min' => 'La dirección debe tener al menos 6 caracteres',
            'phone.required' => 'El número de teléfono es obligatorio',
        ];
        $this->validate($request, $rules, $messages);

        $user = User::create(
            $request->only('name','email','cedula','address','phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $user->specialties()->attach($request->input('specialties'));

        $notification = 'El médico se ha registrado correctamente.';
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');

        $sedes = Sedes::all();
        $sedes_ids = $doctor->sedes()->pluck('sedes.id');

        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids', 'sedes', 'sedes_ids'));
    }

    
    public function update(Request $request, $id)
    {
        
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del médico es obligatorio',
            'name.min' => 'El nombre del médico debe tener más de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresa una dirección de correo electrónico válido',
            'email.unique' => 'Esta dirección de correo electrónico se encuentra registrado',
            'address.min' => 'La dirección debe tener al menos 6 caracteres',
            'phone.required' => 'El número de teléfono es obligatorio',
        ];
        
        try {
            $this->validate($request, $rules, $messages);
            $user = User::doctors()->findOrFail($id);
            
            $data = $request->only('name','email','address','phone');
            $password = $request->input('password');

            if($password)
                $data['password'] = bcrypt($password);

            $user->fill($data);
            $user->save();
            $user->specialties()->sync($request->input('specialties'));
            $user->sedes()->sync($request->input('sedes'));

            $notification = 'La información del médico se actualizo correctamente.';
            return redirect('/medicos')->with(compact('notification'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Hubo un erro al momento de actulizar');
        }
        
    }

    
    public function destroy($id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;
        $user->delete();

        $notification = "El médico $doctorName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
