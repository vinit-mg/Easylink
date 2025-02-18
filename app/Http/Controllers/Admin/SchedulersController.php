<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchedulersRequest;
use App\Models\Customers;
use App\Models\PackageFeatures;
use App\Models\Schedulers;
use App\Models\Stores;

class SchedulersController extends Controller{

    public function show(Customers $customer, Stores $store,  Schedulers $scheduler){

        $this->authorize('adminView', Schedulers::class);
        return view('admin.Scheduler.show', compact('scheduler', 'customer', 'store'));

    }

    public function edit(Customers $customer, Stores $store, Schedulers $scheduler){

        $this->authorize('adminUpdate', Schedulers::class);
        return view('admin.Scheduler.edit', compact('customer', 'store', 'scheduler'));

    }

    public function update(SchedulersRequest $request, Customers $customer, Stores $store, Schedulers $scheduler){

        $this->authorize('adminUpdate', Schedulers::class);
        
        $scheduler->update($request->validated());
        return redirect()->route('admin.customer.stores.manage', [$customer->uuid, $store->uuid])
                        ->with('message', 'Scheduler updated successfully.');

    }
}
