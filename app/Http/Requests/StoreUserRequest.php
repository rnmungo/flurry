<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        $user = $this->route('user');
        if ($user)
            // Si es un update, evito chequear contra el mismo producto
            $myId = ','.$user->id;
        else
            $myId = '';
        return [
            'name'       => 'required|max: 100|min: 5|regex:/^[a-zA-ZñÑ0-9]{5,100}$/|unique:users,name'.$myId,
            'email'      => 'required|max: 100|email',
            'password'   => 'required|max: 100',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => 'nombre de usuario',
            'email'    => 'e-mail',
            'password' => 'contraseña',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre de usuario debe tener contener hasta 100 caracteres como máximo.',
            'name.regex' => 'El nombre de usuario tiene un formato incorrecto.',
        ];
    }
}
