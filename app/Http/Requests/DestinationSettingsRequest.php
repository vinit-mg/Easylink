<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'destination_id'       => 'required|exists:destination,id',
            'package_feature_id'       => 'required|exists:packagefeatures,id',
            'setting_name'          => 'required|string|max:255',
            'setting_key'    => 'required||string|max:255',
            'setting_description'    => '',
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
