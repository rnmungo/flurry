<?php

namespace Flurry\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $product = $this->route('product');
        if ($product)
            // Si es un update, evito chequear contra el mismo producto
            $myId = ','.$product->id;
        else
            $myId = '';

        return [
            'name'       => 'required|max: 50|unique:products,name'.$myId,
            'alias'      => 'nullable|max: 10',
            'max_tastes' => 'required_if:hasTastes,1|numeric|max:5',
            'weight'     => 'nullable|integer|min: 0',
            'price'      => 'numeric|min:0',
            'picture'    => 'nullable|image',
        ];
    }

    public function attributes()
    {
        return [
            'picture' => 'imagen del producto',
            'weight'  => 'peso del producto',
        ];
    }

    public function messages()
    {
        return [
            'price.numeric' => 'El precio debe ser un número.',
            'price.min'     => 'El precio debe ser mayor a 0.',
        ];
    }
}
