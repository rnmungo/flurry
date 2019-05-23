<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreCustomerRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'name'                => 'nombre',
            'lastname'            => 'apellido',
            'area_code_phone_id'  => 'código de área',
            'phone'               => 'teléfono',
            'area_code_mobile_id' => 'código de área',
            'mobile'              => 'celular',
            'email'               => 'e-mail',
            'street'              => 'calle',
            'street_number'       => 'número de calle',
            'locality_id'         => 'localidad',
            'between_street_one'  => 'entre calle',
            'between_street_two'  => 'entre calle',
            'latitude'            => 'latitud',
            'longitude'           => 'longitud'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $phone = $this['phone'];
        $mobile = $this['mobile'];
        $rules = [
            'name'               => 'required|regex:/^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+)*$/|max: 40|min: 2',
            'lastname'           => 'required|regex:/^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+)*$/|max: 40|min: 2',
            'email'              => 'nullable|email|max: 60',
            'street'             => 'required|regex:/^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+)*$/|max: 100',
            'street_number'      => 'required|regex:/^([0-9]){1,5}?$/',
            'locality_id'        => 'required',
            'between_street_one' => 'nullable|regex:/^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+)*$/|max: 100',
            'between_street_two' => 'nullable|regex:/^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9.]+)*$/|max: 100',
            'latitude'           => 'nullable',
            'longitude'          => 'nullable'
        ];
        if (!$phone && !$mobile) {
            $rules += array('mobile' => 'required|regex:/^([0-9]){6,8}?$/');
        }
        else if (!$phone && $mobile) {
            $rules += array('mobile' => 'regex:/^([0-9]){6,8}?$/');
        }
        else if (!$mobile && $phone) {
            $rules += array('phone' => 'regex:/^([0-9]){6,8}?$/');
        }
        else if ($mobile && $phone) {
            $rules += array('phone' => 'regex:/^([0-9]){6,8}?$/', 'mobile' => 'regex:/^([0-9]){6,8}?$/');
        }
        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }
}
