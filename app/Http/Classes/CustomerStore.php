<?php

namespace App\Http\Classes;

use App\Models\Customers;
use App\Models\Stores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CustomerStore {

    public $currentuser;

    public function __construct(){
      
        $this->currentuser = Auth::user();
    }

    public function setCustomerAndStoreToSession(Request $request){
        // Validate the input data (optional but recommended)
        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'store_id' => 'required|integer|exists:stores,id',
        ]);

        // Retrieve the data from the request
        $customerId = $request->input('customer_id');
        $storeId = $request->input('store_id');

        // Save data to session
        Session::put('customer_id', $customerId);
        Session::put('store_id', $storeId);

        // Optional: Return a response
        return response()->json([
            'message' => 'Customer and store IDs saved to session successfully.',
            'customer_id' => Session::get('customer_id'),
            'store_id' => Session::get('store_id'),
        ]);
    }

    public function getCurrentCustomer(){
        
        if(!empty(session('customer_id'))){
            $customer = Customers::find(session('customer_id'));
            $this->validateCustomer($customer);
        }

        if($this->currentuser->CustomerUsers->isEmpty()){
            return false;
        }

        foreach($this->currentuser->CustomerUsers as $CustomerUser){

            if($CustomerUser->customer->IsDefault){
                $this->validateCustomer($CustomerUser->customer);
                return $CustomerUser->customer;
                break;
            }
        }
    }
    public function getCurrentStore(){
        
        if(!empty(session('store_id'))){
            $store = Stores::find(session('store_id'));
            $this->validateStore($store);
        }
       
        if($this->currentuser->CustomerUsers->isEmpty()){
            return false;
        }

        foreach($this->currentuser->CustomerUsers as $CustomerUser){
            if($CustomerUser->customer->stores->isEmpty()){
                return false;
                break;
            }

            foreach($CustomerUser->customer->stores as $store){
                if($store->IsDefault){
                    $this->validateStore($store);
                    return $store;
                    break;
                }
            }
        }
    }
    protected function validateStore($store)
    {
        if (!$store->IsActive) {
            throw new \Exception("The selected store is inactive.");
        }

        if (!$store->customer || !$store->customer->IsActive) {
            throw new \Exception("The customer associated with the store is inactive.");
        }
    }
    protected function validateCustomer($customer)
    {

        if (!$customer->IsActive) {
            throw new \Exception("The customer associated with the store is inactive.");
        }
    }

    public function getTemplatePath($source, $destination, $entity, $action)
    {
        return 'integrations.'.$source.'.'.$destination.'.'.$entity.'.'.$action;
    }
}
