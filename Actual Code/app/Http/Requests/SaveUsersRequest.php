<?php

namespace App\Http\Requests;

use Illuminate\validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveUsersRequest extends FormRequest
{
    /**
     *Determine if the user is authorized to make this request.
     * 
     * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request. 
     * 
     * @return array
    */ 
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'unique:users,email|required|email',
            'cedula' => 'unique:users,cedula|required|digits:6',
            'address' => 'nullable|min:6',
            'phone' => 'required',
            Rule::unique('users')->ignore('id')
        ];
    }
}