<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOnFeatureRequest;
use App\Models\AddOnFeatures;
use App\Models\AddOns;
use App\Models\Destination;
use App\Models\Source;

class AddOnFeaturesController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', AddOnFeatures::class);
        $addonfeatures = AddOnFeatures::get();
       
        return view('admin.AddOnFeature.index', compact('addonfeatures'));

    }

    public function create(){

        $this->authorize('adminCreate', AddOnFeatures::class);
        $Sources = Source::get();
        $Destinations = Destination::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnFeature.create', compact('Sources', 'AddOns', 'Destinations'));

    }


    public function store(AddOnFeatureRequest $request){
        
        $this->authorize('adminCreate', AddOnFeatures::class);
        AddOnFeatures::create($request->validated());
        return redirect()->route('admin.addonfeatures.index')
                        ->with('message', 'AddOn feature created successfully.');

    }

    public function show(AddOnFeatures $addonfeature){

        $this->authorize('adminView', AddOnFeatures::class);
        return view('admin.AddOnFeature.show', compact('addonfeature'));

    }

    public function edit(AddOnFeatures $addonfeature){

        $this->authorize('adminUpdate', AddOnFeatures::class);
        $Sources = Source::get();
        $Destinations = Destination::get();
        $AddOns = AddOns::get();
        return view('admin.AddOnFeature.edit', compact('addonfeature', 'AddOns', 'Sources', 'Destinations'));

    }

    public function update(AddOnFeatureRequest $request, AddOnFeatures $addonfeature){

        $this->authorize('adminUpdate', AddOnFeatures::class);
        $addonfeature->update($request->validated());
        return redirect()->route('admin.addonfeatures.index')
                        ->with('message', 'AddOn feature updated successfully.');

    }

    public function destroy(AddOnFeatures $addonfeature){

        $this->authorize('adminDelete', AddOnFeatures::class);
        $addonfeature->delete();
        return redirect()->route('admin.addonfeatures.index')
                        ->with('message', 'AddOn feature deleted successfully.');

    }
}
