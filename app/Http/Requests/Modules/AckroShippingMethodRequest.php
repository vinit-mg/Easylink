<?php

namespace App\Http\Requests\Modules;

use Illuminate\Foundation\Http\FormRequest;

class AckroShippingMethodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'required|string|max:255',
            'code'       => 'required|string|max:255',
            'IsActive'    => 'nullable|boolean',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'IsActive' => $this->boolean('IsActive'),
        ]);
    }
}
