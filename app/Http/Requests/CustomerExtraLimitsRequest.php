<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerExtraLimitsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'package_feature_id' => 'required|exists:packagefeatures,id',
            'additional_limit'       => 'required|integer|min:1',
            'price'          => 'required|numeric|min:0',
        ];
    }
}
