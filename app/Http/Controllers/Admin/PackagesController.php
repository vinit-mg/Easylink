<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackagesRequest;
use App\Models\Packages;

class PackagesController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', Packages::class);
        $packages = Packages::all();
        return view('admin.Packages.index', compact('packages'));

    }

    public function create(){

        $this->authorize('adminCreate', Packages::class);
        
        return view('admin.Packages.create');

    }

    public function store(PackagesRequest $request){

        $this->authorize('adminCreate', Packages::class);
        $package = Packages::create($request->validated());
        return redirect()->route('admin.packages.index')
                        ->with('message', 'Package created successfully.');

    }

    public function show(Packages $package){

        $this->authorize('adminView', $package);
        return view('admin.Packages.show', compact('package'));

    }

    public function edit(Packages $package){

        $this->authorize('adminUpdate', Packages::class);
        return view('admin.Packages.edit', compact('package'));

    }

    public function update(PackagesRequest $request, Packages $package){

        $this->authorize('adminUpdate', Packages::class);
        $package->update($request->validated());
        return redirect()->route('admin.packages.index')
                        ->with('message', 'Package updated successfully.');


    }

    public function destroy(Packages $package){

        $this->authorize('adminDelete', Packages::class);
        $package->delete();
        return redirect()->route('admin.packages.index')
                        ->with('message', 'Package deleted successfully.');

    }
}
