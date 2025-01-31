<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageFeaturesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'package_id'            => 'required|exists:packages,id',
            'feature_name'          => 'required|string|max:255',
            'type'                  => 'required|string|in:order,inventory,product,customer',
            'source_id'             => 'required|exists:source,id',
            'destination_id'        => 'required|exists:destination,id',
            'included_in_package'   => 'nullable|boolean', // Add this rule
            'default_limit'         => 'required|integer|min:0',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'included_in_package' => $this->boolean('included_in_package'),
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}