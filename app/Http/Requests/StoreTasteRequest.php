<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreTasteRequest extends FormRequest
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
        $taste = $this->route('taste');
        if ($taste)
            // Si es un update, evito chequear contra el mismo gusto
            $myId = ','.$taste->id;
        else
            $myId = '';

        return [
            'name'  => 'required|max: 50|unique:tastes,name'.$myId,
            'color' => 'required|max: 6',
        ];
    }
}
