<?php

namespace App\Http\Requests;

use App\Models\Customers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddOnPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id', // Ensures valid customer ID
            'add_on_id'      => 'required|exists:add_ons,id',
            'quantity'       => 'required|integer|min:1',
            'addon_price'          => 'required|numeric|min:0',
            'total_price'          => 'required|numeric|min:0',
            'purchased_at'          => 'required|date',
        ];
    }
    protected function prepareForValidation()
    {
        
        $customer = $this->route('customer');

        $this->merge([
            'customer_id' => $customer ? $customer->id : null, // Null if UUID is invalid
        ]);
    }
}
