<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SourceSettingsRequest;
use App\Models\PackageFeatures;
use App\Models\Source;
use App\Models\SourceSettings;

class SourceSettingsController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', SourceSettings::class);
        $SourceSettings = SourceSettings::all();
        return view('admin.SourceSettings.index', compact('SourceSettings'));

    }

    public function create(){

        $this->authorize('adminCreate', SourceSettings::class);
        $Sources = Source::get();
        $PackageFeatures = PackageFeatures::get();
        return view('admin.SourceSettings.create', compact('Sources', 'PackageFeatures'));

    }

    public function store(SourceSettingsRequest $request){

        $this->authorize('adminCreate', SourceSettings::class);
        $package = SourceSettings::create($request->validated());
        return redirect()->route('admin.sourcesettings.index')
                        ->with('message', 'Source settings created successfully.');

    }

    public function show(SourceSettings $sourcesetting){

        $this->authorize('adminView', $sourcesetting);
        return view('admin.SourceSettings.show', compact('sourcesetting'));

    }

    public function edit(SourceSettings $sourcesetting){

        $this->authorize('adminUpdate', SourceSettings::class);
        $Sources = Source::get();
        $PackageFeatures = PackageFeatures::get();
        return view('admin.SourceSettings.edit', compact('sourcesetting', 'Sources', 'PackageFeatures'));

    }

    public function update(SourceSettingsRequest $request, SourceSettings $sourcesetting){

        $this->authorize('adminUpdate', SourceSettings::class);
        $sourcesetting->update($request->validated());
        return redirect()->route('admin.sourcesettings.index')
                        ->with('message', 'Source settings updated successfully.');


    }

    public function destroy(SourceSettings $sourcesetting){

        $this->authorize('adminDelete', SourceSettings::class);
        $sourcesetting->delete();
        return redirect()->route('admin.sourcesettings.index')
                        ->with('message', 'Source settings deleted successfully.');

    }
}
