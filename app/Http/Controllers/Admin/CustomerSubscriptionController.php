<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Customers;
use App\Models\CustomerSubscriptions;
use App\Models\Packages;

class CustomerSubscriptionController extends Controller{

    public function index(Customers $customer){
        
        $this->authorize('adminViewAny', CustomerSubscriptions::class);
        $CustomerSubscriptions = CustomerSubscriptions::get();
        return view('admin.CustomerSubscriptions.index', compact('CustomerSubscriptions'));

    }

    public function create(Customers $customer){

        $this->authorize('adminCreate', CustomerSubscriptions::class);
        $Customers = Customers::get();
        $Packages = Packages::get();
        return view('admin.CustomerSubscriptions.create', compact('customer', 'Packages'));

    }

    public function store(SubscriptionRequest $request, Customers $customer){

        $this->authorize('adminCreate', CustomerSubscriptions::class);
        CustomerSubscriptions::create($request->validated());
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Subscription created successfully.');

    }

    public function show(CustomerSubscriptions $customersubscription, Customers $customer){

        $this->authorize('adminView', CustomerSubscriptions::class);
        return view('admin.CustomerSubscriptions.show', compact('customersubscription'));

    }

    public function edit(Customers $customer, CustomerSubscriptions $subscription){

        $this->authorize('adminUpdate', CustomerSubscriptions::class);
        $Customers = Customers::get();
        $Packages = Packages::get();
        return view('admin.CustomerSubscriptions.edit', compact('subscription', 'customer', 'Packages'));
    }

    public function update(SubscriptionRequest $request, Customers $customer, CustomerSubscriptions $subscription){

        $this->authorize('adminUpdate', CustomerSubscriptions::class);
        $subscription->update($request->validated());
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Subscription updated successfully.');

    }

    public function destroy(Customers $customer, CustomerSubscriptions $subscription){

        $this->authorize('adminDelete', CustomerSubscriptions::class);
        $subscription->delete();
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Subscription deleted successfully.');

    }
}
