<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageFeaturesRequest;
use App\Models\Destination;
use App\Models\Packages;
use App\Models\PackageFeatures;
use App\Models\Source;

class PackageFeaturesController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', PackageFeatures::class);
        $packagefeatures = PackageFeatures::all();
        return view('admin.PackageFeature.index', compact('packagefeatures'));

    }

    public function create(){

        $this->authorize('adminCreate', PackageFeatures::class);
        $Packages = Packages::all();
        $Sources = Source::all();
        $Destinations = Destination::all();
        return view('admin.PackageFeature.create', compact('Packages', 'Sources', 'Destinations'));

    }

    public function store(PackageFeaturesRequest $request){

        $this->authorize('adminCreate', PackageFeatures::class);
        PackageFeatures::create($request->validated());
        return redirect()->route('admin.packagefeatures.index')
                        ->with('message', 'Package features created successfully.');

    }

    public function show(PackageFeatures $packagefeature){

        $this->authorize('adminView', $packagefeature);
        return view('admin.PackageFeature.show', compact('packagefeature'));

    }

    public function edit(PackageFeatures $packagefeature){

        $this->authorize('adminUpdate', PackageFeatures::class);
        $Packages = Packages::all();
        $Sources = Source::all();
        $Destinations = Destination::all();
        return view('admin.PackageFeature.edit', compact('packagefeature', 'Packages', 'Sources', 'Destinations'));

    }

    public function update(PackageFeaturesRequest $request, PackageFeatures $packagefeature){

        $this->authorize('adminUpdate', PackageFeatures::class);
        $packagefeature->update($request->validated());
        return redirect()->route('admin.packagefeatures.index')
                        ->with('message', 'Package features updated successfully.');


    }

    public function destroy(PackageFeatures $packagefeature){

        $this->authorize('adminDelete', PackageFeatures::class);
        $packagefeature->delete();
        return redirect()->route('admin.packagefeatures.index')
                        ->with('message', 'Package features deleted successfully.');

    }
}
