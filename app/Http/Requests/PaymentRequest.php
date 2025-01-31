<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount'          => 'required|numeric|min:0',
            'payment_date'    => 'required|date',
            'payment_method'  => 'required|string|max:255',
            'payment_status'  => 'required|string|in:paid,pending,failed',
        ];
    }
}
