<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOnFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'required|string|max:255',
            'add_on_id'       => 'required|exists:add_ons,id',
            'source_id'       => 'required|exists:source,id',
            'destination_id'  => 'required|exists:destination,id',
        ];
    }
}
