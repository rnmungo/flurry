<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
        $rules = [];
        $setting = $this->route('setting');        

        switch ($setting->name) {
            case 'refresh_time':
                $rules = ['value' => 'numeric| min: 0'];
                break;
            case 'days_back_cancelled':
                $rules = ['value' => 'numeric| min: 0'];
                break;
            case 'acceptable_delay':
                $rules = ['value' => 'numeric| min: 0'];
                break;
            case 'orders_per_page':
                $rules = ['value' => 'numeric| min: 4'];
                break;
           
            default:
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'value.numeric' => 'Ingrese un número.',
            'value.min'     => 'Ingrese un número mayor o igual a :min.',
        ];
    }
}
