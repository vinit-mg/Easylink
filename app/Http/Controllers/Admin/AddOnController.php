<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOnRequest;
use App\Models\AddOns;

class AddOnController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', AddOns::class);
        $addOns = AddOns::all();
        return view('admin.AddOns.index', compact('addOns'));

    }

    public function create(){

        $this->authorize('adminCreate', AddOns::class);
        return view('admin.AddOns.create');

    }

    public function store(AddOnRequest $request){

        $this->authorize('adminCreate', AddOns::class);
        AddOns::create($request->validated());
        return redirect()->route('admin.addon.index')
                        ->with('message', 'addOn created successfully.');

    }

    public function show(AddOns $addon){

        $this->authorize('adminView', AddOns::class);
        return view('admin.AddOns.show', compact('addon'));

    }

    public function edit(AddOns $addon){

        $this->authorize('adminUpdate', AddOns::class);
        return view('admin.AddOns.edit', compact('addon'));

    }

    public function update(AddOnRequest $request, AddOns $addOn){

        $this->authorize('adminUpdate', AddOns::class);
        $addOn->update($request->validated());
        return redirect()->route('admin.addon.index')
                        ->with('message', 'addOn updated successfully.');
    }

    public function destroy(AddOns $addOn){

        $this->authorize('adminDelete', AddOns::class);
        $addOn->delete();
        return redirect()->route('admin.addon.index')
                        ->with('message', 'addOn deleted successfully.');

    }
}
