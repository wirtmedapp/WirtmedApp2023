<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Sedes;
use App\Http\Requests\SaveUsersRequest;
class AsesorController extends Controller
{
    
    public function index()
    {
        $asesor = User::asesor()->paginate(10);
        return view('asesor.index', compact('asesor'));
    }

    
    public function create()
    {
        $sedes = Sedes::all();
        return view('asesor.create', compact('sedes'));
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
                'role' => 'asesor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El asesor se ha registrado correctamente.';
        return redirect('/asesor')->with(compact('notification'));
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
        $asesor = User::asesor()->findOrFail($id);

        $sedes = Sedes::all();
        $sedes_ids = $asesor->sedes()->pluck('sedes.id');

        return view('asesor.edit', compact('asesor',  'sedes', 'sedes_ids'));
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
            $user = User::asesor()->findOrFail($id);
            
            $data = $request->only('name','email','address','phone');
            $password = $request->input('password');

            if($password)
                $data['password'] = bcrypt($password);

            $user->fill($data);
            $user->save();
            $user->sedes()->sync($request->input('sedes'));

            $notification = 'La información del asesor se actualizo correctamente.';
            return redirect('/asesor')->with(compact('notification'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Hubo un error al momento de actulizar');
        }
        
    }

    
    public function destroy($id)
    {
        $user = User::asesor()->findOrFail($id);
        $asesorName = $user->name;
        $user->delete();

        $notification = "El asesor $asesorName se elimino correctamente";

        return redirect('/asesor')->with(compact('notification'));
    }
}