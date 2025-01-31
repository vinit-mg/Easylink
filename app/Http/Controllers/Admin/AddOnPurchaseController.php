<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOnPurchaseRequest;
use App\Models\AddOnPurchase;
use App\Models\AddOns;
use App\Models\CustomerSubscriptions;

class AddOnPurchaseController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', AddOnPurchase::class);
        $addOnPurchases = AddOnPurchase::get();
       
        return view('admin.AddOnPurchase.index', compact('addOnPurchases'));

    }

    public function create(){

        $this->authorize('adminCreate', AddOnPurchase::class);
        $CustomerSubscriptions = CustomerSubscriptions::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnPurchase.create', compact('CustomerSubscriptions', 'AddOns'));

    }


    public function store(AddOnPurchaseRequest $request){

        $this->authorize('adminCreate', AddOnPurchase::class);
        AddOnPurchase::create($request->validated());
        return redirect()->route('admin.addonpurchase.index')
                        ->with('message', 'AddOnPurchase created successfully.');

    }

    public function show(AddOnPurchase $addonpurchase){

        $this->authorize('adminView', AddOnPurchase::class);
        return view('admin.AddOnPurchase.show', compact('addonpurchase'));

    }

    public function edit(AddOnPurchase $addonpurchase){

        $this->authorize('adminUpdate', AddOnPurchase::class);
        $CustomerSubscriptions = CustomerSubscriptions::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnPurchase.edit', compact('addonpurchase', 'CustomerSubscriptions', 'AddOns'));

    }

    public function update(AddOnPurchaseRequest $request, AddOnPurchase $addonpurchase){

        $this->authorize('adminUpdate', AddOnPurchase::class);
        $addonpurchase->update($request->validated());
        return redirect()->route('admin.addonpurchase.index')
                        ->with('message', 'AddOnPurchase updated successfully.');

    }

    public function destroy(AddOnPurchase $addonpurchase){

        $this->authorize('adminDelete', AddOnPurchase::class);
        $addonpurchase->delete();
        return redirect()->route('admin.addonpurchase.index')
                        ->with('message', 'AddOnPurchase deleted successfully.');

    }
}
