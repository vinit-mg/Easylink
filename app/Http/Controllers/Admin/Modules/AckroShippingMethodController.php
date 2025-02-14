<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\AckroShippingMethodRequest;
use App\Models\Modules\AckroShippingCode;

class AckroShippingMethodController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', AckroShippingCode::class);
        $AckroShippingCodes = AckroShippingCode::get();
        return view('admin.AckroShippingCode.index', compact('AckroShippingCodes'));

    }

    public function create(){

        $this->authorize('adminCreate', AckroShippingCode::class);
        return view('admin.AckroShippingCode.create');

    }


    public function store(AckroShippingMethodRequest $request){
        
        $this->authorize('adminCreate', AckroShippingCode::class);
        AckroShippingCode::create($request->validated());
        return redirect()->route('admin.ackroshippingcodes.index')
                        ->with('message', 'Ackro Shippin Codes created successfully.');

    }

    public function show(AckroShippingCode $ackroshippingcode){

        $this->authorize('adminView', AckroShippingCode::class);
        return view('admin.AckroShippingCode.show', compact('ackroshippingcode'));

    }

    public function edit(AckroShippingCode $ackroshippingcode){

        $this->authorize('adminUpdate', AckroShippingCode::class);
        return view('admin.AckroShippingCode.edit', compact('ackroshippingcode'));

    }

    public function update(AckroShippingMethodRequest $request, AckroShippingCode $ackroshippingcode){

        $this->authorize('adminUpdate', AckroShippingCode::class);
        $ackroshippingcode->update($request->validated());
        return redirect()->route('admin.ackroshippingcodes.index')
                        ->with('message', 'Ackro Shippin Codes updated successfully.');

    }

    public function destroy(AckroShippingCode $ackroshippingcode){

        $this->authorize('adminDelete', AckroShippingCode::class);
        $ackroshippingcode->delete();
        return redirect()->route('admin.ackroshippingcodes.index')
                        ->with('message', 'Ackro Shippin Codes deleted successfully.');

    }
}
