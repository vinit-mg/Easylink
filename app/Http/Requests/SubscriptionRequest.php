<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id'       => 'required|exists:customers,id',
            'package_id'     => 'required|exists:packages,id',
            'billing_cycle'     => 'required|string|in:monthly,yearly',
            'start_date'     => 'required|date|before_or_equal:end_date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:active,pending,expired',
        ];
    }
}
