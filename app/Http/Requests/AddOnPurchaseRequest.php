<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOnPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_subscription_id' => 'required|exists:customer_subscriptions,id',
            'add_on_id'      => 'required|exists:add_ons,id',
            'quantity'       => 'required|integer|min:1',
            'addon_price'          => 'required|numeric|min:0',
            'total_price'          => 'required|numeric|min:0',
            'purchased_at'          => 'required|date',
        ];
    }
}
