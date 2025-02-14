<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOnPurchaseRequest;
use App\Models\AddOnPurchase;
use App\Models\AddOns;
use App\Models\Customers;
use App\Models\CustomerSubscriptions;

class AddOnPurchaseController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', AddOnPurchase::class);
        $addOnPurchases = AddOnPurchase::get();
       
        return view('admin.AddOnPurchase.index', compact('addOnPurchases'));

    }

    public function create(Customers $customer){

        $this->authorize('adminCreate', AddOnPurchase::class);
        $CustomerSubscriptions = CustomerSubscriptions::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnPurchase.create', compact('CustomerSubscriptions', 'AddOns', 'customer'));

    }


    public function store(AddOnPurchaseRequest $request, Customers $customer){

        $this->authorize('adminCreate', AddOnPurchase::class);
        AddOnPurchase::create($request->validated());
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'AddOnPurchase created successfully.');

    }

    public function show(Customers $customer, AddOnPurchase $addonpurchase){

        $this->authorize('adminView', AddOnPurchase::class);
        return view('admin.AddOnPurchase.show', compact('addonpurchase', 'customer'));

    }

    public function edit(Customers $customer, AddOnPurchase $addonpurchase){

        $this->authorize('adminUpdate', AddOnPurchase::class);
        $CustomerSubscriptions = CustomerSubscriptions::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnPurchase.edit', compact('addonpurchase', 'CustomerSubscriptions', 'AddOns', 'customer'));

    }

    public function update(AddOnPurchaseRequest $request, Customers $customer, AddOnPurchase $addonpurchase){

        $this->authorize('adminUpdate', AddOnPurchase::class);
        $addonpurchase->update($request->validated());
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'AddOnPurchase updated successfully.');

    }

    public function destroy(Customers $customer, AddOnPurchase $addonpurchase){

        $this->authorize('adminDelete', AddOnPurchase::class);
        $addonpurchase->delete();
        return redirect()->route('admin.customers.show', $customer->uuid)
        ->with('message', 'AddOnPurchase deleted successfully.');

    }
}
