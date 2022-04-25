<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|regex:/^([A-z0-9\s\.]*)$/',
            'description' => 'required|regex:/^([A-z0-9\s\.]*)$/',
            'subcategory_id' => 'required|numeric',
            'price' => 'required|numeric|between:0,99999.99',
            'thumbnail' => 'required|regex:/^([A-z0-9\s\.]*)$/',
        ];
    }
}
