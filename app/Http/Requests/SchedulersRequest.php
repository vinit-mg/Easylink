<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'package_feature_id' => 'required|exists:packagefeatures,id',
            'frequency'       => 'required|string|max:255',
            'next_run'          => 'nullable|date',
            'last_run'          => 'nullable|date',
            'attemts'          => 'nullable|int',
            'IsActive'          => 'nullable|boolean',
        ];
    }
    protected function prepareForValidation()
    {
        $store = $this->route('store');
        
        $this->merge([
            'store_id' => $store ? $store->id : null, // Null if UUID is invalid
            'IsActive' => $this->boolean('IsActive'),
            'IsActive' => $this->boolean('IsActive'),
        ]);
    }
}