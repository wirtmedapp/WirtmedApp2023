<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'tdocumento' => 'required',
            'cedula' => 'required|min:6',
            'fnacimiento' => 'nullable',
            'phone' => 'required',
            'phone2' => 'required',
            'sexo' => 'required',
            'dpto' => 'required',
            'municipio' => 'required',
            'address' => 'nullable|min:6',
        ];
        $messages = [
            'name.required' => 'El nombre del paciente es obligatorio',
            'name.min' => 'El nombre del paciente debe tener más de 3 caracteres',
            'apellido.required' => 'El apellido del paciente es obligatorio',
            'apellido.min' => 'El apellido del paciente debe tener más de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresa una dirección de correo electrónico válido',
            'tdocumento.required' => 'Tipo de documento del paciente es obligatorio',
            'cedula.required' => 'La cédula es obligatorio',
            'cedula.digits' => 'La cédula debe de tener minimo 6 dígitos',
            'fnacimiento.required' => 'La fecha de nacimiento del paciente es obligatoria',
            'phone.required' => 'El número de teléfono es obligatorio',
            'phone2.required' => 'El número de teléfono adicional es obligatorio',
            'sex.required' => 'El sexo es obligatorio',
            'dpto.required' => 'El departamento es obligatorio',
            'municipio.required' => 'El municipio es obligatorio',
            'address.min' => 'La dirección debe tener al menos 6 caracteres',
        ];
        $this->validate($request, $rules, $messages);

        User::create(
            $request->only('name','apellido','email','tdocumento','cedula','fnacimiento','phone','phone2', 'sexo','dpto','municipio','address')
            + [
                'role' => 'paciente',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'El paciente se ha registrado correctamente.';
        return redirect('/pacientes')->with(compact('notification'));
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
        $patient = User::Patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

   
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'tdocumento' => 'required',
            'fnacimiento' => 'required',
            'phone' => 'required',
            'phone2' => 'required',
            'sexo' => 'required',
            'dpto' => 'required',
            'municipio' => 'required',
            'address' => 'nullable|min:6',
        ];
        $messages = [
            'name.required' => 'El nombre del paciente es obligatorio',
            'name.min' => 'El nombre del paciente debe tener más de 3 caracteres',
            'apellido.required' => 'El apellido del paciente es obligatorio',
            'apellido.min' => 'El apellido del paciente debe tener más de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresa una dirección de correo electrónico válido',
            'tdocumento.required' => 'Tipo de documento del paciente es obligatorio',
            'fnacimiento.required' => 'La fecha de nacimiento del paciente es obligatoria',
            'phone.required' => 'El número de teléfono es obligatorio',
            'phone2.required' => 'El número de teléfono adicional es obligatorio',
            'sex.required' => 'El sexo es obligatorio',
            'dpto.required' => 'El departamento es obligatorio',
            'municipio.required' => 'El municipio es obligatorio',
            'address.min' => 'La dirección debe tener al menos 6 caracteres',
        ];
        $this->validate($request, $rules, $messages);
        $user = User::Patients()->findOrFail($id);

        $data = $request->only('name','apellido','email','tdocumento','fnacimiento','phone','phone2', 'sexo','dpto','municipio','address');
        $password = $request->input('password');

        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = 'La información del paciente se actualizo correctamente.';
        return redirect('/pacientes')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $user = User::Patients()->findOrFail($id);
        $PacienteName = $user->name;
        $user->delete();

        $notification = "El médico $PacienteName se elimino correctamente";

        return redirect('/pacientes')->with(compact('notification'));
    }
}
