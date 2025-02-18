<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationSettingsRequest;
use App\Models\PackageFeatures;
use App\Models\Destination;
use App\Models\DestinationSettings;

class DestinationSettingsController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', DestinationSettings::class);
        $DestinationSettings = DestinationSettings::all();
        return view('admin.DestinationSettings.index', compact('DestinationSettings'));

    }

    public function create(){

        $this->authorize('adminCreate', DestinationSettings::class);
        $Destinations = Destination::get();
        $PackageFeatures = PackageFeatures::get();
        return view('admin.DestinationSettings.create', compact('Destinations', 'PackageFeatures'));

    }

    public function store(DestinationSettingsRequest $request){

        $this->authorize('adminCreate', DestinationSettings::class);
        $package = DestinationSettings::create($request->validated());
        return redirect()->route('admin.destinationsettings.index')
                        ->with('message', 'Destination settings created successfully.');

    }

    public function show(DestinationSettings $destinationsetting){

        $this->authorize('adminView', $destinationsetting);
        return view('admin.DestinationSettings.show', compact('destinationsetting'));

    }

    public function edit(DestinationSettings $destinationsetting){

        $this->authorize('adminUpdate', DestinationSettings::class);
        $Destinations = Destination::get();
        $PackageFeatures = PackageFeatures::get();
        return view('admin.DestinationSettings.edit', compact('destinationsetting', 'Destinations', 'PackageFeatures'));

    }

    public function update(DestinationSettingsRequest $request, DestinationSettings $destinationsetting){

        $this->authorize('adminUpdate', DestinationSettings::class);
        $destinationsetting->update($request->validated());
        return redirect()->route('admin.destinationsettings.index')
                        ->with('message', 'Destination settings updated successfully.');


    }

    public function destroy(DestinationSettings $destinationsetting){

        $this->authorize('adminDelete', DestinationSettings::class);
        $destinationsetting->delete();
        return redirect()->route('admin.destinationsettings.index')
                        ->with('message', 'Destination settings deleted successfully.');

    }
}
