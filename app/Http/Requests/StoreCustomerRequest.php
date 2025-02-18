<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'CompanyName' => ['required', 'max:255'],
            'Address' => ['required', 'max:255'],
            'ZipCode' => ['required', 'max:255'],
            'Country' => ['required', 'max:255'],
            'CVR_no' => ['required', 'max:255'],
            'Dealer' => ['required', 'max:255'],
        ];
    }
}