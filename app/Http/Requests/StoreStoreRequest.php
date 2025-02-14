<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'source_api_url' => 'required',
            'testsource' => 'accepted',  // Validation rule for 'testsource' field
            'testdestination' => 'accepted',  // Validation rule for 'testsource' field
            'source' => 'required|integer',
            'shopifyapiversion' => 'required_if:source,1', // Conditionally required if source_id is 1 (Shopify)  
            'destination' => 'required|integer',
            'ackrocustomer' => 'required_if:destination,1', // Conditionally required if destination_id is 1 (Ackro)
            'source_auth_type' => 'required',
            'source_username' => 'required_if:source_auth_type,source_basic',
            'source_password' => 'required_if:source_auth_type,source_basic',
            'source_token' => 'required_if:source_auth_type,source_bearer',
            'source_api_key' => 'required_if:source_auth_type,source_api_key',
            'source_client_id' => 'required_if:source_auth_type,source_oauth1',
            'source_client_secret' => 'required_if:source_auth_type,source_oauth1',
            'destination_auth_type' => 'required',
            'destination_username' => 'required_if:source_auth_type,destination_basic',
            'destination_password' => 'required_if:source_auth_type,destination_basic',
            'destination_token' => 'required_if:source_auth_type,destination_bearer',
            'destination_api_key' => 'required_if:source_auth_type,destination_api_key',
            'destination_client_id' => 'required_if:source_auth_type,destination_oauth1',
            'destination_client_secret' => 'required_if:source_auth_type,destination_oauth1',
            
        ];
    }

    /*
    * Custom error messages for validation rules.
    */
    public function messages(): array
    {
        return [
            'testsource.accepted' => 'Source test is not successful!',
            'testdestination.accepted' => 'Destination test is not successful!',
            'shopifyapiversion.required_if' => 'The Shopify API version must be selected.',
            'source_username.required_if' => 'Source username is required if Authentication type is basic',
            'source_password.required_if' => 'Source password is required if Authentication type is basic',
            'source_token.required_if' => 'Source token is required if Authentication type is Bearer',
            'source_api_key.required_if' => 'Source api key is required if Authentication type is API key',
            'source_client_id.required_if' => 'Source client id is required if Authentication type is oAuth1',
            'source_client_secret.required_if' => 'Source client secret is required if Authentication type is oAuth1',
            'destination_username.required_if' => 'Destination username is required if Authentication type is basic',
            'destination_password.required_if' => 'Destination password is required if Authentication type is basic',
            'destination_token.required_if' => 'Destination token is required if Authentication type is Bearer',
            'destination_api_key.required_if' => 'Destination api key is required if Authentication type is API key',
            'destination_client_id.required_if' => 'Destination client id is required if Authentication type is oAuth1',
            'destination_client_secret.required_if' => 'Destination client secret is required if Authentication type is oAuth1',
        ];
    }
}
