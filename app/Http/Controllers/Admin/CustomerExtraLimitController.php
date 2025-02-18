<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerExtraLimitsRequest;
use App\Http\Requests\SourceSettingsRequest;
use App\Models\CustomerExtraLimits;
use App\Models\Customers;
use App\Models\PackageFeatures;
use App\Models\Source;
use App\Models\SourceSettings;
use Carbon\Carbon;

class CustomerExtraLimitController extends Controller{


    public function create(Customers $customer){

        $this->authorize('adminCreate', CustomerExtraLimits::class);
        $PackageFeatures = PackageFeatures::get();
        return view('admin.CustomerExtraLimit.create', compact('customer', 'PackageFeatures'));

    }

    public function store(CustomerExtraLimitsRequest $request, Customers $customer){

        $this->authorize('adminCreate', CustomerExtraLimits::class);
        $data = $request->validated();
        $data['customer_id'] =$customer->id;
        $data['purchased_at'] = Carbon::now();
        CustomerExtraLimits::create($data);
        
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Extra limits added successfully.');

    }

    // public function show(SourceSettings $sourcesetting){

    //     $this->authorize('adminView', $sourcesetting);
    //     return view('admin.SourceSettings.show', compact('sourcesetting'));

    // }

    public function edit(Customers $customer, CustomerExtraLimits $extralimit){

        $this->authorize('adminUpdate', SourceSettings::class);
        $PackageFeatures = PackageFeatures::get();
        return view('admin.CustomerExtraLimit.edit', compact('customer', 'extralimit', 'PackageFeatures'));

    }

    public function update(CustomerExtraLimitsRequest $request, Customers $customer, CustomerExtraLimits $extralimit){

        $this->authorize('adminUpdate', SourceSettings::class);
        $data = $request->validated();
        $data['customer_id'] = $customer->id;
        $data['purchased_at'] = Carbon::now();
        // dd($data);
        $extralimit->update($data);
        return redirect()->route('admin.customers.show', $customer->uuid)
                        ->with('message', 'Extra limits updated successfully.');


    }

    public function destroy(Customers $customer, CustomerExtraLimits $extralimit){

        $this->authorize('adminDelete', SourceSettings::class);
        $extralimit->delete();
        return redirect()->route('admin.customers.show', $customer->uuid)
        ->with('message', 'Extra limits deleted successfully.');

    }
}
