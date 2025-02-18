<?php

namespace App\AddOns\ShippingMethods\ShopifyToAckro\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shopify_shipping_method_name'       => 'required|string|max:255',
            'ackro_shippping_code_id'  =>  'required|exists:ackro_shipping_code,id',
            'drop_point'  => 'required|string|in:not_applicable,dynamic',
            'IsActive'   => 'nullable|boolean', // Add this rule
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'IsActive' => $this->boolean('IsActive'),
        ]);
    }
}
