<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payments;

class PaymentController extends Controller{

    public function index(){

        $this->authorize('adminViewAny', Payments::class);
        $payments = Payments::with('subscription')->get();
        return view('admin.Payments.index', compact('payments'));

    }
    public function show(Payments $payment){

        $this->authorize('adminView', $payment);
        return view('admin.Payments.show', compact('payment'));

    }
}
