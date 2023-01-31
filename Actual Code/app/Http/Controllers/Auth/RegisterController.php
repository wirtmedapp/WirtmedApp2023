<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users'],
            'tdocumento' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'min:6', 'unique:users'],
            'fnacimiento' => ['required', 'date'],
            'sexo' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'phone2' => ['required', 'string'],
            'dpto' => ['required', 'string', 'max:255'],
            'municipio' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'tdocumento' => $data['tdocumento'],
            'cedula' => $data['cedula'],
            'fnacimiento' => $data['fnacimiento'],
            'sexo' => $data['sexo'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'],
            'dpto' => $data['dpto'],
            'municipio' => $data['municipio'],
            'address' => $data['address'],
            'role' => 'paciente',
            'password' => Hash::make($data['password']),
        ]);
    }
}
