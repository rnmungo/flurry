<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCadetRequest extends FormRequest
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
        $cadet = $this->route('cadet');
        if ($cadet)
            // Si es un update, evito chequear contra el mismo producto
            $myId = ','.$cadet->id;
        else
            $myId = '';

        return [
            'name' => 'required|max: 20|unique:cadets,name'.$myId
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Ese nombre ya ha sido registrado. Por favor, elija uno distinto.',
        ];
    }
}
