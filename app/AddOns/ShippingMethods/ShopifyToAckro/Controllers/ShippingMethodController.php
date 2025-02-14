<?php

namespace App\AddOns\ShippingMethods\ShopifyToAckro\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modules\AckroShippingCode;
use Illuminate\Http\Request;
use App\AddOns\ShippingMethods\ShopifyToAckro\Requests\ShippingMethodRequest;
use App\AddOns\ShippingMethods\ShopifyToAckro\Models\ShopifyAckroShippingMethodMapping;
use App\Models\AddOnFeatures;
use App\Models\Customers;
use App\Models\Stores;

class ShippingMethodController extends Controller
{
    public function execute ($customer, $store, $AddOnFeature)
    {
        $this->authorize('adminViewAny', ShopifyAckroShippingMethodMapping::class);
        $ShopifyAckroShippingMethodMappings = ShopifyAckroShippingMethodMapping::get();
        return view('AddOns.ShippingMethods.ShopifyToAckro.index', compact('customer','store', 'AddOnFeature', 'ShopifyAckroShippingMethodMappings'));
    }

    public function create (Customers $customer, Stores $store, AddOnFeatures $feature)
    {
        $this->authorize('adminCreate', ShopifyAckroShippingMethodMapping::class);
        $AckroShippingCodes = AckroShippingCode::get();
        return view('AddOns.ShippingMethods.ShopifyToAckro.create', compact('customer', 'store', 'feature', 'AckroShippingCodes'));
    }

    public function store(ShippingMethodRequest $request, Customers $customer,  Stores $store, AddOnFeatures $feature)
    {
        $this->authorize('adminCreate', ShopifyAckroShippingMethodMapping::class);
        ShopifyAckroShippingMethodMapping::create(array_merge($request->validated(), [
            'store_id' => $store->id, 
            'add_on_feature_id' => $feature->id
        ]));
        return redirect()->route('admin.customer.stores.load.addons', [$customer->uuid, $store->uuid, $feature->id])
                        ->with('message', 'Shipping method created successfully.');
    }
    public function edit(Customers $customer, Stores $store, AddOnFeatures $addonfeature, ShopifyAckroShippingMethodMapping $mapping)
    {
        $this->authorize('adminUpdate', ShopifyAckroShippingMethodMapping::class);
        $AckroShippingCodes = AckroShippingCode::get();
        return view('AddOns.ShippingMethods.ShopifyToAckro.edit', compact('customer','store', 'addonfeature', 'mapping', 'AckroShippingCodes'));
    }
    public function update(ShippingMethodRequest $request, Customers $customer, Stores $store, AddOnFeatures $addonfeature, ShopifyAckroShippingMethodMapping $mapping)
    {
        $this->authorize('adminUpdate', ShopifyAckroShippingMethodMapping::class);
        $mapping->update(array_merge($request->validated(), [
            'store_id' => $store->id, 
            'add_on_feature_id' => $addonfeature->id
        ]));
        return redirect()->route('admin.customer.stores.load.addons', [$customer->uuid, $store->uuid, $addonfeature->id])
                        ->with('message', 'Shipping method updated successfully.');
    }
    public function destroy(Customers $customer, Stores $store, AddOnFeatures $addonfeature, ShopifyAckroShippingMethodMapping $mapping)
    {
        $this->authorize('adminDelete', ShopifyAckroShippingMethodMapping::class);
        $mapping->delete();
        return redirect()->route('admin.customer.stores.load.addons', [$customer->uuid, $store->uuid, $addonfeature->id])
        ->with('message', 'Shipping method deleted successfully.');
    }
    
}
